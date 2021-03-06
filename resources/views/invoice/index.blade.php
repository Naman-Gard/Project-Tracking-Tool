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
            <h6 class="text-white text-capitalize ps-3">All Invoices</h6>
            <a class="btn btn-secondary mx-5 float-right btn-sm hide-item Invoice_add" href="{{route('add-invoice')}}">Add</a>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                <tr class="">
                    <th scope="col">SL no.</th>
                    <th scope="col">Work Order Number</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Recieved Total Amount</th>
                    <th scope="col">Recieved Date</th>
                    <!-- <th scope="col">Mobile No.</th> -->
                    <th scope="col" class="action hide-item Invoice_action">Actions</th>
                </tr>
                </thead>
                <tbody class="t-content ">
                
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
    </div>




<div class="modal fade" id="DeleteInvoice" >
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
  let invoice_id
    function deleteInvoice(id){
      invoice_id=id
    }

    $(".delete-mem-btn").click(()=>{
      let data={
        invoice_id:invoice_id
      }

      $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/invoice/delete',
        }).done((response)=>{
          sessionStorage.setItem("message", "Invoice Deleted Successfully");
          window.location='{{route("invoices")}}'
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
        url: api_url+'items/invoices?limit=-1',
        }).done((response)=>{
        const invoices=response.data
        if(invoices.length!=0){
            invoices.forEach((invoice)=>{
              var edit = '{{ route("edit-invoice", ":id") }}'
              edit = edit.replace(':id', btoa(invoice.id))
            $('.t-content').append('<tr><th scope="col">'+i+'</th><td>'+invoice.work_order_number+'</td><td>'+invoice.invoice_total_amount+'</td><td>'+invoice.recieved_total_amount+'</td><td>'+invoice.payment_recieved_date+'</td><td class="action hide-item Invoice_action"><a href="'+edit+'" class="btn btn-primary btn-sm hide-item Invoice_edit m-1">Edit</a><button class="btn btn-danger m-1 btn-sm hide-item Invoice_delete" onclick="deleteInvoice('+invoice.id+')" data-bs-toggle="modal" data-bs-target="#DeleteInvoice">Delete</button></td></tr>')
            i=i+1
            })
        }
        else{
            $('.t-content').append('<tr><td><td><td class="text-start">No Data Found!</td></td></td></tr>')
        }
        $('.table').DataTable()
        $('.table').on('page.dt', function () {
          getPermissions()
        } );
        $('.table').on('length.dt', function () {
          getPermissions()
        } );
        $('.table').on('search.dt', function () {
          getPermissions()
        } );
        getPermissions()
        })
        
        
    })



</script>
@endpush