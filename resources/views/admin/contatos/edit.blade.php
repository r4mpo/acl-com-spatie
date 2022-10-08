@extends('template.main')
@section('title', 'Editar: ' . $contato->nome)
@section('content')

<div class="formulario">
    <form action="/contato/update/{{ base64_encode($contato->id) }}" method="post">
        
        @csrf
        @method('PUT')

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-people"></i></span>
            <input type="text" class="form-control" value="{{ $contato->nome }}" maxlength="40" name="nome" id="nome" placeholder="Nome" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope"></i></span>
            <input type="text" class="form-control" value="{{ $contato->email }}" maxlength="40" name="email" id="email" placeholder="E-mail" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-fill"></i></span>
            <input type="text" class="form-control" value="{{ $contato->telefone }}" onkeypress="mask(this, mphone);" maxlength="20" name="telefone" id="telefone" placeholder="Telefone" aria-label="Username" aria-describedby="basic-addon1">
        </div>

        <div class="bottom-btn">
            <button type="submit" class="btn btn-outline-success"><i class="bi bi-save"></i> Editar</button>
            <a href="/"><button type="button" class="btn btn-outline-primary"><i class="bi bi-arrow-return-left"></i> Voltar</button></a>
        </div>

    </form>
</div>

@endsection