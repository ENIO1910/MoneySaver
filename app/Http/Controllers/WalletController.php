<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseStoreRequest;
use App\Http\Requests\WalletStoreRequest;
use App\Http\Resources\WalletResource;
use App\Models\Wallet;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WalletController extends Controller
{

    public function __construct(protected WalletService $service){}

    public function index()
    {
        return Inertia::render('Wallet/List', [
            'wallets' => WalletResource::collection(auth()->user()->wallets()->orderBy('id', 'asc')->get()),
        ]);
    }

    public function create()
    {
        return Inertia::render('Wallet/Create');
    }


    public function store(WalletStoreRequest $request): \Inertia\Response
    {
        $this->service->store($request->validated());
        return Inertia::render('Wallet/List', [
            'wallets' =>  WalletResource::collection(auth()->user()->wallets()->orderBy('id', 'asc')->get()),
        ]) ;
    }

    public function destroy(int $id): \Inertia\Response
    {
        $this->service->destroy($id);
        return Inertia::render('Wallet/List', [
            'wallets' =>  WalletResource::collection(auth()->user()->wallets()->orderBy('id', 'asc')->get()),
        ]) ;
    }
}
