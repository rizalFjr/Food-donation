<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Quantity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\ResponseFormatter;

class QuantityController extends Controller
{
    public function getQuantity()
    {
        try {
            $quantity = Quantity::all();

            return ResponseFormatter::success($quantity, "Data quantity berhasil diambil.");

        } catch (Exception $error) {
            return ResponseFormatter::error(null, "Data quantity tidak ada.", 404);
        }
    }
}
