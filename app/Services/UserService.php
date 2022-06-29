<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyService
{
    public function getUser($id)
    {
        $user = User::find(Auth::id())->with(['optometrist']);

        if($user->is_optometrist == 1) {
            
        }
    }

  
}
