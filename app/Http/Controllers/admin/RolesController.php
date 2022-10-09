<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission; /* Model das permissions */
use Spatie\Permission\Models\Role; /* Model das roles */

class RolesController extends Controller
{
    public function index()
    {
        return view('admin.roles.index', ['roles' => Role::all()]);
    }

    public function create()
    {
        return view('admin.roles.create', ['permissions' => Permission::all()]);
    }

    public function store(Request $request)
    {
        foreach ($request->permissions as $permissions => $permission) {
            $permissoes[] = $permission;
        }

        Role::create(['name' => $request->name])->givePermissionTo($permissoes);
        return redirect('/painel');
    }

    public function show($id)
    {
        $id_decodificado = base64_decode($id);
        return view('admin.roles.show', ['role' => Role::findOrFail($id_decodificado)]);
    }

    public function edit($id)
    {
        $id_decodificado = base64_decode($id);
        return view('admin.roles.edit', ['role' => Role::findOrFail($id_decodificado), 'permissions' => Permission::all()]);
    }
    public function update(Request $request, $id)
    {
        $id_decodificado = base64_decode($id);
        $role = Role::findOrFail($id_decodificado);

        foreach ($request->permissions as $permissions => $permission) {
            $permissoes[] = $permission;
        }

        foreach ($role->permissions as $permissao) {
            if (!in_array($permissao, $permissoes)) {
                $role->revokePermissionTo($permissao);
            }
        }

        $role->update(['name' => $request->name]);
        $role->givePermissionTo($permissoes);
        
        return redirect('/painel');
    }

    public function destroy($id)
    {
        $id_decodificado = base64_decode($id);
        Role::findOrFail($id_decodificado)->delete();
        return redirect('/painel');
    }
}