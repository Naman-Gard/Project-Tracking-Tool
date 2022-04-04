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
            <div class="bg-gradient-primary d-flex justify-content-between shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">All Work Orders</h6>
            <a class="btn btn-secondary mx-5 float-right btn-sm hide-item Work_add" href="{{route('add-work-order')}}">Add</a>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                <tr class="text-center">
                    <th scope="col">SL no.</th>
                    <th scope="col">Number</th>
                    <th scope="col">Date</th>
                    <th scope="col">Validity Date</th>
                    <th scope="col" class="action hide-item Work_action">Actions</th>
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




<div class="modal fade" id="DeleteOrder" >
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
  let work_id
    function deleteWork(id){
      work_id=id
    }

    $(".delete-mem-btn").click(()=>{
      let data={
        work_id:work_id
      }

      $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/work-order/delete',
        }).done((response)=>{
          sessionStorage.setItem("message", "Work Order Deleted Successfully");
          window.location='{{route("work-orders")}}'
        })
    })
    

    $(document).ready(()=>{
        if(sessionStorage.getItem("message")){
            $('.success-message').html(sessionStorage.getItem("message"))
            $('.alert-success').removeClass('hide-item')
            setTimeout(()=>{removeMessage("message")},2000)
        }
        var i=1
        $.ajax({
        type: "GET",
        url: api_url+'items/work_orders?limit=-1',
        }).done((response)=>{
        const orders=response.data
        if(orders.length!=0){
            orders.forEach((order)=>{
              var edit = '{{ route("edit-work-order", ":id") }}'
              edit = edit.replace(':id', btoa(order.id))
            $('.t-content').append('<tr><th scope="col">'+i+'</th><td>'+order.number+'</td><td>'+order.date+'</td><td>'+order.validity_date+'</td><td class="action hide-item Work_action"><a href="'+edit+'" class="btn btn-primary btn-sm hide-item Work_edit m-2">Edit</a><button class="btn btn-danger m-3 btn-sm hide-item Work_delete" onclick="deleteWork('+order.id+')" data-bs-toggle="modal" data-bs-target="#DeleteOrder">Delete</button></td></tr>')
            i=i+1
            })
        }
        else{
            $('.t-content').append('<tr><td><td><td class="text-start">No Data Found!</td></td></td></tr>')
        }
        $('.table').DataTable()
        getPermissions()
        })
        
        
    })



</script>
@endpush