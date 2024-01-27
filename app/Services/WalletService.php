<?php


namespace App\Services;

use App\Enums\Categories;
use App\Models\Expense;
use App\Models\Wallet;

final class WalletService
{
    public function __construct(protected Wallet $model) {}
    public function store($data): void
    {
        $data['user_id'] = auth()->user()->id;
        $this->model->create($data);

    }
    public function updateWallet($walletId, $money):void
    {
        $wallet = auth()->user()->wallets()->where('id', $walletId)->first();
        $wallet->money -= $money;
        $wallet->save();
    }
}
