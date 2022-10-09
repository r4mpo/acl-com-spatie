@extends('template.main')
@section('title', $role->name)
@section('content')
<div class="formulario-cadastrar-role">
    <p>{{ $role->name }}</p>

    @foreach ($role->permissions as $permissao)
        <li>{{ $permissao->name }}</li>
    @endforeach

</div>
@endsection