<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Request;

class ProdutoController extends Controller{
    public function lista(){

        $produtos = DB::select('select * from produtos');

        return view('produto.listagem')->with('produtos',$produtos);

    }

    public function mostra(){
      //  $id = Request::input('id','0'); //segundo parametro é valor default
        $id = Request::route('id'); //pega parametro da rota ao inves da url
       //pode remover a requeste e add $id como parametro do metodo
        $resposta = DB::select('select * from produtos where id=?',[$id]);
        if(empty($resposta)){
            return "Esse produto não existe";
        }
        return view('produto.detalhes')->with('p',$resposta[0]);
    }

    public function novo(){
        return view('produto.formulario');
    }
}

