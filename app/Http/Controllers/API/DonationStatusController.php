<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DonationStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Exception;

class DonationStatusController extends Controller
{
    public function getDonationStatus()
    {
        try {
            $donation_status = DonationStatus::all();

            return ResponseFormatter::success($donation_status, "Data status berhasil diambil.");
        } catch (Exception $error) {
            return ResponseFormatter::error(null, "Data status tidak ada.", 404);
        }
    }
}
