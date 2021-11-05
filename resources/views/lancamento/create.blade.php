@extends('layouts.app')

@section('title', 'Cadastrar lançamento')

@section('content')

<a href="{{ route('lancamentos.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar para a lista de lançamentos
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Cadastrar lançamento</h3>

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <x-alert type="danger">
      <x-slot name="message">{{ $error }}</x-slot>
    </x-alert>
  @endforeach
@endif

<form
  action="{{ route('lancamentos.store') }}"
  method="POST"
  id="form"
  class="needs-validation"
  novalidate
>
  @csrf
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="empresa_id">Empresa</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <button
            class="btn btn-primary"
            type="button"
            data-toggle="modal"
            data-target="#empresas"
          >
            <i class="bi bi-search"></i>
          </button>
        </div>
        <select type="text" id="empresa" class="form-control" name="empresa" required></select>
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="descricao">Pessoa</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <button
            class="btn btn-primary"
            type="button"
            data-toggle="modal"
            data-target="#pessoas"
          >
            <i class="bi bi-search"></i>
          </button>
        </div>
        <select type="text" id="pessoa" class="form-control" name="pessoa" disabled></select>
      </div>
    </div>
    <div class="col-md-2 mb-3">
      <label for="descricao">Operação</label>
      <select id="operacao" class="form-control">
        <option value="e" selected>Entrada</option>
        <option value="s">Saída</option>
        <option value="v">Venda</option>
      </select>
    </div>
  </div>
  <hr class="my-4">
  <div class="row mb-3">
    <div class="col-md-7">
      <label for="descricao">Produto</label>
      <div class="input-group">
        <div class="input-group-prepend">
        <button
            class="btn btn-primary"
            type="button"
            data-toggle="modal"
            data-target="#produtos"
          >
            <i class="bi bi-search"></i>
          </button>
        </div>
        <select type="text" id="produto" class="form-control" name="produto" value="" disabled></select>
      </div>
    </div>
    <div class="col-md-3">
      <label for="descricao">Quantidade</label>
      <input
        type="number"
        class="form-control"
        id="quantidade"
        name="quantidade"
        value="1" min="1"
      />
    </div>
    <div class="col-md-2">
      <label for="descricao">_</label>
      <button id="add-produto-btn" type="button" class="btn btn-primary btn-block">
        <i class="bi bi-check-circle-fill"></i>
      </button>
    </div>
  </div>
  <div id="produtos-adicionados" class="list-group mb-3">
    <!-- content -->
  </div>

  <div class="text-right">
    <a class="btn btn-warning" href="{{ route('lancamentos.index') }}">
      <i class="bi bi-arrow-return-left"></i> Cancelar
    </a>
    <button class="btn btn-primary" type="submit">
      <i class="bi bi-check-circle-fill"></i> Cadastrar
    </button>
  </div>
</form>

<x-modal target="empresas" exit_button="no">
  <x-slot name="title">Pesquisar empresas</x-slot>
  <x-slot name="message">
    <input
      type="text"
      class="form-control mb-3"
      id="nome_empresa"
      name="nome_empresa"
      placeholder="Nome da empresa ou CNPJ"
      autocomplete="off"
    />
    <select class="form-control" id="lista-empresas">
      <!-- content -->
    </select>
  </x-slot>
</x-modal>

<x-modal target="pessoas" exit_button="no">
  <x-slot name="title">Pesquisar pessoas</x-slot>
  <x-slot name="message">
    <input
      type="text"
      class="form-control mb-3"
      id="nome_pessoa"
      name="nome_pessoa"
      placeholder="Nome da pessoa ou CNPJ"
      autocomplete="off"
    />
    <select class="form-control" id="lista-pessoas">
      <!-- content -->
    </select>
  </x-slot>
</x-modal>

<x-modal target="produtos" exit_button="no">
  <x-slot name="title">Pesquisar produtos</x-slot>
  <x-slot name="message">
    <input
      type="text"
      class="form-control mb-3"
      id="nome_produto"
      name="nome_produto"
      placeholder="Nome do produto"
      autocomplete="off"
    />
    <select class="form-control" id="lista-produtos">
      <!-- content -->
    </select>
  </x-slot>
</x-modal>

<x-modal target="lancamento" cancel_button="no" exit_button="no">
  <x-slot name="title">
    <i class="bi bi-check2-circle"></i>
    Lançamento efetuado com sucesso
  </x-slot>
  <x-slot name="message"></x-slot>
</x-modal>

@endsection
