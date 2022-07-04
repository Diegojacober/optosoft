<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateOptometrist;
use App\Models\Optometrist;
use App\Models\Otica;
use App\Models\Receita;
use App\Models\User;
use Illuminate\Support\Str;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class OptometristController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        $user = User::with(['optometrist'])->find(Auth::id());

        if($user->is_optometrist == 1) {
            return view('opto.profile',compact('user'));
        }
        return view('home');
    }

    public function updateProfile(StoreUpdateOptometrist $request)
    {
        $user = User::with(['optometrist'])->find(Auth::id());
        $data = $request->validated();
        $nameImage = 'padrao.png';
        if ($request->photo) {
            if (Storage::exists($user->optometrist->uuid."/".$user->optometrist->photo)) {
                Storage::delete($user->optometrist->uuid."/".$user->optometrist->photo);
            }
            //dd($request->photo);
            $name = Str::slug($request->name,'-');
            $extension = $request->photo->extension();
            $nameImage = "$name.$extension";
            $upload = $request->photo->storeAs('/optometrists/'.$user->optometrist->uuid,$nameImage);
            $data['photo'] = $nameImage;
            if(!$upload) {
                return redirect()->back()->with('errors',['Falha no Upload']);
            }
        }
        $data['password'] = Hash::make($data['password']);
        $user->update($data);
        $user->optometrist->update($data);

        return redirect()->back()->withSuccess('Atualizado Com Sucesso');
    }

    public function usersIndex()
    {
       $opto = Optometrist::with(['users','oticas'])->find(Auth::user()->optometrist_id);
       $user = User::find(Auth::id());
       if($opto->pago == 0 ){
        if($user->is_optometrist == 1){
            $users = User::with(['permissoes'])->where('optometrist_id',$opto->id)->paginate(11);
       
            $oticas = $opto->oticas;
            unset($users[0]);
            return view('opto.users.index',compact('users','oticas'));
        
        }
        return redirect()->route('home');
       }
       else{
        return view('pagamento');
       }
    }
}
