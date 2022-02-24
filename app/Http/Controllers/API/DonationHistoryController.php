<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;
use App\Models\DonationHistory;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\ResponseFormatter;
use App\Models\Donation;
use App\Models\Member;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DonationHistoryController extends Controller
{
    public function getDonationhistory(Request $request)
    {
        try {
            $members = Member::where('user_id', '=', Auth::user()->id)->firstOrFail();

            $donation = Donation::select(['donations.*', 'donation_statuses.name as status', 'donation_details.nama_barang', 'donation_details_2.total_items'])
                                    ->leftJoin(DB::raw(
                                        '(SELECT MAX(`id`) as histories_id, donations_id FROM `donation_histories` GROUP BY `donations_id`) donation_histories_1' 
                                    ), function($join) {
                                        $join->on('donations.id', '=', 'donation_histories_1.donations_id' );
                                    })
                                    ->leftJoin(DB::raw(
                                        '(SELECT MAX(`id`) as items_id, donations_id FROM `donation_details` GROUP BY `donations_id`) donation_details_1' 
                                    ), function($join) {
                                        $join->on('donations.id', '=', 'donation_details_1.donations_id' );
                                    })
                                    ->leftJoin(DB::raw(
                                        '(SELECT Count(`id`)-1 as total_items, donations_id FROM `donation_details` GROUP BY `donations_id`) donation_details_2' 
                                    ), function($join) {
                                        $join->on('donations.id', '=', 'donation_details_2.donations_id' );
                                    })
                                    ->leftJoin('donation_histories', 'donation_histories_1.histories_id', '=', 'donation_histories.id')
                                    ->leftJoin('donation_details', 'donation_details_1.items_id', '=', 'donation_details.id')
                                    ->leftJoin('donation_statuses', 'donation_statuses.id', '=', 'donation_histories.donation_statuses_id')
                                    ->orderBy('donations.id', 'DESC')
                                    ->where('donations.members_id', '=', $members->id);

            if ($request->status) {
                $donation->where('donation_histories.donation_statuses_id', '=', $request->status);
            }

            $history = $donation->get();

            return ResponseFormatter::success($history, "Data history berhasil diambil.");

            
        } catch (Exception $error) {
            return ResponseFormatter::error(null, "Data History gagal diambil.", 404);
        }
    }
}
