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
                
                        <div class="row text-center">
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

                        <?php $modules=['User'];?>
                        @foreach($modules as $module)
                        <div class="row text-center">
                    
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
    let view=[]
    let add=[]
    let edit=[]
    let delet=[]
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
                view=JSON.parse(data[0].view)
                add=JSON.parse(data[0].add)
                edit=JSON.parse(data[0].edit)
                delet=JSON.parse(data[0].delete)
                
                view.forEach((item)=>{
                    $("input[name="+item+"_view]").prop('checked',true)
                })
                add.forEach((item)=>{
                    $("input[name="+item+"_add]").prop('checked',true)
                })
                edit.forEach((item)=>{
                    $("input[name="+item+"_edit]").prop('checked',true)
                })
                delet.forEach((item)=>{
                    $("input[name="+item+"_delete]").prop('checked',true)
                })
            })
    })

    function Permit(){
        
        modules=['User']
        modules.forEach((item)=>{
            if($("input[name="+item+"_view]:checked").val()==1){
                if(!view.includes(item)){
                    view.push(item)
                }
            }
            else{
                if(view.includes(item)){
                    view=view.filter((value)=>{
                        return value!=item
                    })
                }
            }
            if($("input[name="+item+"_add]:checked").val()==1){
                if(!add.includes(item)){
                   add.push(item)
                }
            }
            else{
                if(add.includes(item)){
                    add=add.filter((value)=>{
                        return value!=item
                    })
                }
            }
            if($("input[name="+item+"_edit]:checked").val()==1){
                if(!edit.includes(item)){
                   edit.push(item)
                }
            }
            else{
                if(edit.includes(item)){
                    edit=edit.filter((value)=>{
                        return value!=item
                    })
                }
            }
            if($("input[name="+item+"_delete]:checked").val()==1){
                if(!delet.includes(item)){
                   delet.push(item)
                }
            }
            else{
                if(delet.includes(item)){
                    delet=delet.filter((value)=>{
                        return value!=item
                    })
                }
            }
        })
        
        mydata={
            id:data[0].id,
            view:JSON.stringify(view),
            add:JSON.stringify(add),
            edit:JSON.stringify(edit),
            delet:JSON.stringify(delet)
        }

        $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(mydata),
            url: api_url+'master/permit',
        }).done((response)=>{
                window.location='{{route("users")}}'
        })
    }

</script>
@endpush