@extends('layouts.backend')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Add Team Members</h6>
                </div>
                </div>
            <div class="card-body">
                <form class="form1">

                    <div class="row">

                    <div class="col-md-6">
                        <label for="exampleInputEmail1" class="form-label">Project</label>
                        <select name="project" class="form-control" id="project_name">
                            <option value="">Select</option>
                        </select>
                    <span class="text-danger valid_project"></span>
                    </div>

                    <div class="col-md-6">
                        <label for="exampleInputEmail1" class="form-label">Employees</label>
                        <select name="employee[]" class="form-control select" id="employee_name" multiple>
                            <!-- <option value="">Select</option> -->
                        </select>
                    <span class="text-danger valid_employee"></span>
                    </div>

                    </div>
 
                    <div class="mb-3">
                    <input type="button" onclick="Select()" class="btn btn-primary btn-sm" value="Select">
                    </div>

                    <div class="mb-3" id="team_list">
                    <label for="exampleInputEmail1" class="form-label">Existing Team Members</label>
                    <p id="team_members"></p>
                    </div>


                </form>


                <form class="hide-item form2">
                    <div id="all_row">
            
                    </div>
                    
                    <div class="mb-3">
                    <input type="button" onclick="Submit()" class="btn btn-primary btn-sm" value="Add">
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="RemoveEmployeee" >
    <div class="modal-dialog">
        <div class="modal-content">
        
        <div class="modal-body p-0">
            
        
            <div class="card">
                <!-- <div class="card-header">Delete user
                <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                <div class="card-body">
                    <p>Are you sure you want to remove?</p> 
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger delete-mem-btn btn-sm" data-bs-dismiss="modal">Remove</button>
                </div>
            </div>


        
        </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    let emp_data
    let url=window.location.href
    let id=url.split('add/')[1]
    let team_data={}

    function Select(){

        const flag=Validations() 
        var innerHtml = '';
        var name='';
        if(flag){
            $('.form1').addClass('hide-item')
            $('.form2').removeClass('hide-item')
            employees=$('#employee_name').val()
            let innerHtml=''
            employees.forEach((item)=>{
                emp_data.filter((emp)=>{
                    if(emp.employee_id==item){
                        name= emp.name;
                    }
                })
                innerHtml += `<div class="row" id="${item}_row">
                            <div class="col-md-5">
                                <label for="exampleFormControlInput1" class="form-label">Employee Name</label>
                                <input class="form-control" name="emp_name" id="emp_${item}" type="text" placeholder="Employee Name" value="${name}" readonly>
                            </div>

                            <div class="col-md-5">
                                <label for="exampleInputEmail1" class="form-label">Role</label>
                                <select name="role" class="form-control select" id="emp_${item}_role">
                                    <option value="">Select</option>
                                    <option value="lead">Lead</option>
                                </select>
                            <span class="text-danger valid_emp_${item}_role"></span>
                            </div>
                            
                            <div class="col-md-2">
                                <input type="button" onclick="removeEmployee('${item}')" class="btn btn-danger m-3 btn-sm"  data-bs-toggle="modal" data-bs-target="#RemoveEmployeee" value="Remove">
                            </div>
                            </div>`;
            })

            $.each(team_data,(key,value)=>{
                innerHtml += `<div class="row" id="${key}_row">
                            <div class="col-md-5">
                                <label for="exampleFormControlInput1" class="form-label">Employee Name</label>
                                <input class="form-control" name="emp_name" id="emp_${key}" type="text" placeholder="Employee Name" value="${value.name}" readonly>
                            </div>

                            <div class="col-md-5">
                                <label for="exampleInputEmail1" class="form-label">Role</label>
                                <select name="role" class="form-control select" id="emp_${key}_role">
                                    <option value="">Select</option>
                                    <option value="lead">Lead</option>
                                </select>
                            <span class="text-danger valid_emp_${key}_role"></span>
                            </div>

                            <div class="col-md-2">
                                <input type="button" onclick="removeEmployee('${key}')" class="btn btn-danger m-3 btn-sm"  data-bs-toggle="modal" data-bs-target="#RemoveEmployeee" value="Remove">
                            </div>
                            </div>`;
            })

            $('#all_row').html(innerHtml);
            getRoles();
           
        }      

    }
    let temp_removedIDs=''
    let removedIDs=[]
    function removeEmployee(id){
      temp_removedIDs=id
    }

    $(".delete-mem-btn").click(()=>{
        removedIDs.push(temp_removedIDs)
        $('#'+temp_removedIDs+'_row').remove()
    })

    function Submit(){
        const flag=EmpValidations()
        // console.log(removedIDs)
        if(flag){
            let emp_list={}
            
            employees=$('#employee_name').val()
            employees.forEach((item)=>{
                if(!removedIDs.includes(item)){
                    emp_data.filter((emp)=>{
                        if(emp.employee_id==item){
                            emp_list[item]={
                                "id":item,
                                "name":emp.name,
                                "role":$("#emp_"+item+"_role").val()
                            }
                        }
                    })
                }
                
            })

            temp_team_data=team_data;
            Object.keys(temp_team_data)
                .filter(key => removedIDs.includes(key))
                .forEach(key => delete temp_team_data[key]);

            if(Object.keys(temp_team_data).length!=0){
                $.extend(emp_list, temp_team_data);
            }
            // console.log(emp_list)
            data={
                "project_id":atob(id),
                "employee_list":emp_list
            }
            // console.log(data)

            $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/add/project/team',
            }).done((response)=>{
                message=response.data
                if(message.message=="ADD"){
                    sessionStorage.setItem("message", "Team Added Successfully");
                    window.location='{{route("projects")}}'
                }
                else{
                    sessionStorage.setItem("message", "Team Updated Successfully");
                    window.location='{{route("projects")}}'
                }
                
            })
        }
    }

    function EmpValidations(){
        let flag=[]
        employees=$('#employee_name').val()
        employees.forEach((id)=>{
            if(!removedIDs.includes(id)){
                if($("#emp_"+id+"_role").val()){
                    $(".valid_emp_"+id+"_role").html('')
                    flag.push(true)
                }else{
                    $(".valid_emp_"+id+"_role").html('The Role field is required.')
                    flag.push(false)
                }
            }
        })

        $.each(team_data,(key,value)=>{
            if(!removedIDs.includes(key)){
                if($("#emp_"+key+"_role").val()){
                    $(".valid_emp_"+key+"_role").html('')
                    flag.push(true)
                }else{
                    $(".valid_emp_"+key+"_role").html('The Role field is required.')
                    flag.push(false)
                }
            }
        })

        if(flag.includes(false)){
            return false
        }
        else{
            return true
        }
        
    }

    function getRoles(){
        $.ajax({
        type: "GET",
        url: api_url+'items/roles?limit=-1',
        }).done((response)=>{
            roles=response.data
            roles.forEach((item)=>{
                $('select[name=role]').append(`<option value="${item.role}">${item.role}</option>`)
            })

            $.each(team_data,(key,value)=>{
                $('#emp_'+key+'_role').val(value.role)
            })
        })
    }

    function Validations(){

        let flag1=false
        let flag2=false
        
        if($("select[name=project]").val()){
            $('.valid_project').html('')
            flag1=true
        }else{
            $('.valid_project').html('The project field is required.')
            flag1=false
        }

        if($('#employee_name').val()){
            $('.valid_employee').html('')
            flag2=true
        }else{
            $('.valid_employee').html('The employees field is required.')
            flag2=false
        }

        return flag1 && flag2

        
    }

    $('document').ready(()=>{
        
        const filters={
            "project_id":{
                '_eq': atob(id)
            },
        }
        
        $.ajax({
        type: "GET",
        url: api_url+'master/employeeDetails',
        }).done((response)=>{
            employee_data=response.data
            emp_data=employee_data.employee_name

            $.ajax({
            type: "GET",
            url: api_url+'items/teams?filter='+JSON.stringify(filters),
            }).done((response)=>{
                team_data=response.data
                if(team_data.length!=0){
                    team_data=JSON.parse(team_data[0].employees)
                    team_ids=Object.keys(team_data)
                    $.each(team_data,(key,value)=>{
                    $('#team_members').append(value.name + "<br>")
                })
                }else{
                    team_ids=[]
                    // $('#team_list').addClass('hide-item')
                    $('#team_members').html("Team Not Assinged Yet!")
                }
                
                
                $.each( employee_data, function( key, value ) {
                    value.forEach((item)=>{
                        if(key=='project_name'){
                            if(id!=undefined && item.id==atob(id)){
                                $('#'+key).append(`<option value="${item.id}" selected>${item.project_name}</option>`)
                            }
                            else{
                                $('#'+key).append(`<option value="${item.id}">${item.project_name}</option>`)
                            }
                        }
                        if(key=='employee_name'){
                            if(!team_ids.includes(item.employee_id) || team_ids.length==0){
                                $('#'+key).append(`<option value="${item.employee_id}">${item.name}</option>`)
                            }
                        }
                    })
                });

                $('#employee_name').multiselect({
                    columns: 1,
                    placeholder: 'Select',
                    search: true,
                    showCheckbox:false,
                })

            })

            
        })
    })

</script>
@endpush