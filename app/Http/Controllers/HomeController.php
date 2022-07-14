<?php

namespace App\Http\Controllers;

use App\Models\Exame;
use App\Models\Optometrist;
use App\Models\Receita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::find(Auth::id());
        $user->update(['last_access' => now()]);
        if($user->is_optometrist == 1) {
            $opto = Optometrist::with('users','oticas','receitas')->find($user->optometrist_id);
            $totalConsultasHoje = Exame::consultasHoje($opto->id);
            $totalReceitasHoje = Receita::receitasHoje($opto->id);
            $totalUsuarios = count($opto->users) - 1;
            $totalOticas = count($opto->oticas);
            $totalReceitas = count($opto->receitas);
            $usuarios =  $opto->users;
            unset($usuarios[0]);
            foreach ($usuarios as $usuario) {
                $fiveMinutes = strtotime('5 minutes ago');
                $tempoMaximo = date('Y-m-d H:i:s',$fiveMinutes);
                if($usuario->last_access  >= $tempoMaximo) {
                    $usuario['status'] = 1;
                }else {
                    $usuario['status'] = 0;
                }
            }
           
            return view('home',compact('user','usuarios','totalConsultasHoje','totalReceitasHoje','totalUsuarios','totalOticas','totalReceitas'));
        }
        return redirect()->route('receitas.index');
       
    }
}
