<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Receita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function newPdf($id)
    {
        $user = Auth::user();
        $receita = Receita::with(['optometrist'])->find($id);
        if($receita){
                if($user->is_optometrist == 1){
                    if($receita->optometrist->id == $user->optometrist_id) {
                        $pdf = App::make('dompdf.wrapper');
                        $pdf->loadView('pdf.receita',compact('receita'));
                        return $pdf->setPaper('a4')->stream('receita.pdf');
                    }else {
                        return "Está Receita não Pertence a você!";
                    }

                }else {
                    $permissao = Permission::where('otica_id',$receita->otica_id)->where('user_id',$user->id)->firstOrFail();
                    if($permissao) {
                        $pdf = App::make('dompdf.wrapper');
                        $pdf->loadView('pdf.receita',compact('receita'));
                        return $pdf->setPaper('a4')->stream('receita.pdf');
                    }
                    return "Você não tem permissão para acessar esta receita";
                }
               
        }else{
            return "Erro na impressão do PDF, Receita não encontrada";
        }
    }

    public function anamnese1()
    {
        return  redirect(asset('/anamnese/modelo1.pdf'));
    }

    public function anamnese2()
    {
        return  redirect(asset('/anamnese/modelo2.pdf'));
    }
}
