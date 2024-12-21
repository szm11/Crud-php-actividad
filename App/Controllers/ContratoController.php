<?php 
namespace App\Controllers;

use App\Models\Contrato;

class ContratoController {

    static function get() {
        $contratos = Contrato::all();
        
        $result = [];
        
        foreach ($contratos as $contrato) {
            $result[] = [
                'id' => $contrato->id,
                'fecha_inicio' => $contrato->fecha_inicio,
                'fecha_fin' => $contrato->fecha_fin,
                'modalidad' => $contrato->modalidad,
                'tarifa' => $contrato->tarifa,
                'ruta_id' => $contrato->ruta_id,
            ];
        }
        
        echo json_encode($result);
        die;
    }

    static function insert($data) {
        try {
            Contrato::create([
                "fecha_inicio" => $data["fecha_inicio"],
                "fecha_fin" => $data["fecha_fin"],
                "modalidad" => $data["modalidad"],
                "tarifa" => $data["tarifa"],
                "ruta_id" => $data["ruta_id"]
            ]);

            self::get();
            die;
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    static function delete($id) {
        try {
            $sql = "DELETE FROM contratos WHERE id = '$id'";
        
            $result = consultar($sql);
            
            if ($result) {
                return ['status' => 'success'];
            } else {
                return ['status' => 'error', 'message' => 'No se pudo eliminar el contrato o el contrato no fue encontrado'];
            }
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    static function update($id, $data) {
        try {
            $sql = "UPDATE contratos SET 
                        fecha_inicio = '{$data['fecha_inicio']}', 
                        fecha_fin = '{$data['fecha_fin']}', 
                        modalidad = '{$data['modalidad']}', 
                        tarifa = '{$data['tarifa']}', 
                        ruta_id = '{$data['ruta_id']}'
                    WHERE id = '$id'";
            
            $result = consultar($sql);
            
            if ($result) {
                return ['status' => 'success'];
            } else {
                return ['status' => 'error', 'message' => 'No se pudo actualizar el contrato'];
            }
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}