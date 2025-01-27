<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AjointController;
use App\Http\Controllers\CaisseController;
use App\Http\Controllers\CgraeAgentController;
use App\Http\Controllers\CgraeController;
use App\Http\Controllers\CnpsAgentController;
use App\Http\Controllers\CnpsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DecesController;
use App\Http\Controllers\DecesHopController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Doctors\DoctorDashboard;
use App\Http\Controllers\Doctors\SousDoctorsDashboard;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\Vendor\VendorDashboard;
use App\Http\Controllers\MariageController;
use App\Http\Controllers\MinistereAgentController;
use App\Http\Controllers\MinistereController;
use App\Http\Controllers\NaissanceController;
use App\Http\Controllers\NaissanceDeclaController;
use App\Http\Controllers\NaissHopController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SousAdminController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;
use App\Models\Naissance;
use App\Models\Vendor;
use App\Models\Alert;
use App\Models\Doctor;
use App\Models\Ministere;

Route::get('/', [GeneralController::class, 'general'])->name('general');
Route::get('/E-ci-Naissance', [GeneralController::class, 'naissanceavec'])->name('naissanceavec');
Route::get('/E-ci-Naissancesans', [GeneralController::class, 'naissancesans'])->name('naissancesans');
Route::get('/E-ci-deces', [GeneralController::class, 'decesavec'])->name('decesavec');
Route::get('/E-ci-decessans', [GeneralController::class, 'decessans'])->name('decessans');
Route::get('/E-ci-mariagesans', [GeneralController::class, 'mariagesans'])->name('mariagesans');
Route::get('/doctor/dashboard', function () {
    return view('doctor.dashboard');
});
Route::get('/admin/login', function () {
    return view('admin.auth.login');
});

