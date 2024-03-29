@extends('layouts.backend')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Edit Project</h6>
                </div>
                </div>
            <div class="card-body">
                <form>

                    <div class="row">

                    <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Project Name</label>
                    <input class="form-control" name="p_name" type="text" placeholder="Project Name" autocomplete="off">
                    <span class="text-danger valid_p_name"></span>
                    </div>

                    <div class="col-md-6">
                        <label for="exampleInputEmail1" class="form-label">Bussiness Group</label>
                        <select name="b_group" class="form-control" id="business_group">
                            <option value="">Select</option>
                        </select>
                    <span class="text-danger valid_b_group"></span>
                    </div>

                    </div>
                    

                    <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Project Description</label>
                    <!-- <input class="form-control" name="desc" type="text" placeholder="Description" value="{{old('desc')}}" autocomplete="off"> -->
                    <textarea class="form-control" name="desc" placeholder="Project Description"></textarea>
                    <span class="text-danger valid_desc"></span>
                    </div>
                    
                    <div class="row">

                    <div class="col-md-6">
                        <label for="exampleInputEmail1" class="form-label">Client Department</label>
                        <select name="client_dep" class="form-control" id="client_department">
                            <option value="">Select</option>
                        </select>
                        <span class="text-danger valid_client_dep"></span>
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Client Name</label>
                        <select name="client_name" class="form-control" id="client_name">
                            <option value="">Select</option>
                        </select>
                        <span class="text-danger valid_client_name"></span>
                    </div>

                    
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Business Account Manager</label>
                    <input class="form-control" name="b_acc_manager" type="text" placeholder="Business Account Manager"  autocomplete="off">
                    <span class="text-danger valid_b_acc_manager"></span>
                    </div>

                    <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Technical Account Manager</label>
                    <input class="form-control" name="t_acc_manager" type="text" placeholder="Technical Account Manager" autocomplete="off">
                    <span class="text-danger valid_t_acc_manager"></span>
                    </div>
                    </div>

                    <div class="row">
                                      
                    <div class="col-md-6">
                        <label for="exampleInputEmail1" class="form-label">Project Type</label>
                        <select name="p_type" class="form-control" id="project_type">
                            <option value="">Select</option>
                        </select>
                    <span class="text-danger valid_p_type"></span>
                    </div>

                    <div class="col-md-6">
                        <label for="exampleInputEmail1" class="form-label">Project Stage</label>
                        <select name="p_stage" class="form-control" id="project_stage">
                            <option value="">Select</option>
                        </select>
                    <span class="text-danger valid_p_stage"></span>
                    </div>
                    
                    </div>
                    <div class="row">
                    
                    
                    <div class="col-md-6 hide-item" id="bid">
                    <label for="exampleFormControlInput1" class="form-label">Bid Amount</label>
                    <input class="form-control" name="bid_amount" type="text" placeholder="Bid Amount" autocomplete="off">
                    <span class="text-danger valid_bid_amount"></span>
                    </div>
                    </div>

                    <div class="mb-3">
                    <input type="button" onclick="Submit()" class="btn btn-primary btn-sm" value="Update">
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

    let departments=[],clientName=''

    function Submit(){

        const flag=doValidations() 
        
        if(flag){

            let data={
                'project_id':id,
                'project_stage':  $("select[name=p_stage]").val(),
                'business_group':  $("select[name=b_group]").val(),
                'project_name': $("input[name=p_name]").val(),
                'project_description':$("textarea[name=desc]").val(),
                'business_account_manager': $("input[name=b_acc_manager]").val(),
                'technical_account_manager': $("input[name=t_acc_manager]").val(),
                'client_name': $("select[name=client_name]").val(),
                'client_department': $("select[name=client_dep]").val(),
                'project_type':  $("select[name=p_type]").val(),
                'bid_amount': $("input[name=bid_amount]").val(),
            }
            
            $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/update/project',
            }).done((response)=>{
                sessionStorage.setItem("message", "Project Updated Successfully");
                window.location='{{route("projects")}}'
            })
            
        }      

    }

    function doValidations(){

        let flag=[]

        if($("input[name=p_name]").val()){
            $('.valid_p_name').html('')
            flag.push(true)
        }else{
            $('.valid_p_name').html('The project name field is required.')
            flag.push(false)
        }

        if($("select[name=b_group]").val()){
            $('.valid_b_group').html('')
            flag.push(true)
        }else{
            $('.valid_b_group').html('The bussiness group field is required.')
            flag.push(false)
        }

        if($("textarea[name=desc]").val()){
            $('.valid_desc').html('')
            flag.push(true)
        }else{
            $('.valid_desc').html('The project description field is required.')
            flag.push(false)
        }

        if($("select[name=client_name]").val()){
            $('.valid_client_name').html('')
            flag.push(true)
        }else{
            $('.valid_client_name').html('The client name field is required.')
            flag.push(false)
        }

        if($("select[name=client_dep]").val()){
            $('.valid_client_dep').html('')
            flag.push(true)
        }else{
            $('.valid_client_dep').html('The client department field is required.')
            flag.push(false)
        }

        if($("input[name=b_acc_manager]").val()){
            $('.valid_b_acc_manager').html('')
            flag.push(true)
        }else{
            $('.valid_b_acc_manager').html('The bussiness manager field is required.')
            flag.push(false)
        }

        if($("input[name=t_acc_manager]").val()){
            $('.valid_t_acc_manager').html('')
            flag.push(true)
        }else{
            $('.valid_t_acc_manager').html('The technical manager field is required.')
            flag.push(false)
        }

        if($("select[name=p_type]").val()){
            $('.valid_p_type').html('')
            flag.push(true)
        }else{
            $('.valid_p_type').html('The project type field is required.')
            flag.push(false)
        }

        if($("select[name=p_stage]").val()){
            $('.valid_p_stage').html('')
            flag.push(true)
        }else{
            $('.valid_p_stage').html('The project stage field is required.')
            flag.push(false)
        }

        if($('#bid').hasClass('hide-item')){
            $("input[name=bid_amount]").val('')
            flag.push(true)
        }
        else{
            if($("input[name=bid_amount]").val()){
                $('.valid_bid_amount').html('')
                flag.push(true)
            }else{
                $('.valid_bid_amount').html('The bid amount field is required.')
                flag.push(false)
            }
        }

        if(flag.includes(false)){
            return false
        }
        else{
            return true
        }

    }

    $('select[name=p_stage]').change(()=>{
        if($("select[name=p_stage]").val()=='Bid'){
            $('#bid').removeClass('hide-item')
        }
        else{
            $("input[name=bid_amount]").val('')
            $('#bid').addClass('hide-item')
        }
    })

    $('select[name=client_dep]').change((e)=>{
        $('#client_name').empty()
        $('#client_name').append(`<option value="Select">Select</option>`)
        if(e.target.value!==''){
            const spokePersons=JSON.parse(departments.find((department)=> department.name===e.target.value).spoke_persons)
            spokePersons.forEach((person)=>{
                $('#client_name').append(`<option value="${person.name}">${person.name}</option>`)
            })
            if(clientName!==''){
                $('#client_name').val(clientName)
                clientName=''
            }
        }
    })

    let url=window.location.href
    let id=atob(url.split('edit/')[1])
    $('document').ready(()=>{

        const filters={
            "id":{
                '_eq': id
            },
        }

        $.ajax({
        type: "GET",
        url: api_url+'items/projects?filter='+JSON.stringify(filters),
        }).done((response)=>{
            temp_data=response.data.pop()
            $.ajax({
            type: "GET",
            url: api_url+'master/projectdetails',
            }).done((response)=>{
                data=response.data
                $("input[name=p_name]").val(temp_data.project_name)
                $("textarea[name=desc]").val(temp_data.project_description)
                $("input[name=t_acc_manager]").val(temp_data.technical_account_manager)
                // $("select[name=client_name]").val(temp_data.client_name)
                $("input[name=b_acc_manager]").val(temp_data.business_account_manager)

                if(temp_data.bid_amount){
                    $("input[name=bid_amount]").val(temp_data.bid_amount)
                    $('#bid').removeClass('hide-item')
                }


                $.each( data, function( key, value ) {
                    if(key==='client_department'){
                        departments=value
                    }
                    value.forEach((item)=>{
                        if(item.name==temp_data[key]){
                        $('#'+key).append(`<option value="${item.name}" selected>${item.name}</option>`)
                        }else{
                        $('#'+key).append(`<option value="${item.name}">${item.name}</option>`)
                        }
                    })
                });
                clientName=temp_data.client_name
                $("select[name=client_dep]").val(temp_data.client_department).change()
            })
        })
    })

</script>
@endpush