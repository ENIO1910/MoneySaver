<?php


namespace App\Services;

use App\Enums\Categories;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use Cknow\Money\Money;

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

    public function getThisMonthStats(): array
    {
        $expenses = auth()->user()->expenses()
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->get();

        $total = $expenses->sum('money');
        $categories = $expenses->groupBy('category')->map(function ($category) {
            $amount = Money::PLN($category->sum('money'))->getAmount()/100;
            $stringifyAmount = number_format($amount, 2, ',', ' ');
            $categoryEnum = Categories::from($category->first()->category);
            $categoryDescription = $categoryEnum->getDescription();
             return [
                 'amount' => $amount,
                 'string' => $stringifyAmount,
                 'description' => $categoryDescription,

             ];
        });

        $total = Money::PLN($total)->getAmount()/100;
        return [
             'total' => number_format($total, 2, ',', ' '),
             'categories' => $categories,
            ];

    }
}
