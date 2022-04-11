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
                <h6 class="text-white text-capitalize ps-3">All Instrument Purpose</h6>
                <a class="btn btn-dark mx-5 btn-sm hide-item Master_add" onclick="open_add_model()">Add</a>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
              <table id="example" class="table align-items-center mb-0 mdl-data-table">
                  <thead>
                    <tr class="">
                      <th scope="col">SL no.</th>
                      <th scope="col">Type</th>
                      <th scope="col">Purpose</th>
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

    <div class="modal fade" id="Deletetype" >
      <div class="modal-dialog">
          <div class="modal-content">
          
            <div class="modal-body p-0">
                
            
                <div class="card">
                  <!-- <div class="card-header">Delete Instrument Purpose
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
        <h5 class="modal-title" id="staticBackdropLabel">Add Instrument Purpose</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
      <div class="">
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <input type="hidden" id="instrument_purpose_id">
              <div>
              <label for="instrument_type" class="form-label">Instrument Type</label>
              <select name="instrument_type" class="form-control" id="instrument_type">
                  <option value="">Select</option>
              </select>
              <span class="text-danger inst_valid"></span>
            </div>

              <label for="purpose" class="form-label">Instrument Purpose</label>
              <input type="text" id="purpose" name="purpose" autocomplete="off" class="form-control border" value="{{ old('purpose') }}">
            <span class="text-danger purpose"></span>
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
            $(':input').val('');
            
            var innerHtml = '';
            $.ajax({
            type: "GET",
            url: api_url+'master/instrument_type',
            }).done((response)=>{
              const types=response.data

              types.instrument_type.forEach(element => {
                  innerHtml += `<option value="">Select</option>
                                <option value="${element.id}">${element.name}</option>`;
              });
              $('#instrument_type').html(innerHtml);
                
            })     
    }

    function open_edit_model(e){
            
            $('#staticBackdrop').modal('show');
            $.ajax({
            type: "GET",
            url: api_url+'master/instrument_purpose',
            }).done((response)=>{
              const types=response.data
              const type_data = types.instrument_purpose

              const type_data_by_id = type_data.filter((item) => {
                return item.id == e;
                });
              
              const instrument_purpose = type_data_by_id[0]
              $('#instrument_purpose_id').val(btoa(instrument_purpose.id));
              $('#purpose').val(instrument_purpose.name);

              $.ajax({
                type: "GET",
                url: api_url+'master/instrument_type',
                }).done((response)=>{
                const types=response.data
                if(types.instrument_type.length!=0){
                  var i = 1;
                  var innerHtml1 = '';
                  types.instrument_type.forEach(element =>{
                      innerHtml1 += '<option value="">Select</option><option value="' + element.id + '"' + (element.id === instrument_purpose.instrument_id ? 'selected="selected"' : '') +'>' + element.name+ '</option>';
                    })
                }
                $('#instrument_type').html(innerHtml1);
                

              })


                
            })          
    }

    function delete_model(e){
            $('#Deletetype').modal('show');
            $('#delete_type_id').val(btoa(e));     
    }

    function type_delete(){

      let data={
            'instrument_purpose_id': atob($('#delete_type_id').val()) }

      $.ajax({
      type: "DELETE",
      contentType: "application/json",
      dataType: "json",
      data:JSON.stringify(data),
      url: api_url+'master/instrument_purpose',
      }).done((response)=>{
        sessionStorage.setItem("message", "Instrument Purpose Deleted Successfully");
          window.location='{{route("instrumentPurpose")}}'
      })
    }

    function Submit(){

      let data={
            'instrument_id': $("#instrument_type").val(),
            'purpose': $("#purpose").val() }
            console.log(data.instrument_id)

        if(data.instrument_id == ''){
          $('.inst_valid').html('The Instrument Type field is required.');
        }

        if(data.purpose == ''){
          $('.purpose').html('The Purpose field is required.');
        }

        else{

          if($("#instrument_purpose_id").val() == ''){
            $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/instrument_purpose',
            }).done((response)=>{
              sessionStorage.setItem("message", "Instrument Purpose Added Successfully");
                window.location='{{route("instrumentPurpose")}}'
            })
          }

          else{
            let data={
            'instrument_purpose_id': atob($("#instrument_purpose_id").val()),
            'instrument_id': $("#instrument_type").val(),
            'name': $("#purpose").val() }

            $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/instrument_purpose_update',
            }).done((response)=>{
              sessionStorage.setItem("message", "Instrument Purpose Edited Successfully");
                window.location='{{route("instrumentPurpose")}}'
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
        url: api_url+'master/instrument_purpose',
        }).done((response)=>{
        const purpose=response.data
        const types=response.data
        const instrument_type = types.instrument_type
        
        if(purpose.instrument_purpose.length!=0){
          var i = 1;
          purpose.instrument_purpose.forEach(element =>{

              innerHtml += `<tr>
                                <td>${i++}</td>
                                <td>${element.instrument_name}</td>
                                <td>${element.name}</td>
                                <td class="hide-item Master_action">
                                  <button class="btn m-1 btn-info btn-sm hide-item Master_edit" onclick="open_edit_model(${element.id})">Edit</button>
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
