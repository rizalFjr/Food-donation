<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Terms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\ResponseFormatter;

class TermsController extends Controller
{
    public function getTerms()
    {
        try {
            $terms = Terms::select('*')->orderBy('id', 'DESC')->first();

            return ResponseFormatter::success($terms, "Data terms berhasil diambil.");
        } catch (Exception $error) {
            return ResponseFormatter::error(null, "Data terms tidak ada.", 404);
        }
    }
}
