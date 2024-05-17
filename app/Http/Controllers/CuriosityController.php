<?php

namespace App\Http\Controllers;

use App\Models\Curiosity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CuriosityController extends Controller
{

    protected $curiosity;
    public function __construct(Curiosity $curiosity)
    {
        $this->curiosity = $curiosity;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $curiosites = $this->curiosity->get();

        // Remover campos indesejados do elemento principal
        $curiosites = $curiosites->makeHidden(['created_at', 'updated_at']);
        return response()->json($curiosites, 200);
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
        $existingcuriosity = $this->curiosity->where('id', $request->id)->first();

        if ($existingcuriosity) {
            // Se já existir, atualize os dados existentes apenas com os campos enviados que não estão vazios ou nulos
            $dadosAtualizados = array_filter($request->only([
                'title', 'caption', 'description', 'banner', 'video', 'active'
            ]));

            // Verifique se a imagem foi enviada na requisição
            if ($request->file('banner')) {
                // Exclua o arquivo antigo
                Storage::disk('public')->delete($existingcuriosity->banner);

                // Armazene a nova imagem
                $imagem = $request->file('banner');
                $imagem_urn = $imagem->store('img/banners', 'public');

                // Atualize o campo no banco de dados com o nome do arquivo da nova imagem
                $dadosAtualizados['banner'] = $imagem_urn;
            }

            $existingcuriosity->update($dadosAtualizados);

            return response()->json($existingcuriosity, 200);
        } else {
            // Se não existir, crie um novo registro
            $dados = [
                'title' => $request->title,
                'caption' => $request->caption,
                'description' => $request->description,
                'video' => $request->video,
                'active' => $request->active,
            ];

            // Verifique se a imagem foi enviada na requisição
            if ($request->file('banner')) {
                // Armazene a nova imagem
                $imagem = $request->file('banner');
                $imagem_urn = $imagem->store('img/banners', 'public');

                // Adicione o nome do arquivo da nova imagem aos dados a serem salvos
                $dados['banner'] = $imagem_urn;
            }

            // Crie um novo registro
            $curiosity = $this->curiosity->create($dados);

            return response()->json($curiosity, 201);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curiosity  $curiosity
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curiosity = $this->curiosity->with([

            // Filtrar os campos a ser retornados
            //'company'

        ])->find($id);



        if ($curiosity === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404);
        }

        // Remover campos indesejados do elemento principal
        $curiosity = $curiosity->makeHidden(['ativo', 'created_at', 'updated_at']);

        return response()->json($curiosity, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curiosity  $curiosity
     * @return \Illuminate\Http\Response
     */
    public function edit(Curiosity $curiosity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curiosity  $curiosity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $curiosity = $this->curiosity->find($id);

        if ($curiosity === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($curiosity->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $curiosity->feedback());
        } else {
            $request->validate($curiosity->rules(), $curiosity->feedback());
        }

        //preenche os campos com os dados do banco e atualiza apenas os que foram modificados na requisição
        $curiosity->fill($request->all());

        //se a imagem foi encaminhada na requisição
        if($request->file('banner')) {
            //remove o arquivo antigo
            Storage::disk('public')->delete($curiosity->banner);

            $imagem = $request->file('banner');
            $imagem_urn = $imagem->store('banners', 'public');
            $curiosity->banner = $imagem_urn;
        }
        $curiosity->save();

        return response()->json($curiosity, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curiosity  $curiosity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $curiosity = $this->curiosity->find($id);

        if ($curiosity === null) {
            return response()->json(['erro' => 'O recurso solicitado não existe'], 404);
        }

        $curiosity->delete();
        return response()->json(['msg' => 'A item removido com sucesso!'], 200);
    }
}