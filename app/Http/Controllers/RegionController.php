<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\ResponseFormatter;
use App\Models\District;
use App\Models\Regency;

class RegionController extends Controller
{
    public function getProvinces() {
        $provinces = Province::all();
        if ($provinces) {
            return ResponseFormatter::success($provinces, "Data provinsi berhasil diambil.");
        } else {
            return ResponseFormatter::error(null, "Data provinsi tidak ada.", 404);
        }
    }

    public function getCities($id) {
        $province = Province::find($id);
        $regencies = $province->regencies;
        if ($regencies) {
            return ResponseFormatter::success($regencies, "Data kota berhasil diambil.");
        } else {
            return ResponseFormatter::error(null, "Data kota tidak ada.", 404);
        }
    }

    public function getDistricts($id) {
        $regencies = Regency::find($id);
        $districts = $regencies->districts;
        if ($districts) {
            return ResponseFormatter::success($districts, "Data kecamatan berhasil diambil.");
        } else {
            return ResponseFormatter::error(null, "Data kecamatan tidak ada.", 404);
        }
    }

    public function getVillages($id) {
        $district = District::find($id);
        $villages = $district->villages;
        if ($villages) {
            return ResponseFormatter::success($villages, "Data kelurahan berhasil diambil.");
        } else {
            return ResponseFormatter::error(null, "Data kelurahan tidak ada.", 404);
        }
    }
}
