<?php


namespace App\Services;

use App\Enums\Categories;
use App\Http\Resources\MessageResource;
use App\Models\Expense;
use App\Models\Message;
use App\Models\Wallet;
use Illuminate\Support\Facades\Gate;

final class WalletService
{
    public function __construct(protected Wallet $model) {}
    public function store($data): void
    {
        $data['user_id'] = auth()->user()->id;
        $this->model->create($data);

    }


    public function updateWallet(int $money):void
    {

    }

    public function destroy(int $id): void
    {
        $model = Wallet::findOrFail($id);
        Gate::authorize('delete', $model);
        $model->delete();
    }

    public function deposit(int $walletId, array $data): void
    {
        $model = Wallet::findOrFail($walletId);
        Gate::authorize('update', $model);
        $model->update(['money' => $model->money + $data['money']]);
    }
}
