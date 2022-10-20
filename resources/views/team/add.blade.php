@extends('layouts.backend')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary d-flex justify-content-between shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Manage Team Members</h6>
                    <button class="btn btn-secondary mx-5 float-right btn-sm hide-item Team_add" data-bs-toggle="modal" data-bs-target="#AddEmployee">Add More Members</a>
                </div>
                </div>
            <div class="card-body">
                <form class="form1">

                    <div class="row">

                    <div class="col-md-6">
                        <label for="exampleInputEmail1" class="form-label">Project</label>
                        <select name="project" class="form-control" id="project_name" disabled>
                            <option value="">Select</option>
                        </select>
                    <span class="text-danger valid_project"></span>
                    </div>

                    </div>

                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                        <thead>
                            <tr class="">
                            <!-- <th scope="col">SL no.</th> -->
                            <th scope="col">Name</th>
                            <th scope="col">Role</th>
                            <!-- <th scope="col">Mobile No.</th> -->
                            <th scope="col" class="action hide-item Team_action">Action</th>
                            </tr>
                        </thead>
                        <tbody class="t-content">
                            
                        </tbody>
                        </table>
                    </div>


                    <div class="mb-3">
                    <input type="button" id="Update_Team" onclick="Submit()" class="btn btn-primary btn-sm hide-item Team_edit" value="Update">
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
                    <p id="removed_warning">Are you sure you want to remove?</p> 
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger delete-mem-btn btn-sm" data-bs-dismiss="modal">Remove</button>
                </div>
            </div>


        
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="AddEmployee" >
    <div class="modal-dialog">
        <div class="modal-content">
        
        <div class="modal-body p-0">
            
        
            <div class="card">
                <!-- <div class="card-header">Delete user
                <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                <div class="card-body">
                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label">Employees</label>
                        <select name="employee[]" class="form-control select" id="employee_name" multiple>
                        </select>
                    <span class="text-danger valid_employee"></span>
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary add-mem-btn btn-sm">Add</button>
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
    let id=url.split('manage/')[1]
    let team_data={}
    let temp_removedIDs=''
    let removedIDs=[]
    let employees=[]
    let innerHtml=''

    function makeTeamRows(){
        $.each(team_data,(key,value)=>{
                innerHtml += `<tr id="${key}_row">
                            <td>
                                <span name="emp_name" id="emp_${key}">${value.name}</span>
                            </td>

                            <td>
                                <select name="role" class="form-control select" id="emp_${key}_role">
                                    <option value="">Select</option>
                                </select>
                            <span class="text-danger valid_emp_${key}_role"></span>
                            </td>
                            
                            <td class="teamRemove hide-item Team_action">
                                <input type="button" onclick="removeEmployee('${key}')" class="btn btn-danger m-3 btn-sm hide-item Team_delete"  data-bs-toggle="modal" data-bs-target="#RemoveEmployeee" value="Remove">
                            </td>
                            </tr>`;
            })
    }

    function makeEmpRows(){
        employees.forEach((item)=>{
                emp_data.filter((emp)=>{
                    if(emp.employee_id==item){
                        name= emp.name;
                    }
                })
                innerHtml += `<tr id="${item}_row">
                            <td>
                                <span name="emp_name" id="emp_${item}">${name!==''?name:'N/A'}</span>
                            </td>

                            <td>
                                <select name="role" class="form-control select" id="emp_${item}_role">
                                    <option value="">Select</option>
                                </select>
                            <span class="text-danger valid_emp_${item}_role"></span>
                            </td>
                            
                            <td class="teamRemove hide-item Team_action">
                                <input type="button" onclick="removeEmployee('${item}')" class="btn btn-danger m-3 btn-sm hide-item Team_delete"  data-bs-toggle="modal" data-bs-target="#RemoveEmployeee" value="Remove">
                            </td>
                            </tr>`;
            })
    }

    function makeTableRows(){ 
        var name='';
        

        if(Object.keys(team_data).length!=0 || employees.length!=0){
            innerHtml=''
            makeTeamRows()
            makeEmpRows()
            $('#Update_Team').prop('disabled',false)

        }
        else{
            innerHtml=''
            innerHtml +=`<tr>
            <td colspan=3 class="text-center">No Team Added Yet!</td>
            </tr>`
            $('#Update_Team').prop('disabled',true)
        }
        
        

        $('.t-content').html(innerHtml);
        getPermissions()
        getRoles();
           
    }
    
    function removeEmployee(id){
        temp_removedIDs=id
        if((employees.length+Object.keys(team_data).length)>1){
            $('#removed_warning').html('Are you sure you want to remove?')
        }else{
            $('#removed_warning').html('Are you sure you want to remove last member?')
        }
    }

    $(".delete-mem-btn").click(()=>{
        removedIDs.push(temp_removedIDs)
        Object.keys(team_data)
            .filter(key => removedIDs.includes(key))
            .forEach(key => delete team_data[key]);
        employees=employees.filter((emp)=>{
            return emp!=temp_removedIDs
        })
        $('#'+temp_removedIDs+'_row').remove()
        $('input[value='+temp_removedIDs+']').prop('checked',false)
        $('input[value='+temp_removedIDs+']').parent().parent().removeClass('hide-item')
        if((employees.length+Object.keys(team_data).length)==0){
            innerHtml =`<tr>
            <td colspan=3 class="text-center">All members are removed!</td>
            </tr>`
            $('.t-content').html(innerHtml);
            removedIDs=[]
        }       
    })

    $(".add-mem-btn").click(()=>{
        let flag=Validations()
        if(flag){
            employees=$('#employee_name').val()
            makeTableRows()
            $('.selected').addClass('hide-item')
            $('.selected').removeClass('selected')
            $('.ms-options-wrap button').html('Select')
            $('#employee_name').val('')
            $('#AddEmployee').modal('hide')
        }        
    })

    function Submit(){
        const flag=EmpValidations()
        // console.log(removedIDs)
        if(flag){
            let emp_list={}

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

            $.each(team_data,(key,value)=>{
                team_data[key].role=$("#emp_"+key+"_role").val()
            })
            if(Object.keys(team_data).length!=0){
                $.extend(emp_list, team_data);
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
            url: api_url+'master/manage/project/team',
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
        url: api_url+'items/role_type?limit=-1',
        }).done((response)=>{
            roles=response.data
            roles.forEach((item)=>{
                $('select[name=role]').append(`<option value="${item.name}">${item.name}</option>`)
            })

            $.each(team_data,(key,value)=>{
                $('#emp_'+key+'_role').val(value.role)
            })
        })
    }

    function Validations(){

        let flag2=false
        
        // if($("select[name=project]").val()){
        //     $('.valid_project').html('')
        //     flag1=true
        // }else{
        //     $('.valid_project').html('The project field is required.')
        //     flag1=false
        // }

        if($('#employee_name').val()){
            $('.valid_employee').html('')
            flag2=true
        }else{
            $('.valid_employee').html('The employees field is required.')
            flag2=false
        }
        

        return flag2

        
    }

    $('document').ready(()=>{
       
        $.ajax({
        type: "GET",
        url: api_url+'master/employeeDetails',
        }).done((response)=>{
            employee_data=response.data
            emp_data=employee_data.employee_name
            getTeams(employee_data)
           
        })
    })


    function getTeams(employee_data){

        const filters={
            "project_id":{
                '_eq': atob(id)
            },
        }

        $.ajax({
        type: "GET",
        url: api_url+'items/teams?filter='+JSON.stringify(filters),
        }).done((response)=>{
            team_data=response.data
            if(team_data.length!=0){
                team_data=JSON.parse(team_data[0].employees)
            }
            else{
                team_data={}
            }
            if(Object.keys(team_data).length!=0){
                team_ids=Object.keys(team_data)
                $.each(team_data,(key,value)=>{
                $('#team_members').append(value.name + "<br>")
            })
            }else{
                team_ids=[]
                // $('#team_list').addClass('hide-item')
                $('#team_members').html("Team Not Assinged Yet!")
            }
            
            $('#employee_name').append(`<option value="N/A">N/A</option>`)
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
            })

            makeTableRows()

        })
    }

</script>
@endpush