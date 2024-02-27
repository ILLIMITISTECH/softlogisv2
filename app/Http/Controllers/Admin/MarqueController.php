<?php

namespace App\Http\Controllers\Admin;

use App\Models\Marque;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $marques = Marque::where('etat','actif')->get();
        return view('admin.marque.index', compact('marques'));
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
        {
            // Valider les données du formulaire (libelle, color, etc.)
            $request->validate([
                'libelle' => 'string|max:255',
                'color' => 'string|max:255',
            ]);

            DB::beginTransaction();
            try {

                $saving= Marque::create([
                    'uuid'=>Str::uuid(),
                    'libelle' => $request->libelle,
                    'color' => $request->color,
                    'description' => $request->description,
                    'etat' => 'actif',
                    'code' => Refgenerate(Marque::class, 'M', 'code'),
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
        {
            {
                // Valider les données du formulaire (libelle, color, etc.)
                $request->validate([
                    'libelle' => 'required|string|max:255',
                    'color' => 'string|max:255',
                ]);

                DB::beginTransaction();
                try {

                    $saving= Marque::where('uuid',$id)->update([
                        'libelle' => $request->libelle,
                        'color' => $request->color,
                        'description' => $request->description,
                    ]);

                    if ($saving) {

                        $dataResponse =[
                            'type'=>'success',
                            'urlback'=>"back",
                            'message'=>"Marque Modifié avec succes!",
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
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        {

            DB::beginTransaction();
            try {

                $saving= Marque::where(['uuid'=>$request->id])->update(['etat'=>"inactif"]);

                if ($saving) {

                    $dataResponse =[
                        'type'=>'success',
                        'urlback'=>"back",
                        'message'=>"Supprimé avec succes!",
                        'code'=>200,
                    ];
                    DB::commit();
                } else {
                    DB::rollback();
                    $dataResponse =[
                        'type'=>'error',
                        'urlback'=>'',
                        'message'=>"Erreur lors de la suppression!",
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

    }
}
