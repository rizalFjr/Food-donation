<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DonationDetails;
use App\Models\Member;
use App\Traits\GeneralTraits;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DonationItemsController extends Controller
{
    use GeneralTraits;
    
    public function storeCart(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'donation_categories_id' => 'required',
                'quantities_id' => 'required',
                'nama_barang' => 'required|string|max:255',
                'jumlah' => 'required|integer|min:1',
                'foto' => 'image|mimes:jpeg,png,jpg',
            ]
        );

        if ($validator->fails()) {
            return ResponseFormatter::error(['error' => $validator->errors()], 'Add item cart fails', 401);
        }

        if ($request->file('foto')) {
            $members = Member::where('user_id', '=', Auth::user()->id)->firstOrFail();

            $photo_food = $request->file('foto');
            $path_food = '/uploads/images/food';

            $filename_photo = $this->storeCompressImage($photo_food, $path_food);

            $items = DonationDetails::create([
                        'members_id' => $members->id,
                        'donation_categories_id' => $request->donation_categories_id,
                        'quantities_id' => $request->quantities_id,
                        'nama_barang' => $request->nama_barang,
                        'jumlah' => $request->jumlah,
                        'foto' => $filename_photo,
                        'status' => 'in_cart',
                    ]);

            return ResponseFormatter::success($items, 'Add item cart successfully');
        }
    }

    public function getCart(Request $request)
    {
        try {

            $members = Member::where('user_id', '=', Auth::user()->id)->firstOrFail();

            $cart_item = DonationDetails::select(['donation_details.*', 'quantities.name as quantity'])
                                        ->where('status', '=', 'in_cart')
                                        ->where('members_id', '=', $members->id)
                                        ->join('quantities', 'quantities.id', '=', 'donation_details.quantities_id')
                                        ->get();

            return ResponseFormatter::success($cart_item, 'Get item cart successfully');
        } catch (Exception $error) {
            return ResponseFormatter::error($error, 'Get item cart failed');
        }
    }

    public function removeItem(Request $request)
    {
        try {
            $food = DonationDetails::findOrFail($request->id);
            $file_path = public_path('/uploads/images/food/');

            File::delete($file_path.$food->foto);
            $food->delete();

            return ResponseFormatter::success(null, 'Delete item cart successfully');
        } catch (Exception $error) {
            return ResponseFormatter::error($error, 'Delete item cart failed');
        }
    }
}
