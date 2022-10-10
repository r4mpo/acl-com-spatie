@extends('template.main')
@section('title', 'Painel de Controle')
@section('content')

    @if (session('msg'))
        <div class="msg" id="msg">
            <p><span> <button type="button" onclick="removerMensagem('msg')" class="btn-close btn-close-white"
                        aria-label="Close"></button>
                    {{ session('msg') }}</span></p>
        </div>
    @endif

    <table class="table table-bordered border-danger tabela-ajustada-css-2">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">PERFIL DE ACESSO</th>

                @can('Visualizar perfil de acesso')
                    <th scope="col"></th>
                @endcan

                @can('Editar perfil de acesso')
                    <th scope="col"></th>
                @endcan

                @can('Excluir perfil de acesso')
                    <th scope="col"></th>
                @endcan

            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{{ $role->name }}</td>

                    @can('Visualizar perfil de acesso')
                        <td><a href="/role/show/{{ base64_encode($role->id) }}"><button type="button"
                                    class="btn btn-success"><i class="bi bi-eye-fill"></i></button></a></td>
                    @endcan

                    @can('Editar perfil de acesso')
                        <td><a href="/role/edit/{{ base64_encode($role->id) }}"><button type="button"
                                    class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button></a></td>
                    @endcan

                    @can('Excluir perfil de acesso')
                        <td>
                            <form action="/role/delete/{{ base64_encode($role->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button>
                            </form>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>

    @can('Cadastrar perfil de acesso')
        <a href="/role"><button type="button" class="btn btn-dark btn-css-ajuste-2"><i class="bi bi-clipboard-plus"></i> Novo
                Perfil de Acesso</button></a>
    @endcan

@endsection
