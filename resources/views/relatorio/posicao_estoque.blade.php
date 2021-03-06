@extends('layouts.app')

@section('title', 'Relatório de posição de estoque')

@section('content')

<h3 class="pb-4 mb-4 font-italic border-bottom">Relatório de posição de estoque</h3>

@if(!empty($empresas))
  @foreach($empresas as $empresa)
  <h4>{{ $empresa['nome'] }}</h4>
  <table class="table table-borderless table-responsive-lg mb-4">
    <thead>
      <tr class="table-active">
        <th scope="col"><i class="bi bi-key-fill"></i></th>
        <th scope="col">Nome</th>
        <th scope="col">Quantidade</th>
      </tr>
    </thead>
    <tbody>
      @foreach($empresa['produtos'] as $produto)
      <tr class="border-top">
        <td scope="row">{{ $produto->id }}</td>
        <td>{{ $produto->nome }}</td>
        <td>{{ $produto->entradas - $produto->saidas }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endforeach
@else
  <x-alert type="warning" message="Não foram encotrado produtos."/>
@endif

@endsection
