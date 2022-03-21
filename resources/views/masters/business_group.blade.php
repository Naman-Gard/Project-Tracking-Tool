@extends('layouts.backend')

@section('content')

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-warning d-flex justify-content-between align-items-center shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">All Business Groups</h6>
                <a class="btn btn-dark mx-5 btn-sm" onclick="open_add_model()">Add</a>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr class="text-center">
                      <th scope="col">SL no.</th>
                      <th scope="col">Name</th>
                      <th scope="col" class="action Business_action">Actions</th>
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

    <div class="modal fade" id="DeleteGroup" >
      <div class="modal-dialog">
          <div class="modal-content">
          
            <div class="modal-body p-0">
                
            
                <div class="card">
                  <div class="card-header">Delete Group
                  <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="card-body">
                  <form action="" id="delete-court-form" method="GET" enctype="multipart/form-data">
                      @csrf
                      <p>Are you sure you want to delete?</p> 
                      <button type="button" class="btn btn-secondary btn-sm Group_delete" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-danger btn-sm Group_delete">Delete</button>
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
        <h5 class="modal-title" id="staticBackdropLabel">Add Project Group</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
      <div class="">
        <div class="card">
          
          <div class="card-body">
             
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Business Group Name</label>
              <input type="text" id="name" name="name" class="form-control border" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('name') }}">
            <span class="text-danger"></span>
            </div>
            <button onclick="Submit()" class="btn btn-primary btn-sm">Submit</button>
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
    }

    function open_edit_model(e){
            $('#staticBackdrop').modal('show');            
    }

    function delete_model(e){
            $('#Deletegroup').modal('show');
            
    }

    function Submit(){

        let data={
            'name': $("#name").val()
        }

        if(data.name == ''){
          $('.text-danger').html('Name field is required.');
        }
        else{
    
        $.ajax({
        type: "POST",
        contentType: "application/json",
        dataType: "json",
        data:JSON.stringify(data),
        url: api_url+'master/business_group',
        }).done((response)=>{
            window.location='{{route("businessGroup")}}'
        })
      }

    }

$(document).ready(()=>{

        var innerHtml = '';
        
        $.ajax({
        type: "GET",
        url: api_url+'master/business_group',
        }).done((response)=>{
        const groups=response.data
        if(groups.business_group.length!=0){
          var i = 1;
          groups.business_group.forEach(element =>{
              innerHtml += `<tr>
                                <td>${i++}</td>
                                <td>${element.name}</td>
                                <td>
                                  <button class="btn btn-info btn-sm" onclick="open_edit_model(${element.id})">Edit</button>
                                  <button class="btn btn-danger btn-sm" onclick="delete_model(${element.id})">Delete</button>                                  
                                </td>
                            </tr>`;
            })
        }
        else{
          innerHtml = `<tr> <td colspan="6">No Record Found</td> </tr>`;
        }

        $('#all_row').html(innerHtml);

    })
  })

</script>
@endpush
