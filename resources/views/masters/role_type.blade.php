@extends('layouts.backend')

@section('content')

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="alert alert-success alert-dismissible text-white hide-item" role="alert">
                  <span class="text-sm success-message"></span>
                  <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="bg-gradient-warning d-flex justify-content-between align-items-center shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">All Role Types</h6>
                <a class="btn btn-dark mx-5 btn-sm hide-item Master_add" onclick="open_add_model()">Add</a>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
              <table id="example" class="table align-items-center mb-0 mdl-data-table">
                  <thead>
                    <tr class="">
                      <th scope="col">SL no.</th>
                      <th scope="col">Name</th>
                      <th scope="col" class="action hide-item Master_action">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="t-content " id="all_row">
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="modal fade" id="Deletetype" >
      <div class="modal-dialog">
          <div class="modal-content">
          
            <div class="modal-body p-0">
                
            
                <div class="card">
                  <!-- <div class="card-header">Delete Role Type
                  <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                  <div class="card-body">
                  <form>
                      <p>Are you sure you want to delete?</p> 
                      <input type="hidden" id="delete_type_id">
                      <button type="button" class="btn btn-secondary btn-sm Type_delete" data-bs-dismiss="modal">Close</button>
                      <button onclick="type_delete()" class="btn btn-danger btn-sm">Delete</button>
                  </form>
                  </div>
                </div>
            
            </div>
          </div>
      </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Role Type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
      <div class="">
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <label for="name" class="form-label">Role Type Name</label>
              <input type="hidden" id="role_type_id">
              <input type="text" id="name" name="name" class="form-control border" autocomplete="off" aria-describedby="nameHelp" value="{{ old('name') }}">
            <span class="text-danger"></span>
            </div>
            
            <button onclick="Submit()" class="btn btn-success btn-sm">Submit</button>
          </div>
        </div>
    </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      
    </div>
  </div>
</div>


@endsection
@push('scripts')
<script>

    function open_add_model(){
            $('#staticBackdrop').modal('show');
            $(':input').val('');
    }

    function open_edit_model(e){
            
            $('#staticBackdrop').modal('show');
            $.ajax({
            type: "GET",
            url: api_url+'master/role_type',
            }).done((response)=>{
              const types=response.data
              const type_data = types.role_type

              const type_data_by_id = type_data.filter((item) => {
                return item.id == e;
                });
              
              const role_type = type_data_by_id[0]
              $('#role_type_id').val(btoa(role_type.id));
              $('#name').val(role_type.name);
                
            })          
    }

    function delete_model(e){
            $('#Deletetype').modal('show');
            $('#delete_type_id').val(btoa(e));     
    }

    function type_delete(){

      let data={
            'role_type_id': atob($('#delete_type_id').val()) }

      $.ajax({
      type: "DELETE",
      contentType: "application/json",
      dataType: "json",
      data:JSON.stringify(data),
      url: api_url+'master/role_type',
      }).done((response)=>{
          sessionStorage.setItem("message", "Role Type Deleted Successfully");
          window.location='{{route("roleType")}}'
      })
    }

    function Submit(){

      let data={
            'name': $("#name").val() }

        if(data.name == ''){
          $('.text-danger').html('Name field is required.');
        }

        else{

          if($("#role_type_id").val() == ''){
            $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/role_type',
            }).done((response)=>{
                sessionStorage.setItem("message", "Role Type Added Successfully");
                window.location='{{route("roleType")}}'
            })
          }

          else{
            let data={
            'role_type_id': atob($("#role_type_id").val()),
            'name': $("#name").val() }

            $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/role_type_update',
            }).done((response)=>{
                sessionStorage.setItem("message", "Role Type Edited Successfully");
                window.location='{{route("roleType")}}'
            })
          }
          
          
        }

    }

  $(document).ready(()=>{
    if(sessionStorage.getItem("message")){
            $('.success-message').html(sessionStorage.getItem("message"))
            $('.alert-success').removeClass('hide-item')
            setTimeout(()=>{removeMessage("message")},2000)
        }
        var innerHtml = '';
        $.ajax({
        type: "GET",
        url: api_url+'master/role_type',
        }).done((response)=>{
        const types=response.data
        if(types.role_type.length!=0){
          var i = 1;
          types.role_type.forEach(element =>{
              innerHtml += `<tr>
                                <td>${i++}</td>
                                <td>${element.name}</td>
                                <td class="Master_action hide-item">
                                  <button class="btn m-1 btn-info btn-sm hide-item Master_edit" onclick="open_edit_model(${element.id})">Edit</button>
                                  <button class="btn m-1 btn-danger btn-sm hide-item Master_delete" onclick="delete_model(${element.id})">Delete</button>                                  
                                </td>
                            </tr>`;
            })
        }
        else{
          innerHtml = `<tr> <td colspan="6">No Record Found</td> </tr>`;
        }

        $('#example').DataTable($('#all_row').html(innerHtml));
        $('#example').on('page.dt', function () {
          getPermissions()
        } );
        $('#example').on('length.dt', function () {
          getPermissions()
        } );
        $('#example').on('search.dt', function () {
          getPermissions()
        } );
        getPermissions()
      })
    })

</script>
@endpush
