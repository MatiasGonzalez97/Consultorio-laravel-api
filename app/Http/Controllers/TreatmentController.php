<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;
use App\Http\Requests\Treatment\CreateTreatmentRequest;
use App\Helpers\HelperKS;
use App\Http\Requests\Treatment\UpdateTreatmentRequest;
use Carbon\Carbon;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orderByFilter = $request->query('order');
        if(is_null($orderByFilter)){
           $orderByFilter = 'ended_at'; //Ordena por default los ultimos tratamientos terminados 
        }
        $Treatments = Treatment::query()->with(['dentist','patient'])->orderBy($orderByFilter,'DESC')->limit(10)->get();
        $result = [];
        $cont = 0;
        foreach($Treatments as $treat){
            $result[$cont]['id'] = $treat->id;
            $result[$cont]['external_id'] = $treat->external_id;
            $result[$cont]['created_at'] = Carbon::parse($treat->created_at)->format('d/m/Y');
            $result[$cont]['updated_at'] = Carbon::parse($treat->updated_at)->format('d/m/Y');
            $result[$cont]['ended_at'] = Carbon::parse($treat->ended_at)->format('d/m/Y');
            $result[$cont]['dentist'] = [
                'id' => $treat->dentist->user->id,
                'full_name' => $treat->dentist->getFullNameAttribute($treat->dentist->user->id),
                'email'=>$treat->dentist->user->email
            ];
            $result[$cont]['patient'] = [
                'id' => $treat->patient->user->id,
                'full_name' => $treat->patient->getFullNameAttribute($treat->patient->user->id),
                'email'=>$treat->patient->user->email
            ];
            $cont++;
        }
        return response()->json($result);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTreatmentRequest $request)
    {
        $treatmentData = $request->all();
        $existsTreatment = HelperKS::verifyExistmentTreatment($treatmentData['patient_id'],$treatmentData['dentist_id']);
        if($existsTreatment){
            return response()->json(["message"=>'Ya existe un tratamiento para el doctor y paciente ingresado, a continuación se muestra la información del mismo',"Tratamiento ya existente"=>$existsTreatment],409);
        }
        $Treatment = Treatment::create($treatmentData);
        return response()->json($Treatment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Treatment = Treatment::findOrFail($id);
        return response()->json($Treatment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTreatmentRequest $request, $id)
    {
        $Treatment = Treatment::findOrFail($id);
        /* Si tiene dentist_id y patient_id verificamos que al querer updatear no sean ya existentes */
        if($request->has('dentist_id') && $request->has('patient_id')){
            $existsTreatment = HelperKS::verifyExistmentTreatment($request->input('patient_id'),$request->input('dentist_id'));
            if($existsTreatment){
                return response()->json(["message"=>'Ya existe un tratamiento para el doctor y paciente ingresado, a continuación se muestra la información del mismo',"Tratamiento ya existente"=>$existsTreatment],409);
            } else {
                if($request->has('dentist_id')){
                    $Treatment->dentist_id = $request->input('dentist_id');
                }
                if($request->has('patient_id')){
                    $Treatment->patient_id = $request->input('patient_id');
                }
                if($request->has('plates')){
                    $Treatment->plates = $request->input('plates');
                }
                if($request->has('ended_at')){
                    $Treatment->ended_at = $request->input('ended_at');
                }
                $Treatment->save();

                return response()->json($Treatment);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $treatment = Treatment::findOrFail($id);
        $treatment->delete();
        return response()->json(null,204);
    }
}
