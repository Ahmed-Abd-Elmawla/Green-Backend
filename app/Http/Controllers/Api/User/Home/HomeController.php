<?php

namespace App\Http\Controllers\Api\User\Home;


use App\Models\Client;
use App\Models\Product;
use App\Traits\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\Clients\ClientsResource;
use App\Http\Resources\Api\User\Products\ProductsResource;


class HomeController extends Controller
{
    use Response;

    public function clients(Request $request)
    {
        $clients = Client::where('user_id', auth('user')->user()->id)
                 ->latest()
                 ->take(10)
                 ->get();

        $data = ClientsResource::collection($clients);
        return $this->sendResponse(200, __('api.success'), $data, 200);
    }

    public function products(Request $request)
    {
        $products = Product::latest()->take(10)->get();

        $data = ProductsResource::collection($products);
        return $this->sendResponse(200, __('api.success'), $data, 200);
    }
}
