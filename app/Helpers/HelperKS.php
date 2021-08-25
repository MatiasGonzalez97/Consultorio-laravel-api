<?php

namespace App\Helpers;

use App\Models\Treatment;

/* Este metodo servirá para evitar la repetición de codigo y ayudara a buscar si existe algún tratamiento para el paciente y el dentista, en caso de que existan directamente devolverá una respuesta indicando la información del treatment que exista en la base de datos */
class HelperKS {
    public static function verifyExistmentTreatment($patient_id,$dentist_id){
        $result = Treatment::where(['dentist_id'=>$dentist_id,'patient_id'=>$patient_id])->first();
        if(!is_null($result)) {
            return $result;
        } else {
            return false;
        }
    }
}