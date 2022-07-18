<?php

namespace App\Http\Controllers;

use App\Jobs\CancelConsult;
use App\Jobs\ConfirmConsult;
use App\Jobs\ConsultCreated;
use App\Models\Exame;
use App\Models\Optometrist;
use App\Models\Otica;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExameController extends Controller
{

    public function index()
    {
        $user = User::with('permissoes')->find(Auth::id());
        $oticasU = [];
        if ($user->is_optometrist == 1) {
            $oticas = $user->optometrist->oticas;
            foreach ($oticas as $i => $otica) {
                if ($otica->ativo == 0) {
                    $oticasU[] = $otica;
                }
            }
        } else {
            $permissoes = $user->permissoes;
            foreach ($permissoes as $permissao) {
                $otica_id = $permissao->otica_id;
                $oticaN = Otica::find($otica_id);
                if ($oticaN->ativo == 0) {
                    $oticasU[] = $oticaN;
                }
            }
        }

        return view('opto.agenda.index', compact('user', 'oticasU'));
    }


    public function events()
    {
        $user = User::with('optometrist')->find(Auth::id());
        if ($user->is_optometrist == 1) {
            $opto = Optometrist::with('exames')->find($user->optometrist_id);
            $exames = $opto->exames;
            $json = $exames;
            return $json;
        } else {
            $permissoes = $user->permissoes;
            foreach ($permissoes as $i => $permissao) {
                $otica_id = $permissao->otica_id;
                $oticaN = Otica::with('exames')->find($otica_id);
                if ($oticaN->ativo == 0 && count($oticaN->exames) > 0) {
                    $exames[] = $oticaN->exames;
                }
            }
            $json = json_encode($exames[0]);
            return $json;
        }
    }


    public function store(Request $request)
    {
        $data = $request->only('otica_id', 'title', 'idade', 'telefone', 'anotacao', 'start', 'end', 'color');
        $user = Auth::user();
        $data['optometrist_id'] = $user->optometrist_id;
        $start = str_replace('/', '-', $data['start']);
        $end = str_replace('/', '-', $data['end']);

        $data_start = date('Y-m-d H:i:s', strtotime($start));
        $data_end = date('Y-m-d H:i:s', strtotime($end));

        $disponivel = $this->VerificarDisponibildade($data_start, $data_end, $data['optometrist_id'], $data['otica_id']);
        if (count($disponivel) == 0) {
            $opto = Optometrist::find($user->optometrist_id);
            $data['start'] = $data_start;
            $data['end'] = $data_end;
            if (Exame::create($data)) {
                //ConsultCreated::dispatch($opto->email);
                return response()->json(['message' => 'success']);
            } else {
                return response()->json(['message' => 'error']);
            }
        } else {
            return response()->json(['message' => 'exists']);
        }
    }

    public function setStatus(Request $request)
    {
        $data = $request->only('id','status');
        $exame = Exame::find($data['id']);
        if($exame) {
            $opto = Optometrist::find(Auth::user()->optometrist_id);
            if($data['status'] == 'pending') {
                $exame->update(['confirmado' => '0','color' => '#FFD700']);
                return response()->json(['message' => 'success']);
            } else if($data['status'] == 'confirmed') {
                $exame->update([
                    'confirmado' => '1',
                    'color' => '#32CD32'
                ]);
                //ConfirmConsult::dispatch($opto->email);
                return response()->json(['message' => 'success']);
            } else if($data['status'] == 'canceled') {
                //CancelConsult::dispatch($opto->email);
                $exame->update(['confirmado' => '0','color' => '#FF0000']);
                return response()->json(['message' => 'success']);
            }
        }
        return response()->json(['message' => 'error']);
    }

    private function VerificarDisponibildade($horaInicial, $horaFinal, $optoID, $oticaID)
    {
        $reserva = Exame::whereRaw("otica_id = '$oticaID' AND optometrist_id = '$optoID' AND ( NOT (start >= '$horaFinal' OR  end <= '$horaInicial' ))")->get();
        return $reserva;
    }
}
