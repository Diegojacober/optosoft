<?php

namespace App\Http\Controllers;

use App\Models\Optometrist;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Empty_;

class PermissionController extends Controller
{
    public function store(Request $request, $id)
    {
        $opto = Optometrist::find(Auth::user()->optometrist_id);
        $user = User::with(['permissoes'])->find($id);
        $data = $request->only(['oticas']);
        $remove = [];

        if(!empty($data)){
            foreach($user->permissoes as $permissao) {
                if (in_array($permissao->otica_id, $data['oticas'])) { 
                    unset($data['oticas'][$permissao->otica_id]);
                }else{
                    $remove[] = $permissao->otica_id;
                }
            }
    
            if(!empty($remove)){
                foreach($remove as $otica_id) {
                    $permissao = Permission::where('user_id',$user->id)->where('otica_id',$otica_id)->firstOrFail();
    
                    $permissao->delete();
                }
            }
    
            foreach($data['oticas'] as $otica){
                Permission::create([
                    'optometrist_id' => $opto->id,
                    'otica_id' => $otica,
                    'user_id' => $user->id,
                ]);
            }
    
            return redirect()->route('opto.users')->withSuccess("As permissões de $user->name foram alteradas com sucesso!");
        }else{
            return redirect()->route('opto.users')->withErrors('O usuário deve ter no minimo uma permissão');
        }
      
    }
}
