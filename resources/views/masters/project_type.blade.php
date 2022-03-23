@extends('layouts.backend')

@section('content')

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-warning d-flex justify-content-between align-items-center shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">All Project Types</h6>
                <a class="btn btn-dark mx-5 btn-sm hide-item Master_add" onclick="open_add_model()">Add</a>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr class="text-center">
                      <th scope="col">SL no.</th>
                      <th scope="col">Name</th>
                      <th scope="col" class="action Master_action">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="t-content text-center" id="all_row">
                    
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
                  <div class="card-header">Delete Project Type
                  <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
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
        <h5 class="modal-title" id="staticBackdropLabel">Add Project Type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
      <div class="">
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Project Type Name</label>
              <input type="hidden" id="project_type_id">
              <input type="text" id="name" name="name" class="form-control border" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('name') }}">
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
            $('#project_type_id').val('');
            $('#delete_type_id').val('');
    }

    function open_edit_model(e){
            
            $('#staticBackdrop').modal('show');
            $.ajax({
            type: "GET",
            url: api_url+'master/project_type',
            }).done((response)=>{
              const types=response.data
              const type_data = types.project_type

              const type_data_by_id = type_data.filter((item) => {
                return item.id == e;
                });
              
              const project_type = type_data_by_id[0]
              $('#project_type_id').val(project_type.id);
              $('#name').val(project_type.name);
                
            })          
    }

    function delete_model(e){
            $('#Deletetype').modal('show');
            $('#delete_type_id').val(e);     
    }

    function type_delete(){

      let data={
            'project_type_id': $('#delete_type_id').val() }

      $.ajax({
      type: "DELETE",
      contentType: "application/json",
      dataType: "json",
      data:JSON.stringify(data),
      url: api_url+'master/project_type',
      }).done((response)=>{
          window.location='{{route("projectType")}}'
      })
    }

    function Submit(){

      let data={
            'name': $("#name").val() }

        if(data.name == ''){
          $('.text-danger').html('Name field is required.');
        }

        else{

          if($("#project_type_id").val() == ''){
            $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/project_type',
            }).done((response)=>{
                window.location='{{route("projectType")}}'
            })
          }

          else{
            let data={
            'project_type_id': $("#project_type_id").val(),
            'name': $("#name").val() }

            $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/project_type_update',
            }).done((response)=>{
                window.location='{{route("projectType")}}'
            })
          }
          
          
        }

    }

  $(document).ready(()=>{
        var innerHtml = '';
        $.ajax({
        type: "GET",
        url: api_url+'master/project_type',
        }).done((response)=>{
        const types=response.data
        if(types.project_type.length!=0){
          var i = 1;
          types.project_type.forEach(element =>{
              innerHtml += `<tr>
                                <td>${i++}</td>
                                <td>${element.name}</td>
                                <td class="Master_action">
                                  <button class="btn btn-info btn-sm hide-item Master_edit" onclick="open_edit_model(${element.id})">Edit</button>
                                  <button class="btn btn-danger btn-sm hide-item Master_delete" onclick="delete_model(${element.id})">Delete</button>                                  
                                </td>
                            </tr>`;
            })
        }
        else{
          innerHtml = `<tr> <td colspan="6">No Record Found</td> </tr>`;
        }

        $('#all_row').html(innerHtml);
        getPermissions()
      })
    })

</script>
@endpush
