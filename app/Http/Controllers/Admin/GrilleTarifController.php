<?php

namespace App\Http\Controllers\Admin;

use App\Models\GrilleHad;
use App\Models\PorteChar;
use App\Models\Destination;
use App\Models\GrilleTarif;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GrilleTransit;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GrilleTarifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        DB::beginTransaction();
        try {

            $saving= GrilleTarif::create([
                'uuid'=>Str::uuid(),
                'transporteur_uuid' => $request->transporteur_uuid,
                'destination_uuid' => $request->destination_uuid,
                'porteChar_uuid' => $request->porteChar_uuid,
                'cout' => $request->cout,
                'etat' => 'actif',
                // 'code' => Refgenerate(GrilleTarif::class, 'GT', 'code'),
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function storeDestinations(request $request)
    {

        DB::beginTransaction();
        try {

            $saving= Destination::create([
                'uuid'=>Str::uuid(),
                'libelle' => $request->libelle,
                'etat' => 'actif',
                'code' => Refgenerate(Destination::class, 'Dest', 'code'),
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
    public function destroyDestinations(request $request, $id)
    {
        DB::beginTransaction();
        try {
            $saving= Destination::where('uuid', $request->id)->update(['etat' => 'inactif']);

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
    public function storePorteChar(request $request)
    {

        DB::beginTransaction();
        try {

            $saving= PorteChar::create([
                'uuid'=>Str::uuid(),
                'libelle' => $request->libelle,
                'etat' => 'actif',
                'code' => Refgenerate(PorteChar::class, 'PChar', 'code'),
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
    public function destroyPorteChar(request $request, $id)
    {
        DB::beginTransaction();
        try {
            $saving= Portechar::where('uuid', $request->id)->update(['etat' => 'inactif']);

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

    // store Transite grid    ..... HAD

    public function storeHad(request $request)
    {

        DB::beginTransaction();
        try {

            $saving= GrilleHad::create([
                'uuid'=>Str::uuid(),
                'libelle' => $request->libelle,
                'etat' => 'actif',
                'code' => Refgenerate(GrilleHad::class, 'HAD', 'code'),
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
    public function destroyHad(request $request)
    {

        DB::beginTransaction();
        try {
            $saving= GrilleHad::where('uuid', $request->id)->update(['etat' => 'inactif']);



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

    public function storeTransit(request $request)
    {

        DB::beginTransaction();
        try {

            $saving= GrilleTransit::create([
                'uuid'=>Str::uuid(),
                'transitaire_uuid' => $request->transitaire_uuid,
                'had_uuid' => $request->had_uuid,
                'cout' => $request->cout,
                'etat' => 'actif',
                // 'code' => Refgenerate(GrilleTransit::class, 'GrT', 'code'),
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

    // public function updateUuid(Request $request)
    // {
    //     $selectedUuid = $request->input('transporteurUuid');

    //     // Mettez à jour la valeur de $transporteur_uuid ici, par exemple dans la session
    //     session(['transporteur_uuid' => $selectedUuid]);

    //     // Réponse du serveur (peut être ajusté selon vos besoins)
    //     return response()->json(['message' => 'Transporteur UUID mis à jour avec succès']);
    // }

    // public function updateUuid(Request $request)
    // {
    //     $selectedUuid = $request->input('transporteurUuid');

    //     // Mettez à jour la valeur de $transporteur_uuid ici, par exemple dans la session
    //     session(['transporteur_uuid' => $selectedUuid]);
    //     $transporteurUuid = session('transporteur_uuid', '');

    //     // Récupérez les nouvelles données en fonction du transporteur_uuid
    //     $grillesTarifaires = \App\Models\GrilleTarif::where('transporteur_uuid', $transporteurUuid)->get();

    //     // Réponse du serveur avec les nouvelles données
    //     return response()->json(['grillesTarifaires' => $grillesTarifaires]);
    // }

    // public function updateUuid(Request $request)
    // {
    //     $selectedTransporteurUuid = $request->input('transporteurUuid');
    //     $selectedDestinationUuid = $request->input('destinationUuid');

    //     // Mettez à jour la valeur de $transporteur_uuid et $destination_uuid ici, par exemple dans la session
    //     session(['transporteur_uuid' => $selectedTransporteurUuid]);
    //     session(['destination_uuid' => $selectedDestinationUuid]);

    //     $transporteurUuid = session('transporteur_uuid', '');
    //     $destinationUuid = session('destination_uuid', '');

    //     // Récupérez les nouvelles données en fonction du transporteur_uuid et destination_uuid
    //     $grillesTarifaires = \App\Models\GrilleTarif::where('transporteur_uuid', $transporteurUuid)
    //                                                 ->where('destination_uuid', $destinationUuid)
    //                                                 ->get();


    //     // Réponse du serveur avec les nouvelles données
    //     return response()->json(['grillesTarifaires' => $grillesTarifaires]);
    // }

    // public function updateUuid(Request $request)
    // {
    //     $selectedTransporteurUuid = $request->input('transporteurUuid');
    //     $selectedDestinationUuid = $request->input('destinationUuid');
    //     $selectedPorteCharUuid = $request->input('porteCharUuid');

    //     // Mettez à jour la valeur de $transporteur_uuid, $destination_uuid et $porteChar_uuid
    //     session(['transporteur_uuid' => $selectedTransporteurUuid]);
    //     session(['destination_uuid' => $selectedDestinationUuid]);
    //     session(['porteChar_uuid' => $selectedPorteCharUuid]);

    //     $transporteurUuid = session('transporteur_uuid', '');
    //     $destinationUuid = session('destination_uuid', '');
    //     $porteCharUuid = session('porteChar_uuid', '');

    //     // Récupérez les nouvelles données en fonction du transporteur_uuid, destination_uuid et porteChar_uuid
    //     $grillesTarifaires = \App\Models\GrilleTarif::where('transporteur_uuid', $transporteurUuid)
    //                                                 ->where('destination_uuid', $destinationUuid)
    //                                                 ->where('porteChar_uuid', $porteCharUuid)
    //                                                 ->get();

    //     // ... Autre logique ...
    //     // Réponse du serveur avec les nouvelles données
    //     return response()->json(['grillesTarifaires' => $grillesTarifaires]);
    // }

    public function updateUuid(Request $request)
    {
        $selectedTransporteurUuid = $request->input('transporteurUuid');
        $selectedDestinationUuid = $request->input('destinationUuid');
        $selectedPorteCharUuid = $request->input('porteCharUuid');

        session(['transporteur_uuid' => $selectedTransporteurUuid]);
        session(['destination_uuid' => $selectedDestinationUuid]);
        session(['porteChar_uuid' => $selectedPorteCharUuid]);

        $transporteurUuid = session('transporteur_uuid', '');
        $destinationUuid = session('destination_uuid', '');
        $porteCharUuid = session('porteChar_uuid', '');

        $grillesTarifaires = \App\Models\GrilleTarif::with(['transporteur', 'destination', 'porteChar' ])->where('transporteur_uuid', $transporteurUuid)
            ->when($destinationUuid, function ($query) use ($destinationUuid) {
                return $query->where('destination_uuid', $destinationUuid);
            })
            ->when($porteCharUuid, function ($query) use ($porteCharUuid) {
                return $query->where('porteChar_uuid', $porteCharUuid);
            })
            ->get();


        return response()->json(['grillesTarifaires' => $grillesTarifaires]);
    }
    public function updateUuidTransit(Request $request)
    {
        $selectedTransitUuid = $request->input('transitaireUuid');
        $selectedHadUuid = $request->input('hadUuid');

        session(['transitaire_uuid' => $selectedTransitUuid]);
        session(['had_uuid' => $selectedHadUuid]);

        $transitaireUuid = session('transitaire_uuid', '');
        $hadUuid = session('had_uuid', '');

        $grillesTaransit = \App\Models\GrilleTransit::with(['transitaire', 'had'])->where('transitaire_uuid', $transitaireUuid)
            ->when($hadUuid, function ($query) use ($hadUuid) {
                return $query->where('had_uuid', $hadUuid);
            })->get();


        return response()->json(['grillesTaransit' => $grillesTaransit]);
    }




}

// Ajoutez une fonction pour mettre à jour les grilles tarifaires

