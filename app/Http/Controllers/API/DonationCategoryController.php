<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;
use App\Models\DonationCategory;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\ResponseFormatter;

class DonationCategoryController extends Controller
{
    public function getDonationCategory()
    {
        try {
            $donation_category = DonationCategory::all();

            return ResponseFormatter::success($donation_category, "Data category berhasil diambil.");
        } catch (Exception $error) {
            return ResponseFormatter::error(null, "Data category tidak ada.", 404);
        }
    }
}
