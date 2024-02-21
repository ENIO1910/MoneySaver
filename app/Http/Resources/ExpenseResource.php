<?php

namespace App\Http\Resources;

use App\Enums\Categories;
use Cknow\Money\Money;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'money' => Money::PLN($this->money)->format('pl'),
            'category' => Categories::from($this->category)->getDescription(),
            'created_at' => $this->created_at?->format('Y.m.d H:i:s')??'-',
            'wallet' => new WalletResource($this->wallet)
        ];
    }
}
