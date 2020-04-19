<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\Book; 
use Illuminate\Support\Facades\Auth; 
use Validator;
class UserController extends Controller 
{
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required|string|confirmed',
            'country' => 'required|string', 
            'dob' => 'required|string', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'country' => bcrypt($request->country),
            'dob' => bcrypt($request->dob),
        ]);
        $user->save();


        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;

        return response()->json(['success'=>$success], $this-> successStatus); 
    }

    /** 
     * book list 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function books() 
    { 
        $books = Book::get(); 
        return response()->json(['success' => $books], $this-> successStatus); 
    } 
    
    /** 
     * book list 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function bookDetails($id) 
    { 
        $books = Book::find($id); 
        return response()->json(['success' => $books], $this-> successStatus); 
    } 
}