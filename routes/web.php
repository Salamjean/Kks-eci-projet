<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DecesController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Doctors\DoctorDashboard;
use App\Http\Controllers\Doctors\SousDoctorsDashboard;
use App\Http\Controllers\Vendor\VendorDashboard;
use App\Http\Controllers\MariageController;
use App\Http\Controllers\NaissanceController;
use App\Http\Controllers\NaissanceDeclaController;
use App\Http\Controllers\NaissHopController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SousAdminController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;
use App\Models\Naissance;
use App\Models\Vendor;
use App\Models\Alert;

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/doctor/dashboard', function () {
    return view('doctor.dashboard');
});
Route::get('/admin/login', function () {
    return view('admin.auth.login');
});



// Route pour le tableau de bord (affichage général)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');




// Routes pour les naissances



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
    Route::middleware('auth:vendor')->prefix('vendors/dashboard')->group(function(){
        Route::get('/',[VendorDashboard::class, 'index'])->name('vendor.dashboard');
        Route::get('/logout',[VendorDashboard::class, 'logout'])->name('vendor.logout');
    });
    //Authentication de l'Administrador (Mairie)
    Route::prefix('vendors/')->group(function () {
        Route::get('/register', [VendorController::class, 'register'])->name('vendor.register');
        Route::post('/register', [VendorController::class, 'handleRegister'])->name('vendor.handleRegister');
        Route::get('/login', [VendorController::class, 'login'])->name('vendor.login');
        Route::post('/login', [VendorController::class, 'handleLogin'])->name('vendor.handleLogin');
        Route::get('/naissance/{id}/edit', [VendorController::class, 'edit'])->name('naissances.edit');
        Route::post('/naissance/{id}/update-etat', [VendorController::class, 'updateEtat'])->name('naissances.updateEtat');

    });

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
        Route::get('/edit/{$sousadmin}',[SousAdminController::class, 'edit'])->name('doctor.edit');
        Route::put('/edit/{$sousadmin}',[SousAdminController::class, 'update'])->name('doctor.update');
    });
    Route::get('/validate-account/{email}', [SousAdminController::class, 'defineAccess']);
    Route::post('/validate-account/{email}', [SousAdminController::class, 'submitDefineAccess'])->name('doctor.validate');


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
        Route::post('/create', [NaissanceController::class, 'store'])->name('naissance.store');
        Route::get('/create', [NaissanceController::class, 'create'])->name('naissance.create');
        Route::get('/edit/{naissance}', [NaissanceController::class, 'edit'])->name('naissance.edit');
        Route::get('/naissance/{id}', [NaissanceController::class, 'show'])->name('naissance.show');
    });

    Route::prefix('naissHop')->group(function() {
        //les routes cotés hopitals
        Route::get('/', [NaissHopController::class, 'index'])->name('naissHop.index');        
        Route::post('/create', [NaissHopController::class, 'store'])->name('naissHop.store');
        Route::get('/create', [NaissHopController::class, 'create'])->name('naissHop.create');
        Route::get('/edit/{naisshop}', [NaissHopController::class, 'edit'])->name('naissHop.edit');
        Route::put('/edit/{naisshop}', [NaissHopController::class, 'update'])->name('naissHop.update');
        Route::get('/delete/{naisshop}', [NaissHopController::class, 'delete'])->name('naissHop.delete');
        Route::get('/naissHop/{id}', [NaissHopController::class, 'show'])->name('naissHop.show');
        Route::post('/verifier-code-dm', [NaissHopController::class, 'verifierCodeDM'])->name('verifierCodeDM');
        Route::get('/naisshop/download/{id}', [NaissHopController::class, 'download'])->name('naissHop.download');

        //les routes cotés administrator (Mairie)
        Route::get('/vendors', [NaissHopController::class, 'mairieindex'])->name('naissHop.mairieindex'); 

    });

    //les routes de declarations naissances
    Route::prefix('naissances/declarations')->group(function() {
        Route::get('/', [NaissanceDeclaController::class, 'index'])->name('naissanced.index');        
        Route::post('/create', [NaissanceDeclaController::class, 'store'])->name('naissanced.store');
        Route::get('/create', [NaissanceDeclaController::class, 'create'])->name('naissanced.create');
        Route::get('/edit/{naissance}', [NaissanceDeclaController::class, 'edit'])->name('naissanced.edit');

    });
    //les routes de deces
    Route::prefix('deces')->group(function() {
        Route::get('/', [DecesController::class, 'index'])->name('deces.index');        
        Route::post('/create', [DecesController::class, 'store'])->name('deces.store');
        Route::get('/create', [DecesController::class, 'create'])->name('deces.create');
        Route::get('/edit/{deces}', [DecesController::class, 'edit'])->name('deces.edit');
    });

    //les routes de mariages
    Route::prefix('mariages')->group(function() {
        Route::get('/', [MariageController::class, 'index'])->name('mariage.index');        
        Route::post('/create', [MariageController::class, 'store'])->name('mariage.store');
        Route::get('/create', [MariageController::class, 'create'])->name('mariage.create');
        Route::get('/edit/{mariage}', [MariageController::class, 'edit'])->name('mariage.edit');
        Route::get('/mariage/{id}', [MariageController::class, 'show'])->name('mariage.show');
    });

    Route::post('/alerts/{id}/mark-as-read', [VendorDashboard::class, 'markAlertAsRead']);


    require __DIR__.'/auth.php';
    require __DIR__.'/admin-auth.php';