//Routes utilisateur 
Route::prefix('utilisateur')->group(function () {
    // Dashboard
    Route::middleware('utilisateur')->get('/dashboard', [DashboardController::class, 'index'])->name('utilisateur.dashboard');
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

    //les routes du super admin
    Route::prefix('super-admin')->group(function () {
        // Routes pour l'authentification
    Route::get('/register', [SuperAdminController::class, 'register'])->name('super_admin.register');
    Route::post('/register', [SuperAdminController::class, 'handleRegister'])->name('super_admin.handleRegister');
    Route::get('/login', [SuperAdminController::class, 'login'])->name('super_admin.login');
    Route::post('/login', [SuperAdminController::class, 'handleLogin'])->name('super_admin.handleLogin');
    });

    Route::middleware('auth:super_admin')->group(function () {
        // Dashboard
        Route::get('super-admin/dashboard', [SuperAdminController::class, 'dashboard'])->name('super_admin.dashboard');
        Route::get('/logout', [SuperAdminController::class, 'logout'])->name('super_admin.logout');

        Route::get('super-admin/agents', [AgentController::class, 'superindex'])->name('superagent.index');
        Route::get('super-admin/Ajoints', [AjointController::class, 'superindex'])->name('superajoint.index');
        Route::get('super-admin/hopital', [VendorController::class, 'superindex'])->name('superhopital.index');
        Route::get('super-admin/caisse', [CaisseController::class, 'superindex'])->name('supercaisse.index');
        Route::get('super-admin/naissance', [NaissanceController::class, 'superindex'])->name('supernaissance.index');
        Route::get('super-admin/naisshop', [NaissHopController::class, 'superindex'])->name('supernaisshop.index');
        Route::get('super-admin/deces', [DecesController::class, 'superindex'])->name('superdeces.index');
        Route::get('super-admin/deceshop', [DecesHopController::class, 'superindex'])->name('superdeceshop.index');
        Route::get('super-admin/mariage', [MariageController::class, 'superindex'])->name('supermariage.index');
        Route::get('super-admin/docter', [SousAdminController::class, 'superindex'])->name('superdocteur.index');


        //Les routes de la mairies dans le super-admin 
            Route::get('mairie/index', [SuperAdminController::class, 'index'])->name('super_admin.index');
            Route::get('mairie/index/archive', [SuperAdminController::class, 'archive'])->name('super_admin.archive');
            Route::get('mairie/create', [SuperAdminController::class, 'create'])->name('super_admin.create');
            Route::post('mairie/store', [SuperAdminController::class, 'store'])->name('super_admin.store');
            Route::post('/add-solde', [SuperAdminController::class, 'addSolde'])->name('super_admin.add_solde');

        //Les routes de la CNPS dans le super-admin 
            Route::get('cnps/index', [CnpsController::class, 'index'])->name('cnps.index');
            Route::get('cnps/index/archive', [CnpsController::class, 'archive'])->name('cnps.indexarchive');
            Route::get('cnps/create', [CnpsController::class, 'create'])->name('cnps.create');
            Route::post('cnps/store', [CnpsController::class, 'store'])->name('cnps.store');

        //Les routes de la CGRAE dans le super-admin 
            Route::get('cgrae/index', [CgraeController::class, 'index'])->name('cgrae.index');
            Route::get('cgrae/index/archive', [CgraeController::class, 'archive'])->name('cgrae.indexarchive');
            Route::get('cgrae/create', [CgraeController::class, 'create'])->name('cgrae.create');
            Route::post('cgrae/store', [CgraeController::class, 'store'])->name('cgrae.store');

        //Les routes du ministère de la santé dans le super-admin 
            Route::get('ministere/index', [MinistereController::class, 'index'])->name('ministere.index');
            Route::get('ministere/index/archive', [MinistereController::class, 'archive'])->name('ministere.indexarchive');
            Route::get('ministere/create', [MinistereController::class, 'create'])->name('ministere.create');
            Route::post('ministere/store', [MinistereController::class, 'store'])->name('ministere.store');
});


    //Les routes de la CGRAE dans le super-admin
    Route::prefix('cgraes')->group(function () {
        // Routes pour l'authentification
    Route::get('/register', [CgraeController::class, 'register'])->name('cgraes.register');
    Route::post('/register', [CgraeController::class, 'handleRegister'])->name('cgraes.handleRegister');
    Route::get('/login', [CgraeController::class, 'login'])->name('cgraes.login');
    Route::post('/login', [CgraeController::class, 'handleLogin'])->name('cgraes.handleLogin');
    Route::delete('/{cgraes}/archive', [CgraeController::class, 'cgraesarchive'])->name('cgraes.archive');
    Route::put('/cgraes/unarchive/{id}', [CgraeController::class, 'unarchive'])->name('cgraes.unarchive');
    Route::delete('/{cgraes}/delete', [CgraeController::class, 'cgraesdelete'])->name('cgraes.delete');
    Route::middleware('auth:cgrae')->group(function () {
        // Dashboard
        Route::get('/dashboard', [CgraeController::class, 'dashboard'])->name('cgraes.dashboard');
        Route::get('/cgrae/index-declaration', [CgraeController::class, 'indexdeclaration'])->name('cgraes.indexdashboard');
        Route::get('/cgrae/recherche', [CgraeController::class, 'recherche'])->name('cgrae.recherche');
        Route::get('/logout', [CgraeController::class, 'logout'])->name('cgrae.logout');
         // creation de l'agent de la cnps
        Route::prefix('cgrae/agents')->group(function () {
            Route::get('/', [CgraeAgentController::class, 'index'])->name('cgraeagent.index');
            Route::get('/create', [CgraeAgentController::class, 'create'])->name('cgraeagent.create');
            Route::post('/store', [CgraeAgentController::class, 'store'])->name('cgraeagent.store');
            Route::get('/{agent}/edit', [CgraeAgentController::class, 'edit'])->name('cgraeagent.edit');
            Route::put('/{agent}/update', [CgraeAgentController::class, 'update'])->name('cgraeagent.update');
            Route::delete('/{agent}/archive', [CgraeAgentController::class, 'archive'])->name('cgraeagent.archive');
            //Route::delete('/{agent}/delete', [CgraeAgentController::class, 'delete'])->name('cgraeagent.delete');
            });
        });
    });
    //Les routes de la cnps dans le super-admin
    Route::prefix('cnps')->group(function () {
        // Routes pour l'authentification
    Route::get('/register', [CnpsController::class, 'register'])->name('cnps.register');
    Route::post('/register', [CnpsController::class, 'handleRegister'])->name('cnps.handleRegister');
    Route::get('/login', [CnpsController::class, 'login'])->name('cnps.login');
    Route::post('/login', [CnpsController::class, 'handleLogin'])->name('cnps.handleLogin');
    Route::delete('/{cnps}/archive', [CnpsController::class, 'cnpsarchive'])->name('cnps.archive');
    Route::put('/cnps/unarchive/{id}', [CnpsController::class, 'unarchive'])->name('cnps.unarchive');
    Route::delete('/{cnps}/delete', [CnpsController::class, 'cnpsdelete'])->name('cnps.delete');

    Route::middleware('auth:cnps')->group(function () {
        // Dashboard
        Route::get('/dashboard', [CnpsController::class, 'dashboard'])->name('cnps.dashboard');
        Route::get('/cnps/index-declaration', [CnpsController::class, 'indexdeclaration'])->name('cnps.indexdashboard');
        Route::get('/cnps/recherche', [CnpsController::class, 'recherche'])->name('cnps.recherche');
        Route::get('/logout', [CnpsController::class, 'logout'])->name('cnps.logout');

         // creation de l'agent de la cnps
        Route::prefix('cnps/agents')->group(function () {
            Route::get('/', [CnpsAgentController::class, 'index'])->name('cnpsagent.index');
            Route::get('/create', [CnpsAgentController::class, 'create'])->name('cnpsagent.create');
            Route::post('/store', [CnpsAgentController::class, 'store'])->name('cnpsagent.store');
            Route::get('/{agent}/edit', [CnpsAgentController::class, 'edit'])->name('cnpsagent.edit');
            Route::put('/{agent}/update', [CnpsAgentController::class, 'update'])->name('cnpsagent.update');
            Route::delete('/{agent}/archive', [CnpsAgentController::class, 'archive'])->name('cnpsagent.archive');
            //Route::delete('/{agent}/delete', [CnpsAgentController::class, 'delete'])->name('cnpsagent.delete');
                });         
            });

        });

     //Les routes du Ministere dans le super-admin
        Route::prefix('ministere')->group(function () {
                // Routes pour l'authentification
            Route::get('/register', [MinistereController::class, 'register'])->name('ministere.register');
            Route::post('/register', [MinistereController::class, 'handleRegister'])->name('ministere.handleRegister');
            Route::get('/login', [MinistereController::class, 'login'])->name('ministere.login');
            Route::post('/login', [MinistereController::class, 'handleLogin'])->name('ministere.handleLogin');
            Route::delete('/{ministere}/archive', [MinistereController::class, 'ministerearchive'])->name('ministere.archive');
            Route::put('/ministere/unarchive/{id}', [MinistereController::class, 'unarchive'])->name('ministere.unarchive');
            Route::delete('/{ministere}/delete', [MinistereController::class, 'ministeredelete'])->name('ministere.delete');
            Route::middleware('auth:ministere')->group(function () {
                // Dashboard
                Route::get('/dashboard', [MinistereController::class, 'dashboard'])->name('ministere.dashboard');
                Route::get('/ministere/index-naissance', [MinistereController::class, 'naissancedeclaration'])->name('ministere.naissancedashboard');
                Route::get('/ministere/index-deces', [MinistereController::class, 'decesclaration'])->name('ministere.decesdashboard');
                Route::get('/logout', [MinistereController::class, 'logout'])->name('ministere.logout');

                 // creation de l'agent de la cnps
                Route::prefix('ministere/agents')->group(function () {
                    Route::get('/', [MinistereAgentController::class, 'index'])->name('ministereagent.index');
                    Route::get('/create', [MinistereAgentController::class, 'create'])->name('ministereagent.create');
                    Route::post('/store', [MinistereAgentController::class, 'store'])->name('ministereagent.store');
                    Route::get('/{agent}/edit', [MinistereAgentController::class, 'edit'])->name('ministereagent.edit');
                    Route::put('/{agent}/update', [MinistereAgentController::class, 'update'])->name('ministereagent.update');
                    Route::delete('/{agent}/archive', [MinistereAgentController::class, 'archive'])->name('ministereagent.archive');
                    //Route::delete('/{agent}/delete', [MinistereAgentController::class, 'delete'])->name('ministereagent.delete');
                   
                    });
                });
        });
    Route::get('ministere/deces/download/{id}', [MinistereAgentController::class, 'decesdownload'])->name('ministereagent.decesdownload');
    Route::get('ministere/naiss/download/{id}', [MinistereAgentController::class, 'naissdownload'])->name('ministereagent.naissdownload');
    Route::get('cnps/download/{id}', [CnpsAgentController::class, 'download'])->name('cnpsagent.download');
    Route::get('cgrae/download/{id}', [CgraeAgentController::class, 'download'])->name('cgraeagent.download');

    //Les routes de l'administrator (Mairie)
    Route::prefix('vendors')->group(function () {
        // Routes pour l'authentification
    Route::get('/register', [VendorController::class, 'register'])->name('vendor.register');
    Route::post('/register', [VendorController::class, 'handleRegister'])->name('vendor.handleRegister');
    Route::get('/login', [VendorController::class, 'login'])->name('vendor.login');
    Route::post('/login', [VendorController::class, 'handleLogin'])->name('vendor.handleLogin');
    Route::delete('/{vendor}/archive', [VendorController::class, 'archive'])->name('vendor.archive');
    Route::put('/mairie/unarchive/{id}', [VendorController::class, 'unarchive'])->name('mairie.unarchive');
    Route::delete('/{vendor}/delete', [VendorController::class, 'vendordelete'])->name('vendor.delete');
    
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
        Route::delete('/{agent}/archive', [AgentController::class, 'archive'])->name('agent.archive');
        Route::delete('/{agent}/delete', [AgentController::class, 'agentdelete'])->name('agent.delete');
        });

        //Gestion des ajoints
        Route::prefix('ajoints')->group(function () {
            Route::get('/', [AjointController::class, 'ajointindex'])->name('ajoint.index');
            Route::get('/create', [AjointController::class, 'ajointcreate'])->name('ajoint.create');
            Route::post('/store', [AjointController::class, 'ajointstore'])->name('ajoint.store');
            Route::get('/{ajoint}/edit', [AjointController::class, 'ajointedit'])->name('ajoint.edit');
            Route::put('/{ajoint}/update', [AjointController::class, 'ajointupdate'])->name('ajoint.update');
            Route::delete('/{ajoint}/delete', [AjointController::class, 'ajointdelete'])->name('ajoint.delete');
            });

        // Gestion des caisses
        Route::prefix('caisses')->group(function () {
            Route::get('/', [CaisseController::class, 'caisseindex'])->name('caisse.index');
            Route::get('/create', [CaisseController::class, 'caissecreate'])->name('caisse.create');
            Route::post('/store', [CaisseController::class, 'caissestore'])->name('caisse.store');
            Route::get('/{caisse}/edit', [CaisseController::class, 'caisseedit'])->name('caisse.edit');
            Route::put('/{caisse}/update', [CaisseController::class, 'caisseupdate'])->name('caisse.update');
            Route::delete('/{caisse}/delete', [CaisseController::class, 'caissedelete'])->name('caisse.delete');
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

 Route::get('/decesdeja/{id}/edit', [VendorController::class, 'edit4'])->name('decesdeja.edit');
Route::post('/decesdeja/{id}/update-etat', [VendorController::class, 'updateEtat4'])->name('decesdeja.updateEtat');

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

    // routes du directeur
    Route::prefix('directeur')->group(function () {
        Route::get('/register', [DirectorController::class, 'register'])->name('directeur.register');
        Route::post('/register', [DirectorController::class, 'handleRegister'])->name('directeur.handleRegister');
        Route::get('/login', [DirectorController::class, 'login'])->name('directeur.login');
        Route::post('/login', [DirectorController::class, 'handleLogin'])->name('directeur.handleLogin');
    });
    Route::middleware('auth:directeur')->prefix('directeur')->name('directeur.')->group(function(){
        Route::get('/directeurs-dashboard', [DirectorController::class, 'dashboard'])->name('dashboard');
        Route::get('/directeur-index',[DirectorController::class, 'directeurindex'])->name('index');
        Route::get('/index-naissance-directeur',[NaissHopController::class, 'directeurindex'])->name('naissanceindex');
        Route::get('/index-deces-directeur',[DecesHopController::class, 'directeurindex'])->name('decesindex');
        Route::get('/logout',[DirectorController::class, 'logout'])->name('logout');
        });
    

    Route::middleware('sous_admin')->prefix('SousDoctor')->group(function(){
    
    });

    //Les routes pour definie les access de apres l'envoie du mail
    Route::get('/validate-account/{email}', [SousAdminController::class, 'defineAccess']);
    Route::post('/validate-account/{email}', [SousAdminController::class, 'submitDefineAccess'])->name('doctor.validate');
    Route::get('/validate-hopital-account/{email}', [VendorController::class, 'defineAccess']);
    Route::post('/validate-hopital-account/{email}', [VendorController::class, 'submitDefineAccess'])->name('doctor.hopitalvalidate');
    Route::get('/validate-mairie-account/{email}', [SuperAdminController::class, 'defineAccess']);
    Route::post('/validate-mairie-account/{email}', [SuperAdminController::class, 'submitDefineAccess'])->name('vendor.validate');
    Route::get('/validate-agent-account/{email}', [AgentController::class, 'defineAccess']);
    Route::post('/validate-agent-account/{email}', [AgentController::class, 'submitDefineAccess'])->name('agent.validate');
    Route::get('/validate-ajoint-account/{email}', [AjointController::class, 'defineAccess']);
    Route::post('/validate-ajoint-account/{email}', [AjointController::class, 'submitDefineAccess'])->name('ajoint.validate');
    Route::get('/validate-caisse-account/{email}', [CaisseController::class, 'defineAccess']);
    Route::post('/validate-caisse-account/{email}', [CaisseController::class, 'submitDefineAccess'])->name('caisse.validate');
    Route::get('/validate-director-account/{email}', [DirectorController::class, 'defineAccess']);
    Route::post('/validate-director-account/{email}', [DirectorController::class, 'submitDefineAccess'])->name('directeur.validate');
    Route::get('/validate-cnps-account/{email}', [CnpsController::class, 'defineAccess']);
    Route::post('/validate-cnps-account/{email}', [CnpsController::class, 'submitDefineAccess'])->name('cnps.validate');
    Route::get('/validate-cnps-agent-account/{email}', [CnpsAgentController::class, 'defineAccess']);
    Route::post('/validate-cnps-agent-account/{email}', [CnpsAgentController::class, 'submitDefineAccess'])->name('cnpsagent.validate');
    Route::get('/validate-cgrae-account/{email}', [CgraeController::class, 'defineAccess']);
    Route::post('/validate-cgrae-account/{email}', [CgraeController::class, 'submitDefineAccess'])->name('cgrae.validate');
    Route::get('/validate-cgrae-agent-account/{email}', [CgraeAgentController::class, 'defineAccess']);
    Route::post('/validate-cgrae-agent-account/{email}', [CgraeAgentController::class, 'submitDefineAccess'])->name('cgraeagent.validate');
    Route::get('/validate-ministere-account/{email}', [MinistereController::class, 'defineAccess']);
    Route::post('/validate-ministere-account/{email}', [MinistereController::class, 'submitDefineAccess'])->name('ministere.validate');
    Route::get('/validate-ministere-agent-account/{email}', [MinistereAgentController::class, 'defineAccess']);
    Route::post('/validate-ministere-agent-account/{email}', [MinistereAgentController::class, 'submitDefineAccess'])->name('ministereagent.validate');


    //creer un docteurs

    Route::middleware('auth:doctor')->prefix('SousDoctor')->group(function () {
        //les routes du sous-admins(docteurs)
    Route::get('/index',[DoctorController::class, 'index'])->name('doctor.index');
    Route::get('/create',[DoctorController::class, 'create'])->name('doctor.create');
    Route::post('/create',[DoctorController::class, 'store'])->name('doctor.store');
    Route::get('/edit/{sousadmin}',[DoctorController::class, 'edit'])->name('doctor.edit');
    Route::put('/edit/{sousadmin}',[DoctorController::class, 'update'])->name('doctor.update');
    Route::get('/delete/{sousadmin}',[DoctorController::class, 'delete'])->name('doctor.delete');

    // routes des directeurs
    Route::get('/create-director',[DirectorController::class, 'create'])->name('directeur.create');
    Route::post('/create-director',[DirectorController::class, 'store'])->name('directeur.store');
    Route::get('/edit-director/{director}',[DirectorController::class, 'edit'])->name('directeur.edit');
    Route::put('/edit-director/{director}',[DirectorController::class, 'update'])->name('directeur.update');
    Route::get('/delete-director/{director}',[DirectorController::class, 'delete'])->name('directeur.delete');

    });

//les routes de extraits naissances
    Route::prefix('naissances')->group(function() {
        Route::get('/', [NaissanceController::class, 'index'])->name('naissance.index');        
        Route::get('/agent', [NaissanceController::class, 'agentindex'])->name('naissance.agentindex');        
        Route::get('/ajoint', [NaissanceController::class, 'ajointindex'])->name('naissance.ajointindex');        
        Route::post('/create', [NaissanceController::class, 'store'])->name('naissance.store');
        Route::get('/create', [NaissanceController::class, 'create'])->name('naissance.create');
        Route::get('/edit/{naissance}', [NaissanceController::class, 'edit'])->name('naissance.edit');
        Route::get('/naissance/{id}', [NaissanceController::class, 'show'])->name('naissance.show');
        Route::get('/naissance/delete/{naissance}', [NaissanceController::class, 'delete'])->name('naissance.delete');
       
    });

    Route::post('/naissance/traiter/{id}', [NaissanceController::class, 'traiterDemande'])->name('naissance.traiter');
    Route::post('/deces/traiter/{id}', [NaissanceController::class, 'traiterDemandeDeces'])->name('deces.traiter');
    Route::post('/mariage/traiter/{id}', [NaissanceController::class, 'traiterDemandeMariage'])->name('mariage.traiter');
//les routes de extraits naissances
    Route::prefix('agent')->group(function() {
        Route::get('/login', [AgentController::class, 'login'])->name('agent.login');
        Route::post('/login', [AgentController::class, 'handleLogin'])->name('agent.handleLogin');
    });

    Route::prefix('cnps/agent')->group(function() {
        Route::get('/login', [CnpsAgentController::class, 'login'])->name('cnpsagent.login');
        Route::post('/login', [CnpsAgentController::class, 'handleLogin'])->name('cnpsagent.handleLogin');
    });

    Route::prefix('cgrae/agent')->group(function() {
        Route::get('/login', [CgraeAgentController::class, 'login'])->name('cgraeagent.login');
        Route::post('/login', [CgraeAgentController::class, 'handleLogin'])->name('cgraeagent.handleLogin');
    });

    Route::prefix('ministere/agent')->group(function() {
        Route::get('/login', [MinistereAgentController::class, 'login'])->name('ministereagent.login');
        Route::post('/login', [MinistereAgentController::class, 'handleLogin'])->name('ministereagent.handleLogin');
    });

    Route::prefix('ajoint-maire')->group(function() {
        Route::get('/login', [AjointController::class, 'login'])->name('ajoint.login');
        Route::post('/login', [AjointController::class, 'handleLogin'])->name('ajoint.handleLogin');
    });

    Route::prefix('caisse')->group(function() {
        Route::get('/login', [CaisseController::class, 'login'])->name('caisse.login');
        Route::post('/login', [CaisseController::class, 'handleLogin'])->name('caisse.handleLogin');
    });

    Route::middleware('auth:agent')->prefix('agent')->group(function(){
        Route::get('/dashboard', [AgentController::class, 'agentdashboard'])->name('agent.dashboard');
        Route::get('/vue', [AgentController::class, 'agentvue'])->name('agent.vue');
        Route::get('/logout', [AgentController::class, 'logout'])->name('agent.logout');
    });
    Route::middleware('cnpsagent')->prefix('cnps/agent')->group(function(){
        Route::get('/dashboard', [CnpsAgentController::class, 'dashboard'])->name('cnpsagent.dashboard');
        Route::get('/logout', [CnpsAgentController::class, 'logout'])->name('cnpsagent.logout');
    });

    Route::middleware('cgraeagent')->prefix('cgrae/agent')->group(function(){
        Route::get('/dashboard', [CgraeAgentController::class, 'dashboard'])->name('cgraeagent.dashboard');
        Route::get('/logout', [CgraeAgentController::class, 'logout'])->name('cgraeagent.logout');
    });

    Route::middleware('ministereagent')->prefix('ministere/agent')->group(function(){
        Route::get('/dashboard', [MinistereAgentController::class, 'dashboard'])->name('ministereagent.dashboard');
        Route::get('/logout', [MinistereAgentController::class, 'logout'])->name('ministereagent.logout');
    });
    Route::middleware('ajoint')->prefix('ajoint')->group(function(){
        Route::get('/vue', [AjointController::class, 'ajointvue'])->name('ajoint.dashboard');
        Route::get('/logout', [AjointController::class, 'logout'])->name('ajoint.logout');
    });

    Route::middleware('caisse')->prefix('caisse')->group(function(){
        Route::get('/vue', [CaisseController::class, 'dashboard'])->name('caisse.dashboard');
        Route::get('/logout', [CaisseController::class, 'logout'])->name('caisse.logout');
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
        Route::get('/download-contagion/{id}', [DecesHopController::class, 'downloadcontagion'])->name('decesHop.downloadcontagion');
    });

    // Les routes pour les statistiques
    Route::prefix('stats')->group(function () {
        Route::get('/', [StatController::class, 'index'])->name('stats.index');
        Route::get('/download', [StatController::class, 'download'])->name('stats.download');
        Route::get('/super', [StatController::class, 'superindex'])->name('stats.superindex');
        Route::get('/directeur-stats', [StatController::class, 'directeurindex'])->name('stats.directeurindex');
        Route::get('/super/download', [StatController::class, 'superdownload'])->name('stats.superdownload');
        Route::get('/directeur/download', [StatController::class, 'directeurdownload'])->name('stats.directeurdownload');
        Route::get('/deces/delete/{deces}', [DecesController::class, 'delete'])->name('deces.statdelete');
    });
    

      

    //les routes de declarations naissances
    Route::prefix('naissances/declarations')->group(function() {
        Route::get('/', [NaissanceDeclaController::class, 'index'])->name('naissanced.index');        
        Route::post('/create', [NaissanceDeclaController::class, 'store'])->name('naissanced.store');
        Route::get('/create', [NaissanceDeclaController::class, 'create'])->name('naissanced.create');
        Route::get('/naissanced/{id}', [NaissanceDeclaController::class, 'show'])->name('naissanced.show');
        Route::get('/naissanced/delete/{naissanceD}', [NaissanceDeclaController::class, 'delete'])->name('naissanced.delete');

    });
    //les routes de deces
    Route::prefix('deces')->group(function() {
        Route::get('/', [DecesController::class, 'index'])->name('deces.index');        
        Route::get('/agent', [DecesController::class, 'agentindex'])->name('deces.agentindex');        
        Route::get('/ajoint', [DecesController::class, 'ajointindex'])->name('deces.ajointindex');        
        Route::post('/create', [DecesController::class, 'store'])->name('deces.store');
        Route::get('/create', [DecesController::class, 'create'])->name('deces.create');
        Route::get('/deces/{id}', [DecesController::class, 'show'])->name('deces.show');
        Route::get('/create/deja',[DecesController::class,'createdeja'])->name('deces.createdeja');
        Route::post('/create/deja-store',[DecesController::class,'storedeja'])->name('deces.storedeja');
        Route::get('/create-deja', [DecesController::class, 'indexdeja'])->name('deces.indexdeja'); 
        Route::get('/deces/delete/{deces}', [DecesController::class, 'delete'])->name('deces.delete');
        Route::get('/decesdeja/delete/{decesdeja}', [DecesController::class, 'deletedeja'])->name('deces.deletedeja'); 
    });

    //les routes de mariages
    Route::prefix('mariages')->group(function() {
        Route::get('/', [MariageController::class, 'index'])->name('mariage.index');        
        Route::get('/agent', [MariageController::class, 'agentindex'])->name('mariage.agentindex');        
        Route::get('/ajoint', [MariageController::class, 'ajointindex'])->name('mariage.ajointindex');        
        Route::post('/create', [MariageController::class, 'store'])->name('mariage.store');
        Route::get('/create', [MariageController::class, 'create'])->name('mariage.create');
        Route::get('/mariage/{id}', [MariageController::class, 'show'])->name('mariage.show');
        Route::get('/mariage/delete/{mariage}', [MariageController::class, 'delete'])->name('mariage.delete');
    });

    Route::post('/alerts/{id}/mark-as-read', [VendorDashboard::class, 'markAlertAsRead']);
    

    require __DIR__.'/auth.php';
    require __DIR__.'/admin-auth.php';
