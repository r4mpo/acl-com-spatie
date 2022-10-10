@extends('template.main')
@section('title', 'Dashboard')
@section('content')
    <div class="info-guest">
        <p>Seja bem-vindo, {{ Auth::user()->name }} :D</p>
        <p>A nossa dashboard está em construção... <i class="bi bi-gear-fill"></i></p>
        <p>Divirta-se com as suas permissões.</p>
    </div>
@endsection