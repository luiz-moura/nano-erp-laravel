@extends('layouts.app')

@section('title', 'Visualizar lançamento')

@section('content')

<a href="{{ route('lancamentos.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar para a lista de lançamentos
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Visualizar lançamento</h3>

<div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="nome">Empresa</label>
      <input
        type="text"
        class="form-control"
        id="empresa"
        name="empresa"
        value="{{ $lancamento->empresa->nome }}"
        disabled
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="descricao">{{ $lancamento->contexto_pessoa }}</label>
      <input
        type="text"
        class="form-control"
        id="contexto_id"
        name="contexto_id"
        value="{{ $lancamento->contexto->nome }}"
        disabled
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="descricao">Operação</label>
      <input
        type="text"
        class="form-control"
        id="operacao"
        name="operacao"
        value="{{ $lancamento->operacao_formatada }}"
        disabled
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="descricao">Data da operação</label>
      <input
        type="text"
        class="form-control"
        id="data_operacao"
        name="data_operacao"
        value="{{ $lancamento->data_operacao_formatada }}"
        disabled
      />
    </div>
  </div>
  @if (!$lancamento->produtos->isEmpty())
  <table class="table table-striped table-borderless table-responsive-lg">
    <thead>
      <tr>
        <th scope="col"><i class="bi bi-key-fill"></i></th>
        <th scope="col">Produto</th>
        <th scope="col">Quantidade</th>
        <th scope="col">Valor</th>
      </tr>
    </thead>
    <tbody>
      @foreach($lancamento->produtos as $produto)
      <tr>
        <th scope="row">{{ $produto->pivot->id }}</th>
        <td>{{ $produto->nome }}</td>
        <td>{{ $produto->pivot->quantidade }}</td>
        <td>{{ $produto->pivot->preco_unitario }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif
  <div class="form-row">
    <div class="col-md-12 text-right">
      <a class="btn btn-warning" href="{{ route('lancamentos.index') }}">
        <i class="bi bi-arrow-return-left"></i> Voltar
      </a>
      <form
        action="{{ route('lancamentos.destroy', $lancamento->id) }}"
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
        href="{{ route('lancamentos.edit', $lancamento->id) }}"
        class="btn btn-dark"
      >
        <i class="bi bi-brush"></i> Editar
      </a>
    </div>
  </div>
</div>

<x-modal target="delete">
  <x-slot name="title">Deseja deletar essa lançamento?</x-slot>
  <x-slot name="message">Clique em confirmar para deletar, caso deseje cancele a operação!</x-slot>
</x-modal>

@endsection
