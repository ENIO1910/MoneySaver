<?php


namespace App\Services;

use App\Enums\Categories;
use App\Models\Expense;

final class ExpenseService
{
    public function __construct(protected Expense $model) {}
    public function store($data): void
    {
        $data['user_id'] = auth()->user()->id;
        $this->updateWallet($data['wallet_id'], $data['money']);
        $this->model->create($data);
    }
    public function updateWallet($walletId, $money):void
    {
        $wallet = auth()->user()->wallets()->where('id', $walletId)->first();
        $wallet->money -= $money;
        $wallet->save();
    }
}
