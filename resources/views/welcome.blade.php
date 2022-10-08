@extends('template.main')
@section('title', 'ACL-COM-SPATIE')
@section('content')

    @auth
        @can('visualizar-contatos')
            <table class="table table-bordered border-danger tabela-ajustada-css">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NOME</th>
                        <th scope="col">E-MAIL</th>
                        <th scope="col">TELEFONE</th>

                        @can('enviar-email')
                            <th scope="col"></th>
                        @endcan

                        @can('editar-contato')
                            <th scope="col"></th>
                        @endcan

                        @can('excluir-contato')
                            <th scope="col"></th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contatos as $contato)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $contato->nome }}</td>
                        <td>{{ $contato->email }}</td>
                        <td>{{ $contato->telefone }}</td>
                        
                        @can('enviar-email')
                            <td>
                                <a href="/contato/email/{{ base64_encode($contato->id) }}">
                                    <button type="button" class="btn btn-success"><i class="bi bi-envelope"></i></button>
                                </a>
                            </td>
                        @endcan

                        @can('editar-contato')
                            <td><a href="/contato/edit/{{ base64_encode($contato->id) }}"><button type="button" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button></a></td>
                        @endcan
                
                        @can('excluir-contato')
                        <td>
                            <form action="/contato/delete/{{ base64_encode($contato->id) }}" method="post">
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

            @can('cadastrar-contato')
                <a href="/contato"><button type="button" class="btn btn-dark btn-css-ajuste"><i class="bi bi-clipboard-plus"></i> Novo Contato</button></a>
            @endcan

            <div class="page">
                {{ $contatos->links() }}
            </div>

        @endcan
    @endauth

    @guest
        <div class="info-guest">
            <p>Olá, entre no sistema para ter acesso às informações! :D</p>
        </div>
    @endguest

@endsection
