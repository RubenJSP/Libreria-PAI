<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Loan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasPermissionTo('view users')){
            $users = Loan::with('users','books')->get();
            return view('users.index',compact('users'));
        }
        return redirect()->back()->with("error","You don't have permissions"); 
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
    public function store(Request $request)
    {
        if(Auth::user()->hasPermissionTo('create users')){
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'max:255' , 'confirmed'],
                'role_id' => ['required','numeric']
            ]);
            //En caso de no ser válidos, se regresa con una respuesta de error
            if ($validator->fails()) {
                return  redirect()->back()->with('error', 'Oops! Something went wrong'); 
            } 
            if($user = User::create($request->all())){
                $user->assignRole($user->role_id);
                $user->password =  Hash::make($request['password']);
                $user->save();
                return  redirect()->back()->with('success', 'User created successfully');
            }
            return  redirect()->back()->with('error', "Sorry, couldn't create user");
        }
        return redirect()->back()->with("error","You don't have permissions"); 
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(Auth::user()->hasPermissionTo('edit users')){
            //Validar los datos del request
            $validator = Validator::make($request->all(), [
                'id' => ['required', 'numeric'],
                'role_id' => ['required', 'numeric'],
           ]);
           //En caso de no ser válidos, se regresa con una respuesta de error
           if ($validator->fails()) {
               return  redirect()->back()->with('error', 'Oops! Something went wrong'); 
           } 
           $user = User::find($request['id']);
           if($user!=null){
               $user->Update($request->all());
               $user->assignRole($request['role_id']);
               return  redirect()->back()->with('success', 'The user has been updated');
           }
           return redirect()->back()->with('error', 'Sorry, user not updated, try again'); 
         }
         return redirect()->back()->with("error","You don't have permissions");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->hasPermissionTo('delete books')){
            $user = User::find($id);
            if($user!=null){
                //Se elimian TODOS los préstamos ligados al usuario
                Loan::where('user_id',$user->id)->delete();
                //Se elimina el usuario 
                if($user->delete()){
                    return response()->json([
                        'message' => 'User deleted successfully', 
                        'code' => '200'
                    ]);
                }
                return response()->json([
                        'message' => "Sorry, coudn't delete the User", 
                        'code' => '400'
                    ]);
            }
        }
        return response()->json([
            'message' => "You don't have permissions", 
            'code' => '403'
        ]);
    }
}
