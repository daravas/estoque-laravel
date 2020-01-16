<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Produto;
use Request;
use App\Http\Requests\ProdutosRequest;


class ProdutoController extends Controller{
    public function lista(){

       // $produtos = DB::select('select * from produtos');

       //usando eloquent
       $produtos = Produto::all();

        return view('produto.listagem')->with('produtos',$produtos);

    }

    public function mostra(){
      //  $id = Request::input('id','0'); //segundo parametro é valor default
        $id = Request::route('id'); //pega parametro da rota ao inves da url
       //pode remover a request e add $id como parametro do metodo
      //  $resposta = DB::select('select * from produtos where id=?',[$id]);
       $produto = Produto::find($id); // usando eloquent

        if(empty($produto)){
            return "Esse produto não existe";
        }
        return view('produto.detalhes')->with('p',$produto);
    }

    public function novo(){
        return view('produto.formulario');
    }

    public function adiciona(ProdutosRequest $request){

      /*  $nome = Request::input('nome');
        $descricao = Request::input('descricao');
        $valor = Request::input('valor');
        $quantidade = Request::input('quantidade');

        DB::insert('insert into produtos(nome,quantidade,valor,descricao) values(?,?,?,?)', array($nome,$quantidade,$valor,$descricao));
        //return redirect('/produtos')->withInput(Request::only('nome')); retorna pra uma URI*/

        $params = $request->all();
       // $produto = new Produto($params);
      //  $produto->save();
        Produto::create($params);
        return redirect()->action('ProdutoController@lista')->withInput(Request::only('nome'));//retora para o metodo lista
    }

    public function remove($id){
      $produto = Produto::find($id);
      $produto->delete();

      return redirect()->action('ProdutoController@lista');
    }

}

