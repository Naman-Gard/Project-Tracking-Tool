@extends('layouts.backend')

@section('content')

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary d-flex justify-content-between shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">All Users</h6>
            <a class="btn btn-secondary mx-5 float-right btn-sm Project_add" href="{{route('add-user')}}">Add</a>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr class="text-center">
                      <th scope="col">SL no.</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <!-- <th scope="col">Mobile No.</th> -->
                      <th scope="col" class="action User_action">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="t-content text-center">
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>




    <div class="modal fade" id="Deleteuser" >
      <div class="modal-dialog">
          <div class="modal-content">
          
            <div class="modal-body p-0">
                
            
                <div class="card">
                  <!-- <div class="card-header">Delete user
                  <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                  <div class="card-body">
                      <p>Are you sure you want to delete?</p> 
                      <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-danger delete-mem-btn btn-sm">Delete</button>
                  </div>
                </div>


            
            </div>
          </div>
      </div>
    </div>


@endsection
@push('scripts')
<script>
  let user_id
    function deleteUser(id){
      user_id=id
    }

    $(".delete-mem-btn").click(()=>{
      let data={
        user_id:user_id
      }

      $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/user/delete',
        }).done((response)=>{
          window.location='{{route("users")}}'
        })
    })
    

    $(document).ready(()=>{
        const email='{{Session::get("user")["email"]}}'
        const filters={
            "email":{
                '_nin': [email,'admin@gmail.com']
            }
        }
        var i=1
        $.ajax({
        type: "GET",
        url: api_url+'items/users?limit=-1&&filter='+JSON.stringify(filters),
        }).done((response)=>{
        const users=response.data
        if(users.length!=0){
            users.forEach((user)=>{
              var permission = '{{ route("permission", ":id") }}'
              permission = permission.replace(':id', btoa(user.id))
            $('.t-content').append('<tr><th scope="col">'+i+'</th><td>'+user.name+'</td><td>'+user.email+'</td><td class="action User_action"><a href="'+permission+'" class="btn btn-primary btn-sm hide-item User_edit m-2">Permissions</a><button class="btn btn-danger m-3 btn-sm hide-item User_delete" onclick="deleteUser('+user.id+')" data-bs-toggle="modal" data-bs-target="#Deleteuser">Delete</button></td></tr>')
            i=i+1
            })
        }
        else{
            $('.t-content').append('<tr><td><td><td class="text-start">No Data Found!</td></td></td></tr>')
        }

        getPermissions()
        })

    })



</script>
@endpush
