<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private $register_validate = [
        'name'=> 'required|max:30|unique:permissions,name'
    ];
    private function updateValidate($id)
    {
        return [
            'name' => 'required|max:30|unique:permissions,name,' . $id,
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('permission/viewPermission', compact("permissions"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permission/createPermission');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate($this->register_validate);
        Permission::create(['name' => $request->name]);
        return redirect()->route('permission.index')->with('success','New permission create successfully.');
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
        $permission = Permission::find($id);
        return view('permission/editPermission', compact('permission'));
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
        $validatedData= $request->validate($this->updateValidate($id));
        $permission = Permission::find($id);
        $permission->update($validatedData);
        return redirect()->route('permission.index')->with('success','Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);
        if ($permission) {
            $permission->delete();
            return redirect()->route('permission.index')->with('success','Permission deleted successfully.');
        }
        return redirect()->route('permission.index')->with('fail','Permission not found.');
    }
}
