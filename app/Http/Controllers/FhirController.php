<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Satusehat\Integration\KYC;

class FhirController extends Controller
{
    public function kyc_url()
    {
        // Check SATUSEHAT_ENV if not PROD, redirect to home with error message
        if (env('SATUSEHAT_ENV') != "PROD") {
            return redirect()
                ->route('filament.admin.pages.k-y-c')
                ->with('error', 'KYC memerlukan settingan environment SATUSEHAT Production.');
        }

        $kyc = new KYC;

        // DEBUGGING KYC Validation in $kyc
        dd($kyc);

        // Pass current user name and NIK to generate URL
        $json = $kyc->generateUrl(Auth::user()->name, Auth::user()->nik);
        $kyc_link = json_decode($json, true);

        // DEBUGGING response in $json
        dd($json);

        return redirect($kyc_link['data']['url']);
    }
}
