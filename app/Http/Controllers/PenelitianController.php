<?php

namespace App\Http\Controllers;

use App\Models\Rencana;
use App\Models\DetailPendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    public function getAll()
    {
        // Bagian M
        $orasi = Rencana::join('detail_penelitian', 'rencana.id_rencana')
        ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.kategori', 'detail_pendidikan.sks_terhitung', 'rencana.sks_terhitung', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'orasi')
            ->get();
    }
};