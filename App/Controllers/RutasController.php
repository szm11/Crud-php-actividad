<?php 
namespace App\Controllers;

use App\Models\Rutas;

class RutasController{

    static function get(){
        $Rutas = Rutas::all();
        
        $result = [];
        
        foreach ($Rutas as $ruta) {
            $result[] = [
                'id' => $ruta->id,
                'capacidad' => $ruta->capacidad,
                'estado' => $ruta->estado,
                'kilometraje' => $ruta->kilometraje,
            ];
        }
        
         echo json_encode($result);
         die;
    }

    static function insert($data){
        try {
            Rutas::create([
                "capacidad" => $data["capacidad"],
                "estado" => $data["estado"],
                "kilometraje" => $data["kilometraje"]
            ]);

            self::get();
            die;
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    static function delete($id) {
        try {
            $sql = "DELETE FROM rutas_escolares WHERE id = '$id'";
        
                        $result = consultar($sql);
            
            if ($result) {
                return ['status' => 'success'];
            } else {
                return ['status' => 'error', 'message' => 'No se pudo eliminar la ruta o la ruta no fue encontrado'];
            }
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    static function update($id, $data) {
        try {
            $sql = "UPDATE rutas_escolares SET 
                        capacidad = '{$data['capacidad']}', 
                        estado = '{$data['estado']}', 
                        kilometraje = '{$data['kilometraje']}'
                    WHERE id = '$id'";
            
            $result = consultar($sql);
            
            if ($result) {
                return ['status' => 'success'];
            } else {
                return ['status' => 'error', 'message' => 'No se pudo actualizar la ruta'];
            }
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}