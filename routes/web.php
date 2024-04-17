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

        //bimbingan

        //seminar

        //Tugas Akhir

        //Proposal

        // rendah

        // Kembang

        // CANGKOK

        //KOORDINATOR
    });
    //END ROUTE FOR PENDIDIKAN

    //

});