@extends('layouts.backend')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Add Team</h6>
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
                </form>


                <form class="hide-item form2">
                    <div class="row" id="all_row">
            
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

@endsection
@push('scripts')
<script>
    let emp_data
    let url=window.location.href
    let id=url.split('add/')[1]
 
    function Select(){

        const flag=Validations() 
        var innerHtml = '';
        var name='';
        if(flag){
            $('.form1').addClass('hide-item')
            $('.form2').removeClass('hide-item')
            employees=$('#employee_name').val()
            employees.forEach((item)=>{
                emp_data.filter((emp)=>{
                    if(emp.employee_id==item){
                        name= emp.name;
                    }
                })
                innerHtml += `
                            <div class="col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">Employee Name</label>
                                <input class="form-control" name="emp_name" id="emp_${item}" type="text" placeholder="Employee Name" value="${name}" readonly>
                            </div>

                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="form-label">Role</label>
                                <select name="role" class="form-control select" id="emp_${item}_role">
                                    <option value="">Select</option>
                                    <option value="lead">Lead</option>
                                </select>
                            <span class="text-danger valid_emp_${item}_role"></span>
                            </div>`;
            })

            $('#all_row').html(innerHtml);
            getRoles();

            

            
        }      

    }

    function Submit(){
        const flag=EmpValidations()
        if(flag){
            data={
                "project_id":atob(id),
                "employee_name"
            }
        }
    }

    function EmpValidations(){
        let flag=[]
        employees=$('#employee_name').val()
        employees.forEach((id)=>{
            if($("#emp_"+id+"_role").val()){
                $(".valid_emp_"+id+"_role").html('')
                flag.push(true)
            }else{
                $(".valid_emp_"+id+"_role").html('The Role field is required.')
                flag.push(false)
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

    // $('select[name=instrument_type]').change(()=>{
    //     $('#instrument_purpose').empty()
    //     $('#instrument_purpose').append(`<option value="">Select</option>`)
    //     let temp_data=instr_data.instrument_purpose
    //     temp_data=temp_data.filter((item)=>{
    //         return item.instrument_id == $("select[name=instrument_type]").val()
    //     })
        
    //     temp_data.forEach((item)=>{
    //         $('#instrument_purpose').append(`<option value="${item.id}">${item.name}</option>`)        
    //     })
    // })

    $('document').ready(()=>{
        
        $.ajax({
        type: "GET",
        url: api_url+'master/employeeDetails',
        }).done((response)=>{
            employee_data=response.data
            emp_data=employee_data.employee_name
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
                    $('#'+key).append(`<option value="${item.employee_id}">${item.name}</option>`)
                    }
                })
            });
        })
    })

</script>
@endpush