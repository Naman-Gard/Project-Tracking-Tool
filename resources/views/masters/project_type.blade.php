@extends('layouts.backend')

@section('content')

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary d-flex justify-content-between shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">All Project Types</h6>
                <a class="btn btn-danger mx-5 float-right btn-sm Type_add" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add</a>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr class="text-center">
                      <th scope="col">SL no.</th>
                      <th scope="col">Name</th>
                      <th scope="col" class="action Type_action">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="t-content text-center">
                      <tr>
                        <td scope="col">1.</td>
                        <td scope="col">ABC</td>
                        <td scope="col" class="action User_action">
                        <button class="btn btn-primary btn-sm Type_edit" data-delete-link="#" data-bs-toggle="modal" data-bs-target="#Edittype">Edit</button>
                        <button class="btn btn-danger btn-sm delete-mem-btn Type_delete" data-delete-link="#" data-bs-toggle="modal" data-bs-target="#Deletetype">Delete</button>
                        </td>
                      </tr>
                    
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
                  <form action="" id="delete-court-form" method="GET" enctype="multipart/form-data">
                      @csrf
                      <p>Are you sure you want to delete?</p> 
                      <button type="button" class="btn btn-secondary btn-sm Type_delete" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-danger btn-sm Type_delete">Delete</button>
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
      <div class="modal-body p-0">
      <div class="">
        <div class="card">
          <div class="card-header">Add Project Type
          <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="card-body">
          <form>
              @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Name</label>
              <input type="text" id="name" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('name') }}">
              @error('name')
            <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
            
            <button type="submit" onclick="Submit()" class="btn btn-primary btn-sm">Submit</button>
          </form>
          </div>
        </div>
    </div>

      </div>
      
    </div>
  </div>
</div>


@endsection
@push('scripts')
<script>

    function Submit(){

        let data={
            'name': $("#name").val()
        }
    
        $.ajax({
        type: "POST",
        contentType: "application/json",
        dataType: "json",
        data:JSON.stringify(data),
        url: api_url+'master/project-Types',
        }).done((response)=>{
            window.location='{{route("projectTypes")}}'
        })

    }

</script>
@endpush
