<?php

dd($request->input('user'));
Session::put('user', $request->input('user') );  

?>