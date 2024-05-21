<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPengabdian;
use App\Models\Rencana;


class PengabdianController extends Controller
{
    //HANDLER UPLOAD LAMPIRAN
    public function postLampiran(Request $request){
        // Retrieve the id_rencana from the request payload
        $id_rencana = $request->get('id_rencana');
        $jenis_penelitian = $request->get("jenis_pengabdian");

        // Check if Rencana exists with the provided id_rencana
        $rencana = Rencana::where('id_rencana', $id_rencana)->first();

        if (!$rencana) {
            return response()->json(['error' => 'Rencana not found'], 404);
        }

        $id_dosen = $rencana->id_dosen;

        $filenames = [];

        if ($request->hasFile('fileInput')) {
            $files = $request->file('fileInput');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . $id_dosen . '_' . $jenis_penelitian . time() . '.' . $extension;
                    $file->move(app()->basePath('storage/documents/pengabdian'), $filename);
                    $filenames[] = $filename;
                } else {
                    return response()->json(['error' => 'Something went wrong'], 401);
                }
            }
        } else {
            return response()->json(['error' => 'No files selected'], 400);
        }

        // Update $rencana->lampiran with new filenames
        $rencana->lampiran = is_array($rencana->lampiran) ? $rencana->lampiran : [];
        $rencana->lampiran = array_merge($rencana->lampiran, $filenames);

        $rencana->save();

        $res = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 202);

    }
    //END OF HANDLER POST LAMPIRAN
}