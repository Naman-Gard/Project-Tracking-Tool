<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use DB;

class UserController extends Controller
{
    public function permission()
    {
        return view('users.permission');
    }

    public function addUser(){
        return view('users.add');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        try {
     
            $user = Socialite::driver('google')->user();
      
            $finduser = User::where('social_id', $user->id)->first();

            $findgmailuser = DB::table('user_gmail_login')->where('email_id', $user->email)->first();

            if($finduser){
      
                Auth::login($finduser);

                Session::put('user',$finduser);

                return redirect()->route('home');
      
            }else{

                if($findgmailuser){
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'social_id'=> $user->id,
                        'social_type'=> 'google',
                        'password' => encrypt('my-google')
                    ]);
    
                    $get_user = User::where('email', $user->email)->first();
    
                    DB::table('permissions')->insert([
                        'user_id' => $get_user->id,
                        'role' => $findgmailuser->role,
                        'view' => $findgmailuser->view,
                        'add' => $findgmailuser->add,
                        'edit' => $findgmailuser->edit,
                        'delete' => $findgmailuser->delete,
                    ]);
         
                    Auth::login($newUser);
                    Session::put('user',$newUser);
                    
                    return redirect()->route('home');
                }

                else{
                    return redirect()->route('login')->with('not-exist','This Gmail Account does not exist!');;
                }
                
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
