<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Optometrist;
use App\Models\Otica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OticaController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if ($user->is_optometrist == 1) {
            $oticas = $user->optometrist->oticas;
            $ativos = [];
            $inativos = [];
            foreach ($oticas as $i => $otica) {
                if ($otica->ativo == 0) {
                    $ativos[] = $otica;
                } else {
                    $inativos[] = $otica;
                }
            }
            return view('opto.oticas.index', compact('inativos', 'ativos'));
        }

        return redirect()->route('home');
    }

    public function store(Request $request)
    {
        $data = $request->only('nome', 'cidade');

        $user = Auth::user();
        if ($user->is_optometrist == 1) {
            $data['optometrist_id'] = $user->optometrist_id;
            Otica::create($data);
            return redirect()->route('otica.index')->withSuccess('Ótica cadastrada!');
        }

        return redirect()->route('home');
    }

    public function action($id)
    {
        $otica = Otica::find($id);
        $user = Auth::user();
        if ($user->is_optometrist == 1) {
            if ($user->optometrist_id == $otica->optometrist_id) {

                if ($otica->ativo == 1) {
                    $otica->update(['ativo' => 0]);
                    return redirect()->route('otica.index')->withSuccess("A ótica $otica->nome foi ativada");
                } else {
                    $otica->update(['ativo' => 1]);
                    return redirect()->route('otica.index')->withSuccess("A ótica $otica->nome foi inativada");
                }
            }
        }
        return redirect()->route('home');
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('nome', 'cidade');
        $otica = Otica::find($id);
        $user = Auth::user();
        if ($user->is_optometrist == 1) {
            if ($user->optometrist_id == $otica->optometrist_id) {
                $otica->update($data);
                return redirect()->route('otica.index')->withSuccess("A ótica $otica->nome foi alterada com sucesso");
            }
        }
        return redirect()->route('home');
    }
}
