@extends('layouts.backend')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
    <div class="col-12">
        <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary d-flex justify-content-between shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">All Instruments</h6>
            <a class="btn btn-secondary mx-5 float-right btn-sm hide-item Instrument_add" href="{{route('add-instrument')}}">Add</a>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                <tr class="text-center">
                    <th scope="col">SL no.</th>
                    <th scope="col">Serial Number</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                    <th scope="col">Expiry Date</th>
                    <!-- <th scope="col">Mobile No.</th> -->
                    <th scope="col" class="action hide-item Instrument_action">Actions</th>
                </tr>
                </thead>
                <tbody class="t-content text-center">
                
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
    </div>




<div class="modal fade" id="DeleteInstrument" >
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


@endsection
@push('scripts')
<script>
  let instrument_id
    function deleteInstrument(id){
      instrument_id=id
    }

    $(".delete-mem-btn").click(()=>{
      let data={
        instrument_id:instrument_id
      }

      $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/instrument/delete',
        }).done((response)=>{
          window.location='{{route("instruments")}}'
        })
    })
    

    $(document).ready(()=>{
        var i=1
        $.ajax({
        type: "GET",
        url: api_url+'items/instruments?limit=-1',
        }).done((response)=>{
        const instruments=response.data
        if(instruments.length!=0){
            instruments.forEach((instrument)=>{
              var edit = '{{ route("edit-instrument", ":id") }}'
              edit = edit.replace(':id', btoa(instrument.id))
            $('.t-content').append('<tr><th scope="col">'+i+'</th><td>'+instrument.serial_no+'</td><td>'+instrument.amount+'</td><td>'+instrument.date+'</td><td>'+instrument.expiry_date+'</td><td class="action hide-item Instrument_action"><a href="'+edit+'" class="btn btn-primary btn-sm hide-item Instrument_edit m-2">Edit</a><button class="btn btn-danger m-3 btn-sm hide-item Instrument_delete" onclick="deleteInstrument('+instrument.id+')" data-bs-toggle="modal" data-bs-target="#DeleteInstrument">Delete</button></td></tr>')
            i=i+1
            })
        }
        else{
            $('.t-content').append('<tr><td><td><td class="text-start">No Data Found!</td></td></td></tr>')
        }
        })
        getPermissions()
    })



</script>
@endpush