@extends('layouts.backend')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Edit Invoice Details</h6>
                </div>
                </div>
            <div class="card-body">
                <form>

                    <div class="row">

                        <div class="col-md-6">
                            <label for="exampleInputEmail1" class="form-label">Work Order Number</label>
                            <select name="work_order_number" class="form-control" id="work_order_number">
                                <option value="">Select</option>
                            </select>
                        <span class="text-danger valid_work_order_number"></span>
                        </div>

                        <div class="col-md-6">
                            <label for="exampleInputEmail1" class="form-label">Project</label>
                            <select name="project" class="form-control" id="project_name">
                                <option value="">Select</option>
                            </select>
                        <span class="text-danger valid_project"></span>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Reference Milestone Number</label>
                        <input class="form-control" name="reference_milestone_no" type="text" placeholder="Reference Milestone Number" value="{{old('reference_milestone_no')}}" autocomplete="off">
                        <span class="text-danger valid_reference_milestone_no"></span>
                        </div>

                        <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Date</label>
                        <input class="form-control" name="invoice_date" type="date" value="{{old('invoice_date')}}" autocomplete="off">
                        <span class="text-danger valid_invoice_date"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                        <label for="exampleFormControlInput1" class="form-label">Invoice Price</label>
                        <input class="form-control" name="invoice_price" type="number" placeholder="Invoice Price" value="{{old('invoice_price')}}" autocomplete="off">
                        <span class="text-danger valid_invoice_price"></span>
                        </div>

                        <div class="col-md-4">
                        <label for="exampleFormControlInput1" class="form-label">Tax(%)</label>
                        <input class="form-control" name="amount_tax" type="number" placeholder="Tax" value="{{old('amount_tax')}}" autocomplete="off">
                        <span class="text-danger valid_amount_tax"></span>
                        </div>

                        <div class="col-md-4">
                        <label for="exampleFormControlInput1" class="form-label">Total Amount</label>
                        <input class="form-control" name="invoice_total_amount" type="number" placeholder="Total Amount" value="{{old('invoice_total_amount')}}" autocomplete="off" readonly>
                        <span class="text-danger valid_invoice_total_amount"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                        <label for="exampleFormControlInput1" class="form-label">Recieved Price</label>
                        <input class="form-control" name="recieved_price" type="number" placeholder="Recieved Price" value="{{old('recieved_price')}}" autocomplete="off">
                        <span class="text-danger valid_recieved_price"></span>
                        </div>

                        <div class="col-md-4">
                        <label for="exampleFormControlInput1" class="form-label">Tax(%)</label>
                        <input class="form-control" name="payment_tax" type="number" placeholder="Tax" value="{{old('payment_tax')}}" autocomplete="off">
                        <span class="text-danger valid_payment_tax"></span>
                        </div>

                        <div class="col-md-4">
                        <label for="exampleFormControlInput1" class="form-label">Total Amount</label>
                        <input class="form-control" name="recieved_total_amount" type="number" placeholder="Total Amount" value="{{old('recieved_total_amount')}}" autocomplete="off" readonly>
                        <span class="text-danger valid_recieved_total_amount"></span>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Payment Due Date</label>
                        <input class="form-control" name="payment_due_date" type="date"  value="{{old('payment_due_date')}}" autocomplete="off">
                        <span class="text-danger valid_payment_due_date"></span>
                        </div>

                        <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Payment Recieved Date</label>
                        <input class="form-control" name="payment_recieved_date" type="date" value="{{old('payment_recieved_date')}}" autocomplete="off">
                        <span class="text-danger valid_payment_recieved_date"></span>
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
    let url=window.location.href
    let id=atob(url.split('edit/')[1])
 
    function Submit(){

        const flag=invoiceValidations() 
        
        if(flag){
            
            let data={
                'invoice_id':id,
                'work_order_number':$("select[name=work_order_number]").val(),
                'project_id':$("select[name=project]").val(),
                'reference_milestone_no':$("input[name=reference_milestone_no]").val(),
                'date':$("input[name=invoice_date]").val(),
                'invoice_price':$("input[name=invoice_price]").val(),
                'amount_tax':$("input[name=amount_tax]").val(),
                'invoice_total_amount':$("input[name=invoice_total_amount]").val(),
                'payment_recieved_date':$("input[name=payment_recieved_date]").val(),
                'payment_due_date':$("input[name=payment_due_date]").val(),
                'recieved_price':$("input[name=recieved_price]").val(),
                'payment_tax':$("input[name=payment_tax]").val(),
                'recieved_total_amount':$("input[name=recieved_total_amount]").val(),
            }
            console.log(data)
            $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/update/invoice_details',
            }).done((response)=>{
                sessionStorage.setItem("message", "Invoice Details Updated Successfully");
                window.location='{{route("invoices")}}'
            })
            
        }      

    }

    function invoiceValidations(){

        let flag1=false
        let flag2=false
        let flag3=false
        let flag4=false
        let flag5=false
        let flag6=false
        let flag7=false
        let flag8=false
        let flag9=false
        let flag=false

        if($("select[name=work_order_number]").val()){
            $('.valid_work_order_number').html('')
            flag1=true
        }else{
            $('.valid_work_order_number').html('The work order number field is required.')
            flag1=false
        }

        if($("select[name=project]").val()){
            $('.valid_project').html('')
            flag2=true
        }else{
            $('.valid_project').html('The project field is required.')
            flag2=false
        }

        if($("input[name=reference_milestone_no]").val()){
            $('.valid_reference_milestone_no').html('')
            flag4=true
        }else{
            $('.valid_reference_milestone_no').html('The reference milestone no field is required.')
            flag4=false
        }

        if($("input[name=invoice_price]").val()){
            $('.valid_invoice_price').html('')
            flag5=true
        }else{
            $('.valid_invoice_price').html('The invoice price field is required.')
            flag5=false
        }

        if($("input[name=invoice_date]").val()){
            $('.valid_invoice_date').html('')
            flag6=true
        }else{
            $('.valid_invoice_date').html('The date field is required.')
            flag6=false
        }

        if($("input[name=amount_tax]").val()){
            $('.valid_amount_tax').html('')
            flag7=true
        }else{
            $('.valid_amount_tax').html('The tax field is required.')
            flag7=false
        }

        if($("input[name=payment_recieved_date]").val()){
            $('.valid_payment_recieved_date').html('')
            flag8=true
        }else{
            $('.valid_payment_recieved_date').html('The payment recieved date is required.')
            flag8=false
        }

        if($("input[name=payment_due_date]").val()){
            $('.valid_payment_due_date').html('')
            flag3=true
        }else{
            $('.valid_payment_due_date').html('The payment due date field is required.')
            flag3=false
        }

        if($("input[name=recieved_price]").val()){
            $('.valid_recieved_price').html('')
            flag9=true
        }else{
            $('.valid_recieved_price').html('The recieved price field is required.')
            flag9=false
        }

        if($("input[name=payment_tax]").val()){
            $('.valid_payment_tax').html('')
            flag=true
        }else{
            $('.valid_payment_tax').html('The tax field is required.')
            flag=false
        }
        
        return flag && flag1 && flag2 && flag3 && flag4 && flag5 && flag6 && flag7 && flag8 && flag9

    }

    $('input[name=amount_tax]').keyup(()=>{
        if($("input[name=invoice_price]").val()){

            $('.valid_invoice_price').html('')
            if($('input[name=amount_tax]').val()){

                $('.valid_amount_tax').html('')
                amount=parseInt($('input[name=invoice_price]').val())+(parseInt($('input[name=amount_tax]').val())/100)*parseInt($('input[name=invoice_price]').val())
                $('input[name=invoice_total_amount]').val(amount.toFixed(2))

            }
            else{

                amount=parseInt($('input[name=invoice_price]').val())
                $('input[name=invoice_total_amount]').val(amount.toFixed(2))

            }  
        }else{

            $('.valid_invoice_price').html('The invoice price field is required.')

        }    
    })


    $('input[name=invoice_price]').keyup(()=>{

        if($("input[name=amount_tax]").val()){

            $('.valid_amount_tax').html('')
            if($('input[name=invoice_price]').val()){

                $('.valid_invoice_price').html('')
                amount=parseInt($('input[name=invoice_price]').val())+(parseInt($('input[name=amount_tax]').val())/100)*parseInt($('input[name=invoice_price]').val())
                $('input[name=invoice_total_amount]').val(amount.toFixed(2))

            }
            else{

                amount=parseInt($('input[name=invoice_price]').val())
                $('input[name=invoice_total_amount]').val(amount.toFixed(2))

            }  
        }else{
            amount=parseInt($('input[name=invoice_price]').val())
            $('input[name=invoice_total_amount]').val(amount.toFixed(2))
            $('.valid_amount_tax').html('The tax field is required.')
            
        }    
    })

    $('input[name=payment_tax]').keyup(()=>{

        if($("input[name=recieved_price]").val()){

            $('.valid_recieved_price').html('')
            if($('input[name=payment_tax]').val()){
                $('.valid_payment_tax').html('')
                amount=parseInt($('input[name=recieved_price]').val())+($('input[name=payment_tax]').val()/100)*$('input[name=recieved_price]').val()
                $('input[name=recieved_total_amount]').val(amount)
            }
            else{
                amount=parseInt($('input[name=recieved_price]').val())
                $('input[name=recieved_total_amount]').val(amount)
            }
            
        }else{

            $('.valid_recieved_price').html('The recieved price field is required.')

        }
        
    })

    $('input[name=recieved_price]').keyup(()=>{

        if($("input[name=payment_tax]").val()){

            $('.valid_payment_tax').html('')
            if($('input[name=recieved_price]').val()){
                $('.valid_recieved_price').html('')
                amount=parseInt($('input[name=recieved_price]').val())+($('input[name=payment_tax]').val()/100)*$('input[name=recieved_price]').val()
                $('input[name=recieved_total_amount]').val(amount)
            }
            else{
                amount=parseInt($('input[name=recieved_price]').val())
                $('input[name=recieved_total_amount]').val(amount)
            }
            
        }else{
            amount=parseInt($('input[name=recieved_price]').val())
            $('input[name=recieved_total_amount]').val(amount)
            $('.valid_payment_tax').html('The tax field is required.')

        }
        
    })

    $('document').ready(()=>{
        
        const filters={
            "id":{
                '_eq': id
            },
        }

        $.ajax({
        type: "GET",
        url: api_url+'items/invoices?filter='+JSON.stringify(filters),
        }).done((response)=>{
            temp_data=response.data.pop()
            $.ajax({
            type: "GET",
            url: api_url+'master/invoicedetails',
            }).done((response)=>{
                data=response.data
                instr_data=response.data
                delete Object.assign(data, {['project_id']: data['project_name'] })['project_name'];
                $("input[name=reference_milestone_no]").val(temp_data.reference_milestone_no)
                $("input[name=invoice_date]").val(temp_data.date)
                $("input[name=invoice_price]").val(temp_data.invoice_price)
                $("input[name=amount_tax]").val(temp_data.amount_tax)
                $("input[name=invoice_total_amount]").val(temp_data.invoice_total_amount)
                $("input[name=payment_recieved_date]").val(temp_data.payment_recieved_date)
                $("input[name=payment_due_date]").val(temp_data.payment_due_date)
                $("input[name=recieved_price]").val(temp_data.recieved_price)
                $("input[name=payment_tax]").val(temp_data.payment_tax)
                $("input[name=recieved_total_amount]").val(temp_data.recieved_total_amount)

                $.each( data, function( key, value ) {
                    value.forEach((item)=>{

                        if(item.id==temp_data[key]){
                            if(key=="project_id"){
                                $('#project_name').append(`<option value="${item.id}" selected>${item.project_name}</option>`)
                            }
                            else{
                                $('#'+key).append(`<option value="${item.id}" selected>${item.number}</option>`)
                            }
                        }else{
                            if(key=="project_id"){
                                $('#project_name').append(`<option value="${item.id}">${item.project_name}</option>`)
                            }
                            else{
                                $('#'+key).append(`<option value="${item.id}">${item.number}</option>`)
                            }
                        }
                        
                    })
                });
            })
        })
    })

</script>
@endpush