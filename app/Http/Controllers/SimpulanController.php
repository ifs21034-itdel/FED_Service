<?php

namespace App\Http\Controllers;

use App\Models\Rencana;
use Illuminate\Http\Request;

class SimpulanController extends Controller
{
    public function getAll($id){
        try {
            $totalSksPendidikan = Rencana::where('id_dosen', $id)->where("jenis_rencana", "pendidikan")->whereNotNull("lampiran")->sum("sks_terhitung");
            $totalSksPenelitian = Rencana::where('id_dosen', $id)->where("jenis_rencana", "penelitian")->whereNotNull("lampiran")->sum("sks_terhitung");
            $totalSksPengabdian = Rencana::where('id_dosen', $id)->where("jenis_rencana", "pengabdian")->whereNotNull("lampiran")->sum("sks_terhitung");
            $totalSksPenunjang = Rencana::where('id_dosen', $id)->where("jenis_rencana", "penunjang")->whereNotNull("lampiran")->sum("sks_terhitung");
            $sksTotal = $totalSksPendidikan + $totalSksPenelitian + $totalSksPengabdian + $totalSksPenunjang;

            $res = [
                "sks_pendidikan" => $totalSksPendidikan,
                "sks_penelitian" => $totalSksPenelitian,
                "sks_pengabdian" => $totalSksPengabdian,
                "sks_penunjang" => $totalSksPenunjang,
                "sks_total" => $sksTotal
            ];

            return response()->json($res, 200);

        } catch(\Throwable $th) {
            return response()->json(['error' => 'Failed to retrieve data from database'], 500);
        }
    }
}
