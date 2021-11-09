@extends('layouts.app')

@section('title', 'Categorias')

@section('content')

<a href="{{ route('categorias.create') }}" class="d-block mb-4">
  <i class="bi bi-bookmark-plus-fill"></i>
  Cadastrar categoria
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Categorias</h3>

<form class="mb-5" method="GET">
  <div class="form-row align-items-center">
    <div class="col-sm-10 my-1">
      <label for="search">Consultar</label>
      <input
        type="text"
        class="form-control"
        placeholder="Digite o nome ou Código de barras"
        name="search"
        value="{{ $query['search'] ?? null }}"
      >
    </div>
    <div class="col-sm-2 my-1">
      <label>_</label>
      <button type="submit" class="btn btn-primary btn-block">Procurar</button>
    </div>
  </div>
</form>

@if ($message = Session::get('success'))
  <x-alert type="success">
    <x-slot name="message">{{ $message }}</x-slot>
  </x-alert>
@endif

@if(!$categorias->isEmpty())
  <table class="table table-striped table-borderless table-responsive-lg">
    <thead>
      <tr>
        <th scope="col"><i class="bi bi-key-fill"></i></th>
        <th scope="col">Nome</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($categorias as $cat)
      <tr>
        <th scope="row">{{ $cat->id }}</th>
        <td>{{ $cat->nome }}</td>
        <td class="text-right">
          <form action="{{ route('categorias.destroy', $cat->id) }}" method="POST">
            <a
              href="{{ route('categorias.show', $cat->id) }}"
              class="btn btn-info pb-0 pt-0"
            >
              <i class="bi bi-eye-fill"></i>
              Visualizar
            </a>
            <a
              href="{{ route('categorias.edit', $cat->id) }}"
              class="btn btn-dark pb-0 pt-0"
            >
              <i class="bi bi-brush"></i>
              Editar
            </a>
            @csrf
            @method('DELETE')
            <button
              type="submit"
              class="btn btn-danger pb-0 pt-0"
              name="delete"
              data-toggle="modal"
              data-target="#delete"
            >
              <i class="bi bi-trash"></i>
              Excluir
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {!! $categorias->links() !!}

  <x-modal target="delete">
    <x-slot name="title">Deseja deletar essa categoria?</x-slot>
    <x-slot name="message">Clique em confirmar para deletar, caso deseje cancele a operação!</x-slot>
  </x-modal>
@else
  <div class="alert alert-dark" role="alert">
    Não foram encotrado categorias.
  </div>
@endif

@endsection
