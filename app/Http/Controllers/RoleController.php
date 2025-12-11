<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $validate = [
        'name'=> 'required|max:30|unique:roles,name',
        'permissions' => 'nullable|array',
    ];

    private function updateValidate($id)
    {
        return [
            'name' => 'required|max:30|unique:roles,name,'.$id,
            'permissions' => 'nullable|array',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("viewAny",Role::class);

        $roles = Role::all();
        return view('role/viewRole', compact("roles"));
    }

    public function edit($id)
    {
        $role = Role::find($id);

        $this->authorize("update",$role);

        $permissions = Permission::all();

        return view('role/editRole', compact('role', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize("create",Role::class);

        $validatedData = $request->validate( $this->validate);
        $role = Role::create(["name"=>$validatedData["name"]]);

        // check if the permissions is not null and then attach the permission to the role
        if ($request->permissions == null) 
        {
            return redirect()->route('role.index')->with('fail','Role create successfully but no permission attached.');
        }
        else
        {
            foreach ($validatedData["permissions"] as $key=>$permission) {
                $permission = Permission::firstOrCreate(['name' => $permission]);
                $validatedData["permissions"][$key] = $permission->id;
            }
            $role->permissions()->attach($validatedData["permissions"]); 
        }
        
        return redirect()->route('role.index')->with('success','New role create successfully.');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize("view",Role::class);

        $role = Role::find($id);
        if ($role){
            return ($role->name);
        }
        return redirect()->route('role.index')->with('fail','Role not found.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize("create",Role::class);

        $permissions = Permission::all();

        return view('role/createRole',compact("permissions"));
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
        $role = Role::find($id);

        $this->authorize("update",$role);

        if (!$role) {
            return redirect()->route('role.index')->with('fail','Role not found.');
        }
        $role_update = $request->validate($this->updateValidate($id));

        $role->update(["name"=>$role_update["name"]]);

        // check if the permissions is not null and then attach the permission to the role
        if ($request->permissions == null) {
            $role->permissions()->detach();
            return redirect()->route('role.index')->with('fail','Role update successfully but no permission attached.');
        }
        else
        {
            foreach ($role_update["permissions"] as $key=>$permission) {
                $permission = Permission::firstOrCreate(['name' => $permission]);
                $role_update["permissions"][$key] = $permission->id;
            }
            $role->permissions()->sync($role_update["permissions"]);
        }

        // the with is to store the Role update successfully into success flash session
        return redirect()->route('role.index')->with('success','Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize("delete",Role::class);

        $role = Role::find($id);

        if ($role) {
            $role->delete();
            return redirect()->route('role.index')->with('success','Role delete successfully.');
        }
        return redirect()->route('role.index')->with('fail','Role not found.');
    }
}
