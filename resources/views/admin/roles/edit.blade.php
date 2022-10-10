@extends('template.main')
@section('title', 'Editar: ' . $role->name)
@section('content')

    <div class="formulario-cadastrar-role">
        <form action="/role/update/{{ base64_encode($role->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-wrench"></i></span>
                <input type="text" class="form-control" maxlength="40" value="{{ $role->name }}" name="name"
                    id="name" placeholder="Perfil de Acesso" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div>
                <i class="bi bi-pie-chart info-permissoes"></i>
                <p class="info-permissoes">Permissões do Perfil de Acesso</p>
            </div>

            {{-- Permissões --}}

            @foreach ($funcionalidades as $titulo => $funcionalidade)
                <div class="permissoes">
                    <p>{{ $titulo }}</p>

                    @foreach ($permissions as $permission)
                        @if (strpos($permission->name, $funcionalidade) !== false)
                            <div class="form-check">
                                <input class="form-check-input" @if ($role->hasPermissionTo($permission->name)) checked @endif
                                    type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endif
                    @endforeach

                    <hr>
                </div>
            @endforeach

            <div class="bottom-btn">
                <button type="submit" class="btn btn-outline-success"><i class="bi bi-save"></i> Editar</button>
                <a href="/painel"><button type="button" class="btn btn-outline-primary"><i
                            class="bi bi-arrow-return-left"></i> Voltar</button></a>
            </div>
        </form>
    </div>
@endsection
