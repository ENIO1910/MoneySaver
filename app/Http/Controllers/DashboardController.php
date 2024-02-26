<?php

namespace App\Http\Controllers;

use App\Enums\Categories;
use App\Http\Resources\BackupResource;
use App\Models\Backup;
use App\Models\Device;
use App\Services\DashboardService;
use App\Services\ExpenseService;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct(protected DashboardService $dashboardService,
    protected ExpenseService $expenseService) {}

    public function __invoke()
    {

        return Inertia::render('Dashboard/Show', [
            'categories' => Categories::getDescriptions(),
            'thisMonthStats' => $this->expenseService->getThisMonthStats(),
        ]);
    }


    public function uikitButtonsTest ()
    {
        return Inertia::render('Uikit/Button');
    }
}
