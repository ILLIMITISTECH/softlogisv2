<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Company;
use App\Models\GrilleHad;
use App\Models\PorteChar;
use App\Mail\LogisticaMail;
use App\Models\Destination;
use App\Models\GrilleTarif;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GrilleTransit;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::where('etat', 'actif')->get();
        return view('admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire (nom, email, etc.)
        $request->validate([
            'raison_sociale' => 'required|string|max:255',
            // 'email' => 'required|string|email|unique:companies,email',
            'email' => 'required|string|email',
        ]);

        DB::beginTransaction();
        try {

             // add profil img
             $logo= $request->logo ?? "";
             if($logo == null) {
              $logo = 'default_logo.jpg';
             }else{
                 $file = $request->file('logo');
              //    dd($logo);
                 $logo = Str::uuid().'.'.$file->getClientOriginalExtension();
                 $file->move('files/',$logo);
             }

            $uuid_company = Str::uuid();

            $saving= Company::create([
                'uuid'=>$uuid_company,
                'logo' => $logo,
                'raison_sociale' => $request->raison_sociale,
                'phone' => $request->phone,
                'identification' => $request->identification,
                'email' => $request->email,
                'localisation' => $request->localisation,
                'description' => $request->description,
                'type' => $request->type, // organisation
                'voie_transport' => $request->voie_transport, // terrestre /Maritim
                'contact_one_name' => $request->contact_one_name,
                'contact_one_lastName' => $request->contact_one_lastName,
                'contact_one_email' => $request->contact_one_email,
                'contact_two_name' => $request->contact_two_name,
                'contact_two_lastName' => $request->contact_two_lastName,
                'contact_two_email' => $request->contact_two_email,
                'code' => Refgenerate(Company::class, 'ORG', 'code'),
            ])->save();

            if ($saving) {

                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Enregistré avec succes!",
                    'code'=>200,
                ];
                DB::commit();
           } else {
                DB::rollback();
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur lors de l'enregistrement!",
                    'code'=>500,
                ];
           }

        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! $th",
                'code'=>500,
            ];
        }
        return response()->json($dataResponse);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::where(['uuid'=>$id])->firstOrFail();
        $destinations = Destination::where(['etat'=>'actif'])->get();
        $porteChars = PorteChar::where(['etat'=>'actif'])->get();
        $grilleTarifaires = GrilleTarif::where(['etat'=>'actif', 'transporteur_uuid'=>$company->uuid])->get();
        $grilleTariftransits = GrilleTransit::where(['etat'=>'actif', 'transitaire_uuid'=>$company->uuid])->get();

        $hads = GrilleHad::where(['etat'=>'actif'])->get();
        return view('admin.company.show', compact('company', 'destinations', 'porteChars','grilleTarifaires', 'hads', 'grilleTariftransits'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Valider les données du formulaire (nom, email, etc.)
        $request->validate([
            'raison_sociale' => 'required|string|max:255',
            'email' => 'required|string|email',
        ]);

        DB::beginTransaction();
        try {

            $company = Company::where(['uuid'=>$id])->first();

            $logo = $company->logo; // Utilisez l'ancien logo par défaut

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $logo = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move('files/', $logo);
            }

            $saving= Company::where(['uuid'=>$id])->update([
                'logo' => $logo,
                'raison_sociale' => $request->raison_sociale,
                'phone' => $request->phone,
                'identification' => $request->identification,
                'email' => $request->email,
                'localisation' => $request->localisation,
                'description' => $request->description,
                'type' => $request->type,
                'voie_transport' => $request->voie_transport,
                'contact_one_name' => $request->contact_one_name,
                'contact_one_lastName' => $request->contact_one_lastName,
                'contact_one_email' => $request->contact_one_email,
                'contact_two_name' => $request->contact_two_name,
                'contact_two_lastName' => $request->contact_two_lastName,
                'contact_two_email' => $request->contact_two_email,
            ]);

            if ($saving) {

                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Enregistré avec succes!",
                    'code'=>200,
                ];
                DB::commit();
           } else {
                DB::rollback();
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur lors de l'enregistrement!",
                    'code'=>500,
                ];
           }

        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! $th",
                'code'=>500,
            ];
        }
        return response()->json($dataResponse);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $deleted = Company::where(['uuid'=>$request->id])->update(['etat'=>"inactif"]);
            if ($deleted) {
                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Opération effectuée avec succes",
                    'code' => 200,
                ];
                DB::commit();
                return response()->json($dataResponse);
            }
            else{
                $dataResponse = [
                    'type' => 'warning',
                    'urlback' => "back",
                    'message' => "l'opération a échouée",
                    'code' => 500,
                ];
                DB::rollback();
                return response()->json($dataResponse);
            }
        } catch (\Exception $e) {

            $dataResponse = [
                'type' => 'warning',
                'urlback' => '',
                'message' => "l'Opération a échouée contactez l'administrateur".$e,
                'code' => 500,
            ];
            DB::rollback();
            return response()->json($dataResponse);
        }

    }
    public function toActive(Request $request)
    {

        // dd($request->company_uuid);
        DB::beginTransaction();
        try {

            $deleted = Company::where(['uuid'=>$request->company_uuid])->update(['isActive' => 'true']);

            // dd($deleted);

            if ($deleted) {
                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Opération effectuée avec succes",
                    'code' => 200,
                ];
                DB::commit();
                return response()->json($dataResponse);
            }
            else{
                $dataResponse = [
                    'type' => 'warning',
                    'urlback' => "back",
                    'message' => "l'opération a échouée",
                    'code' => 500,
                ];
                DB::rollback();
                return response()->json($dataResponse);
            }
        } catch (\Exception $e) {

            $dataResponse = [
                'type' => 'warning',
                'urlback' => '',
                'message' => "l'Opération a échouée contactez l'administrateur".$e,
                'code' => 500,
            ];
            DB::rollback();
            return response()->json($dataResponse);
        }

    }
    public function toBlock(Request $request)
    {
        DB::beginTransaction();
        try {

            $deleted = Company::where(['uuid'=>$request->company_uuid])->update(['isActive' => 'false']);

            if ($deleted) {
                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Opération effectuée avec succes",
                    'code' => 200,
                ];
                DB::commit();
                return response()->json($dataResponse);
            }
            else{
                $dataResponse = [
                    'type' => 'warning',
                    'urlback' => "back",
                    'message' => "l'opération a échouée",
                    'code' => 500,
                ];
                DB::rollback();
                return response()->json($dataResponse);
            }
        } catch (\Exception $e) {

            $dataResponse = [
                'type' => 'warning',
                'urlback' => '',
                'message' => "l'Opération a échouée contactez l'administrateur".$e,
                'code' => 500,
            ];
            DB::rollback();
            return response()->json($dataResponse);
        }

    }
}
