@extends('template.main')
@section('title', 'Cadastrar novo contato')
@section('content')

<div class="formulario">
    <form action="/contato/store" method="post">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-people"></i></span>
            <input type="text" class="form-control" maxlength="40" name="nome" id="nome" placeholder="Nome" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope"></i></span>
            <input type="text" class="form-control" maxlength="40" name="email" id="email" placeholder="E-mail" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-fill"></i></span>
            <input type="text" class="form-control" onkeypress="mask(this, mphone);" maxlength="20" name="telefone" id="telefone" placeholder="Telefone" aria-label="Username" aria-describedby="basic-addon1">
        </div>

        <div class="bottom-btn">
            <button type="submit" class="btn btn-outline-success"><i class="bi bi-save"></i> Salvar</button>
            <a href="/"><button type="button" class="btn btn-outline-primary"><i class="bi bi-arrow-return-left"></i> Voltar</button></a>
        </div>

    </form>
</div>

@endsection