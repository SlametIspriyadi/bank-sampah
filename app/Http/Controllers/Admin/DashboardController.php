<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sampah;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $nasabahCount = User::where('role', 'nasabah')->count();
        $transaksiCount = \App\Models\Transaksi::count();

        // Hitung total pendapatan seluruh nasabah dikurangi total penarikan
        $totalPendapatan = \App\Models\Transaksi::sum('total_pendapatan') - \App\Models\TransaksiTarik::sum('jumlah_tarik');

        // Data grafik bulanan (tahun ini)
        $year = date('Y');
        $bulanLabels = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ];
        $bulanData = array_fill(0, 12, 0);
        $bulanan = \App\Models\Transaksi::selectRaw('MONTH(tgl_setor) as bulan, COUNT(*) as jumlah')
            ->whereYear('tgl_setor', $year)
            ->groupBy('bulan')
            ->pluck('jumlah', 'bulan');
        foreach ($bulanan as $bulan => $jumlah) {
            $bulanData[$bulan-1] = (int)$jumlah; // pastikan integer
        }

        // Data grafik tahunan (5 tahun terakhir)
        $tahunLabels = [];
        $tahunData = [];
        $tahunSekarang = (int)date('Y');
        for ($i = $tahunSekarang-4; $i <= $tahunSekarang; $i++) {
            $tahunLabels[] = (string)$i;
            $tahunData[] = (int)\App\Models\Transaksi::whereYear('tgl_setor', $i)->count(); // pastikan integer
        }

        return view('admin.dashboard', compact(
            'nasabahCount',
            'transaksiCount',
            'totalPendapatan',
            'bulanLabels',
            'bulanData',
            'tahunLabels',
            'tahunData'
        ));
    }
}
