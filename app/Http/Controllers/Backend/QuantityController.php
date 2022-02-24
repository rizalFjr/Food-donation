<?php

namespace App\Http\Controllers\Backend;

use App\Models\Quantity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class QuantityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Quantity::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        return '<div class="dropdown dropleft">
                                    <button class="btn btn-secondary btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="'.route('quantity.edit', $row->id).'"><i class="fas fa-pencil-alt"></i> Edit</a>
                                        <form action="'.route('quantity.destroy', $row->id).'" method="POST">
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
        
        return view('pages.quantity.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.quantity.create');
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
            $quantity = Quantity::create([
                'name' => $request->name,
                'description' => $request->description,
               
            ]);

            if($quantity) {
                return redirect()->route('quantity.index')->with('success','Quantity created successfully.');
            } else {
                return back()->with('errors', 'Quantity created failed.');
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
        $quantity = Quantity::findOrFail($id);

        return view('pages.quantity.edit', [
            'item' => $quantity,
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
                // 'description' => 'required|string|max:255',
            ]
        );
        if($validate->fails()) {
            return back()->with('errors', $validate->messages()->all()[0])->withInput();           
        } else {
            $data = $request->all();
            $quantity = Quantity::findOrFail($id);
            $quantity->update($data);

            if($quantity) {
                return redirect()->route('quantity.index')->with('success','Quantity updated successfully.');
            } else {
                return back()->with('errors', 'Quantity updated failed.');
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
        $quantity = Quantity::findOrFail($id);
        $quantity->delete();
    
        return redirect()->route('quantity.index')->with('success','Quantity deleted successfully.');
    }
}
