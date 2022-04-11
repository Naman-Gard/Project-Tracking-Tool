@extends('layouts.app')

@section('content')
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              @if(session('not-exist'))
                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                <span class="text-sm success-message">{{session('not-exist')}}</span>
                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                @endif
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                  <div class="row mt-3">
                    <!-- <div class="col-2 text-center ms-auto">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-facebook text-white text-lg"></i>
                      </a>
                    </div> -->
                    <!-- <div class="col-2 text-center px-1">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-github text-white text-lg"></i>
                      </a>
                    </div> -->
                    <div class="col-2 text-center m-auto">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-google text-white text-lg"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form>
                    @csrf
                    <span class="text-danger" id="auth"></span>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                    
                  </div>
                  <span class="text-danger" id="valid_email"></span>
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Password</label>
                     <input id="password" type="password" class="form-control" name="password" required autocomplete="off">
                    
                  </div>
                  <span class="text-danger" id="valid_password"></span>
                  <!-- <div class="form-check form-switch d-flex align-items-center mb-3">
                   
                     <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label mb-0 ms-2" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                  </div> -->
                  <div class="text-center">
                    
                       <button type="button" onclick="Login()" class="btn bg-gradient-primary w-100 my-4 mb-2"> Sign in </button>
                       <!-- <a  href="{{ url('auth/google') }}" class="btn bg-gradient-primary w-100 my-4 mb-2"><i class="fa fa-envelope"></i>
                          <strong>Google Login</strong>
                       </a> -->
                       <a class="oauth-container btn darken-4 white black-text bg-gradient-primary" href="{{ url('auth/google') }}" style="text-transform:none;">
                          <div class="left">
                              <img width="20px" style="margin-top:7px; margin-right:8px" alt="Google sign-in" 
                                  src="{{asset('assets/images/Google__G__Logo.svg.webp')}}" />
                          </div>
                          Login with Google
                      </a>
                  </div>
              
                  <!-- <p class="mt-4 text-sm text-center">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">Sign up</a>
                  </p> -->
             
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  
    </div>
@endsection
@push('scripts')
<script>

function Login(){
  let email=$('#email').val()
  let password=$('#password').val()

  const flag=doValidation(email,password)

  if(flag){

    const filters={
      "email":{
          '_eq': email
      },
      "password":{
        '_eq': btoa(password)
      }
    }

    $.ajax({
      type: "GET",
      url: api_url+'items/users?filter='+JSON.stringify(filters),
    }).done((response)=>{
      const user=response.data
      if(user.length!=0){

        $.ajax({
         url: "/set-session",
         data: { user }
        }).done(()=>{
          window.location='{{route("home")}}'
        });
        
        
      }
      else{
        $('#auth').html('Invalid Email & Password')
      }
    })

  }
  
  
}


function doValidation(email,password){
  let flag=false
  let flag2=false
  if(email==''){
    $('#valid_email').html('The email field is required.')
    flag=false
  }
  else{
    flag=emailValidation(email)
  }

  if(password==''){
    $('#valid_password').html('The password field is required.')
    flag2=false
  }
  else{
    $('#valid_password').html('')
    flag2=true
  }

  return flag && flag2
}

function emailValidation(email){
  let valid = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(email.toLowerCase().match(valid)){
    $('#valid_email').html('')
    return true
  }
  else{
    $('#valid_email').html('Invalid Email')
    return false
  }
}


</script>
@endpush