<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $user = Auth::user();
        $query = DB::table('transaksi_setor')
            ->where('nasabah_id', $user->id);
        // Filter bulan dan tahun
        if ($request->filled('bulan')) {
            $query->whereMonth('tgl_setor', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('tgl_setor', $request->tahun);
        }
        $transaksi = $query->orderByDesc('tgl_setor')->paginate(10);
        $transaksi->getCollection()->transform(function ($trx) {
            // detil_sampah bisa berupa string json atau string biasa, handle keduanya
            $detil = [];
            if (!empty($trx->detil_sampah)) {
                $decoded = json_decode($trx->detil_sampah, true);
                if (is_array($decoded)) {
                    $detil = collect($decoded)->map(function($item) {
                        if (is_array($item) && isset($item['jenis_sampah'], $item['jumlah'], $item['satuan'])) {
                            return $item;
                        } elseif (is_string($item)) {
                            $matches = [];
                            if (preg_match('/^(.+?)\s+(\d+(?:[.,]\d+)?)\s*(\w+)?$/u', trim($item), $matches)) {
                                return [
                                    'jenis_sampah' => $matches[1] ?? '-',
                                    'jumlah' => $matches[2] ?? '-',
                                    'satuan' => $matches[3] ?? '',
                                ];
                            } else {
                                return [
                                    'jenis_sampah' => trim($item),
                                    'jumlah' => '-',
                                    'satuan' => '',
                                ];
                            }
                        } else {
                            return [
                                'jenis_sampah' => $item['jenis_sampah'] ?? '-',
                                'jumlah' => $item['jumlah'] ?? '-',
                                'satuan' => $item['satuan'] ?? '',
                            ];
                        }
                    })->toArray();
                } else {
                    $detil = collect(explode(',', $trx->detil_sampah))->map(function($item) {
                        $matches = [];
                        if (preg_match('/^(.+?)\s+(\d+(?:[.,]\d+)?)\s*(\w+)?$/u', trim($item), $matches)) {
                            return [
                                'jenis_sampah' => $matches[1] ?? '-',
                                'jumlah' => $matches[2] ?? '-',
                                'satuan' => $matches[3] ?? '',
                            ];
                        } else {
                            return [
                                'jenis_sampah' => trim($item),
                                'jumlah' => '-',
                                'satuan' => '',
                            ];
                        }
                    })->toArray();
                }
            }
            $trx->detil_sampah = $detil;
            return $trx;
        });
        // Untuk dropdown tahun
        $tahunList = DB::table('transaksi_setor')
            ->selectRaw('YEAR(tgl_setor) as tahun')
            ->where('nasabah_id', $user->id)
            ->groupBy('tahun')
            ->orderByDesc('tahun')
            ->pluck('tahun');
        return view('user.transaksi.index', compact('transaksi', 'tahunList'));
    }
}
