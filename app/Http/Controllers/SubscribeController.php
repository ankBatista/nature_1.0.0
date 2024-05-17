<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    protected $item;
    public function __construct(Subscribe $item)
    {
        $this->item = $item;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = $this->item->get();

        // Remover campos indesejados do elemento principal
        $items = $items->makeHidden(['created_at', 'updated_at']);
        return response()->json($items, 200);
    }

    /**
     * Mostra o formulário para criar um novo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mostra o formulário de inscrição, se necessário
    }

    /**
     * Armazena um recurso recém-criado no armazenamento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Verifique se já existe um registro com base em alguma condição, por exemplo, o título
        $existingitemPage = $this->item->where('id', $request->id)->first();

        if ($existingitemPage) {
            // Se já existir, atualize os dados existentes apenas com os campos enviados que não estão vazios ou nulos
            $dadosAtualizados = array_filter($request->only([
                'email'
            ]));

            $existingitemPage->update($dadosAtualizados);

            return response()->json($existingitemPage, 200);
        } else {
            // Se não existir, crie um novo registro
            $dados = [
                'email' => $request->email,
            ];

            // Crie um novo registro
            $item = $this->item->create($dados);

            return response()->json($item, 201);
        }
    }

    /**
     * Exibe o recurso especificado.
     *
     * @param  \App\Models\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->item->with([

            // Filtrar os campos a ser retornados
            //'company'

        ])->find($id);



        if ($item === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404);
        }

        // Remover campos indesejados do elemento principal
        $item = $item->makeHidden(['ativo', 'created_at', 'updated_at']);

        return response()->json($item, 200);
    }

    /**
     * Mostra o formulário para editar o recurso especificado.
     *
     * @param  \App\Models\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscribe $subscribe)
    {
        // Mostra o formulário de edição para uma inscrição específica, se necessário
    }

    /**
     * Atualiza o recurso especificado no armazenamento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $item = $this->item->find($id);

        if ($item === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($item->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $item->feedback());
        } else {
            $request->validate($item->rules(), $item->feedback());
        }

        //preenche os campos com os dados do banco e atualiza apenas os que foram modificados na requisição
        $item->fill($request->all());


        $item->save();

        return response()->json($item, 200);
    }

    /**
     * Remove o recurso especificado do armazenamento.
     *
     * @param  \App\Models\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $item = $this->item->find($id);

        if ($item === null) {
            return response()->json(['erro' => 'O recurso solicitado não existe'], 404);
        }

        $item->delete();
        return response()->json(['msg' => 'A item removido com sucesso!'], 200);
    }
}
