<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveDoctorRequest;
use App\Http\Requests\SousAdminRequest;
use App\Http\Requests\UpdateSousDoctorRequest;
use App\Models\Doctor;
use App\Models\ResetCodePassword;
use App\Models\SousAdmin;
use App\Notifications\SendEmailToDoctorAfterRegistrationNotification;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use PhpParser\Node\Stmt\TryCatch;

class DoctorController extends Controller
{
    //pour les vues de doctor
    public function dashboard(){
        return view('doctor.dashboard');
    }

    public function edit(SousAdmin $sousadmin){
        return view('doctor.edit', compact('sousadmin'));
    }

    public function update(UpdateSousDoctorRequest $request,SousAdmin $sousadmin){
        try {
            $sousadmin->name = $request->name;
            $sousadmin->prenom = $request->prenom;
            $sousadmin->email = $request->email;
            $sousadmin->description = $request->description;
            $sousadmin->contact = $request->contact;
            $sousadmin->update();

            return redirect()->route('doctor.index')->with('success','Vos informations ont été mises à jour avec succès.');
        } catch (Exception $e) {
            // dd($e);
            throw new Exception('error','Une erreur est survenue lors de la modification du Docteur');
        }
    }

    public function delete(SousAdmin $sousadmin){
        try {
            $sousadmin->delete();
            return redirect()->route('doctor.index')->with('success1','Le Docteur a été supprimé avec succès.');
        } catch (Exception $e) {
            // dd($e);
            throw new Exception('error','Une erreur est survenue lors de la suppression du Docteur');
        }
    }


    // Pour l'authentification
    
    public function register(){
        return view('doctor.auth.register');
    }

    public function login(){
        return view('doctor.auth.login');
    }
    
    
    public function handleRegister(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:doctors,email',
            'password' => 'required|min:8',
            'nomHop'=>'required',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation de l'image
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'Veuillez fournir une adresse e-mail valide.',
            'email.unique' => 'Cette adresse e-mail existe déjà.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit avoir au moins 8 caractères.',
            'profile_picture.image' => 'La photo de profil doit être une image.',
            'profile_picture.mimes' => 'Les formats d\'image autorisés sont jpeg, png, jpg, gif, svg.',
            'profile_picture.max' => 'L\'image ne doit pas dépasser 2 Mo.',
            'nomHop.required' => 'Le nom de l\'hôpital est obligatoire.',
        ]);
        
        try {
            // Traitement de la photo de profil si elle existe
            $profilePicturePath = null;
            if ($request->hasFile('profile_picture')) {
                // Générer un nom unique pour l'image et la sauvegarder dans le dossier 'profile_pictures'
                $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            }
            
            // Création du nouveau compte
            $doctor = Doctor::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nomHop'=> $request->nomHop,
                'profile_picture' => $profilePicturePath, // Sauvegarde du chemin de l'image
            ]);
    
            // Redirection avec un message de succès
            return redirect()->route('doctor.login')->with('success', 'Votre compte a été créé avec succès. Vous pouvez vous connecter.');
            
        } catch (\Exception $e) {
            // En cas d'erreur inattendue
            return back()->withErrors(['error' => 'Une erreur est survenue. Veuillez réessayer.'])->withInput();
        }
    }
    
    public function handleLogin(Request $request)
    {
        
        $request->validate([
            'email' =>'required|exists:doctors,email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Le mail est obligatoire.',
            'email.exists' => 'Cette adresse mail n\'existe pas.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit avoir au moins 8 caractères.',
        ]);

        try {
            if(auth('doctor')->attempt($request->only('email', 'password')))
            {
                return redirect()->route('doctor.dashboard')->with('Bienvenu sur votre page ');
            }else{
                return redirect()->back()->with('error', 'Votre mot de passe ou votre adresse mail est incorrect.');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

     public function store(SousAdminRequest $request){
        try {
            $sousadmin = new SousAdmin();
            $sousadmin->name = $request->name;
            $sousadmin->prenom = $request->prenom;
            $sousadmin->email = $request->email;
            $sousadmin->description = $request->description;
            $sousadmin->password = Hash::make('default');
            $sousadmin->contact = $request->contact;
            $sousadmin->profile_picture = $request->profile_picture;
            $sousadmin->save();

            //Systeme d'envopie de mail

            //Envoie de mail pour laverification 
            if($sousadmin){
               try {
                ResetCodePassword::where('email', $sousadmin->email)->delete();
                $code = rand(1000, 4000);

                $data = [
                    'code' => $code,
                    'email' => $sousadmin->email,
                ];
                ResetCodePassword::create($data);
                Notification::route('mail', $sousadmin->email)->notify(new SendEmailToDoctorAfterRegistrationNotification($code, $sousadmin->email));

                return redirect()->route('doctor.index')->with('success','Le docteur a été ajouter avec success');
               } catch (Exception $e) {
                //dd($e);
                Throw new Exception('Une erreur est subvenu lors de l\'envoie de mail');
               }
            }


        } catch (Exception $e) {
            //dd($e);
            throw new Exception('Une erreur est subvenu lors de la creation du Docteur');
        }
    }
    public function index(){
        $sousadmins = SousAdmin::all();
        return view('doctor/index', compact('sousadmins'));
    }
    public function create(){
        return view('doctor/create');
    }
  
}
