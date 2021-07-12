<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\ProfileHasAddresses;
use Illuminate\Support\Facades\Auth;
use App\Address;
use Illuminate\Support\Facades\DB;
use App\Profile;
use App\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use PhpParser\Node\Expr\FuncCall;

class ProfileController extends Controller
{

    public function profile()
    {

        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->select('users.*', 'model_has_roles.model_id', 'model_has_roles.role_id')
            ->where('model_has_roles.role_id', '=', 3)
            ->get();

        $profiles = Profile::where('user_id', '=', Auth::user()->id)->get();

        $addresses = DB::table('profile_has_addresses')
            ->join('addresses', 'profile_has_addresses.address_id', '=', 'addresses.id')
            ->join('profiles', 'profile_has_addresses.profile_id', '=', 'profiles.id')
            ->select('addresses.*', 'profiles.user_id as user_id')
            ->where('profiles.user_id', '=', Auth::user()->id)
            ->get();

        $cookie = Cookie::get('iP');

        return view('profile.index', compact('users', 'profiles', 'addresses', 'cookie'));
    }


    public function address_store(Request $request)
    {
        $profiles = Profile::where('user_id', '=', Auth::user()->id)->first();

        $address = new Address();
        $address->street_name = $request->street_name;
        $address->number_home = $request->number_home;
        $address->postal_code = $request->postal_code;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->suburb = $request->suburb;
        $address->references =  $request->references;
        $address->save();

        $profilehasaddresses = new ProfileHasAddresses();

        $profilehasaddresses->profile_id = $profiles->id;
        $profilehasaddresses->address_id = $address->id;
        $profilehasaddresses->save();

        return redirect()->route('profile')->with('msj', 'Se ha actualizado su dirección de entrega')->with('icon', 'success');
    }


    public function profile_store(Request $request)
    {

        $profile = new Profile();
        $profile->user_id = User::where('id', '=', Auth::user()->id)->value('id');
        $profile->name_profile = $request->name;
        $profile->primary_phone = $request->primary_phone;
        $profile->secondary_phone = $request->secondary_phone;
        $profile->gender = $request->gender;
        $profile->save();

        $address = new Address();
        $address->street_name = $request->street_name;
        $address->number_home = $request->number_home;
        $address->postal_code = $request->postal_code;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->suburb = $request->suburb;
        $address->references =  $request->references;
        $address->save();

        $profilehasaddresses = new ProfileHasAddresses();

        $profilehasaddresses->profile_id = $profile->id;
        $profilehasaddresses->address_id = $address->id;
        $profilehasaddresses->save();

        return redirect()->route('profile')->with('msj', 'se han guardado sus datos con exito')->with('icon', 'success');
    }

    public function profile_update(Request $request)
    {
        $profile = Profile::where('user_id', '=', Auth::user()->id)->first();

        $profile->name_profile = $request->name_profile;
        $profile->primary_phone = $request->primary_phone;
        $profile->secondary_phone = $request->secondary_phone;
        $profile->gender = $request->gender;
        $profile->update();

        return redirect()->route('profile')->with('msj', 'Se ha actualizado su información del perfil')->with('icon', 'success');
    }

    public function address_update(Request $request)
    {
        $id = $request->id;
        $address = Address::where('id', $id)->first();

        $address->street_name = $request->street_name;
        $address->number_home = $request->number_home;
        $address->postal_code = $request->postal_code;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->suburb = $request->suburb;
        $address->references =  $request->references;
        $address->update();

        return redirect()->route('profile')->with('msj', 'Se ha actualizado su dirección de entrega')->with('icon', 'success');
    }

    public function user_update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:4', 'max:15'],
        ]);

        $user = User::where('id', '=', Auth::user()->id)->first();

        $hashedPassword = $request->password;

        if (Hash::check($hashedPassword, $user->password)) {
            $user->name = $request->name;
            $user->update();
            return redirect()->route('profile')->with('msj', 'Se ha actualizado su nombre de usuario')->with('icon', 'success');
        } else {
            return redirect()->route('profile')->with('msj', 'Error en su contraseña')->with('icon', 'error');
        }
    }


    public function email_update(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'unique:users'],
        ]);

        $user = User::where('id', '=', Auth::user()->id)->first();

        $hashedPassword = $request->password;

        if (Hash::check($hashedPassword, $user->password)) {
            $user->email = $request->email;
            $user->update();

            return redirect()->route('profile')->with('msj', 'Se ha actualizado su nombre de usuario')->with('icon', 'success');
        } else {
            return redirect()->route('profile')->with('msj', 'Error en su contraseña')->with('icon', 'error');
        }
    }


    public function password_update(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
            'new_assword_confir' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::where('id', '=', Auth::user()->id)->first();

        $hashedPassword = $request->password;
        $new_password = $request->new_password;
        $confir_password = $request->new_password_confir;

        if (Hash::check($hashedPassword, $user->password) && ($new_password == $confir_password)) {
            $user->password = Hash::make($request->new_password);
            $user->update();

            return redirect()->route('profile')->with('msj', 'Se ha actualizado su nombre de usuario')->with('icon', 'success');
        } else {
            return redirect()->route('profile')->with('msj', 'Error en su contraseña')->with('icon', 'error');
        }
    }
}
