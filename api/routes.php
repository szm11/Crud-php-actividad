<?php

use App\Controllers\RutasController;
use App\Controllers\ContratoController;

Flight::route('GET /', function () {
    echo 'hello world! desde api';
});

// Rutas para Rutas
Flight::route('GET /rutas', function () {
   $data = RutasController::get();
   echo json_encode($data);
});

Flight::route('POST /rutas', function () {
    $data = Flight::request()->data->getData();
    $result = RutasController::insert($data);
    if (isset($result['status']) && $result['status'] === 'error') {
        echo json_encode(['status' => 'error', 'message' => $result['message']]);
    } else {
        echo json_encode(['status' => 'success']);
    }
});

Flight::route('DELETE /rutas/@id', function ($id) {
    $result = RutasController::delete($id);
    if (isset($result['status']) && $result['status'] === 'error') {
        echo json_encode(['status' => 'error', 'message' => $result['message']]);
    } else {
        echo json_encode(['status' => 'success']);
    }
});

Flight::route('POST /rutas/@id', function ($id) {
    $data = Flight::request()->data->getData();
    if (empty($data)) {
        echo json_encode(['status' => 'error', 'message' => 'No se recibieron datos.']);
        return;
    }
    $result = RutasController::update($id, $data);
    echo json_encode($result);
});

// Rutas para Contratos
Flight::route('GET /contratos', function () {
   $data = ContratoController::get();
   echo json_encode($data);
});

Flight::route('POST /contratos', function () {
    $data = Flight::request()->data->getData();
    $result = ContratoController::insert($data);
    if (isset($result['status']) && $result['status'] === 'error') {
        echo json_encode(['status' => 'error', 'message' => $result['message']]);
    } else {
        echo json_encode(['status' => 'success']);
    }
});

Flight::route('DELETE /contratos/@id', function ($id) {
    $result = ContratoController::delete($id);
    if (isset($result['status']) && $result['status'] === 'error') {
        echo json_encode(['status' => 'error', 'message' => $result['message']]);
    } else {
        echo json_encode(['status' => 'success']);
    }
});

Flight::route('POST /contratos/@id', function ($id) {
    $data = Flight::request()->data->getData();
    if (empty($data)) {
        echo json_encode(['status' => 'error', 'message' => 'No se recibieron datos.']);
        return;
    }
    $result = ContratoController::update($id, $data);
    echo json_encode($result);
});

Flight::start();
