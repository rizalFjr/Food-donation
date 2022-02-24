<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Member;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DonationHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\ResponseFormatter;
use App\Models\DonationDetails;

class DonationController extends Controller
{
    public function storeDonation(Request $request)
    {
        try {
            $request->validate([
                'pick_up_date' => 'required|date_format:"Y-m-d"',
                'alamat' => 'required',
                'provinsi' => 'required',
                'kota' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'rw' => 'required',
                'rt' => 'required',
                'kode_pos' => 'required',
            ]);

            $members = Member::where('user_id', '=', Auth::user()->id)->firstOrFail();

            $donation = Donation::create([
                'donation_date' => Carbon::now(),
                'pick_up_date' => $request->pick_up_date,
                'members_id' => $members->id,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'rw' => $request->rw, 
                'rt' => $request->rt, 
                'kode_pos' => $request->kode_pos, 
            ]);

            $history = DonationHistory::create([
                'donations_id' => $donation->id,
                'donation_statuses_id' => 1,
                'users_id' => Auth::user()->id,
                'histories_date' => Carbon::now(),
            ]);

            $items = json_decode($request->items);

            foreach ($items as $item) {
                $food = DonationDetails::findOrFail($item->id);

                $food->update([
                    'donations_id' => $donation->id,
                    'status' => 'checked_out',
                ]);
            }

            return ResponseFormatter::success([
                'donation' => $donation,
                'item' => $food,
                'history' => $history,
            ], "Donasi berhasil ditambahkan.");
            
        } catch (Exception $error) {
            return ResponseFormatter::error($error, "Donasi gagal ditambahkan.", 404);
        }
    }

    public function cancelDonation(Request $request)
    {
        try {
            $history = DonationHistory::create([
                'donations_id' => $request->id,
                'donation_statuses_id' => 4,
                'users_id' => Auth::user()->id,
                'histories_date' => Carbon::now(),
            ]);

            return ResponseFormatter::success([
                'history' => $history,
            ], "Donasi berhasil dibatalkan.");
        }  catch (Exception $error) {
            return ResponseFormatter::error($error, "Donasi gagal dibatalkan.", 404);
        }
    }
}
