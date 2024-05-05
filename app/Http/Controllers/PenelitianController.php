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

        // Kembalikan data dalam bentuk yang sesuai untuk ditampilkan di halaman
        return response()->json([
            'orasi' => $orasi
        ], 200);
    }

    public function getOrasi($id)
    {
        $orasi = Rencana::join('detail_pendidikan', 'rencana.id_rencana', '=', 'detail_pendidikan.id_rencana')
            ->select('rencana.id_rencana', 'rencana.nama_kegiatan', 'detail_pendidikan.kategori', 'detail_pendidikan.sks_terhitung', 'rencana.sks_terhitung', 'rencana.lampiran')
            ->where('rencana.sub_rencana', 'orasi')
            ->where('id_dosen', $id)
            ->get();

        return response()->json($orasi, 200);
    }

    public function postOrasi(Request $request)
    {
        $request->all();
        $id_rencana = $request->get('id_rencana');

        $rencana = Rencana::where('id_rencana', $id_rencana)->first();
        $id_dosen = $rencana->id_dosen;

        $filenames = [];

        if ($request->file()) {

            $files = $request->file('fileInput');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .'_' . $id_dosen . '_pendidikan_' . time() . '.' . $extension;
                    $file->move(app()->basePath('storage/documents/pendidikan'), $filename);
                    $filenames[] = $filename;
                } else {
                    continue;
                }
            }
        } else {
            return 'Tidak ada file yang dipilih.';
        }

        $rencana->lampiran = $filenames;
        $rencana->save();

        $res = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 200);
    }

    public function editOrasi(Request $request)
    {
        
    }

    public function deleteOrasi($id)
    {
        
    }
    //END OF METHOD A

};