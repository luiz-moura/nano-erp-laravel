<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFornecedorRequest;
use App\Http\Requests\UpdateFornecedorRequest;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifica.contexto')->except(['index', 'create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $qb = Pessoa::tipo('u');

        if ($request->filled('search')) {
            $qb->where('nome', 'ilike', "%{$request->query('search')}%")
                ->orWhere('cpf_cnpj', "{$request->query('search')}%");
        }

        $fornecedores = $qb->latest()->paginate(20)->withQueryString();

        return view('fornecedor.index', compact('fornecedores'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fornecedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFornecedorRequest $request)
    {
        $validated = $request->validated();

        $fornecedor = Pessoa::create($validated);

        $marcados = $request->input('tipo', []);

        $contextos = [['tipo' => 'u']];
        foreach ($marcados as $tipo) {
            $contextos[] = ['tipo' => $tipo];
        }

        $fornecedor->contextos()->createMany($contextos);

        return redirect()->route('fornecedores.index')
            ->with('success', 'Fornecedor criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pessoa  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function show(Pessoa $fornecedor)
    {
        return view('fornecedor.show', compact('fornecedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pessoa  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Pessoa $fornecedor)
    {
        return view('fornecedor.edit', compact('fornecedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pessoa  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFornecedorRequest $request, Pessoa $fornecedor)
    {
        $validated = $request->validated();

        $marcados = $request->input('tipo', []);

        $fornecedor->contextos()->whereNotIn('tipo', $marcados)->delete();

        foreach ($marcados as $tipo) {
            if ($fornecedor->contextos()->where('tipo', $tipo)->doesntExist()) {
                $fornecedor->contextos()->create(['tipo' => $tipo]);
            }
        }

        $fornecedor->update($validated);

        return redirect()->route('fornecedores.index')
            ->with('success', 'Fornecedor atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pessoa  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pessoa $fornecedor)
    {
        $fornecedor->delete();

        return redirect()->route('fornecedores.index')
            ->with('success', 'Fornecedor deletado com sucesso');
    }
}
