<?php

namespace App\Http\Controllers;


use App\Http\Requests\ExpenseStoreRequest;
use App\Http\Resources\DeviceResource;
use App\Http\Resources\ExpenseResource;
use App\Models\Device;
use App\Models\Expense;
use App\Services\DeviceService;
use App\Services\ExpenseService;
use Inertia\Inertia;

class ExpenseController extends Controller
{
    public function __construct(protected ExpenseService $service){}

    public function index()
    {
        return Inertia::render('Expense/List', [
            'expenses' => ExpenseResource::collection(auth()->user()->expenses()->orderBy('id', 'desc')->get())
        ]);
    }

    public function create()
    {
        return Inertia::render('Expense/Create', [
            'wallets' => auth()->user()->wallets,
        ]);
    }

    public function store(ExpenseStoreRequest $request)
    {
        $result = $this->service->store($request->validated());
        return Inertia::render('Expense/Create', [
            'wallets' => auth()->user()->wallets,
        ]) ;
    }

    public function show(Expense $expense)
    {
        return Inertia::render('Expense/Edit', [
            'expense' => $this->service->getOne($expense),
        ]);
    }
    public function edit(Expense $expense)
    {
        return Inertia::render('Expense/Edit', [
            'expense' => $this->service->getOne($expense),
            'wallets' => auth()->user()->wallets,
        ]);
    }

}
