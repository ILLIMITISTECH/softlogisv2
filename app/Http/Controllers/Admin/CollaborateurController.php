<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Mail\LogisticaMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class CollaborateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allcollaborateurs = User::where(['etat'=> 'actif', 'type' => '0'])->get();
        $roles = Role::all();

        // dd($roles);
        return view('admin.collaborateur.index', compact('allcollaborateurs', 'roles'));
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
            'name' => 'required|string|max:255',
            'lastname' => 'string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        DB::beginTransaction();
        try {

            $saving= User::create([
                'uuid'=>Str::uuid(),
                'name' => $request->name,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'avatar' => 'default.jpg',
                'email' => $request->email,
                'etat' => 'actif',
                'type' => '0', // Collaborateur Jalo
                'code' => Refgenerate(User::class, 'COL', 'code'),
                'id_role' => $request->id_role,
                'password' => bcrypt($request->password),
            ])->save();

            if ($saving) {
               

                // Envoie d'email

                $mailData = [
                    'title' => 'Votre compte Softlogis',
                    'body' => 'Votre compte Softlogis a bien été créé. Vous pouvez maintenant vous connecter avec ces identifiants. <br><br>
                     <strong>Nom d\'utilisateur : </strong>'.$request->email.'
                     <br> <strong>Mot de passe : </strong>'.$request->password.'<br>',

                     'btnText' => 'Se connecter',
                     'btnLink' => route('login'),

                ];

                $emailSubject = 'Votre compte Softlogis';

                Mail::to($request->email)->send(new LogisticaMail($mailData,$emailSubject));

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
        // Valider les données du formulaire (nom, email, etc.)
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'string|max:255',
            'email' => 'required|string|email',
        ]);

        DB::beginTransaction();
        try {


            $user = User::where(['uuid'=>$id])->first();
            $saving= User::where(['uuid'=>$id])->update([

                'name' => $request->name,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'email' => $request->email,
                'type' => '0', // Collaborateur Jalo
                'id_role' => $request->id_role,
            ]);

            if ($saving) {
                $role = Role::find($request->id_role);
                $user->assignRole($role);

                $user->syncRoles([$role->id]);


                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Modifié avec succes!",
                    'code'=>200,
                ];
                DB::commit();
           } else {
                DB::rollback();
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur lors de la modification",
                    'code'=>500,
                ];
           }

        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme!",
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
            $deleted = User::where(['uuid'=>$request->id])->update(['etat'=>"inactif"]);
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
