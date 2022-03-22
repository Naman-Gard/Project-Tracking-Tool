@extends('layouts.backend')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Add User</h6>
                </div>
                </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input class="form-control" name="name" type="text" placeholder="Name" value="{{old('name')}}" autocomplete="off">
                    <span class="text-danger valid_name"></span>
                    </div>
                    

                    <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email Address</label>
                    <input class="email form-control" name="email" type="email" placeholder="Email Address" value="{{old('email')}}" autocomplete="off">
                    <span class="text-danger valid_email"></span>
                    </div>

                    <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                    <input class="form-control" name="password"  type="password" placeholder="Enter Password" value="{{old('password')}}" autocomplete="off">
                    <span class="text-danger valid_pass"></span>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">User Role</label>
                        <select name="role" class="form-control">
                            <option value="">Select</option>
                            <option value="CEO">CEO</option>
                            <option value="COO">COO</option>
                            <option value="Finance">Finance</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                    <span class="text-danger valid_role"></span>
                    </div>

                    <div class="mb-3">
                    <input type="button" onclick="Submit()" class="btn btn-primary btn-sm" value="Add">
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>

    function Submit(){

        const flag=doValidations() 

        const filters={
            "email":{
                '_eq': $("input[name=email]").val()
            },
        }

        $.ajax({
        type: "GET",
        url: api_url+'items/users?filter='+JSON.stringify(filters),
        }).done((response)=>{
            const data=response.data
            if(data.length>0){
                $('.valid_email').html('The email is already registered.')
            }
            else{
                $('.valid_email').html('')
                if(flag){

                    let data={
                        'name': $("input[name=name]").val(),
                        'email': $("input[name=email]").val(),
                        'password': btoa($("input[name=password]").val()),
                        'role': $("select[name=role]").val(),
                        'view': JSON.stringify(['Dashbard','Profile','Logout']),
                        'add': JSON.stringify(['Dashbard','Profile']),
                        'edit': JSON.stringify(['Dashbard','Profile']),
                        'delet': JSON.stringify(['Dashbard','Profile']),
                    }
                
                    $.ajax({
                    type: "POST",
                    contentType: "application/json",
                    dataType: "json",
                    data:JSON.stringify(data),
                    url: api_url+'master/register',
                    }).done((response)=>{
                        window.location='{{route("users")}}'
                    })
                    
                }
            }
        })
        
        

    }

    function doValidations(){

        let flag1=false
        let flag2=false
        let flag3=false
        let flag4=false

        if($("input[name=name]").val()){
            $('.valid_name').html('')
            flag1=true
        }else{
            $('.valid_name').html('The name field is required.')
            flag1=false
        }

        if($("input[name=email]").val()){
            flag2= emailValidation($("input[name=email]").val())
        }else{
            $('.valid_email').html('The email field is required.')
            flag2=false
        }

        if($("input[name=password]").val()){
            $('.valid_pass').html('')
            flag3=true
        }else{
            $('.valid_pass').html('The password field is required.')
            flag3=false
        }

        if($("select[name=role]").val()){
            $('.valid_role').html('')
            flag4=true
        }else{
            $('.valid_role').html('The Role field is required.')
            flag4=false
        }
        
        return flag1 && flag2 && flag3 && flag4

    }

    function emailValidation(email){

        let valid = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(email.toLowerCase().match(valid)){
            $('.valid_email').html('')
            return true
        }
        else{
        $('.valid_email').html('Invalid Email')
        return false
        }
    }
</script>
@endpush