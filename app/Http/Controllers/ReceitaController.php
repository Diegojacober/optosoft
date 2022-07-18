<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateReceita;
use App\Models\Optometrist;
use App\Models\Otica;
use App\Models\Receita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceitaController extends Controller
{
    public function index()
    {
        $user = User::with(['optometrist','permissoes'])->find(Auth::id());
        $opto = Optometrist::with(['oticas'])->find($user->optometrist_id);
        if ($opto->pago == 0) {
            if ($user->is_optometrist == 1) {
                $oticas = $opto->oticas;
              return view('opto.receitas.index',compact('oticas','user'));
            }else {
                $permissoes = $user->permissoes;
                $oticas = [];
                foreach($permissoes as $permissao) {
                    $otica = Otica::find($permissao->otica_id);
                    $oticas[] = $otica;
                }
                return view('opto.receitas.index',compact('oticas','user'));
            }
        } else {
            return view('pagamento');
        }
    }

    public function create()
    {
        $user = User::with(['optometrist'])->find(Auth::id());
        $opto = Optometrist::with(['oticas'])->find($user->optometrist_id);
        $oticas = $opto->oticas;
        if ($opto->pago == 0) {
            if ($user->is_optometrist == 1) {
                return view('opto.receitas.create', compact('oticas'));
            }
        } else {
            return view('pagamento');
        }
    }

    public function store(StoreUpdateReceita $request)
    {
        $data = $request->validated();
        $user = User::with(['optometrist'])->find(Auth::id());
        $opto = Optometrist::with(['oticas'])->find($user->optometrist_id);
        foreach ($data['oticas'] as $key => $otica) {
            if($data['ac'] == ''){
                $data['ac'] = '-';
            }
            if($data['acd'] == ''){
                $data['acd'] = '-';
            }
            if($data['ace'] == ''){
                $data['ace'] = '-';
            }
            Receita::create([
                'nome' => $data['nome'],
                'idade' => $data['idade'],
                'od_esferico' => $data['od_esferico'],
                'od_cilindrico' => $data['od_cilindrico'],
                'od_eixo' => $data['od_eixo'],
                'oe_esferico' => $data['oe_esferico'],
                'oe_cilindrico' => $data['oe_cilindrico'],
                'oe_eixo' => $data['oe_eixo'],
                'adicao' => $data['adicao'],
                'obs' => $data['obs'],
                'ac' => $data['ac'],
                'acd' => $data['acd'],
                'ace' => $data['ace'],
                'optometrist_id' => $opto->id,
                'otica_id' => $otica
            ]);
        }

        return redirect()->back()->withSuccess('Cadastro realizado com sucesso');
    }

    public function getReceitas($id)
    {
        $user = User::with(['optometrist'])->find(Auth::id());
        $opto = Optometrist::with(['oticas'])->find($user->optometrist_id);
        $otica = Otica::with(['receitas','optometrist'])->find($id);
        if ($opto->pago == 0) {
                if($otica->optometrist->id == $opto->id) {
                    $total = Receita::where('otica_id',$otica->id)->where('optometrist_id',$opto->id)->count();
                    $receitas = Receita::where('otica_id',$otica->id)->where('optometrist_id',$opto->id)->orderBy('created_at', 'DESC')->paginate(55);
                    
                    
                    foreach($receitas as $i => $receita) {
                    $receitas[$i]['data_formatada'] = $receita->created_at->format('d/m/Y H:i');
                    $receitas[$i]['qntdReceitas'] = $total;
                    $receitas[$i]['is_opto'] = ($user->is_optometrist == 1) ? 1 : 0;
                    }
                    
                    json_encode($receitas);
                    return response()->json($receitas);
                }
        }
    }

    public function searchReceita(Request $request)
    {
        $user = User::with(['optometrist'])->find(Auth::id());
        $opto = Optometrist::with(['oticas'])->find($user->optometrist_id);
        $otica = Otica::with(['optometrist'])->find($request->otica_id);
        if ($opto->pago == 0) {
                if($otica->optometrist->id == $opto->id) {
            
                    $receitas = Receita::where('otica_id',$otica->id)->where('optometrist_id',$opto->id)->where('nome','LIKE',"%$request->nome%")->orderBy('created_at', 'DESC')->get();
                    foreach($receitas as $i => $receita) {
                    $receitas[$i]['data_formatada'] = $receita->updated_at->format('d/m/Y H:i');
                    $receitas[$i]['is_opto'] = ($user->is_optometrist == 1) ? 1 : 0;
                    }
                    
                    json_encode($receitas);
                    return response()->json($receitas);
                }
        }
    }

    public function update(Request $request,$id)
    {
        $data = $request->only('nome','idade','adicao','obs','od_esferico','od_cilindrico','od_eixo','oe_esferico','oe_cilindrico','oe_eixo','ac','acd','ace');

        if($data['ac'] == ''){
            $data['ac'] = '-';
        }
        if($data['acd'] == ''){
            $data['acd'] = '-';
        }
        if($data['ace'] == ''){
            $data['ace'] = '-';
        }
        foreach($data as $i => $dado) {
            if(is_null($data[$i])){
                $data[$i] = ' ';
            }
        }
        $receita = Receita::find($id);
        if(!$receita) {
            return response(['message' => 'error']);
        }

        if($receita->update($data)) {
            return response(['message' => 'success']);
        }        

        return response(['message' => 'error']);
    }

    public function delete($id)
    {
        $user = User::with(['optometrist'])->find(Auth::id());
        $opto = Optometrist::with(['oticas'])->find($user->optometrist_id);
        if ($user->is_optometrist == 1) {

            $receita = Receita::find($id);
            $receita->delete();
            return response(['message' => 'success'],200);
        }
        return response(['message' => 'error'],204);
    }
}
