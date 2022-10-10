<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission; /* Model das permissions */
use Spatie\Permission\Models\Role; /* Model das roles */

class RolesController extends Controller
{
    protected $funcionalidades = [
        'Contatos'              => 'contato',
        'Perfis de Acesso'      => 'perfil',
        'E-mail'                => 'e-mail',
        'Painel Administrativo' => 'administrativo'
    ];

    public function index()
    {
        return view('admin.roles.index', ['roles' => Role::all()]);
    }

    public function create()
    {
        return view('admin.roles.create', ['permissions' => Permission::all(), 'funcionalidades' => $this->funcionalidades]);
    }

    public function show($id)
    {
        return view('admin.roles.show', ['role' => Role::findOrFail(base64_decode($id))]);
    }

    public function edit($id)
    {
        return view('admin.roles.edit', ['role' => Role::findOrFail(base64_decode($id)), 'permissions' => Permission::all(), 'funcionalidades' => $this->funcionalidades]);
    }

    public function store(Request $request)
    {
        try 
        {
            Role::create(['name' => $request->name])->givePermissionTo($request->permissions);  
            return redirect('/painel')->with('msg', 'Perfil de acesso cadastrado com sucesso.');
        } 
        catch(\Exception $e)
        {
            return redirect('/painel')->with('msg', 'Houve um erro ao cadastrar o perfil de acesso.');
        }
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail(base64_decode($id));

        try
        {
            foreach ($role->permissions as $permission) {
                $role->revokePermissionTo($permission->name);
            }

            $role->update(['name' => $request->name]);
            $role->givePermissionTo($request->permissions);
            return redirect('/painel')->with('msg', 'Perfil de acesso editado com sucesso.');
        } 
        
        catch (\Exception $e) 
        {
            return redirect('/painel')->with('msg', 'Houve um erro ao editar o perfil de acesso.');
        }
    }

    public function destroy($id)
    {
        Role::findOrFail(base64_decode($id))->delete();
        return redirect('/painel')->with('msg', 'Perfil de acesso excluído com sucesso.');
    }
}