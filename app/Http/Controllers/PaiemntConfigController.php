<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PaiemntConfig;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaiemntConfigController extends Controller
{
    public function getAccountInfo(){
        $superadmin =  auth('super_admin')->user()->id;
        $paiementInfo = PaiemntConfig::where('super_admin_id', $superadmin)->first();
        
        return view('compte_demande.info' ,compact('paiementInfo'));
    }

    public function handleUpdateInfo(Request $request){

        DB::beginTransaction();
        $request->validate([
            'api_key' => 'required',
            'site_id' => 'required',
            'secret_key' => 'required',
        ],[
            'api_key.required' => 'Api Key est requis',
            'site_id.required' => 'Site ID est requis',
           'secret_key.required' => 'Secret Key est requis',

        ]);

        try {
            $superadmin =  auth('super_admin')->user()->id;
            $existingAccount = PaiemntConfig::where('super_admin_id', $superadmin)->first();
            if($existingAccount){
                $existingAccount->api_key = $request->api_key;
                $existingAccount->site_id = $request->site_id;
                $existingAccount->secret_key = $request->secret_key;
                $existingAccount->update();
            }else{
                PaiemntConfig::create([
                    'super_admin_id' => $superadmin,
                    'api_key' => $request->api_key,
                    'site_id' => $request->site_id,
                    'secret_key' => $request->secret_key,
                ]);
            }
            return redirect()->back()->with('success', 'Informations mises à jour avec succès');
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Une erreur est survenue']);
        }
    
        
    }


}
