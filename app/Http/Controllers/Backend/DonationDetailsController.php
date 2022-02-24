<?php

namespace App\Http\Controllers\Backend;

use App\Models\Member;
use App\Models\Donation;
use App\Models\Quantity;
use Illuminate\Http\Request;
use App\Traits\GeneralTraits;
use App\Models\DonationDetails;
use App\Models\DonationHistory;
use App\Models\DonationCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class DonationDetailsController extends Controller
{
    use GeneralTraits;

    public function getDetails($id) {
        $donation = Donation::select(['donations.*', 'members.no_telp', 'users.name', 'users.email', 'donation_statuses.name as status', 'provinces.name as nama_provinsi', 'regencies.name as nama_kota', 'districts.name as nama_kecamatan', 'villages.name as nama_kelurahan'])
                                ->join('members', 'members.id', '=', 'donations.members_id')
                                ->join('users', 'users.id', '=', 'members.user_id')
                                ->join('donation_histories', 'donations.id', '=', 'donation_histories.donations_id')
                                ->join('donation_statuses', 'donation_statuses.id', '=', 'donation_histories.donation_statuses_id')
                                ->leftJoin('provinces', 'provinces.id', '=', 'donations.provinsi')
                                ->leftJoin('regencies', 'regencies.id', '=', 'donations.kota')
                                ->leftJoin('districts', 'districts.id', '=', 'donations.kecamatan')
                                ->leftJoin('villages', 'villages.id', '=', 'donations.kelurahan')
                                ->where('donations.id', '=', $id)->firstOrFail();

        $donation_histories = DonationHistory::select(['donation_histories.*', 'donation_statuses.name as status', 'users.name as user'])
                                               ->join('donation_statuses', 'donation_statuses.id', '=', 'donation_histories.donation_statuses_id')
                                               ->join('users', 'users.id', '=', 'donation_histories.users_id')
                                               ->where('donations_id', '=', $donation->id)
                                               ->orderBy('donation_histories.id', 'DESC')
                                               ->get();


        return view('pages.donation-details.index', [
            'item' => $donation,
            'histories' => $donation_histories,
        ]);
    }

    public function getFood(Request $request, $id) {
        if($request->ajax()) {
            $food = DonationDetails::select(['donation_details.*', 'donation_categories.name as category', 'quantities.name as quantity'])
                                    ->join('donation_categories', 'donation_categories.id', '=', 'donation_details.donation_categories_id')
                                    ->join('quantities', 'quantities.id', '=', 'donation_details.quantities_id')
                                    ->where('donation_details.status', '=', 'checked_out')
                                    ->where('donation_details.donations_id', '=', $id);
            
            return DataTables::of($food)
                                ->addIndexColumn()
                                ->editColumn('jumlah', function ($row) {
                                    return $row->jumlah.' '.$row->quantity;
                                })
                                ->addColumn('image', function ($row) {
                                    $url = $row->foto ? asset('/uploads/images/food/'.$row->foto) : asset('/uploads/images/food/no-image.jpg');
                                    return '<div>
                                                <a id="image-click">
                                                    <img class="rounded" id="image-resource" src="'.$url.'" width="250" />
                                                </a>
                                            </div>';
                                })
                                ->addColumn('action', function($row){

                                    return '<div class="dropdown dropleft">
                                                <button class="btn btn-secondary btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="'.route('edit-food', $row->id).'"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                    <form action="'.route('delete-foods',  ['donation_id' => $row->donations_id, 'id' => $row->id]).'" method="POST">
                                                        '.method_field("DELETE").'
                                                        '.csrf_field().'
                                                        <button type="submit" class="dropdown-item btn-delete" onclick="return confirm(\'Are You Sure Want to Delete?\')"><i class="fas fa-trash"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>';
                                })
                                ->rawColumns(['image', 'action'])
                                ->make(true);
        }
    }

    public function createFood($id) {
        $donation = Donation::select(['members_id'])->where('id', '=', $id)->first();
        $category = DonationCategory::select(['id', 'name'])->get();
        $quantity = Quantity::select(['id', 'name'])->get();
        
        return view('pages.donation-details.create', [
            'donation_id' => $id,
            'members_id' => $donation->members_id,
            'categories' => $category,
            'quantities' => $quantity,
        ]);
    }

    public function storeFood(Request $request) {
        $validate = Validator::make(
            $request->all(),
            [
                'donations_id' => 'required',
                'donation_categories_id' => 'required',
                'quantities_id' => 'required',
                'nama_barang' => 'required|string|max:255',
                'jumlah' => 'required|integer|min:1',
                'foto' => 'image|mimes:jpeg,png,jpg',
            ]
        );
        if ($validate->fails()) {
            return back()->with('errors', $validate->messages()->all()[0])->withInput();
        } else {

            $food = DonationDetails::create([
                'donations_id' => $request->donations_id,
                'members_id' => $request->members_id,
                'donation_categories_id' => $request->donation_categories_id,
                'quantities_id' => $request->quantities_id,
                'nama_barang' => $request->nama_barang,
                'jumlah' => $request->jumlah,
                'status' => 'checked_out',
            ]);

            if ($request->file('foto')) {
                $photo_food = $request->file('foto');
                $path_food = '/uploads/images/food';

                $filename_photo = $this->storeCompressImage($photo_food, $path_food);

                $food->update([
                    'foto' => $filename_photo,
                ]);
            } 

            if($food) {
                return redirect()->route('donation-details', $request->donations_id)->with('success','Food created successfully.');
            } else {
                return back()->with('errors', 'Food created failed.');
            }
        }
    } 

    public function updateFood(Request $request, $id) {
        $validate = Validator::make(
            $request->all(),
            [
                'donations_id' => 'required',
                'donation_categories_id' => 'required',
                'quantities_id' => 'required',
                'nama_barang' => 'required|string|max:255',
                'jumlah' => 'required|integer|min:1',
                'foto' => 'image|mimes:jpeg,png,jpg',
            ]
        );
        if ($validate->fails()) {
            return back()->with('errors', $validate->messages()->all()[0])->withInput();
        } else {
            $food = DonationDetails::findOrFail($id);
            $food->update([
                'donations_id' => $request->donations_id,
                'donation_categories_id' => $request->donation_categories_id,
                'quantities_id' => $request->quantities_id,
                'nama_barang' => $request->nama_barang,
                'jumlah' => $request->jumlah,
                'status' => 'checked_out',
            ]);

            if ($request->file('foto')) {
                $file_path = public_path('/uploads/images/food/');
                File::delete($file_path.$food->foto);

                $photo_food = $request->file('foto');
                $path_food = '/uploads/images/food';

                $filename_photo = $this->storeCompressImage($photo_food, $path_food);

                $food->update([
                    'foto' => $filename_photo,
                ]);
            } 

            if($food) {
                return redirect()->route('donation-details', $request->donations_id)->with('success','Food updated successfully.');
            } else {
                return back()->with('errors', 'Food updated failed.');
            }
        }
    }

    public function editFood($id) {
        $food = DonationDetails::findOrFail($id);
        $category = DonationCategory::select(['id', 'name'])->get();
        $quantity = Quantity::select(['id', 'name'])->get();
        
        return view('pages.donation-details.edit', [
            'food' => $food,
            'categories' => $category,
            'quantities' => $quantity,
        ]);
    }

    public function destroyFood(Request $request, $donation_id, $id) {
        $food = DonationDetails::findOrFail($id);
        $file_path = public_path('/uploads/images/food/');

        File::delete($file_path.$food->foto);
        $food->delete();

        return redirect()->route('donation-details', $donation_id)->with('success','Food deleted successfully.');
    }
}
