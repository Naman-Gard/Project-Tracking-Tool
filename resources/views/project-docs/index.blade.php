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
            <h6 class="text-white text-capitalize ps-3">All Documents</h6>
            <a class="btn btn-secondary mx-5 float-right btn-sm hide-item Project_add" data-bs-toggle="modal" data-bs-target="#AddDoc">Add</a>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                <tr class="">
                    <th scope="col">SL no.</th>
                    <th scope="col">Title</th>
                    <th scope="col" class="action">Actions</th>
                </tr>
                </thead>
                <tbody class="t-content ">
                
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
    </div>




<div class="modal fade" id="DeleteDoc" >
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


<div class="modal fade" id="AddDoc" >
    <div class="modal-dialog">
        <div class="modal-content">
        
        <div class="modal-body p-0">
            
        
            <div class="card">
                <div class="modal-header">
                    Add Document
                </div>
                <div class="modal-body">
                    <form>

                    <div class="form-group mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input class="form-control" name="title" type="text" placeholder="Document Title" value="{{old('title')}}" autocomplete="off">
                    <span class="text-danger valid_title"></span>
                    </div>

                    <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Choose Doc</label>
                    <input class="form-control" name="file" type="file">
                    <span class="text-danger valid_file"></span>
                    </div>
                    
                    </form> 
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm m-1" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary add-mem-btn btn-sm m-1">Add</button>
                </div>
            </div>


        
        </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>

    let url=window.location.href
    let id=atob(url.split('docs/')[1])
    let p_doc_id

    function deleteDoc(id){
        p_doc_id=id
    }
    $(".delete-mem-btn").click(()=>{
        let data={
            doc_id:p_doc_id
        }

        var route = '{{ route("docs-by-project", ":id") }}'
        route = route.replace(':id', btoa(id))

        $.ajax({
                type: "POST",
                contentType: "application/json",
                dataType: "json",
                data:JSON.stringify(data),
                url: api_url+'master/project/doc/delete',
            }).done((response)=>{
            sessionStorage.setItem("message", "Document Deleted Successfully");
            window.location=route
            })
    })
    
    $(".add-mem-btn").click(()=>{

        let flag=Validation()

        if(flag){
            let data={
                "project_id":id,
                "title":$("input[name=title]").val(),
                "file":$("input[name=file]").val()
            }

            var route = '{{ route("docs-by-project", ":id") }}'
            route = route.replace(':id', btoa(id))

            $.ajax({
                    type: "POST",
                    contentType: "application/json",
                    dataType: "json",
                    data:JSON.stringify(data),
                    url: api_url+'master/project/doc/add',
                }).done((response)=>{
                sessionStorage.setItem("message", "Document Added Successfully");
                window.location=route
                })
            }

        
    })

    function Validation(){

        let flag=[]

        if($("input[name=title]").val()){
            $('.valid_title').html('')
            flag.push(true)
        }else{
            $('.valid_title').html('The title field is required.')
            flag.push(false)
        }

        if($("input[name=file]").val()){
            $('.valid_file').html('')
            flag.push(true)
        }else{
            $('.valid_file').html('The file field is required.')
            flag.push(false)
        }

        if(flag.includes(false)){
            return false
        }
        else{
            return true
        }

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
        url: api_url+'items/project_docs?limit=-1',
        }).done((response)=>{
        const project_docs=response.data
        if(project_docs.length!=0){
            project_docs.forEach((doc)=>{
            var doc_id=doc.id
            $('.t-content').append('<tr><th scope="col">'+i+'</th><td>'+doc.title+'</td><td class="action"><a href="" class="btn btn-primary btn-sm m-1">View</a><button class="btn btn-danger m-1 btn-sm hide-item Project_delete" onclick="deleteDoc('+doc_id+')" data-bs-toggle="modal" data-bs-target="#DeleteDoc">Delete</button></td></tr>')
            i=i+1
            })
        }
        else{
            $('.t-content').append('<tr><td></td><td class="text-center">No Data Found!</td><td></td></tr>')
        }
        $('.table').DataTable()
        $('.table').on('page.dt', function () {
          getPermissions()
        } );
        $('.table').on('length.dt', function () {
          getPermissions()
        } );
        $('.table').on('search.dt', function () {
          getPermissions()
        } );
        getPermissions()
        })
        
        
    })



</script>
@endpush