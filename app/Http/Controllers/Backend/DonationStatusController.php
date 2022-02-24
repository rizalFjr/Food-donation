<?php

namespace App\Http\Controllers\Backend;

use App\Models\DonationStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;


class DonationStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DonationStatus::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        return '<div class="dropdown dropleft">
                        <button class="btn btn-secondary btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="'.route('donationstatus.edit', $row->id).'"><i class="fas fa-pencil-alt"></i> Edit</a>
                            <form action="'.route('donationstatus.destroy', $row->id).'" method="POST">
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
        
        return view('pages.donationstatus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.donationstatus.create');
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
                'description' => 'required|string|max:255',
            ]
        );
        if($validate->fails()) {
            return back()->with('errors', $validate->messages()->all()[0])->withInput();           
        } else {
            $donationstatus = DonationStatus::create([
                'name' => $request->name,
                'description' => $request->description,
               
            ]);

            if($donationstatus) {
                return redirect()->route('donationstatus.index')->with('success','Donation status created successfully.');
            } else {
                return back()->with('errors', 'Donation status created failed.');
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
        $donationstatus = DonationStatus::findOrFail($id);

        return view('pages.donationstatus.edit', [
            'item' => $donationstatus,
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
              
            ]
        );
        if($validate->fails()) {
            return back()->with('errors', $validate->messages()->all()[0])->withInput();           
        } else {
            $data = $request->all();
            $donationstatus = DonationStatus::findOrFail($id);
            $donationstatus->update($data);

            if($donationstatus) {
                return redirect()->route('donationstatus.index')->with('success','Donation status updated successfully.');
            } else {
                return back()->with('errors', 'Donation status updated failed.');
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
        $donationstatus = DonationStatus::findOrFail($id);
        $donationstatus->delete();
    
        return redirect()->route('donationstatus.index')->with('success','Donation status deleted successfully.');
    }
}
