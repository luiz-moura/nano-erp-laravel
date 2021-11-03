<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePessoaRequest;
use App\Http\Requests\UpdatePessoaRequest;
use App\Models\Pessoa;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pessoas = Pessoa::latest()->paginate(20);

        return view('pessoa.index', compact('pessoas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pessoa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePessoaRequest $request)
    {
        $request->validated();

        $pessoa = Pessoa::create($request->all());

        $marcados = $request->tipo ?: [];

        $contextos = [];
        foreach ($marcados as $tipo) {
            $contextos[] = ['tipo' => $tipo];
        }

        $pessoa->contextos()->createMany($contextos);

        return redirect()->route('pessoas.index')
            ->with('success', 'Pessoa criada com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function show(Pessoa $pessoa)
    {
        return view('pessoa.show', compact('pessoa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function edit(Pessoa $pessoa)
    {
        return view('pessoa.edit', compact('pessoa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePessoaRequest $request, Pessoa $pessoa)
    {
        $request->validated();

        $marcados = $request->tipo ?: [];

        $pessoa->contextos()->whereNotIn('tipo', $marcados)->delete();

        foreach ($marcados as $tipo) {
            if ($pessoa->contextos()->where('tipo', $tipo)->doesntExist()) {
                $pessoa->contextos()->create(['tipo' => $tipo]);
            }
        }

        $pessoa->update($request->all());

        return redirect()->route('pessoas.index')
            ->with('success', 'Pessoa atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pessoa $pessoa)
    {
        $pessoa->delete();

        return redirect()->route('pessoas.index')
            ->with('success', 'Pessoa deletada com sucesso');
    }
}
