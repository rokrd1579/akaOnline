<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use App\Business;
use App\User;
use App\Profile;
use App\Address;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.create')->only('create', 'store');
        $this->middleware('can:admin.users.show')->only('show');
        $this->middleware('can:admin.users.edit')->only('edit', 'update');
        $this->middleware('can:admin.users.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->orderBy('id', 'DESC')->get();
        return view('admin.users.index')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $businesses = Business::orderBy('name')->get();
        $roles = Role::all();
        $profiles = Profile::with('addresses')->get();
        $addresses = Address::with('profiles')->get();
        return view('admin.users.create',compact('profiles', 'addresses', 'roles', 'businesses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name_profile' => ['required', 'max:80'],
            'primary_phone' => ['required', 'min:10', 'max:10'],
            'gender' => ['required'],
            'number_home' => ['required'],
            'postal_code' => ['required'],
            'street_name' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'suburb' => ['required'],
            'references' => ['required'],
            'roles' => ['required']
        ],
        [
            'name.required' => 'El campo nombre de usuario es obligatorio',
            'email.required' => 'El campo dirección correo electrónico es obligatorio',
            'password.required' => 'El campo contraseña es obligatorio',
            'name_profile.required' => 'El campo nombre de perfil es obligatorio',
            'primary_phone.required' => 'El campo teléfono es obligatorio',
            'gender.required' => 'El campo género es obligatorio',
            'number_home.required' => 'El campo número exterior es obligatorio',
            'postal_code.required' => 'El campo código postal es obligatorio',
            'street_name.required' => 'El campo calle es obligatorio',
            'state.required' => 'El campo estado es obligatorio',
            'city.required' => 'El campo ciudad es obligatorio',
            'suburb.required' => 'El campo colonia es obligatorio',
            'references.required' => 'El campo referencias es obligatorio',
            'roles.required' => 'El campo roles es obligatorio'
        ]);

        $users = new User();
        $users->name = $request->get('name');
        $users->email = $request->get('email');
        $users->password = Hash::make($request->get('password'));
        /* $users->active = $request->get('active');
        if($request->get('active')){
            $users->active=1;
        }
        else{
            $users->active=0;
        } */
        $users->assignRole($request->roles);
        $users->save();
        $users->businesses()->attach($request->businesses);

        $profiles = new Profile();
        $profiles = $users->profile()->create([
            'user_id' =>$request->user_id,
            'name_profile' => $request->name_profile,
            'primary_phone' => $request->primary_phone,
            'secondary_phone' => $request->secondary_phone,
            'gender' => $request->gender,
        ])->id;  
        $addresses = new Address();
        $addresses->number_home = $request->get('number_home');
        $addresses->postal_code = $request->get('postal_code');
        $addresses->street_name = $request->get('street_name');
        $addresses->state = $request->get('state');
        $addresses->city = $request->get('city');
        $addresses->suburb = $request->get('suburb');
        $addresses->references = $request->get('references');
        $addresses->save();
        $addresses->Profiles()->attach($profiles);

        return redirect()->route('admin.users.index')->with('Agregar', 'Ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::all();
        $profile = Profile::with('addresses')->firstOrFail();
        return view('admin.users.show', [
            'addresses' => Address::all(),
            'user' => $user,
            'roles' => $roles,
            'profile' => Profile::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $profile = Profile::with('addresses')->firstOrFail();
        return view('admin.users.edit', [
            'addresses' => Address::all(),
            'user' => $user,
            'roles' => $roles,
            'profile' => Profile::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->email, 'email')],
            'password' => ['confirmed'],
            'name_profile' => ['required', 'max:80'],
            'primary_phone' => ['required', 'min:10', 'max:10'],
            'gender' => ['required'],
            'number_home' => ['required'],
            'postal_code' => ['required'],
            'street_name' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'suburb' => ['required'],
            'references' => ['required']
            
        ],
        [
            'name.required' => 'El campo nombre de usuario es obligatorio',
            'email.required' => 'El campo dirección correo electrónico es obligatorio',
            'name_profile.required' => 'El campo nombre de perfil es obligatorio',
            'primary_phone.required' => 'El campo teléfono es obligatorio',
            'gender.required' => 'El campo género es obligatorio',
            'number_home.required' => 'El campo número exterior es obligatorio',
            'postal_code.required' => 'El campo código postal es obligatorio',
            'street_name.required' => 'El campo calle es obligatorio',
            'state.required' => 'El campo estado es obligatorio',
            'city.required' => 'El campo ciudad es obligatorio',
            'suburb.required' => 'El campo colonia es obligatorio',
            'references.required' => 'El campo referencias es obligatorio',
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        //$user->password = Hash::make($request->get('password'));
        if ( !empty($request->input('password')) ) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->active = $request->get('active');
        if($request->active){
            $user->active=1;
        }
        else{
            $user->active=0;
        }
        /* $user->roles()->sync($request->roles); */
        $user->syncRoles($request->roles);
        /* user->hasRole()->sync($request->roles); */
        $user->save();

        $profile = Profile::find($id);
        $profile->name_profile = $request->get('name_profile');
        $profile->primary_phone = $request->get('primary_phone');
        $profile->secondary_phone = $request->get('secondary_phone');
        $profile->gender = $request->get('gender');
        $profile->save();
        
        $address = Address::find($id);
        $address->number_home = $request->get('number_home');
        $address->postal_code = $request->get('postal_code');
        $address->street_name = $request->get('street_name');
        $address->state = $request->get('state');
        $address->city = $request->get('city');
        $address->suburb = $request->get('suburb');
        $address->references = $request->get('references');
        $address->save();
        $address->Profiles()->sync($profile);
        return redirect()->route('admin.users.index')->with('Editar', 'Ok');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete($id);
        return redirect()->route('admin.users.index')->with('Eliminar', 'Ok');
    }
}
