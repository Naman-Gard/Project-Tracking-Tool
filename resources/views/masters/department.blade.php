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
                <h6 class="text-white text-capitalize ps-3">All Department</h6>
                <a class="btn btn-dark mx-5 btn-sm hide-item Master_add" onclick="open_add_model()">Add</a>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
              <table id="example" class="table align-items-center mb-0 mdl-data-table">
                  <thead>
                    <tr class="">
                      <th scope="col">SL no.</th>
                      <th scope="col">Name</th>
                      <th scope="col" class="action hide-item Master_action">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="t-content " id="all_row">
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="modal fade" id="Deletedepartment" >
      <div class="modal-dialog">
          <div class="modal-content">
          
            <div class="modal-body p-0">
                
            
                <div class="card">
                  <!-- <div class="card-header">Delete Department
                  <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                  <div class="card-body">
                  <form>
                      <p>Are you sure you want to delete?</p> 
                      <input type="hidden" id="delete_department_id">
                      <button type="button" class="btn btn-secondary btn-sm Department_delete" data-bs-dismiss="modal">Close</button>
                      <button onclick="type_delete()" class="btn btn-danger btn-sm">Delete</button>
                  </form>
                  </div>
                </div>
            
            </div>
          </div>
      </div>
    </div>

    <div class="modal fade" id="spokePerson" >
      <div class="modal-dialog" style="max-width:750px">
          <div class="modal-content">
          
            <div class="modal-body p-0">
                
            
                <div class="card">
                  <!-- <div class="card-header">Delete Department
                  <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                  <div class="card-body">
                  <form>
                    <input type="hidden" name="persons_department_id" id="persons_department_id">
                      <table class="table-responsive table">
                        <thead>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <th onClick="addSpokeRow()">+</th>
                        </thead>
                        <tbody id="spokeBody">
                          
                        </tbody>
                      </table>
                      <button type="button" onClick="updateSpokePersons()" class="btn m-1 btn-primary btn-sm">Update</button>
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
        <h5 class="modal-title" id="staticBackdropLabel">Add Project Department</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
      <div class="">
        <div class="card">
          
          <div class="card-body">
            <div class="mb-3">
              <label for="name" class="form-label">Department Name</label>
              <input type="hidden" id="department_id">
              <input type="text" id="name" autocomplete="off" name="name" class="form-control border" aria-describedby="nameHelp" autocomplete="off" value="{{ old('name') }}">
              <span class="text-danger"></span>
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
    let row=0,createdRow=[],departments=[];
    function open_add_model(){
            $('#staticBackdrop').modal('show');
            $(':input').val('');

    }

    function addSpokeRow(){
      row=row+1
      let innerHtml=createHtml(row)
      createdRow.push(row)
      $('#spokeBody').append(innerHtml)
      commonValidation()
    }

    function removeRow(id){
      $('#row_'+id).remove()
      const index = createdRow.indexOf(id);
      if (index !== -1) {
        createdRow.splice(index, 1);
      }
    }

    function updateSpokePersons(){
      const tempData=[]
      const flag=[]
      createdRow.forEach((rowId,index)=>{
        flag.push(spokePersonValidation(rowId))
        tempData.push({
          'name':$(`#name_${rowId}`).val(),
          'email':$(`#email_${rowId}`).val(),
          'mobile':$(`#mobile_${rowId}`).val()
        })
      })
      // console.log($('#persons_department_id').val())
      if(!flag.includes(false)){
        $.ajax({
          type: "POST",
          contentType: "application/json",
          dataType: "json",
          data:JSON.stringify({id:$('#persons_department_id').val(),data:JSON.stringify(tempData)}),
          url: api_url+'master/spokePerson/update',
          }).done((response)=>{
            sessionStorage.setItem("message", "Spoke Persons Updated Successfully");
            window.location='{{route("department")}}'
        })
      }
      
    }

    function spokePersonValidation(rowId){
      const flag=[]
      if($(`#name_${rowId}`).val()===''){
        $(`#valid_name_${rowId}`).html('Name is required')
        flag.push(false)
      }
      else{
        $(`#valid_name_${rowId}`).html('')
      }
      if($(`#email_${rowId}`).val()===''){
        $(`#valid_email_${rowId}`).html('Email is required')
        flag.push(false)
      }
      else{
        let email=$(`#email_${rowId}`).val()
        let valid =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (email.toLowerCase().match(valid)) {
          $(`#valid_email_${rowId}`).html('')
        }
        else{
          flag.push(false)
          $(`#valid_email_${rowId}`).html('Please enter valid email')       
        }
      }
      if($(`#mobile_${rowId}`).val()===''){
        $(`#valid_mobile_${rowId}`).html('Mobile is required')
        flag.push(false)
      }
      else{
        $(`#valid_mobile_${rowId}`).html('')
      }
      return flag.includes(false)?false:true
    }

    function createHtml(row){
      return `<tr id="row_${row}">
                <td>
                  <div class="d-grid">
                    <input class="personName" id="name_${row}" name="name" type="text">
                    <span class="text-danger" id="valid_name_${row}"></span>
                  </div>
                </td>
                <td>
                  <div class="d-grid">
                    <input id="email_${row}" type="email">
                    <span class="text-danger" id="valid_email_${row}"></span>
                  </div>
                </td>
                <td>
                  <div class="d-grid">
                    <input class="personMobile" id="mobile_${row}" type="text">
                    <span class="text-danger" id="valid_mobile_${row}"></span>
                  </div>
                </td>
                <td onClick="removeRow(${row})">-</td>
              </tr>`
    }

    function open_edit_model(e){
            $('#staticBackdrop').modal('show'); 
            $.ajax({
            type: "GET",
            url: api_url+'master/department',
            }).done((response)=>{
              const department=response.data
              const department_data = department.department

              const department_data_by_id = department_data.filter((item) => {
                return item.id == e;
                });
              
              const department_type = department_data_by_id[0]
              $('#department_id').val(btoa(department_type.id));
              $('#name').val(department_type.name);
                
            })                
    }

    function open_person_model(id){
      row=0;
      createdRow=[];
      $('#spokeBody').html('')
      const spokePersons=JSON.parse(departments.find((department)=> department.id===id).spoke_persons)
      spokePersons.forEach((person)=>{
        row=row+1
        let innerHtml=createHtml(row)
        createdRow.push(row)
        $('#spokeBody').append(innerHtml)
        $(`#name_${row}`).val(person.name)
        $(`#email_${row}`).val(person.email)
        $(`#mobile_${row}`).val(person.mobile)
      })

      $('#spokePerson').modal('show');
      $('#persons_department_id').val(id)
      commonValidation()
    }

    function commonValidation(){
      $('.personName').keydown((e) => {
          var keyCode = (e.keyCode ? e.keyCode : e.which);
          if (!(keyCode >= 65 && keyCode <= 123)
            && (keyCode != 32 && keyCode != 0)
            && (keyCode != 48 && keyCode != 8)
            && (keyCode != 9)) {
              e.preventDefault();
          }
      })

      $('.personMobile').keydown((e) => {
        var keyCode = (e.keyCode ? e.keyCode : e.which);
        if (e.currentTarget.value.length == 10 && keyCode!==8)
            return false;
        
        return e.ctrlKey || e.altKey 
                    || (47<e.keyCode && e.keyCode<58 && e.shiftKey==false) 
                    || (95<e.keyCode && e.keyCode<106)
                    || (e.keyCode==8) || (e.keyCode==9) 
                    || (e.keyCode>34 && e.keyCode<40) 
                    || (e.keyCode==46)
      })
    }

    function delete_model(e){
            $('#Deletedepartment').modal('show');
            $('#delete_department_id').val(btoa(e));
    }

    function type_delete(){

    let data={
          'department_id': atob($('#delete_department_id').val()) }

    $.ajax({
    type: "DELETE",
    contentType: "application/json",
    dataType: "json",
    data:JSON.stringify(data),
    url: api_url+'master/department',
    }).done((response)=>{
      sessionStorage.setItem("message", "Department Deleted Successfully");
        window.location='{{route("department")}}'
    })
    }

    function Submit(){

      let data={
            'name': $("#name").val() }

        if(data.name == ''){
          $('.text-danger').html('Name field is required.');
        }

        else{
    
          if($("#department_id").val() == ''){
            $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/department',
            }).done((response)=>{
              sessionStorage.setItem("message", "Department Added Successfully");
                window.location='{{route("department")}}'
            })
          }

          else{
            let data={
            'department_id': atob($("#department_id").val()),
            'name': $("#name").val() }

            $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/department_update',
            }).done((response)=>{
              sessionStorage.setItem("message", "Department Edited Successfully");
                window.location='{{route("department")}}'
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
        url: api_url+'master/department',
        }).done((response)=>{
        departments=response.data.department
        const department=response.data
        if(department.department.length!=0){
          var i = 1;
          department.department.forEach(element =>{
              innerHtml += `<tr>
                                <td>${i++}</td>
                                <td>${element.name}</td>
                                <td class="Master_action hide-item">
                                  <button class="btn m-1 btn-info btn-sm hide-item Master_edit" onclick="open_edit_model(${element.id})">Edit</button>
                                  <button class="btn m-1 btn-primary btn-sm" onclick="open_person_model(${element.id})">Spoken Person</button>
                                  <button class="btn m-1 btn-danger btn-sm hide-item Master_delete" onclick="delete_model(${element.id})">Delete</button>                                  
                                </td>
                            </tr>`;
            })
        }
        else{
          innerHtml = `<tr> <td colspan="6">No Record Found</td> </tr>`;
        }

        $('#example').DataTable($('#all_row').html(innerHtml));
        $('#example').on('page.dt', function () {
          getPermissions()
        } );
        $('#example').on('length.dt', function () {
          getPermissions()
        } );
        $('#example').on('search.dt', function () {
          getPermissions()
        } );

        getPermissions()
    })
  })

</script>
@endpush
