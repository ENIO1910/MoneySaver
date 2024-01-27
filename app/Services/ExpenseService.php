<?php


namespace App\Services;

use App\Enums\Categories;
use App\Models\Expense;

final class ExpenseService
{
    public function __construct(protected Expense $model) {}
    public function store($data): string
    {
        $data['user_id'] = auth()->user()->id;
        $this->updateWallet($data['wallet_id'], $data['money']);
        $this->model->create($data);

        return 'Udało się dodać wydatek';
    }
    public function updateWallet($walletId, $money):void
    {
        $wallet = auth()->user()->wallets()->where('id', $walletId)->first();
        $wallet->money -= $money;
        $wallet->save();
    }
}
