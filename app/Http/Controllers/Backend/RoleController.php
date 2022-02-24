<?php

namespace App\Http\Controllers\Backend;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        return '<div class="dropdown dropleft">
                        <button class="btn btn-secondary btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="'.route('role.edit', $row->id).'"><i class="fas fa-pencil-alt"></i> Edit</a>
                            <form action="'.route('role.destroy', $row->id).'" method="POST">
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
        
        return view('pages.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.role.create');
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
            ]
        );
        if($validate->fails()) {
            return back()->with('errors', $validate->messages()->all()[0])->withInput();           
        } else {
            $role = Role::create([
                'name' => $request->name,
            ]);

            if($role) {
                return redirect()->route('role.index')->with('success','Role created successfully.');
            } else {
                return back()->with('errors', 'Role created failed.');
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
        $role = Role::findOrFail($id);

        return view('pages.role.edit', [
            'item' => $role,
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
            $role = Role::findOrFail($id);
            $role->update($data);

            if($role) {
                return redirect()->route('role.index')->with('success','Role updated successfully.');
            } else {
                return back()->with('errors', 'Role updated failed.');
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
        $role = Role::findOrFail($id);
        $role->delete();
    
        return redirect()->route('role.index')->with('success','Role deleted successfully.');
    }
}
