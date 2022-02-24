<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\DonationDetails;
use App\Models\DonationHistory;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DonationDetailsController extends Controller
{
    public function getDonationdetails($id)
    {
        try {
            $donationdetails = Donation::select([
                                                'donations.*', 
                                                'provinces.name as provinsi', 
                                                'regencies.name as kota', 
                                                'districts.name as kecamatan',
                                                'villages.name as kelurahan',
                                                'users.name as members',
                                                'members.no_telp',
                                                'donation_statuses.name as status',
                                                ])
                                            ->leftJoin(DB::raw(
                                                    '(SELECT MAX(`id`) as histories_id, donations_id FROM `donation_histories` GROUP BY `donations_id`) donation_histories_1' 
                                                ), function($join) {
                                                    $join->on('donations.id', '=', 'donation_histories_1.donations_id' );
                                                })
                                            ->leftJoin('members', 'members.id', '=', 'donations.members_id')
                                            ->leftJoin('users', 'users.id', '=', 'members.user_id')
                                            ->leftJoin('provinces', 'provinces.id', '=', 'donations.provinsi')
                                            ->leftJoin('regencies', 'regencies.id', '=', 'donations.kota')
                                            ->leftJoin('districts', 'districts.id', '=', 'donations.kecamatan')
                                            ->leftJoin('villages', 'villages.id', '=', 'donations.kelurahan')
                                            ->leftJoin('donation_histories', 'donation_histories_1.histories_id', '=', 'donation_histories.id')
                                            ->leftJoin('donation_statuses', 'donation_statuses.id', '=', 'donation_histories.donation_statuses_id')
                                            ->where('donations.id', '=', $id)
                                            ->where('users.id', '=', Auth::user()->id)
                                            ->with([
                                                'items' => function ($query) {
                                                    $query->select(['donation_details.*', 'quantities.name as quantity', 'donation_categories.name as category'])
                                                          ->join('quantities', 'quantities.id', '=', 'donation_details.quantities_id')
                                                          ->join('donation_categories', 'donation_categories.id', '=', 'donation_details.donation_categories_id');
                                                },
                                                'histories' => function ($query) {
                                                    $query->join('donation_statuses', 'donation_statuses.id', '=', 'donation_histories.donation_statuses_id')
                                                          ->orderBy('donation_histories.id', 'DESC');
                                                }
                                            ])->firstOrFail();

            return ResponseFormatter::success($donationdetails, "Data Donasi berhasil ditampilkan");
            
        } catch (Exception $error) {
            return ResponseFormatter::error(null, "Data Donasi gagal ditampilkan.", 404);
        }
    }

}
