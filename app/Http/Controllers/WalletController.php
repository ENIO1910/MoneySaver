<?php

namespace App\Http\Controllers;

use App\Http\Resources\WalletResource;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WalletController extends Controller
{
    public function index()
    {
        return Inertia::render('Wallet/List', [
            'wallets' => WalletResource::collection(auth()->user()->wallets()->orderBy('id', 'asc')->get()),
        ]);
    }
}
