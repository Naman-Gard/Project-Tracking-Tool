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
              <div class="bg-gradient-warning d-flex justify-content-between align-items-center shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">All Employee List</h6>
                <a class="btn btn-dark mx-5 btn-sm hide-item Master_add" onclick="open_add_model()">Add</a>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr class="text-center">
                      <th scope="col">SL no.</th>
                      <th scope="col">Employee ID</th>
                      <th scope="col">Name</th>
                      <th scope="col">Designation</th>
                      <th scope="col">Department</th>
                      <th scope="col">Email Id</th>
                      <th scope="col">Joining Date</th>
                      <th scope="col">Reporting To</th>
                      <th scope="col" class="action Master_action">Actions</th>
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

    <div class="modal fade" id="Deletetype" >
      <div class="modal-dialog">
          <div class="modal-content">
          
            <div class="modal-body p-0">
                
            
                <div class="card">
                  <!-- <div class="card-header">Delete Employee List
                  <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                  <div class="card-body">
                  <form>
                      <p>Are you sure you want to delete?</p> 
                      <input type="hidden" id="delete_type_id">
                      <button type="button" class="btn btn-secondary btn-sm Type_delete" data-bs-dismiss="modal">Close</button>
                      <button onclick="type_delete()" class="btn btn-danger btn-sm">Delete</button>
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
        <h5 class="modal-title" id="staticBackdropLabel">Add Employee List</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
      <div class="">
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <input type="hidden" id="employee_list_id">
              <div>
                <label for="employee_id" class="form-label">Employee ID</label>
                <input type="text" id="employee_id" name="employee_id" class="form-control border" value="{{ old('employee_id') }}">
                <span class="text-danger employee_id"></span>
             </div>
              <div>
              <label for="name" class="form-label">Name</label>
              <input type="text" id="name" name="name" class="form-control border" value="{{ old('name') }}">
              <span class="text-danger name"></span>
             </div>
             <div>
              <label for="designation" class="form-label">Designation</label>
              <input type="text" id="designation" name="designation" class="form-control border" value="{{ old('designation') }}">
              <span class="text-danger designation"></span>
            </div>
            <div>
              <label for="department" class="form-label">Department</label>
              <input type="text" id="department" name="department" class="form-control border" value="{{ old('department') }}">
              <span class="text-danger department"></span>
            </div>
            <div>

              <label for="email_id" class="form-label">Email ID</label>
              <input type="email" id="email_id" name="email_id" class="form-control border" value="{{ old('email_id') }}">
              <span class="text-danger email_id"></span>
            </div>
            <div>
              <label for="joining_date" class="form-label">Date of Joining</label>
              <input type="date" id="joining_date" name="joining_date" class="form-control border" value="{{ old('joining_date') }}">
              <span class="text-danger joining_date"></span>
            </div>
            <div>
              <label for="reporting_to" class="form-label">Reporting To</label>
              <input type="text" id="reporting_to" name="reporting_to" class="form-control border" value="{{ old('reporting_to') }}">
              <span class="text-danger reporting_to"></span>
            </div>
            
            <button onclick="Submit()" class="btn btn-success btn-sm">Submit</button>
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
            $('#employee_list_id').val('');
            $('#delete_type_id').val('');
    }

    function open_edit_model(e){
            
            $('#staticBackdrop').modal('show');
            $.ajax({
            type: "GET",
            url: api_url+'master/employee_list',
            }).done((response)=>{
              const types=response.data
              const type_data = types.employee_list

              const type_data_by_id = type_data.filter((item) => {
                return item.id == e;
                });
              
              const employee_list = type_data_by_id[0]
              $('#employee_list_id').val(employee_list.id);
              $('#employee_id').val(employee_list.employee_id);
              $('#name').val(employee_list.name);
              $('#department').val(employee_list.department);
              $('#designation').val(employee_list.designation);
              $('#email_id').val(employee_list.email_id);
              $('#joining_date').val(employee_list.date_of_joining);
              $('#reporting_to').val(employee_list.reporting_to);
                
            })          
    }

    function delete_model(e){
            $('#Deletetype').modal('show');
            $('#delete_type_id').val(e);     
    }

    function type_delete(){

      let data={
            'employee_list_id': $('#delete_type_id').val() }

      $.ajax({
      type: "DELETE",
      contentType: "application/json",
      dataType: "json",
      data:JSON.stringify(data),
      url: api_url+'master/employee_list',
      }).done((response)=>{
        sessionStorage.setItem("message", "Employee Details Deleted Successfully");
          window.location='{{route("employeeList")}}'
      })
    }

    function Submit(){

      let data={
            'employee_id': $("#employee_id").val(),
            'name': $("#name").val(),
            'department': $("#department").val(),
            'designation': $("#designation").val(),
            'email_id': $("#email_id").val(),
            'joining_date': $("#joining_date").val(),
            'reporting_to': $("#reporting_to").val() }

        if(data.employee_id == ''){
          $('.employee_id').html('Employee ID field is required.');
        }

        if(data.name == ''){
          $('.name').html('Name field is required.');
        }

        else{

          if($("#employee_list_id").val() == ''){
            $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/employee_list',
            }).done((response)=>{
              sessionStorage.setItem("message", "Employee Details Added Successfully");
                window.location='{{route("employeeList")}}'
            })
          }

          else{
            let data={
            'employee_list_id': $("#employee_list_id").val(),
            'employee_id': $("#employee_id").val(),
            'name': $("#name").val(),
            'department': $("#department").val(),
            'designation': $("#designation").val(),
            'email_id': $("#email_id").val(),
            'joining_date': $("#joining_date").val(),
            'reporting_to': $("#reporting_to").val() }
            console.log(data);

            $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/employee_list_update',
            }).done((response)=>{
              sessionStorage.setItem("message", "Employee Details Edited Successfully");
                window.location='{{route("employeeList")}}'
            })
          }
        }

    }

  $(document).ready(()=>{
    if(sessionStorage.getItem("message")){
            $('.success-message').html(sessionStorage.getItem("message"))
            $('.alert-success').removeClass('hide-item')
            setTimeout(()=>{removeMessage("message")},2000)
        }
  
        var innerHtml = '';
        $.ajax({
        type: "GET",
        url: api_url+'master/employee_list',
        }).done((response)=>{
        const types=response.data
        if(types.employee_list.length!=0){
          var i = 1;
          types.employee_list.forEach(element =>{
              innerHtml += `<tr>
                                <td>${i++}</td>
                                <td>${element.employee_id}</td>
                                <td>${element.name}</td>
                                <td>${element.designation}</td>
                                <td>${element.department}</td>
                                <td>${element.email_id}</td>
                                <td>${element.date_of_joining ? element.date_of_joining : 'a'}</td>
                                <td>${element.reporting_to}</td>
                                <td class="Master_action">
                                  <button class="btn btn-info btn-sm hide-item Master_edit" onclick="open_edit_model(${element.id})">Edit</button>
                                  <button class="btn btn-danger btn-sm hide-item Master_delete" onclick="delete_model(${element.id})">Delete</button>                                  
                                </td>
                            </tr>`;
            })
        }
        else{
          innerHtml = `<tr> <td colspan="6">No Record Found</td> </tr>`;
        }

        $('#all_row').html(innerHtml);
        getPermissions()
      })
    })

    getPermissions()

</script>
@endpush
