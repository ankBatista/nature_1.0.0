<?php

namespace App\Http\Controllers;

use App\Models\Sevices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SevicesController extends Controller 
{
    protected $service;
    public function __construct(Sevices $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $services = $this->service->get();

        // Remover campos indesejados do elemento principal
        $services = $services->makeHidden(['created_at', 'updated_at']);
        return response()->json($services, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Verifique se já existe um registro com base em alguma condição, por exemplo, o título
        $existingService = $this->service->where('id', $request->id)->first();

        if ($existingService) {
            // Se já existir, atualize os dados existentes apenas com os campos enviados que não estão vazios ou nulos
            $dadosAtualizados = array_filter($request->only([
                'title', 'content', 'icon', 'active'
            ]));

            // Verifique se a imagem foi enviada na requisição
            if ($request->file('icon')) {
                // Exclua o arquivo antigo
                Storage::disk('public')->delete($existingService->icon);

                // Armazene a nova imagem
                $imagem = $request->file('icon');
                $imagem_urn = $imagem->store('img/services', 'public');

                // Atualize o campo no banco de dados com o nome do arquivo da nova imagem
                $dadosAtualizados['icon'] = $imagem_urn;
            }

            $existingService->update($dadosAtualizados);

            return response()->json($existingService, 200);
        } else {
            // Se não existir, crie um novo registro
            $dados = [
                'title' => $request->title,                
                'content' => $request->content,
                'icon' => $request->icon,
                'active' => $request->active,
            ];

            // Verifique se a imagem foi enviada na requisição
            if ($request->file('icon')) {
                // Armazene a nova imagem
                $imagem = $request->file('icon');
                $imagem_urn = $imagem->store('img/services', 'public');

                // Adicione o nome do arquivo da nova imagem aos dados a serem salvos
                $dados['icon'] = $imagem_urn;
            }

            // Crie um novo registro
            $service = $this->service->create($dados);

            return response()->json($service, 201);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $Service
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = $this->service->with([

            // Filtrar os campos a ser retornados
            //'company'

        ])->find($id);



        if ($service === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404);
        }

        // Remover campos indesejados do elemento principal
        $service = $service->makeHidden(['ativo', 'created_at', 'updated_at']);

        return response()->json($service, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $Service
     * @return \Illuminate\Http\Response
     */
    public function edit(Sevices $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $service = $this->service->find($id);

        if ($service === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($service->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $service->feedback());
        } else {
            $request->validate($service->rules(), $service->feedback());
        }

        //preenche os campos com os dados do banco e atualiza apenas os que foram modificados na requisição
        $service->fill($request->all());

        //se a imagem foi encaminhada na requisição
        if($request->file('icon')) {
            //remove o arquivo antigo
            Storage::disk('public')->delete($service->icon);

            $imagem = $request->file('icon');
            $imagem_urn = $imagem->store('services', 'public');
            $service->icon = $imagem_urn;
        }
        $service->save();

        return response()->json($service, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $service = $this->service->find($id);

        if ($service === null) {
            return response()->json(['erro' => 'O recurso solicitado não existe'], 404);
        }

        $service->delete();
        return response()->json(['msg' => 'A item removido com sucesso!'], 200);
    }
}
