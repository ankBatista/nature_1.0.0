<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FaqController extends Controller
{
    protected $faq;
    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $faqs = $this->faq->get();

        // Remover campos indesejados do elemento principal
        $faqs = $faqs->makeHidden(['created_at', 'updated_at']);
        return response()->json($faqs, 200);
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
        $existingFaqPage = $this->faq->where('id', $request->id)->first();

        if ($existingFaqPage) {
            // Se já existir, atualize os dados existentes apenas com os campos enviados que não estão vazios ou nulos
            $dadosAtualizados = array_filter($request->only([
                'question', 'response', 'active'
            ]));

            $existingFaqPage->update($dadosAtualizados);

            return response()->json($existingFaqPage, 200);
        } else {
            // Se não existir, crie um novo registro
            $dados = [
                'question' => $request->question,
                'response' => $request->response,
                'active' => $request->active,
            ];

            // Crie um novo registro
            $faq = $this->faq->create($dados);

            return response()->json($faq, 201);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FaqPage  $FaqPage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faq = $this->faq->with([

            // Filtrar os campos a ser retornados
            //'company'

        ])->find($id);



        if ($faq === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404);
        }

        // Remover campos indesejados do elemento principal
        $faq = $faq->makeHidden(['ativo', 'created_at', 'updated_at']);

        return response()->json($faq, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $FaqPage
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $FaqPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FaqPage  $FaqPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $faq = $this->faq->find($id);

        if ($faq === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($faq->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $faq->feedback());
        } else {
            $request->validate($faq->rules(), $faq->feedback());
        }

        //preenche os campos com os dados do banco e atualiza apenas os que foram modificados na requisição
        $faq->fill($request->all());

        
        $faq->save();

        return response()->json($faq, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FaqPage  $FaqPage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $faq = $this->faq->find($id);

        if ($faq === null) {
            return response()->json(['erro' => 'O recurso solicitado não existe'], 404);
        }

        $faq->delete();
        return response()->json(['msg' => 'A item removido com sucesso!'], 200);
    }
}
