<?php

namespace App\Http\Controllers;

use App\Enums\Categories;
use App\Http\Resources\BackupResource;
use App\Models\Backup;
use App\Models\Device;
use App\Services\DashboardService;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct(protected DashboardService $service) {}

    public function __invoke()
    {

        return Inertia::render('Dashboard/Show', [
            'lastBackupDate' => "Brak",
            'nextBackupDate' => "Brak",
            'backupsInProgressCount' => 0,
            'backupsSuccessCount' => 0,
            'backupsFailCount' => 0,
        ]);
    }


    public function uikitButtonsTest ()
    {
        return Inertia::render('Uikit/Button');
    }
}
