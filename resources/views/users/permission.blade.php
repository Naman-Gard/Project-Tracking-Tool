@extends('layouts.backend')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Give Permissions</h6>
                </div>
                </div>
                <div class="card-body  px-0 pb-2">
                
                        <div class="row text-center permission_module">
                            <div class="col-3 p-0">
                            <strong>Module</strong>
                            </div>
                            <div class="col-2 p-0">
                            <strong>View</strong>
                            </div>
                            <div class="col-2 p-0">
                            <strong>Add</strong>
                            </div>
                            <div class="col-2 p-0">
                            <strong>Edit</strong>
                            </div>
                            <div class="col-2 p-0">
                            <strong>Delete</strong>
                            </div>
                        </div>
                        <hr>
                        
                        <form>

                        <?php $modules=['Master','Project','Instrument','Invoice','Work','User','Team'];?>
                        @foreach($modules as $module)
                        <div class="row text-center permission_module">
                    
                        <div class="col-3 p-0">
                        <strong>{{$module}}</strong>
                        </div>
                    
                        <div class="col-2 p-0">
                        <input class="form-group" name="{{$module}}_view" type="checkbox" value='1'>
                        </div>


                        
                        <div class="col-2 p-0">
                        <input class="form-group" name="{{$module}}_add" type="checkbox" value='1'>
                        </div>

                        
                        <div class="col-2 p-0">
                        <input class="form-group" name="{{$module}}_edit" type="checkbox" value='1'>
                        </div>

                        
                        <div class="col-2 p-0">
                        <input class="form-group" name="{{$module}}_delete" type="checkbox" value='1'>
                        </div>

                        </div>
                        <hr>
                        @endforeach

                        

                        <div class="m-3">
                        <input type="button" onclick="Permit()" class="btn btn-primary btn-sm float-right User_edit" value="Permit">
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

    let url=window.location.href
    let id=atob(url.split('permission/')[1])
    let permit_view=[]
    let permit_add=[]
    let permit_edit=[]
    let permit_delet=[]
    let data
    $(document).ready(()=>{

        const filters={
            "user_id":{
                '_eq': id
            },
        }
        $.ajax({
            type: "GET",
            url: api_url + 'items/permissions?limit=-1&&filter='+JSON.stringify(filters),
            }).done((response)=>{
                data=response.data
                permit_view=JSON.parse(data[0].view)
                permit_add=JSON.parse(data[0].add)
                permit_edit=JSON.parse(data[0].edit)
                permit_delet=JSON.parse(data[0].delete)
                
                permit_view.forEach((item)=>{
                    $("input[name="+item+"_view]").prop('checked',true)
                })
                permit_add.forEach((item)=>{
                    $("input[name="+item+"_add]").prop('checked',true)
                })
                permit_edit.forEach((item)=>{
                    $("input[name="+item+"_edit]").prop('checked',true)
                })
                permit_delet.forEach((item)=>{
                    $("input[name="+item+"_delete]").prop('checked',true)
                })
            })
    })

    function Permit(){
        
        modules=['User','Project','Instrument','Master','Invoice','Work','Team']
        modules.forEach((item)=>{
            if($("input[name="+item+"_view]:checked").val()==1){
                if(!permit_view.includes(item)){
                    permit_view.push(item)
                }
            }
            else{
                if(permit_view.includes(item)){
                    permit_view=permit_view.filter((value)=>{
                        return value!=item
                    })
                }
            }
            if($("input[name="+item+"_add]:checked").val()==1){
                if(!permit_add.includes(item)){
                   permit_add.push(item)
                }
            }
            else{
                if(permit_add.includes(item)){
                    permit_add=permit_add.filter((value)=>{
                        return value!=item
                    })
                }
            }
            if($("input[name="+item+"_edit]:checked").val()==1){
                if(!permit_edit.includes(item)){
                   permit_edit.push(item)
                }
            }
            else{
                if(permit_edit.includes(item)){
                    permit_edit=permit_edit.filter((value)=>{
                        return value!=item
                    })
                }
            }
            if($("input[name="+item+"_delete]:checked").val()==1){
                if(!permit_delet.includes(item)){
                   permit_delet.push(item)
                }
            }
            else{
                if(permit_delet.includes(item)){
                    permit_delet=permit_delet.filter((value)=>{
                        return value!=item
                    })
                }
            }
        })
        
        mydata={
            id:data[0].id,
            view:JSON.stringify(permit_view),
            add:JSON.stringify(permit_add),
            edit:JSON.stringify(permit_edit),
            delet:JSON.stringify(permit_delet)
        }

        $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(mydata),
            url: api_url+'master/permit',
        }).done((response)=>{
            sessionStorage.setItem("message", "Permissions Permited Successfully");
            window.location='{{route("users")}}'
        })
    }

</script>
@endpush