<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;

class MaintenanceController extends Controller
{
    /**
     * Tampilkan Halaman Pengaturan & Tombol Kontrol Maintenance
     */
    public function index(): View
    {
        $isDown = app()->isDownForMaintenance();
        $maintenanceData = [];

        if ($isDown) {
            try {
                $maintenanceData = (array) app()->maintenanceMode()->data();
            } catch (\Throwable $e) {
                $maintenanceData = [];
            }
        }

        return view('admin.maintenance', [
            'isDown' => $isDown,
            'maintenanceData' => $maintenanceData,
            'siteName' => config('app.name', 'Nirwana Tour Lampung'),
        ]);
    }

    /**
     * Proses Aktifkan / Matikan Mode Maintenance
     */
    public function toggle(Request $request): RedirectResponse
    {
        $action = $request->input('action');

        if ($action === 'enable') {
            $secret = trim($request->input('secret') ?: 'nirwana2026');
            // Bersihkan format secret key agar aman digunakan di URL
            $secret = preg_replace('/[^a-zA-Z0-9\-_]/', '', $secret);
            if (empty($secret)) {
                $secret = 'nirwana2026';
            }

            try {
                Artisan::call('down', [
                    '--render' => 'errors.503',
                    '--secret' => $secret,
                ]);

                return back()->with(
                    'success',
                    "Mode Maintenance BERHASIL DIAKTIFKAN! Pengunjung umum kini melihat halaman 503. Panel admin tetap aktif, dan Anda dapat melakukan bypass via: " . url('/' . $secret)
                );
            } catch (\Throwable $e) {
                return back()->with('error', 'Gagal mengaktifkan mode maintenance: ' . $e->getMessage());
            }
        } else {
            try {
                Artisan::call('up');

                return back()->with('success', 'Mode Maintenance BERHASIL DIMATIKAN! Website Nirwana Tour Lampung kini kembali ONLINE normal untuk semua pengunjung.');
            } catch (\Throwable $e) {
                return back()->with('error', 'Gagal mematikan mode maintenance: ' . $e->getMessage());
            }
        }
    }
}
