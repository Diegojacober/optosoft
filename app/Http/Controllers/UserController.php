<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateOptoUser;
use App\Models\Optometrist;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        //
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
    public function store(StoreUpdateOptoUser $request)
    {
        $data = $request->validated();
        $opto = Optometrist::with(['oticas'])->find(Auth::user()->optometrist_id);
        if ($opto->pago == 0) {
            
           $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'optometrist_id' => $opto->id,
                'is_optometrist' => 0,
                'last_access' => now()
            ]);
           
            foreach($data['oticas'] as $otica) {
                Permission::create([
                    'optometrist_id' => $opto->id,
                    'otica_id' => $otica,
                    'user_id' => $user->id,
                ]);
            }
            
            return redirect()->route('opto.users');
        } else {
            return view('pagamento');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $opto = Optometrist::with(['users','oticas'])->find(Auth::user()->optometrist_id);
        if($opto->pago == 0){
         $user = User::find($id);
         return view('opto.users.editProfile',compact('user'));
        }
        else{
         return view('pagamento');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateOptoUser $request, $id)
    {
        $data = $request->validated();
        $user = User::find($id);

        if($request->password){
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);

        return redirect()->route('opto.users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
