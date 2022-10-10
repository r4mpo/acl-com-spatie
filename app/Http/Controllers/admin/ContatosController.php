<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\admin\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContatosController extends Controller
{
    public function index()
    {
        return view('welcome', ['contatos' => Contato::paginate(5)]);
    }

    public function create()
    {
        return view('admin.contatos.create');
    }

    public function store(Request $request)
    {
        Contato::create($request->all());
        return redirect('/')->with('msg', 'O contato foi cadastrado com sucesso.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $id_decodificado = base64_decode($id);
        return view('admin.contatos.edit', ['contato' => Contato::findOrFail($id_decodificado)]);
    }

    public function update(Request $request, $id)
    {
        $id_decodificado = base64_decode($id);
        Contato::findOrFail($id_decodificado)->update($request->all());
        return redirect('/')->with('msg', 'O contato foi editado com sucesso.');
    }

    public function destroy($id)
    {
        $id_decodificado = base64_decode($id);
        Contato::findOrFail($id_decodificado)->delete();
        return redirect('/')->with('msg', 'O contato foi excluído com sucesso.');
    }

    public function send_email($id) 
    {
        $id_decodificado = base64_decode($id);

        Mail::send('admin.mail.contato', ['contato' => Contato::findOrFail($id_decodificado)], function($dados_email)
        {
            $dados_email->from('erick.sousa.dev@gmail.com', 'Erick Rampo - LaraSpatie');
            $dados_email->to('erick1souza1ago04@gmail.com');
            $dados_email->subject('Confira os dados do contato');
        });

        return redirect('/')->with('msg', 'O e-mail foi enviado com sucesso.');
    }
}