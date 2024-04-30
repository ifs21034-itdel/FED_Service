<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\PenunjangController;
use App\Http\Controllers\PenelitianController;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    //PENDIDIKAN START
    $router->get('/pendidikan', 'PendidikanController@getAll');

    //START ROUTE FOR PENDIDIKAN
    $router->group(['prefix' => 'pendidikan'], function () use ($router) {
        //teori
        $router->get('/teori/{id}', 'PendidikanController@getTeori');
        $router->post('/teori', 'PendidikanController@postTeori');
        $router->delete('/teori/{id}', 'PendidikanController@deleteTeori');
        $router->post('/edit/teori', 'PendidikanController@editTeori');

        //praktikum
        $router->get('/praktikum/{id}', 'PendidikanController@getPraktikum');
        $router->post('/praktikum', 'PendidikanController@postPraktikum');
        $router->delete('/praktikum/{id}', 'PendidikanController@deletePraktikum');
        $router->post('/edit/praktikum', 'PendidikanController@editPraktikum');
        
        //bimbingan
        $router->get('/bimbingan/{id}', 'PendidikanController@getBimbingan');
        $router->post('/bimbingan', 'PendidikanController@postBimbingan');
        $router->delete('/bimbingan/{id}', 'PendidikanController@deleteBimbingan');
        $router->post('/edit/bimbingan', 'PendidikanController@editBimbingan');
        
        //seminar
        $router->get('/seminar/{id}', 'PendidikanController@getSeminar');
        $router->post('/seminar', 'PendidikanController@postSeminar');
        $router->delete('/seminar/{id}', 'PendidikanController@deleteSeminar');
        $router->post('/edit/seminar', 'PendidikanController@editSeminar');
        
        //Tugas Akhir
        $router->get('/tugasAkhir/{id}', 'PendidikanController@getTugasakhir');
        $router->post('/tugasAkhir', 'PendidikanController@postTugasakhir');
        $router->delete('/tugasAkhir/{id}', 'PendidikanController@deleteTugasakhir');
        $router->post('/edit/tugasAkhir', 'PendidikanController@editTugasakhir');
        
        //Proposal

        // rendah

        // Kembang

        // CANGKOK

        //KOORDINATOR
    });
    //END ROUTE FOR PENDIDIKAN

    //START ROUTE FOR PENUNJANG
    $router->group(['prefix' => 'penunjang'], function () use ($router) {
        // Bagian A
        $router->get('/akademik/{id}', 'penunjang_controller@getAkademik');
        $router->post('/akademik', 'penunjang_controller@postAkademik');
        $router->post('/edit/akademik', 'penunjang_controller@editAkademik');
        $router->delete('/akademik/{id}', 'penunjang_controller@deleteAkademik');
        // END OF BAGIAN A

        //BAGIAN B
        $router->get('/bimbingan/{id}', 'penunjang_controller@getBimbingan');
        $router->post('/bimbingan', 'penunjang_controller@postBimbingan');
        $router->post('/edit/bimbingan', 'penunjang_controller@editBimbingan');
        $router->delete('/bimbingan/{id}', 'penunjang_controller@deleteBimbingan');
        //END OF BAGIAN B

        //BAGIAN C
        $router->get('/ukm/{id}', 'penunjang_controller@getUkm');
        $router->post('/ukm', 'penunjang_controller@postUkm');
        $router->post('/edit/ukm/', 'penunjang_controller@editUkm');
        $router->delete('/ukm/{id}', 'penunjang_controller@deleteUkm');
        //END OF BAGIAN C

        //BAGIAN D
        $router->get('/sosial/{id}', 'penunjang_controller@getSosial');
        $router->post('/sosial', 'penunjang_controller@postSosial');
        $router->post('/edit/sosial/', 'penunjang_controller@editSosial');
        $router->delete('/sosial/{id}', 'penunjang_controller@deleteSosial');
        //END OF BAGIAN D

        // BAGIAN E
        $router->get('/struktural/{id}', 'penunjang_controller@getStruktural');
        $router->post('/struktural', 'penunjang_controller@postStruktural');
        $router->post('/edit/struktural/', 'penunjang_controller@editStruktural');
        $router->delete('/struktural/{id}', 'penunjang_controller@deleteStruktural');
        // END OF BAGIAN E

        // BAGIAN F
        $router->get('/nonstruktural/{id}', 'penunjang_controller@getNonstruktural');
        $router->post('/nonstruktural', 'penunjang_controller@postNonstruktural');
        $router->post('/edit/nonstruktural/', 'penunjang_controller@editNonstruktural');
        $router->delete('/nonstruktural/{id}', 'penunjang_controller@deleteNonstruktural');
        // END OF BAGIAN F

        // BAGIAN G
        $router->get('/redaksi/{id}', 'penunjang_controller@getRedaksi');
        $router->post('/redaksi', 'penunjang_controller@postRedaksi');
        $router->post('/edit/redaksi/', 'penunjang_controller@editRedaksi');
        $router->delete('/redaksi/{id}', 'penunjang_controller@deleteRedaksi');
        // END OF BAGIAN G

        // BAGIAN H
        $router->get('/adhoc/{id}', 'penunjang_controller@getAdhoc');
        $router->post('/adhoc', 'penunjang_controller@postAdhoc');
        $router->post('/edit/adhoc/', 'penunjang_controller@editAdhoc');
        $router->delete('/adhoc/{id}', 'penunjang_controller@deleteAdhoc');
        // END OF BAGIAN H

        // BAGIAN I
        $router->get('/ketuapanitia/{id}', 'penunjang_controller@getKetuaPanitia');
        $router->post('/ketuapanitia', 'penunjang_controller@postKetuaPanitia');
        $router->post('/edit/ketuapanitia', 'penunjang_controller@editKetuaPanitia');
        $router->delete('/ketuapanitia/{id}', 'penunjang_controller@deleteKetuaPanitia');

        // BAGIAN J
        $router->get('/anggotapanitia/{id}', 'penunjang_controller@getAnggotaPanitia');
        $router->post('/anggotapanitia', 'penunjang_controller@postAnggotaPanitia');
        $router->post('/edit/anggotapanitia', 'penunjang_controller@editAnggotaPanitia');
        $router->delete('/anggotapanitia/{id}', 'penunjang_controller@deleteAnggotaPanitia');

        // BAGIAN K
        $router->get('/pengurusyayasan/{id}', 'penunjang_controller@getPengurusYayasan');
        $router->post('/pengurusyayasan', 'penunjang_controller@postPengurusYayasan');
        $router->post('/edit/pengurusyayasan', 'penunjang_controller@editPengurusYayasan');
        $router->delete('/pengurusyayasan/{id}', 'penunjang_controller@deletePengurusYayasan');

        //BAGIAN L
        $router->get('/asosiasi/{id}', 'penunjang_controller@getAsosiasi');
        $router->post('/asosiasi', 'penunjang_controller@postAsosiasi');
        $router->post('/edit/asosiasi', 'penunjang_controller@editAsosiasi');
        $router->delete('/asosiasi/{id}', 'penunjang_controller@deleteAsosiasi');
        //END OF BAGIAN L


        //BAGIAN M
        $router->get('/seminar/{id}', 'penunjang_controller@getSeminar');
        $router->post('/seminar', 'penunjang_controller@postSeminar');
        $router->post('/edit/seminar', 'penunjang_controller@editSeminar');
        $router->delete('/seminar/{id}', 'penunjang_controller@deleteSeminar');
        //END OF BAGIAN M


        //BAGIAN N
        $router->get('/reviewer/{id}', 'penunjang_controller@getReviewer');
        $router->post('/reviewer', 'penunjang_controller@postReviewer');
        $router->post('/edit/reviewer', 'penunjang_controller@editReviewer');
        $router->delete('/reviewer/{id}', 'penunjang_controller@deleteReviewer');
        //END OF BAGIAN N
    });

    //END ROUTE FOR PENUNJANG

});