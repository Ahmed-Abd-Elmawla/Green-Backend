<?php

namespace App\Http\Controllers\Api\User\Clients;


use App\Models\Client;
use App\Traits\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Clients\ClientRequest;
use App\Http\Resources\Api\User\Clients\ClientsResource;

use function PHPUnit\Framework\isEmpty;

class ClientsController extends Controller
{
    use Response;

    public function index(Request $request)
    {
        $clients = Client::whereUserId(auth('user')->user()->id)
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%');
            })->get();

        $data = ClientsResource::collection($clients);
        return $this->sendResponse(200, __('api.success'), $data, 200);
    }

    public function show(Client $client)
    {
        return $this->sendResponse(200, __('api.success'), ClientsResource::make($client), 200);
    }

    public function store(ClientRequest $request)
    {
        $data = $request->validated();
        $user = auth('user')->user();
        if (!$user) {
            return $this->sendResponse(401, __('api.not_auth_login'), null, 401);
        }
        $data['user_id'] = $user->id;
        Client::create($data);
        return $this->sendResponse(200, __('api.added_success'), null, 200);
    }
}
