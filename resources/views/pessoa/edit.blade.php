@extends('layouts.app')

@section('title', 'Editar pessoa')

@section('content')

<a href="{{ route('pessoas.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar para a lista de pessoas
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Editar pessoa</h3>

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <x-alert type="danger">
      <x-slot name="message">{{ $error }}</x-slot>
    </x-alert>
  @endforeach
@endif

<form
  action="{{ route('pessoas.update', $pessoa->id) }}"
  method="POST"
  id="form"
  class="needs-validation"
  novalidate
>
  @csrf
  @method('PUT')
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="nome">Nome</label>
      <input
        type="text"
        class="form-control"
        id="nome"
        name="nome"
        value="{{ $pessoa->nome }}"
        required
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="cpf_cnpj">CPF ou CNPJ</label>
      <input
        type="text"
        class="form-control"
        id="cpf_cnpj"
        name="cpf_cnpj"
        value="{{ $pessoa->cpf_cnpj }}"
      />
    </div>
    <div class="col-md-4 mb-3">
      <label for="inscricao_estadual">IE (Inscrição Estadual)</label>
      <input
        type="text"
        class="form-control"
        id="inscricao_estadual"
        name="inscricao_estadual"
        value="{{ $pessoa->inscricao_estadual }}"
      />
    </div>
    <div class="col-md-4 mb-3">
      <label for="nome_fantasia">Nome fantasia</label>
      <input
        type="text"
        class="form-control"
        id="nome_fantasia"
        name="nome_fantasia"
        value="{{ $pessoa->name_fantasia }}"
      />
    </div>
    <div class="col-md-4 mb-3">
      <label for="razao_social">Razão Social</label>
      <input
        type="text"
        class="form-control"
        id="razao_social"
        name="razao_social"
        value="{{ $pessoa->razao_social }}"
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="email">E-mail</label>
      <input
        type="email"
        class="form-control"
        id="email"
        name="email"
        value="{{ $pessoa->email }}"
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="telefone">Telefone</label>
      <input
        type="text"
        class="form-control"
        id="telefone"
        name="telefone"
        value="{{ $pessoa->telefone }}"
      />
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="bairro">Bairro</label>
      <input
        type="text"
        class="form-control"
        id="bairro"
        name="bairro"
        value="{{ $pessoa->bairro }}"
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="rua">Rua</label>
      <input
        type="text"
        class="form-control"
        id="rua"
        name="rua"
        value="{{ $pessoa->rua }}"
      />
    </div>
    <div class="col-md-2 mb-3">
      <label for="numero">Número</label>
      <input
        type="text"
        class="form-control"
        id="numero"
        name="numero"
        value="{{ $pessoa->numero }}"
      />
    </div>
    <div class="col-md-8 mb-3">
      <label for="complemento">Complemento</label>
      <input
        type="text"
        class="form-control"
        id="complemento"
        name="complemento"
        value="{{ $pessoa->complemento }}"
      />
    </div>
    <div class="col-md-2 mb-3">
      <label for="cep">CEP</label>
      <input
        type="text"
        class="form-control"
        id="cep"
        name="cep"
        value="{{ $pessoa->cep }}"
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="cidade">Cidade</label>
      <input
        type="text"
        class="form-control"
        id="cidade"
        name="cidade"
        value="{{ $pessoa->cidade }}"
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="estado">Estado</label>
      <x-select-estados select="{{ $pessoa->estado }}" />
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-12 mb-5">
      <label class="mr-3">Constar em:</label>
      <div class="custom-control-inline custom-switch mr-3">
        <input
          type="checkbox"
          class="custom-control-input"
          id="cliente"
          name="tipo[]"
          value="c"
          <?php echo $pessoa->contextos()->where('tipo', 'c')->exists() ? 'checked' : '' ?>
        >
        <label class="custom-control-label" for="cliente">Cliente</label>
      </div>
      <div class="custom-control-inline custom-switch mr-3">
        <input
          type="checkbox"
          class="custom-control-input"
          id="fornecedor"
          name="tipo[]"
          value="u"
          <?php echo $pessoa->contextos()->where('tipo', 'u')->exists() ? 'checked' : '' ?>
        >
        <label class="custom-control-label" for="fornecedor">Fornecedor</label>
      </div>
      <div class="custom-control-inline custom-switch mr-3">
        <input
          type="checkbox"
          class="custom-control-input"
          id="funcionario"
          name="tipo[]"
          value="f"
          <?php echo ($pessoa->contextos()->where('tipo', 'f')->exists()) ? 'checked' : '' ?>
        >
        <label class="custom-control-label" for="funcionario">Funcionário</label>
      </div>
      <div class="custom-control-inline custom-switch mr-3">
        <input
          type="checkbox"
          class="custom-control-input"
          id="empresa"
          name="tipo[]"
          value="e"
          <?php echo ($pessoa->contextos()->where('tipo', 'e')->exists()) ? 'checked' : '' ?>
        >
        <label class="custom-control-label" for="empresa">Empresa</label>
      </div>
    </div>
  </div>
</form>
<div class="form-row">
  <div class="col-md-12 text-right">
		<a class="btn btn-warning" href="{{ route('pessoas.index') }}">
			<i class="bi bi-arrow-return-left"></i> Cancelar
		</a>
		<form
      action="{{ route('pessoas.destroy', $pessoa->id) }}"
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
		<button class="btn btn-primary" type="submit" form="form">
			<i class="bi bi-check-circle-fill"></i> Atualizar
		</button>
	</div>
</div>

<x-modal target="delete">
  <x-slot name="title">Deseja deletar essa pessoa?</x-slot>
  <x-slot name="message">Clique em confirmar para deletar, caso deseje cancele a operação!</x-slot>
</x-modal>

@endsection
