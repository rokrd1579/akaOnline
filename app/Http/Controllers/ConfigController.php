<?php

namespace App\Http\Controllers;

use App\Configuration;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class ConfigController extends Controller
{
    

    public function configuration($config)
    {   
        $user = Auth::user();
        $conf = '';
        if($config == 1){
            Configuration::where('user_id', $user->id)->update(['notif_push'=>0]);
            $conf = "Las notificaciones se han desactivado";
        }elseif($config == 0){
            Configuration::where('user_id', $user->id)->update(['notif_push'=>1]);
            $conf = "Las notificaciones se han activado";
        }
             return response(json_encode($conf),200)->header('Content-Type','text/plain');
        
    }   
}