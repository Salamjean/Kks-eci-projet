<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CinetPay\CinetPay;

class PaiementController extends Controller
{
    public function initierPaiement(Request $request)
    {
        // Récupérer les données du formulaire
        $data = $request->all();

        // Configuration CinetPay
        $apiKey = config('services.cinetpay.api_key');
        $siteId = config('services.cinetpay.site_id');
        $version = 'V1';
        $currency = 'XOF'; // Devise (Franc CFA)
        $transactionId = uniqid(); // ID unique pour la transaction
        $amount = 2000; // Montant total (500 pour le timbre + 1500 pour la livraison)
        $description = 'Paiement pour extrait de naissance et livraison';

        // Initialisation de CinetPay
        $cinetPay = new CinetPay($siteId, $apiKey);

        // Paramètres de la transaction
        $params = [
            'transaction_id' => $transactionId,
            'amount' => $amount,
            'currency' => $currency,
            'description' => $description,
            'return_url' => route('paiement.success'), // URL de retour après paiement
            'notify_url' => route('paiement.notify'), // URL de notification (webhook)
            'customer_name' => $data['nom_destinataire'],
            'customer_surname' => $data['prenom_destinataire'],
            'customer_email' => $data['email_destinataire'],
            'customer_phone_number' => $data['contact_destinataire'],
        ];

        try {
            // Initialiser le paiement
            $cinetPay->setRequestData($params);
            $paymentUrl = $cinetPay->getPaymentUrl();

            // Rediriger l'utilisateur vers la page de paiement CinetPay
            return redirect()->away($paymentUrl);
        } catch (\Exception $e) {
            // Gérer les erreurs
            return back()->with('error', 'Erreur lors de l\'initialisation du paiement : ' . $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        // Traitement après un paiement réussi
        return view('paiement.success'); // Afficher une vue de succès
    }

    public function notify(Request $request)
    {
        // Traitement des notifications CinetPay (webhook)
        $transactionId = $request->input('cpm_trans_id');
        $status = $request->input('cpm_result');

        // Mettre à jour la base de données selon le statut du paiement
        if ($status === '00') {
            // Paiement réussi
        } else {
            // Paiement échoué
        }

        return response()->json(['status' => 'ok']);
    }
}