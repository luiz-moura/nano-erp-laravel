@extends('layouts.app')

@section('title', 'Visualizar produto')

@section('content')

<a href="{{ route('produtos.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar pra lista de produtos
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Visualizar produto</h3>

<form>
  <div class="form-row">
    <div class="col-md-8 mb-3">
      <label for="nome">Nome</label>
      <input
        type="text"
        class="form-control"
        id="nome"
        name="nome"
        value="{{ $produto->nome }}"
        disabled
      />
    </div>
    <div class="col-md-4 mb-3">
      <label for="codigo_barras">Código de barras</label>
      <input
        type="text"
        class="form-control"
        id="codigo_barras"
        name="codigo_barras"
        value="{{ $produto->codigo_barras }}"
        disabled
      />
    </div>
    <div class="col-md-12 mb-3">
      <label for="marca">Marca</label>
      <input
        type="text"
        class="form-control"
        id="marca"
        name="marca"
        value="{{ $produto->marca }}"
        disabled
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="valor_venda">Valor venda</label>
      <input
        type="text"
        class="form-control"
        id="valor_venda"
        name="valor_venda"
        disabled
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="categoria_id">Categoria</label>
      <select
        class="custom-select"
        id="categoria_id"
        name="categoria_id"
        disabled
      >
        <option value="{{ $produto->categoria->id }}">
          {{ $produto->categoria->nome }}
        </option>
      </select>
    </div>
  </div>
</form>
<div class="form-row">
  <div class="col-md-12 text-right">
    <a class="btn btn-warning" href="{{ route('produtos.index') }}">
	    <i class="bi bi-arrow-return-left"></i> Voltar
    </a>
    <form
      action="{{ route('produtos.destroy', $produto->id) }}"
      method="POST"
      class="d-inline"
    >
			@csrf
			@method('DELETE')
			<button
        type="submit"
        class="btn btn-danger d-inline"
        name="delete"
        data-toggle="modal"
        data-target="#delete"
      >
				<i class="bi bi-trash"></i>
				Excluir
			</button>
		</form>
    <a
      href="{{ route('produtos.edit', $produto->id) }}"
      class="btn btn-dark"
      type="submit"
    >
      <i class="bi bi-brush"></i> Editar
    </a>
  </div>
</div>

<x-modal target="delete">
  <x-slot name="title">Deseja deletar essa produto?</x-slot>
  <x-slot name="message">Clique em confirmar para deletar, caso deseje cancele a operação!</x-slot>
</x-modal>

@endsection