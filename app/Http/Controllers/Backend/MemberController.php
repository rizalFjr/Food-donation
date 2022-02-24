<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Traits\GeneralTraits;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\ResponseFormatter;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use GeneralTraits;
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Member::select(['members.*', 'users.name', 'users.email'])
                            ->join('users', 'users.id', '=', 'members.user_id');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        return '<div class="dropdown dropleft">
                                    <button class="btn btn-secondary btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="'.route('members.show', $row->id).'"><i class="fas fa-eye"></i> View</a>
                                        <a class="dropdown-item" href="'.route('members.edit', $row->id).'"><i class="fas fa-pencil-alt"></i> Edit</a>
                                        <form action="'.route('members.destroy', $row->id).'" method="POST">
                                            '.method_field("DELETE").'
                                            '.csrf_field().'
                                            <button type="submit" class="dropdown-item btn-delete" onclick="return confirm(\'Are You Sure Want to Delete?\')"><i class="fas fa-trash"></i> Delete</button>
                                        </form>
                                    </div>
                                </div>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('pages.member.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.member.create');
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
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255|unique:users',
                'password' => 'required|string|min:8',
                'no_telp' => 'required|string|max:255',
                'foto' => 'image|mimes:jpeg,png,jpg',
            ]
        );
        if ($validate->fails()) {
            return back()->with('errors', $validate->messages()->all()[0])->withInput();
        } else {
            $users = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $users->assignRole('user');

            $members = Member::create([
                'user_id' => $users->id,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'rw' => $request->rw,
                'rt' => $request->rt,
                'kode_pos' => $request->kode_pos,
               
            ]);

            
            if ($request->file('foto')) {
                $photo_profile = $request->file('foto');
                $path_profile = '/uploads/images/photo-profile';

                $filename_photo = $this->storeCompressImage($photo_profile, $path_profile);

                $members->update([
                    'foto' => $filename_photo,
                ]);
            }

            if($users && $members) {
                return redirect()->route('members.index')->with('success','Member created successfully.');
            } else {
                return back()->with('errors', 'Member created failed.');
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
        $members = DB::table('members')
                        ->select(
                            'members.*', 
                            'users.name as name', 'users.email as email', 
                            'provinces.name as provinsi', 'regencies.name as kota', 'districts.name as kecamatan', 'villages.name as kelurahan',
                        )
                        ->join('users', 'users.id', '=', 'members.user_id')
                        ->leftJoin('provinces', 'provinces.id', '=', 'members.provinsi')
                        ->leftJoin('regencies', 'regencies.id', '=', 'members.kota')
                        ->leftJoin('districts', 'districts.id', '=', 'members.kecamatan')
                        ->leftJoin('villages', 'villages.id', '=', 'members.kelurahan')
                        ->where('members.id', '=', $id)
                        ->first();

        return view('pages.member.show', [
            'item' => $members,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $members = DB::table('members')
                        ->select(
                            'members.*', 
                            'users.name as name', 'users.email as email', 
                        )
                        ->join('users', 'users.id', '=', 'members.user_id')
                        ->where('members.id', '=', $id)
                        ->first();

        return view('pages.member.edit', [
            'item' => $members,
        ]);
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
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'no_telp' => 'required|string|max:255',
                'foto' => 'image|mimes:jpeg,png,jpg',
            ]
        );
        if ($validate->fails()) {
            return back()->with('errors', $validate->messages()->all()[0])->withInput();
        } else {

            $members = Member::findOrFail($id);
            $users = User::findOrFail($members->user_id);
            $users->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);
           
            $members->update([
                'user_id' => $users->id,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'rw' => $request->rw,
                'rt' => $request->rt,
                'kode_pos' => $request->kode_pos,
            ]);

            if($request->password) {
                $users->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            if ($request->file('foto')) {
                $file_path = public_path('/uploads/images/photo-profile/');
                File::delete($file_path.$members->foto);

                $photo_profile = $request->file('foto');
                $path_profile = '/uploads/images/photo-profile';

                $filename_photo = $this->storeCompressImage($photo_profile, $path_profile);

                $members->update([
                    'foto' => $filename_photo,
                ]);
            } 

            if($users && $members) {
                return redirect()->route('members.index')->with('success','Member created successfully.');
            } else {
                return back()->with('errors', 'Member created failed.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $members = Member::findOrFail($id);
        $users = User::findOrFail($members->user_id);
        $file_path = public_path('/uploads/images/photo-profile/');

        File::delete($file_path.$members->foto);
        $users->delete();
        $members->delete();

        return redirect()->route('members.index')->with('success','Member deleted successfully.');
    }

    public function getMembers($id) {
        $members = Member::findOrFail($id);
        if ($members) {
            return ResponseFormatter::success($members, "Data member berhasil diambil.");
        } else {
            return ResponseFormatter::error(null, "Data member tidak ada.", 404);
        }
    }
}
