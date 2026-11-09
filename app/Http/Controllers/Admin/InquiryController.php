<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InquiryController extends Controller
{
    /**
     * Tampilkan daftar pesan & konsultasi perjalanan dari calon klien
     */
    public function index(Request $request): Response
    {
        $query = Inquiry::with('tourPackage:id,title')
            ->when($request->search, function ($q, $search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('message', 'like', "%{$search}%");
                });
            })
            ->when($request->status, function ($q, $status) {
                $q->where('status', $status);
            })
            ->latest('id');

        $inquiries = $query->paginate(10)->withQueryString()->through(function ($inq) {
            $cleanPhone = preg_replace('/[^0-9]/', '', $inq->phone);
            if (str_starts_with($cleanPhone, '0')) {
                $cleanPhone = '62' . substr($cleanPhone, 1);
            }

            return [
                'id' => $inq->id,
                'name' => $inq->name,
                'phone' => $inq->phone,
                'whatsapp_url' => "https://wa.me/{$cleanPhone}?text=" . rawurlencode("Halo {$inq->name}, terima kasih telah menghubungi Nirwana Tour Lampung terkait konsultasi perjalanan."),
                'email' => $inq->email,
                'participants' => $inq->participants ?? 1,
                'travel_date' => $inq->travel_date ? date('d M Y', strtotime($inq->travel_date)) : '-',
                'message' => $inq->message,
                'status' => $inq->status,
                'package_title' => $inq->tourPackage?->title ?? 'Konsultasi Kustom / Umum',
                'created_at' => $inq->created_at ? $inq->created_at->diffForHumans() : '-',
            ];
        });

        return Inertia::render('Inquiries/Index', [
            'inquiries' => $inquiries,
            'filters' => [
                'search' => $request->search ?? '',
                'status' => $request->status ?? '',
            ],
            'statusCounts' => [
                'all' => Inquiry::count(),
                'pending' => Inquiry::where('status', 'pending')->count(),
                'contacted' => Inquiry::where('status', 'contacted')->count(),
                'completed' => Inquiry::where('status', 'completed')->count(),
            ],
        ]);
    }

    /**
     * Ubah status penanganan pesan (pending, contacted, completed, cancelled)
     */
    public function updateStatus(Request $request, Inquiry $inquiry): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,contacted,completed,cancelled',
        ]);

        $inquiry->update($validated);

        return back()->with('success', "Status pesan dari {$inquiry->name} telah diperbarui.");
    }

    /**
     * Export data pesan & prospek konsultasi ke CSV (kompatibel Excel)
     */
    public function exportCsv(Request $request): StreamedResponse
    {
        $filename = 'data-inquiry-nirwana-' . date('Y-m-d-His') . '.csv';

        $query = Inquiry::with('tourPackage:id,title')
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->latest('id');

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () use ($query) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF");

            fputcsv($handle, [
                'ID',
                'Nama Klien',
                'Nomor WhatsApp / Telp',
                'Email',
                'Jumlah Peserta',
                'Rencana Tanggal',
                'Paket Yang Diminati',
                'Status Penanganan',
                'Pesan / Catatan',
                'Waktu Masuk',
            ]);

            $query->chunk(100, function ($inquiries) use ($handle) {
                foreach ($inquiries as $inq) {
                    fputcsv($handle, [
                        $inq->id,
                        $inq->name,
                        $inq->phone,
                        $inq->email ?? '-',
                        $inq->participants ?? 1,
                        $inq->travel_date ? date('Y-m-d', strtotime($inq->travel_date)) : '-',
                        $inq->tourPackage?->title ?? 'Konsultasi Kustom / Umum',
                        ucfirst($inq->status ?? 'pending'),
                        $inq->message ?? '',
                        $inq->created_at ? $inq->created_at->format('Y-m-d H:i:s') : '-',
                    ]);
                }
            });

            fclose($handle);
        }, 200, $headers);
    }

    /**
     * Hapus pesan masuk
     */
    public function destroy(Inquiry $inquiry): RedirectResponse
    {
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Pesan konsultasi telah berhasil dihapus.');
    }

    /**
     * Hapus banyak pesan sekaligus (Bulk Delete)
     */
    public function bulkDelete(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:inquiries,id',
        ]);

        $count = Inquiry::whereIn('id', $validated['ids'])->delete();

        return redirect()->route('admin.inquiries.index')
            ->with('success', "{$count} pesan konsultasi berhasil dihapus sekaligus.");
    }
}
