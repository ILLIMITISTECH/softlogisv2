<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\GrilleHad;
use App\Models\PorteChar;
use App\Models\Destination;
use App\Models\GrilleTarif;
use Illuminate\Support\Str;
use App\Models\FactProforma;
use Illuminate\Http\Request;
use App\Models\GrilleTransit;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FactProformaController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $transports = Company::where('etat', 'actif')->get();
        $destinations = Destination::where('etat', 'actif')->get();
        $porteChars = PorteChar::where('etat', 'actif')->get();

        $factureProformas = FactProforma::where('etat', 'actif')->get();

        $grilleTarifs = GrilleTarif::all();
        $grilleTransits = GrilleTransit::all();
//
        return view('admin.facturation.proforma.index', compact('transports', 'destinations', 'porteChars', 'factureProformas', 'grilleTarifs', 'grilleTransits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $transports = Company::where(['etat' => 'actif', 'type' => 'transporteur'])->get();
        $destinations = Destination::where('etat', 'actif')->get();
        $porteChars = PorteChar::where('etat', 'actif')->get();

        $grilleTarifaires = GrilleTarif::where(['etat'=>'actif'])->get();
        return view('admin.facturation.proforma.create', compact('transports', 'destinations', 'porteChars', 'grilleTarifaires',));
    }
    public function createTransit()
    {

        $transports = Company::where(['etat' => 'actif', 'type' => 'transitaire'])->get();
        $destinations = GrilleHad::where('etat', 'actif')->get();

        $grilleTarifaires = GrilleTransit::where(['etat'=>'actif'])->get();
        return view('admin.facturation.proforma.create', compact('transports', 'destinations', 'grilleTarifaires',));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {

            $saving= FactProforma::create([
                'uuid'=>Str::uuid(),
                'transporteur_uuid' => $request->transporteur_uuid,
                'destination_uuid' => $request->destination_uuid,
                'porteChar_uuid' => $request->porteChar_uuid,
                'cout_prestation' => $request->cout_prestation,
                'etat' => 'actif',
                'code' => Refgenerate(FactProforma::class, 'FactPro', 'code'),
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
}
