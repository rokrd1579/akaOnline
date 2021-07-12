<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
/* use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use App\User;
use App\Profile; */
use Illuminate\Validation\Rule;
use App\Address;
use App\Business;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin.business.index')->only('index');
        $this->middleware('can:admin.business.create')->only('create', 'store');
        $this->middleware('can:admin.business.show')->only('show');
        $this->middleware('can:admin.business.edit')->only('edit', 'update');
        $this->middleware('can:admin.business.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $businesses = Business::with('address')->orderBy('id', 'DESC')->get();
        $addresses = Address::all();
        return view('admin.business.index')->with(compact('businesses', 'addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* $businesses = User::with('profiles')->get(); */
        /* $profiles = Profile::with('addresses')->get(); */
        $business = Business::with('address');
        return view('admin.business.create',compact('business'));
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
            'email' => ['required', 'email', 'unique:businesses'],
            'name_business' => ['required'],
            'phone' => ['required','min:10'],
            'rfc' => ['required'],
            'description' => ['required'],
            'number_home' => ['required'],
            'postal_code' => ['required'],
            'street_name' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'suburb' => ['required'],
            'references' => ['required']
        ],
        [
            'name.required' => 'El campo nombre de empresa es obligatorio',
            'email.required' => 'El campo dirección correo electrónico es obligatorio',
            'name_business.required' => 'El campo razón social es obligatorio',
            'phone.required' => 'El campo teléfono es obligatorio',
            'gender.required' => 'El campo género es obligatorio',
            'rfc.required' => 'El campo rfc es obligatorio',
            'description.required' => 'El campo descripción es obligatorio',
            'number_home.required' => 'El campo número exterior es obligatorio',
            'postal_code.required' => 'El campo código postal es obligatorio',
            'street_name.required' => 'El campo calle es obligatorio',
            'state.required' => 'El campo estado es obligatorio',
            'city.required' => 'El campo ciudad es obligatorio',
            'suburb.required' => 'El campo colonia es obligatorio',
            'references.required' => 'El campo referencias es obligatorio',
        ]);

        /* $businesses = new User();
        $businesses->name = $request->get('name');
        $businesses->email = $request->get('email');
        $businesses->password = Hash::make($request->get('password'));
        $businesses->active = $request->get('active'); */
        /* if($request->get('active')){
            $businesses->active=1;
        }
        else{
            $businesses->active=0;
        } */
        /* $businesses->assignRole('seller');
        $businesses->save();
        $profiles = new Profile();
        $profiles = $businesses->profile()->create([
            'user_id' =>$request->user_id,
            'name_profile' => $request->name_profile,
            'primary_phone' => $request->primary_phone,
            'secondary_phone' => $request->secondary_phone,
            'gender' => $request->gender,
        ])->id; */  
        $businesses =new Business();
        $businesses->name = $request->get('name');
        $businesses->name_business = $request->get('name_business');
        $businesses->email = $request->get('email');
        $businesses->phone = $request->get('phone');
        $businesses->rfc = $request->get('rfc');
        $businesses->description = $request->get('description');
        $businesses->save();
        $businesses->address()->create([
            'business_id' =>$request->business_id,
            'number_home' => $request->number_home,
            'postal_code' => $request->postal_code,
            'street_name' => $request->street_name,
            'state' => $request->state,
            'city' =>$request->city,
            'suburb' => $request->suburb,
            'references' => $request->references,
        ]);
        /* $addresses = new Address();
        $addresses->number_home = $request->get('number_home');
        $addresses->postal_code = $request->get('postal_code');
        $addresses->street_name = $request->get('street_name');
        $addresses->state = $request->get('state');
        $addresses->city = $request->get('city');
        $addresses->suburb = $request->get('suburb');
        $addresses->references = $request->get('references');
        $addresses->save();
        $addresses->Profiles()->attach($profiles); */

        return redirect()->route('admin.business.index')->with('Agregar', 'Ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $business = Business::find($id);
        $address = Address::firstOrFail();
        return view('admin.business.show', compact('business', 'address'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $business = Business::with('address')->find($id);
        $address = Address::firstOrFail();
        return view('admin.business.edit', compact('business', 'address')); 
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
        /* $request->validate([
            'name' => ['required', 'max:255'],
            'email' =>  ['required', 'email', Rule::unique('users')->ignore($request->email, 'email')],
            'name_profile' => ['required', 'max:255'],
            'primary_phone' => ['required', 'min:10', 'max:10'],
            'gender' => ['required'],
            'number_home' => ['required'],
            'postal_code' => ['required'],
            'street_name' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'suburb' => ['required'],
            'references' => ['required']
        ]); */

        /* $business = User::find($id);
        $business->name = $request->get('name');
        $business->email = $request->get('email');
        //$business->password = Hash::make($request->get('password'));
        $business->active = $request->get('active');
        if ( !empty($request->input('password')) ) {
            $business->password = Hash::make($request->input('password'));
        }
        if($request->active){
            $business->active=1;
        }
        else{
            $business->active=0;
        }
        $business->assignRole('seller');
        $business->save();
        
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

        if(auth()->user()->hasRole('seller')){
        return redirect()->back();
        } */
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->email, 'email')],
            'name_business' => ['required'],
            'phone' => ['required'],
            'rfc' => ['required'],
            'description' => ['required'],
            'number_home' => ['required'],
            'postal_code' => ['required'],
            'street_name' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'suburb' => ['required'],
            'references' => ['required']
        ],
        [
            'name.required' => 'El campo nombre de empresa es obligatorio',
            'email.required' => 'El campo dirección correo electrónico es obligatorio',
            'name_business.required' => 'El campo razón social es obligatorio',
            'phone.required' => 'El campo teléfono es obligatorio',
            'gender.required' => 'El campo género es obligatorio',
            'rfc.required' => 'El campo rfc es obligatorio',
            'description.required' => 'El campo descripción es obligatorio',
            'number_home.required' => 'El campo número exterior es obligatorio',
            'postal_code.required' => 'El campo código postal es obligatorio',
            'street_name.required' => 'El campo calle es obligatorio',
            'state.required' => 'El campo estado es obligatorio',
            'city.required' => 'El campo ciudad es obligatorio',
            'suburb.required' => 'El campo colonia es obligatorio',
            'references.required' => 'El campo referencias es obligatorio',
        ]);

        $business = Business::find($id);
        $business->name = $request->get('name');
        $business->name_business = $request->get('name_business');
        $business->email = $request->get('email');
        $business->phone = $request->get('phone');
        $business->rfc = $request->get('rfc');
        $business->description = $request->get('description');
        $business->save();

        /* $business->address()->create([
            'business_id' =>$request->business_id,
            'number_home' => $request->number_home,
            'postal_code' => $request->postal_code,
            'street_name' => $request->street_name,
            'state' => $request->state,
            'city' => $request->city,
            'suburb' => $request->suburb,
            'references' => $request->references,
            'state' => $request->state,
        ]); */
        $address = Address::find($id);
        $address->number_home = $request->get('number_home');
        $address->postal_code = $request->get('postal_code');
        $address->street_name = $request->get('street_name');
        $address->state = $request->get('state');
        $address->city = $request->get('city');
        $address->suburb = $request->get('suburb');
        $address->references= $request->get('references');
        $address->save();

        return redirect()->route('admin.business.index')->with('Modificar', 'Ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $business = Business::find($id);
        $business->delete($id);
        return redirect()->route('admin.business.index')->with('Eliminar', 'Ok');
    }
}
