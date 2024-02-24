<?php


namespace App\Services;

use App\Enums\Categories;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;

final class ExpenseService
{
    public function __construct(protected Expense $model) {}

    public function store($data): void
    {
        $this->updateWallet($data['wallet_id'], $data['money']);
        $data['money'] = $data['money'] * 100;
        $expense = $this->model->make($data);
        $expense->user()->associate(auth()->user());
        $expense->save();

    }

    public function getOne(Expense $expense): ExpenseResource
    {
        return new ExpenseResource($expense);
    }

    public function updateWallet($walletId, $money):void
    {
        $wallet = auth()->user()->wallets()->findOrFail($walletId);
        $wallet->money -= $money;
        $wallet->save();
    }
}
