<?php

namespace App\Http\Controllers\Backend;

use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DonationHistory;
use App\Models\Member;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Donation::select(['donations.*', 'members.no_telp', 'users.name', 'users.email', 'donation_statuses.name as status'])
                              ->leftJoin(DB::raw(
                                '(SELECT MAX(`id`) as histories_id, donations_id FROM `donation_histories` GROUP BY `donations_id`) donation_histories_1' 
                              ), function($join) {
                                $join->on('donations.id', '=', 'donation_histories_1.donations_id' );
                              })
                              ->leftJoin('members', 'members.id', '=', 'donations.members_id')
                              ->leftJoin('users', 'users.id', '=', 'members.user_id')
                              ->leftJoin('donation_histories', 'donation_histories_1.histories_id', '=', 'donation_histories.id')
                              ->leftJoin('donation_statuses', 'donation_statuses.id', '=', 'donation_histories.donation_statuses_id')
                              ->orderBy('donations.id', 'DESC')
                              ->orderBy('donation_histories.id', 'DESC');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $button = '';

                        if($row->status == 'Menunggu') {
                            $button = '<form action="'.route('donation.confirm', $row->id).'" method="POST">
                                            '.csrf_field().'
                                            <input type="hidden" name="donation_statuses_id" id="donation_statuses_id" value="2">
                                            <button type="submit" class="dropdown-item" onclick="return confirm(\'Are You Sure Want to Confirm?\')"><i class="fas fa-sync"></i> Proses</button>
                                        </form>';
                        } else if($row->status == 'Diproses') {
                            $button = '<form action="'.route('donation.confirm', $row->id).'" method="POST">
                                            '.csrf_field().'
                                            <input type="hidden" name="donation_statuses_id" id="donation_statuses_id" value="3">
                                            <button type="submit" class="dropdown-item" onclick="return confirm(\'Are You Sure Want to Confirm?\')"><i class="fas fa-check"></i> Selesai</button>
                                        </form>';
                        }
     
                        return '<div class="dropdown dropleft">
                                    <button class="btn btn-secondary btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="'.route('donation-details', $row->id).'"><i class="fas fa-eye"></i> View</a>
                                        '.$button.'
                                    </div>
                                </div>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('pages.donation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::select(['members.id', 'users.name as name'])
                          ->join('users', 'users.id', '=', 'members.user_id')->get();
        return view('pages.donation.create', [
            'members' => $members,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'donation_date' => 'required|date_format:"Y-m-d H:i:s"',
                'pick_up_date' => 'required|date_format:"Y-m-d"',
                'members_id' => 'required|exists:members,id',
                'alamat' => 'required|string|max:255',
                'provinsi' => 'required|exists:provinces,id',
                'kota' => 'required|exists:regencies,id',
                'kecamatan' => 'required|exists:districts,id',
                'kelurahan' => 'required|exists:villages,id',
                'rw' => 'required|string|max:255',
                'rt' => 'required|string|max:255',
                'kode_pos' => 'required|string|max:255',
            ]
        );
        if($validate->fails()) {
            return back()->with('errors', $validate->messages()->all()[0])->withInput();           
        } else {
            $donation = Donation::create([
                'donation_date' => $request->donation_date,
                'pick_up_date' => $request->pick_up_date,
                'members_id' => $request->members_id,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'rw' => $request->rw, 
                'rt' => $request->rt, 
                'kode_pos' => $request->kode_pos, 
            ]);

            if($donation) {
                DonationHistory::create([
                    'donations_id' => $donation->id,
                    'donation_statuses_id' => 1,
                    'users_id' => Auth::user()->id,
                    'histories_date' => Carbon::now(),
                ]);
                return redirect()->route('donation.index')->with('success','Donation created successfully.');
            } else {
                return back()->with('errors', 'Donation created failed.');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);
        $donation_histories = DonationHistory::where('donations_id', '=', $id);
        $donation_histories->delete();
        $donation->delete();

        return redirect()->route('donation.index')->with('success','Donation deleted successfully.');
    }

    public function confirm(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);
        DonationHistory::create([
            'donations_id' => $donation->id,
            'donation_statuses_id' => $request->donation_statuses_id,
            'histories_date' => Carbon::now(),
            'users_id' => Auth::user()->id,
        ]);

        return redirect()->route('donation.index')->with('success','Donation process successfully.');
    }
}
