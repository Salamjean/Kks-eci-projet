<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DecesController;
use App\Http\Controllers\DecesHopController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Doctors\DoctorDashboard;
use App\Http\Controllers\Doctors\SousDoctorsDashboard;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\Vendor\VendorDashboard;
use App\Http\Controllers\MariageController;
use App\Http\Controllers\NaissanceController;
use App\Http\Controllers\NaissanceDeclaController;
use App\Http\Controllers\NaissHopController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SousAdminController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;
use App\Models\Naissance;
use App\Models\Vendor;
use App\Models\Alert;

Route::get('/E-ci', [GeneralController::class, 'general'])->name('general');
Route::get('/doctor/dashboard', function () {
    return view('doctor.dashboard');
});
Route::get('/admin/login', function () {
    return view('admin.auth.login');
});

//Routes utilisateur 
Route::prefix('utilisateur')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('utilisateur.dashboard');
    Route::get('/index', [NaissanceController::class, 'userindex'])->name('utilisateur.index');
    Route::get('/deces-index', [DecesController::class, 'userindex'])->name('decesutilisateur.index');
    Route::get('/mariage-index', [MariageController::class, 'userindex'])->name('mariage.userindex');
    Route::get('/logout', [UtilisateurController::class, 'logout'])->name('utilisateur.logout');
});  

Route::prefix('utilisateur/')->group(function () {
    Route::get('/register', [UtilisateurController::class, 'register'])->name('utilisateur.register');
    Route::post('/register', [UtilisateurController::class, 'handleRegister'])->name('utilisateur.handleRegister');
    Route::get('/login', [UtilisateurController::class, 'login'])->name('utilisateur.login');
    Route::post('/login', [DoctorController::class, 'handleLogin'])->name('utilisateur.handleLogin');
});



// Route pour le tableau de bord (affichage général)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::get('/dashboard/{id}', [DashboardController::class, 'show'])->name('user.dashboard');


// Routes liées au profil de l'utilisateur
Route::middleware('auth:web')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes pour la gestion des mariages et décès


