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
        $jenis_pengabdian = $request->get("jenis_pengabdian");

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
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . $id_dosen . '_' . $jenis_pengabdian . time() . '.' . $extension;
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
        if ($rencana->lampiran == null) {
            $rencana->lampiran = [];
        } else {
            $rencana->lampiran = json_decode($rencana->lampiran);
        }

        $rencana->lampiran = json_encode(array_merge($rencana->lampiran, $filenames));

        $rencana->save();

        $res = [
            "rencana" => $rencana,
            "message" => "Lampiran added successfully"
        ];

        return response()->json($res, 202);

    }
    //END OF HANDLER POST LAMPIRAN

    //HANDLER GET LAMPIRAN (DOWNLOAD LAMPIRAN WITH ENCODED BASE64 URL)
    public function getFileLampiran($fileName)
    {
        $file = base64_decode($fileName);
        $filePath = storage_path('documents/pengabdian/' . $file);

        $name = basename($filePath);
        $mimeType = mime_content_type($filePath);

        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $name . '"'
        ]);
    }

    //HANDLER DELETE LAMPIRAN (DELETE LAMPIRAN WITH ENCODED BASE64 URL)
    public function deleteFileLampiran($idRencana, $fileName)
    {
        $rencana = Rencana::where('id_rencana', $idRencana)->first();
        $fileName = base64_decode($fileName);

        $lampiran = json_decode($rencana->lampiran);

        $result = array_filter($lampiran, function ($value) use ($fileName) {
            return $value !== $fileName;
        });

        if(sizeof(array_values($result)) == sizeof($lampiran)){
            return response()->json(["error_message" => "file not found"], 404);
        }

        $lampiran = array_values($result);

        unlink(storage_path("documents/pengabdian/" . $fileName));

        if(sizeof($lampiran) == 0){
            $rencana->lampiran = null;
        } else {
            // Encode the array back to JSON if needed
            $rencana->lampiran = json_encode($lampiran);
        }

        // Save the changes to the database if $rencana is an Eloquent model
        $rencana->save();

        return response()->json($lampiran, 200);
    }
}