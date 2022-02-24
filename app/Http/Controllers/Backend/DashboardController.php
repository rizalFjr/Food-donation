<?php

namespace App\Http\Controllers\Backend;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\DonationHistory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        $menunggu = DonationHistory::join(DB::raw(
                                                    '(SELECT MAX(`id`) as histories_id, donations_id FROM donation_histories GROUP BY donations_id) histories'
                                                ), function($join) {
                                                    $join->on('donation_histories.id', '=', 'histories.histories_id');
                                                })
                                    ->where('donation_statuses_id',1)->count();
        $proses = DonationHistory::join(DB::raw(
                                                    '(SELECT MAX(`id`) as histories_id, donations_id FROM donation_histories GROUP BY donations_id) histories'
                                                ), function($join) {
                                                    $join->on('donation_histories.id', '=', 'histories.histories_id');
                                                })
                                ->where('donation_statuses_id',2)->count();
        $berhasil = DonationHistory::join(DB::raw(
                                                    '(SELECT MAX(`id`) as histories_id, donations_id FROM donation_histories GROUP BY donations_id) histories'
                                                ), function($join) {
                                                    $join->on('donation_histories.id', '=', 'histories.histories_id');
                                                })
                                    ->where('donation_statuses_id',3)->count();
        $members = Member::count();



        return view('pages.dashboard.dashboard', [
            'tunggu' => $menunggu,
            'proses' => $proses, 
            'berhasil' => $berhasil, 
            'members' => $members
        ]);
    }
}
