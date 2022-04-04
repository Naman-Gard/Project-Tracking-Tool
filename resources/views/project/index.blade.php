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
            <div class="bg-gradient-primary d-flex justify-content-between shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">All Projects</h6>
            <a class="btn btn-secondary mx-5 float-right btn-sm hide-item Project_add" href="{{route('add-project')}}">Add</a>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                <tr class="text-center">
                    <th scope="col">SL no.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <!-- <th scope="col">Mobile No.</th> -->
                    <th scope="col" class="action hide-item Project_action">Actions</th>
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




<div class="modal fade" id="DeleteProject" >
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
  let project_id
    function deleteProject(id){
      project_id=id
    }

    $(".delete-mem-btn").click(()=>{
      let data={
        project_id:project_id
      }

      $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/project/delete',
        }).done((response)=>{
          sessionStorage.setItem("message", "Project Deleted Successfully");
          window.location='{{route("projects")}}'
        })
    })

    function addInstrument(id){
        var route = '{{ route("add-ins-by-project", ":id") }}'
        route = route.replace(':id', btoa(id))
        window.location=route
    }

    function addWork(id){
        var route = '{{ route("add-work-by-project", ":id") }}'
        route = route.replace(':id', btoa(id))
        window.location=route
    }

    function addTeam(id){
        var route = '{{ route("add-team-by-project", ":id") }}'
        route = route.replace(':id', btoa(id))
        window.location=route
    }
    

    $(document).ready(()=>{
        if(sessionStorage.getItem("message")){
            $('.success-message').html(sessionStorage.getItem("message"))
            $('.alert-success').removeClass('hide-item')
            setTimeout(()=>{removeMessage("message")},2000)
        }
        var i=1
        $.ajax({
        type: "GET",
        url: api_url+'items/projects?limit=-1',
        }).done((response)=>{
        const projects=response.data
        if(projects.length!=0){
            projects.forEach((project)=>{
              var edit = '{{ route("edit-project", ":id") }}'
              edit = edit.replace(':id', btoa(project.id))
            $('.t-content').append('<tr><th scope="col">'+i+'</th><td>'+project.project_name+'</td><td>'+project.project_stage+'</td><td class="action hide-item Project_action"><a href="'+edit+'" class="btn btn-primary btn-sm hide-item Project_edit m-1">Edit</a><button class="btn btn-danger m-1 btn-sm hide-item Project_delete" onclick="deleteProject('+project.id+')" data-bs-toggle="modal" data-bs-target="#DeleteProject">Delete</button><button class="btn btn-info btn-sm m-1 hide-item Instrument_add" onclick="addInstrument('+project.id+')">Add Instrument</button><button class="btn btn-info m-1 hide-item btn-sm Work_add" onclick="addWork('+project.id+')">Add Work Order</button><button class="btn btn-info m-1 btn-sm hide-item Team_add" onclick="addTeam('+project.id+')">Manage Team</button></td></tr>')
            i=i+1
            })
        }
        else{
            $('.t-content').append('<tr><td><td><td class="text-start">No Data Found!</td></td></td></tr>')
        }
        $('.table').DataTable()
        getPermissions()
        })
        
        
    })



</script>
@endpush