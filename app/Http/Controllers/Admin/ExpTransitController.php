<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\ExTransit;
use App\Models\Expedition;
use App\Mail\LogisticaMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ExTransiteFile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ExpTransitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $transits = ExTransit::where('etat', 'actif')->get();

        $transitaires = Company::where(['etat' => 'actif', 'type' => 'transitaire'])->get();
        return view('admin.expTransit.index' ,compact('transits', 'transitaires'));
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
        // dd($request->all());
        DB::beginTransaction();
        $user = auth()->user()->name . ' ' . auth()->user()->lastname;
        try {

            $expTransit = ExTransit::create([
                'uuid' => Str::uuid(),
                'note' => $request->note,
                'transitaire_uuid' => $request->transitaire_uuid,
                'expedition_uuid' => $request->expedition_uuid,
                'user_uuid' => $user,
                'etat' => 'actif',
                'code' => Refgenerate(ExTransit::class, 'EXT', 'code'),
            ]);

            if($request->has('expedition_uuid')){
                $expedition = Expedition::where('uuid', $request->expedition_uuid)->update([
                    'statut' => 'odTransit',
                    'date_transit' => now(),
                ]);
            }

            if($request->has('files')){
                foreach($request->file('files') as $key => $file){
                    $imageName = Str::uuid().'.'.$file->getClientOriginalExtension();
                    $destinationPath = public_path('documents/files');
                    $file->move($destinationPath, $imageName);
                    $filePath = $destinationPath . '/' . $imageName;

                    $odretransite_file = ExTransiteFile::create([
                        'uuid' => Str::uuid(),
                        'name' => $request->input('name')[$key],
                        'transite_uuid' => $expTransit->uuid,
                        'files' => $imageName,
                        'user_uuid' => $user,
                        'filePath' => $filePath,
                    ]);
                    $odretransite_file->filePath = $filePath;
                }
            }
            $expTransit->save();

            if ($expTransit) {

                $transitaireName = Company::where('uuid', $request->transitaire_uuid)->first();

                $mailData = [
                    'title' => 'ORDRE DE TRANSIT JALO LOGISTIQUE',
                    'body' => 'Bonjour Chers '.$transitaireName->raison_sociale.' Je vous transmet en P.J l\'ensemble des documents relatif  <br><br> En attente de votre retour , je reste disponible au besoin <br><br>
                        <strong>Date de creation : </strong>'.$expTransit->created_at.'<br>',
                ];

                $emailSubject = 'Jalo Logistique - ORDRE DE TRANSIT';

                $mail = new LogisticaMail($mailData, $emailSubject);

                // Attache les fichiers au message
                foreach ($expTransit->files as $file) {
                    $mail->attach($file->filePath);
                }

                Mail::to($transitaireName->email)->send($mail);

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

        $expTransit = ExTransit::where('uuid', $id)->firstOrFail();
        return view('admin.expTransit.show', compact('expTransit'));
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
        // dd($request->all());
        DB::beginTransaction();
        $user = auth()->user()->name . ' ' . auth()->user()->lastname;
        try {

            $expTransit = ExTransit::where(['uuid'=>$id])->update([

                'note' => $request->note,
                'transitaire_uuid' => $request->transitaire_uuid,
                'user_uuid' => $user,
                'etat' => 'actif',
            ]);

            if ($expTransit) {

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
    public function destroy(string $id)
    {
        {
            DB::beginTransaction();
            try {

                $saving= ExTransit::where(['uuid'=>$id])->update(['etat'=>"inactif"]);

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

    public function delette_doc_transit(string $id)
    {
        DB::beginTransaction();
        try {

            $saving = ExTransiteFile::where(['uuid'=>$id])->update(['etat'=>"inactif"]);
            if ($saving) {
                $dataResponse =[
                    'type'=>'success',
                    'urlback'=> 'back',
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

    public function addTransitDoc(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();

        try {
            $user = Auth::user()->name . ' ' . Auth::user()->lastname;

            if($request->has('files')){
                $names = $request->input('name');
                foreach($request->file('files') as $key => $file){
                 $imageName = Str::uuid().'.'.$file->getClientOriginalExtension();
                //  $imageName = $file->getClientOriginalName();
                 $destinationPath = public_path('documents/files');
                 $file->move($destinationPath, $imageName);
                 $filePath = $destinationPath . '/' . $imageName;

                 $odretransite_file = ExTransiteFile::create([
                    'uuid' => Str::uuid(),
                    'name' => $request->input('name')[$key],
                    'transite_uuid' => $request->input('transite_uuid'),
                    'files' => $imageName,

                    'user_uuid' => $user,
                    'filePath' => $filePath,
                ]);
                $odretransite_file->filePath = $filePath;
                }
                if ($odretransite_file) {

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
