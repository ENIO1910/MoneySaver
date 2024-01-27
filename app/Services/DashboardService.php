<?php

namespace App\Services;

use App\Enums\Categories;
use App\Models\Device;
use Carbon\Carbon;

final class DashboardService
{
    public function getBackupsSizeChartData()
    {
        $backupsSizeChart = [
            'labels' => [],
            'datasets' => [],
        ];

        for ($i = 6; $i >= 0; $i--) {
            $backupsSizeChart['labels'][] = now()->subDays($i)->format("m.d");
        }

        $devices = Device::with(['backups' => function ($query) {
            $query->where('status', Categories::SUCCESS)
                ->whereBetween('updated_at', [now()->subDays(6), now()])
                ->with('tables');
        }])->get();

        foreach ($devices as $device) {
            $item = [
                'label' => $device->name,
                'data' => [],
            ];

            // Obliczanie rozmiaru backupu dla każdego dnia
            foreach ($backupsSizeChart['labels'] as $label) {
                $date = Carbon::createFromFormat('m.d', $label);
                $totalSize = $device->backups->filter(function ($backup) use ($date) {
                    return $backup->updated_at->isSameDay($date);
                })->sum(function ($backup) {
                    return $backup->tables->sum('size');
                });

                $item['data'][] = $totalSize;
            }

            $backupsSizeChart['datasets'][] = $item;
        }

        return $backupsSizeChart;
    }
}
