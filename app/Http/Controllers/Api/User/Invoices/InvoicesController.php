<?php

namespace App\Http\Controllers\Api\User\Invoices;

use Throwable;
use App\Models\Client;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Invoices\InvoiceRequest;
use App\Http\Resources\Api\User\Invoices\InvoicesResource;
use App\Http\Resources\Api\User\Invoices\InvoicesMiniResource;
use App\Models\Invoice;
use App\Models\Product;

use function PHPUnit\Framework\isEmpty;

class InvoicesController extends Controller
{
    use Response;

    public function index(Request $request){
        $invoices = Invoice::where('user_id', auth('user')->user()->id)
            ->whereHas('client', function($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('code', 'LIKE', '%' . $request->search . '%');
            })
            ->when($request->payment_type, function ($q) use ($request) {
                $q->where('payment_type', 'LIKE', '%'. $request->payment_type. '%');
            })->latest()->paginate();

        return InvoicesMiniResource::collection($invoices)->additional([
            'status' => 200,
            'message' =>  __('api.success'),
        ]);
    }

    public function show(Invoice $invoice){
        return $this->sendResponse(200, __('api.success'), InvoicesResource::make($invoice), 200);
    }

    public function store(InvoiceRequest $request)
    {
        $data = $request->safe()->except('invoiceItems', 'client_id');
        $user = auth('user')->user();
        if (!$user) {
            return $this->sendResponse(401, __('api.not_auth_login'), null, 401);
        }
        $client = Client::where('uuid', $request->client_id)->first();
        if (!$client) {
            return $this->sendResponse(422, __('api.invoice.client_not_found'), null, 422);
        };
        $data['user_id'] = $user->id;
        $data['client_id'] = $client->id;

        $stock = self::checkStock($request->invoiceItems);
        if (!$stock) {
            return $this->sendResponse(422, __('api.invoice.not_enough_stock'), null, 422);
        }

        DB::beginTransaction();
        try {

            self::changeStock($request->invoiceItems);

            $invoice = Invoice::create($data);

            if (isset($request->invoiceItems) && count($request->invoiceItems)) {
                foreach ($request->invoiceItems as $invoiceItem) {
                    $product_id = Product::where('uuid', $invoiceItem['product_id'])->first()->id;
                    $invoice->products()->attach($product_id, ['quantity' => $invoiceItem['quantity'], 'price' => $invoiceItem['price']]);
                }
            }

            self::updateClient($client, $request);

            DB::commit();
            return $this->sendResponse(200, __('api.invoice.successfully_created'), InvoicesResource::make($invoice), 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->sendResponse(500, __('api.error'), null, 500);
        }
    }

    private static function checkStock($products)
    {
        foreach ($products as $product) {
            $stock = Product::where('uuid', $product['product_id'])->value('stock');
            if ($stock == 0 || $stock < $product['quantity']) {
                return false;
            }
        }
        return true;
    }

    private static function changeStock($products)
    {
        foreach ($products as $product) {
            $productInfo = Product::where('uuid', $product['product_id'])->first();
            $productInfo->stock -= $product['quantity'];
            $productInfo->save();
        }
    }

    private static function updateClient($client, $request)
    {
        if ($request->payment_type === 'cash') {
            $client->dues += $request->total_amount;
            $client->balance += $request->total_amount;
            $client->save();
        } elseif ($request->payment_type === 'postpaid') {
            $client->dues += $request->total_amount;
            if (is_null($request->paid) || $request->paid == 0) {
                $client->net_account -= $request->total_amount;
                $client->save();
            }else{
                $client->balance += $request->paid;
                $client->net_account -= $request->remaining;
                $client->save();
            }
        }
    }
}
