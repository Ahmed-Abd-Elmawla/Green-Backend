<?php

namespace App\Http\Controllers\Api\User\Collections;

use Throwable;
use App\Models\Client;
use App\Traits\Response;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Helpers\sendNotification;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Collections\CollectionRequest;
use App\Http\Resources\Api\User\Collections\CollectionResource;

class CollectionsController extends Controller
{
    use Response;

    public function index(Request $request){
        $collections = Collection::where('user_id', auth('user')->user()->id)
            ->whereHas('Client', function($query) use ($request) {
                $query->where('uuid', 'LIKE', '%' . $request->client_id . '%');
            })->latest()->paginate();

        return CollectionResource::collection($collections)->additional([
            'status' => 200,
            'message' =>  __('api.success'),
        ]);
    }

    public function store(CollectionRequest $request)
    {
        $data = $request->safe()->except('client_id');
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

        DB::beginTransaction();
        try {

            $collection = Collection::create($data);

            self::updateClient($client, $request);

            DB::commit();
            sendNotification::newCollectionNotify();
            return $this->sendResponse(200, __('api.invoice.collection_successfully_created'), CollectionResource::make($collection), 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->sendResponse(500, __('api.error'), null, 500);
        }
    }

    private static function updateClient($client, $request)
    {
            $client->balance += $request->amount;
            $client->net_account = $client->balance - $client->dues;
            $client->save();
    }
}