// Routes administratives
    Route::prefix('admin')->middleware('auth:admin')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
    });

    //Les routes du Docteur

    Route::middleware('auth:doctor')->prefix('doctors/dashboard')->group(function(){
        Route::get('/',[DoctorDashboard::class, 'index'])->name('doctor.dashboard'); 
        Route::get('/logout',[DoctorDashboard::class, 'logout'])->name('doctor.logout'); 
    });
    //Authenfication de doctor

    Route::prefix('doctors/')->group(function () {
    Route::get('/register', [DoctorController::class, 'register'])->name('doctor.register');
    Route::post('/register', [DoctorController::class, 'handleRegister'])->name('handleRegister');
    Route::get('/login', [DoctorController::class, 'login'])->name('doctor.login');
    Route::post('/login', [DoctorController::class, 'handleLogin'])->name('handleLogin');
    
    });

    //Les routes de l'administrator (Mairie)
    Route::prefix('vendors')->group(function () {
        // Routes pour l'authentification
    Route::get('/register', [VendorController::class, 'register'])->name('vendor.register');
    Route::post('/register', [VendorController::class, 'handleRegister'])->name('vendor.handleRegister');
    Route::get('/login', [VendorController::class, 'login'])->name('vendor.login');
    Route::post('/login', [VendorController::class, 'handleLogin'])->name('vendor.handleLogin');
    
    Route::middleware('auth:vendor')->group(function () {
    // Dashboard
    Route::get('/dashboard', [VendorDashboard::class, 'index'])->name('vendor.dashboard');
    Route::get('/logout', [VendorDashboard::class, 'logout'])->name('vendor.logout');
    
    // Création d'un hôpital
    Route::get('/hospital/create', [VendorController::class, 'hoptitalcreate'])->name('doctor.hoptitalcreate');
    Route::post('/hospital/store', [VendorController::class, 'hoptitalstore'])->name('doctor.hoptitalstore');
    
            // Gestion des agents
    Route::prefix('agents')->group(function () {
        Route::get('/', [AgentController::class, 'agentindex'])->name('agent.index');
        Route::get('/create', [AgentController::class, 'agentcreate'])->name('agent.create');
        Route::post('/store', [AgentController::class, 'agentstore'])->name('agent.store');
        Route::get('/{agent}/edit', [AgentController::class, 'agentedit'])->name('agent.edit');
        Route::put('/{agent}/update', [AgentController::class, 'agentupdate'])->name('agent.update');
        Route::delete('/{agent}/delete', [AgentController::class, 'agentdelete'])->name('agent.delete');
        });
    });
});

 //edit de l'etat de naissance
 Route::get('/naissance/{id}/edit', [VendorController::class, 'edit'])->name('naissances.edit');
 Route::post('/naissance/{id}/update-etat', [VendorController::class, 'updateEtat'])->name('naissances.updateEtat');

 //edit de l'etat de naissance grand
 Route::get('/naissanced/{id}/edit', [VendorController::class, 'edit1'])->name('naissanced.edit');
 Route::post('/naissanced/{id}/update-etat', [VendorController::class, 'updateEtat1'])->name('naissanced.updateEtat');

 //edit de l'etat de décès 
 Route::get('/deces/{id}/edit', [VendorController::class, 'edit2'])->name('deces.edit');
 Route::post('/deces/{id}/update-etat', [VendorController::class, 'updateEtat2'])->name('deces.updateEtat');

 //edit de l'etat de mariage 
 Route::get('/mariage/{id}/edit', [VendorController::class, 'edit3'])->name('mariage.edit');
 Route::post('/mariage/{id}/update-etat', [VendorController::class, 'updateEtat3'])->name('mariage.updateEtat');

    // Routes pour le sous-admin (Sous docteurs)
    Route::prefix('sous-admin')->name('sous_admin.')->group(function () {
        Route::get('/login', [SousAdminController::class, 'souslogin'])->name('login');
        Route::post('/login', [SousAdminController::class, 'soushandleLogin'])->name('handlelogin');
    });
    Route::middleware('auth:sous_admin')->prefix('sous-admin')->name('sous_admin.')->group(function(){
    Route::get('/dashboard', [SousAdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout',[SousAdminController::class, 'souslogout'])->name('logout');
    });
    

    Route::middleware('sous_admin')->prefix('SousDoctor')->group(function(){
    
    });

    //Les routes pour definie les access de apres l'envoie du mail
    Route::get('/validate-account/{email}', [SousAdminController::class, 'defineAccess']);
    Route::post('/validate-account/{email}', [SousAdminController::class, 'submitDefineAccess'])->name('doctor.validate');
    Route::get('/validate-hopital-account/{email}', [VendorController::class, 'defineAccess']);
    Route::post('/validate-hopital-account/{email}', [VendorController::class, 'submitDefineAccess'])->name('doctor.hopitalvalidate');
    Route::get('/validate-agent-account/{email}', [AgentController::class, 'defineAccess']);
    Route::post('/validate-agent-account/{email}', [AgentController::class, 'submitDefineAccess'])->name('agent.validate');


    //creer un docteurs

    Route::middleware('auth:doctor')->prefix('SousDoctor')->group(function () {
    Route::get('/index',[DoctorController::class, 'index'])->name('doctor.index');
    Route::get('/create',[DoctorController::class, 'create'])->name('doctor.create');
    Route::post('/create',[DoctorController::class, 'store'])->name('doctor.store');
    Route::get('/edit/{sousadmin}',[DoctorController::class, 'edit'])->name('doctor.edit');
    Route::put('/edit/{sousadmin}',[DoctorController::class, 'update'])->name('doctor.update');
    Route::get('/delete/{sousadmin}',[DoctorController::class, 'delete'])->name('doctor.delete');

    });

//les routes de extraits naissances
    Route::prefix('naissances')->group(function() {
        Route::get('/', [NaissanceController::class, 'index'])->name('naissance.index');        
        Route::get('/agent', [NaissanceController::class, 'agentindex'])->name('naissance.agentindex');        
        Route::post('/create', [NaissanceController::class, 'store'])->name('naissance.store');
        Route::get('/create', [NaissanceController::class, 'create'])->name('naissance.create');
        Route::get('/edit/{naissance}', [NaissanceController::class, 'edit'])->name('naissance.edit');
        Route::get('/naissance/{id}', [NaissanceController::class, 'show'])->name('naissance.show');
       
    });

    Route::post('/naissance/traiter/{id}', [NaissanceController::class, 'traiterDemande'])->name('naissance.traiter');
    Route::post('/deces/traiter/{id}', [NaissanceController::class, 'traiterDemandeDeces'])->name('deces.traiter');
    Route::post('/mariage/traiter/{id}', [NaissanceController::class, 'traiterDemandeMariage'])->name('mariage.traiter');
//les routes de extraits naissances
    Route::prefix('agent')->group(function() {
        Route::get('/login', [AgentController::class, 'login'])->name('agent.login');
        Route::post('/login', [AgentController::class, 'handleLogin'])->name('agent.handleLogin');
    });

    Route::middleware('agent')->prefix('agent')->group(function(){
        Route::get('/dashboard', [AgentController::class, 'agentdashboard'])->name('agent.dashboard');
        Route::get('/vue', [AgentController::class, 'agentvue'])->name('agent.vue');
        Route::get('/logout', [AgentController::class, 'logout'])->name('agent.logout');
    });

    Route::prefix('naissHop')->group(function () {
        // Routes pour les naissances à l'hôpital
        Route::get('/hopital', [NaissHopController::class, 'index'])->name('naissHop.index');
        Route::get('/hopital', [NaissHopController::class, 'index'])->name('naissHop.index');
        Route::get('/hopital/create', [NaissHopController::class, 'create'])->name('naissHop.create');
        Route::post('/hopital/create', [NaissHopController::class, 'store'])->name('naissHop.store');
        Route::get('/hopital/edit/{naisshop}', [NaissHopController::class, 'edit'])->name('naissHop.edit');
        Route::put('/hopital/edit/{naisshop}', [NaissHopController::class, 'update'])->name('naissHop.update');
        Route::get('/hopital/delete/{naisshop}', [NaissHopController::class, 'delete'])->name('naissHop.delete');
        Route::get('/hopital/download/{id}', [NaissHopController::class, 'download'])->name('naissHop.download');
        Route::get('/hopital/{id}', [NaissHopController::class, 'show'])->name('naissHop.show');
        Route::get('/mairie/{id}', [NaissHopController::class, 'mairieshow'])->name('naissHopmairie.show');
    
        // Routes pour la mairie
        Route::get('/mairie', [NaissHopController::class, 'mairieindex'])->name('naissHop.mairieindex');
        Route::get('/mairie-agent', [NaissHopController::class, 'agentmairieindex'])->name('naissHop.agentmairieindex');
        Route::get('/mairie-deces', [NaissHopController::class, 'mairieDecesindex'])->name('deces.mairieDecesindex');
        Route::get('/mairie-agent-deces', [NaissHopController::class, 'agentmairieDecesindex'])->name('deces.agentmairieDecesindex');
    
        // Route spécifique pour vérifier le code DM
        Route::post('/verifier-code-dm', [NaissHopController::class, 'verifierCodeDM'])->name('verifierCodeDM');
    });
    
    Route::prefix('decesHop')->group(function(){
        //Les routes les routes cotés Naissances hopital
        Route::get('/', [DecesHopController::class, 'index'])->name('decesHop.index');        
        Route::get('/', [DecesHopController::class, 'index'])->name('decesHop.index');        
        Route::post('/create', [DecesHopController::class, 'store'])->name('decesHop.store');
        Route::get('/create', [DecesHopController::class, 'create'])->name('decesHop.create');
        Route::get('/edit/{deceshop}', [DecesHopController::class, 'edit'])->name('decesHop.edit');
        Route::put('/edit/{deceshop}', [DecesHopController::class, 'update'])->name('decesHop.update');
        Route::get('/delete/{deceshop}', [DecesHopController::class, 'delete'])->name('decesHop.delete');
        Route::get('/{id}', [DecesHopController::class, 'show'])->name('decesHop.show');
        Route::get('/mairie/{id}', [DecesHopController::class, 'mairieshow'])->name('mairiedecesHop.show');
        Route::post('/deces/verifierCodeCMD', [DecesHopController::class, 'verifierCodeDMD'])->name('deces.verifierCodeCMD');
        Route::get('/download/{id}', [DecesHopController::class, 'download'])->name('decesHop.download');
    });

    // Les routes pour les statistiques
    Route::prefix('stats')->group(function () {
        Route::get('/', [StatController::class, 'index'])->name('stats.index');
        Route::get('/download', [StatController::class, 'download'])->name('stats.download');
        Route::get('/super', [StatController::class, 'superindex'])->name('stats.superindex');
        Route::get('/super/download', [StatController::class, 'superdownload'])->name('stats.superdownload'); // Modifie la route pour éviter le conflit
    });
    

      

    //les routes de declarations naissances
    Route::prefix('naissances/declarations')->group(function() {
        Route::get('/', [NaissanceDeclaController::class, 'index'])->name('naissanced.index');        
        Route::post('/create', [NaissanceDeclaController::class, 'store'])->name('naissanced.store');
        Route::get('/create', [NaissanceDeclaController::class, 'create'])->name('naissanced.create');
        Route::get('/naissanced/{id}', [NaissanceDeclaController::class, 'show'])->name('naissanced.show');

    });
    //les routes de deces
    Route::prefix('deces')->group(function() {
        Route::get('/', [DecesController::class, 'index'])->name('deces.index');        
        Route::get('/agent', [DecesController::class, 'agentindex'])->name('deces.agentindex');        
        Route::post('/create', [DecesController::class, 'store'])->name('deces.store');
        Route::get('/create', [DecesController::class, 'create'])->name('deces.create');
        Route::get('/deces/{id}', [DecesController::class, 'show'])->name('deces.show');
        Route::get('/create/deja',[DecesController::class,'createdeja'])->name('deces.createdeja');
        Route::post('/create/deja-store',[DecesController::class,'storedeja'])->name('deces.storedeja');
        Route::get('/create-deja', [DecesController::class, 'indexdeja'])->name('deces.indexdeja');  
    });

    //les routes de mariages
    Route::prefix('mariages')->group(function() {
        Route::get('/', [MariageController::class, 'index'])->name('mariage.index');        
        Route::get('/agent', [MariageController::class, 'agentindex'])->name('mariage.agentindex');        
        Route::post('/create', [MariageController::class, 'store'])->name('mariage.store');
        Route::get('/create', [MariageController::class, 'create'])->name('mariage.create');
        Route::get('/mariage/{id}', [MariageController::class, 'show'])->name('mariage.show');
    });

    Route::post('/alerts/{id}/mark-as-read', [VendorDashboard::class, 'markAlertAsRead']);
    

    require __DIR__.'/auth.php';
    require __DIR__.'/admin-auth.php';
