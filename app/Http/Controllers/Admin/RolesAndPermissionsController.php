<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Admin\RolesStoreRequest;
class RolesAndPermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::all();

        return response()->json(['success' => true, 'data'=>$role],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {

    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RolesStoreRequest $request)
    {
        $data = $request->validated();
        $role = Role::create(['name' => $request->role, 'guard_name' => 'web'])->givePermissionTo($request->permissions);
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        return response()->json(['success' => true, 'data' => $role], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permissions = Permission::all();

        return response()->json(['success' => true, 'permissions' => $permissions],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        $role->role_permissions = $role->permissions;
        $permissions = Permission::all();

        return response()->json(['success' => true, 'data' => $role,'permissions' => $permissions],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);
        $permissions = $role->permissions;
        $role->revokePermissionTo($permissions);
        $role->givePermissionTo($request->permissions);
        $role->update(['name' => $request->role]);
        $role = $role->refresh();
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //_method: put
        return response()->json(['success' => true, 'data' => $role],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $permissions = $role->permissions;
        $role->revokePermissionTo($permissions);
        $role->delete();

        //_method: delete
        return response()->json(['success' => true],200);
    }
}
