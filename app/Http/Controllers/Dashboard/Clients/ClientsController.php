<?php

namespace App\Http\Controllers\Dashboard\Clients;

use App\Models\Client;
use App\Traits\ShowToast;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Clients\ClientRequest;
use App\Http\Resources\Dashboard\Clients\ClientResource;
use App\Http\Requests\Dashboard\Clients\ClientUpdateRequest;

class ClientsController extends Controller
{
    use ShowToast;

    public function index(Request $request)
    {
        $clients = Client::when($request->search, function ($q) use ($request) {
            $q->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('email', 'LIKE', '%' . $request->search . '%');
        })->with(['user'])->latest()->paginate();
        $clientsData = ClientResource::collection($clients);
        // return response()->json($clientsData);
        return view('pages.Clients.clients', compact('clientsData'));
    }

    public function store(ClientRequest $request)
    {
        try {
        $validatedData = $request->validated();
        Client::create($validatedData );
        $this->showToast(__('dashboard.client.successfully_created'));
        return response()->json(['success' => true], 200);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => '__(\'dashboard.validation.went_wrong\'): ' . $e->getMessage()], 500);
    }
    }

    public function update(ClientUpdateRequest $request, Client $client)
    {
        {
            try {
                $validatedData = $request->validated();

                $client->update($validatedData);

                $this->showToast(__('dashboard.client.successfully_updated'));

                return response()->json(['success' => true], 200);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'error' => '__(\'dashboard.validation.went_wrong\'): ' . $e->getMessage()], 500);
            }
        }
    }

    public function destroy(Client $client)
    {
        $client->delete();
        $this->showToast(__('dashboard.client.successfully_deleted'));
        return redirect()->back();
    }
}

