<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailboxController extends Controller
{
    public function index(){
        return view('mailbox.index');
    }
    public function draft(){
        return view('mailbox.draft');
    }
    public function sent(){
        return view('mailbox.sent');
    }
}
