@extends('layouts.backend')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Add Instrument</h6>
                </div>
                </div>
            <div class="card-body">
                <form>

                    <div class="row">

                    <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Serial Number</label>
                    <input class="form-control" name="instrument_serial_no" type="text" placeholder="Instrument Serial Number" value="{{old('instrument_serial_no')}}" autocomplete="off">
                    <span class="text-danger valid_instrument_serial_no"></span>
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
                        <label for="exampleInputEmail1" class="form-label">Instrument Type</label>
                        <select name="instrument_type" class="form-control" id="instrument_type">
                            <option value="">Select</option>
                        </select>
                    <span class="text-danger valid_instrument_type"></span>
                    </div>

                    <div class="col-md-6">
                        <label for="exampleInputEmail1" class="form-label">Instrument Purpose</label>
                        <select name="instrument_purpose" class="form-control" id="instrument_purpose">
                            <option value="">Select</option>
                        </select>
                    <span class="text-danger valid_instrument_purpose"></span>
                    </div>
                    
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Reference Number</label>
                    <input class="form-control" name="instrument_reference_number" type="text" placeholder="Instrument Reference Number" value="{{old('instrument_reference_number')}}" autocomplete="off">
                    <span class="text-danger valid_instrument_reference_number"></span>
                    </div>

                    <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Amount</label>
                    <input class="form-control" name="instrument_amount" type="number" placeholder="Instrument Amount" value="{{old('instrument_amount')}}" autocomplete="off">
                    <span class="text-danger valid_instrument_amount"></span>
                    </div>
                    </div>
                    
                    <div class="row">
                    <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Date</label>
                    <input class="form-control" name="instrument_date" type="date" placeholder="Instrumet Date" value="{{old('instrument_date')}}" autocomplete="off">
                    <span class="text-danger valid_instrument_date"></span>
                    </div>

                    <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Expiry Date</label>
                    <input class="form-control" name="instrument_expiry_date" type="date" placeholder="Instrument Expiry Date" value="{{old('instrument_expiry_date')}}" autocomplete="off">
                    <span class="text-danger valid_instrument_expiry_date"></span>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Submission Date</label>
                    <input class="form-control" name="instrument_submission_date" type="date" placeholder="Instrument Submission Date" value="{{old('instrument_submission_date')}}" autocomplete="off">
                    <span class="text-danger valid_instrument_submission_date"></span>
                    </div>

                    <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Maturity Date</label>
                    <input class="form-control" name="instrument_maturity_date" type="date" placeholder="Instrument Maturity Date" value="{{old('instrument_maturity_date')}}" autocomplete="off">
                    <span class="text-danger valid_instrument_maturity_date"></span>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Acknowledgement Date</label>
                    <input class="form-control" name="instrument_acknowledgement_date" type="date" placeholder="Instrument Acknowledgement Date" value="{{old('instrument_acknowledgement_date')}}" autocomplete="off">
                    <span class="text-danger valid_instrument_acknowledgement_date"></span>
                    </div>

                    <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Acknowledge By</label>
                    <input class="form-control" name="instrument_acknowledge_by" type="text" placeholder="Instrument Acknowledge By" value="{{old('instrument_acknowledge_by')}}" autocomplete="off">
                    <span class="text-danger valid_instrument_acknowledge_by"></span>
                    </div>
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
    let instr_data
    let url=window.location.href
    let id=url.split('add/')[1]
 
    function Submit(){

        const flag=projectValidations() 
        
        if(flag){
            
            let data={
                'serial_no':$("input[name=instrument_serial_no]").val(),
                'project_id':$("select[name=project]").val(),
                'type':$("select[name=instrument_type]").val(),
                'purpose':$("select[name=instrument_purpose]").val(),
                'reference_number':$("input[name=instrument_reference_number]").val(),
                'amount':$("input[name=instrument_amount]").val(),
                'date':$("input[name=instrument_date]").val(),
                'expiry_date':$("input[name=instrument_expiry_date]").val(),
                'submission_date':$("input[name=instrument_submission_date]").val(),
                'maturity_date':$("input[name=instrument_maturity_date]").val(),
                'acknowledgement_date':$("input[name=instrument_acknowledgement_date]").val(),
                'acknowledge_by':$("input[name=instrument_acknowledge_by]").val()
            }
            console.log(data)
            $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/add/instrument',
            }).done((response)=>{
                window.location='{{route("instruments")}}'
            })
            
        }      

    }

    function projectValidations(){

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
        let flag10=false
        let flag11=false

        if($("input[name=instrument_serial_no]").val()){
            $('.valid_instrument_serial_no').html('')
            flag1=true
        }else{
            $('.valid_instrument_serial_no').html('The serial number field is required.')
            flag1=false
        }

        if($("select[name=project]").val()){
            $('.valid_project').html('')
            flag2=true
        }else{
            $('.valid_project').html('The project field is required.')
            flag2=false
        }

        if($("input[name=instrument_reference_number]").val()){
            $('.valid_instrument_reference_number').html('')
            flag4=true
        }else{
            $('.valid_instrument_reference_number').html('The reference number field is required.')
            flag4=false
        }

        if($("input[name=instrument_amount]").val()){
            $('.valid_instrument_amount').html('')
            flag5=true
        }else{
            $('.valid_instrument_amount').html('The amount field is required.')
            flag5=false
        }

        if($("input[name=instrument_date]").val()){
            $('.valid_instrument_date').html('')
            flag6=true
        }else{
            $('.valid_instrument_date').html('The date field is required.')
            flag6=false
        }

        if($("input[name=instrument_expiry_date]").val()){
            $('.valid_instrument_expiry_date').html('')
            flag7=true
        }else{
            $('.valid_instrument_expiry_date').html('The expiry date field is required.')
            flag7=false
        }

        if($("input[name=instrument_submission_date]").val()){
            $('.valid_instrument_submission_date').html('')
            flag8=true
        }else{
            $('.valid_instrument_submission_date').html('The submission date field is required.')
            flag8=false
        }

        if($("input[name=instrument_maturity_date]").val()){
            $('.valid_instrument_maturity_date').html('')
            flag3=true
        }else{
            $('.valid_instrument_maturity_date').html('The maturity date field is required.')
            flag3=false
        }

        if($("input[name=instrument_acknowledgement_date]").val()){
            $('.valid_instrument_acknowledgement_date').html('')
            flag9=true
        }else{
            $('.valid_instrument_acknowledgement_date').html('The acknowledgement date field is required.')
            flag9=false
        }

        if($("input[name=instrument_acknowledge_by]").val()){
            $('.valid_instrument_acknowledge_by').html('')
            flag=true
        }else{
            $('.valid_instrument_acknowledge_by').html('The acknowledge by field is required.')
            flag=false
        }

        if($("select[name=instrument_type]").val()){
            $('.valid_instrument_type').html('')
            flag10=true
        }else{
            $('.valid_instrument_type').html('The instrument type field is required.')
            flag10=false
        }

        if($("select[name=instrument_purpose]").val()){
            $('.valid_instrument_purpose').html('')
            flag11=true
        }else{
            $('.valid_instrument_purpose').html('The instrument purpose field is required.')
            flag11=false
        }
        
        return flag && flag1 && flag2 && flag3 && flag4 && flag5 && flag6 && flag7 && flag8 && flag9 && flag10 && flag11

    }

    $('select[name=instrument_type]').change(()=>{
        $('#instrument_purpose').empty()
        $('#instrument_purpose').append(`<option value="">Select</option>`)
        let temp_data=instr_data.instrument_purpose
        temp_data=temp_data.filter((item)=>{
            return item.instrument_id == $("select[name=instrument_type]").val()
        })
        
        temp_data.forEach((item)=>{
            $('#instrument_purpose').append(`<option value="${item.id}">${item.name}</option>`)        
        })
    })

    $('document').ready(()=>{
        
        $.ajax({
        type: "GET",
        url: api_url+'master/instrumentdetails',
        }).done((response)=>{
            instr_data=response.data
            $.each( instr_data, function( key, value ) {
                value.forEach((item)=>{
                    if(key=='project_name'){
                        if(id!=undefined && item.id==atob(id)){
                            $('#'+key).append(`<option value="${item.id}" selected>${item.project_name}</option>`)
                        }
                        else{
                            $('#'+key).append(`<option value="${item.id}">${item.project_name}</option>`)
                        }
                    }
                    if(key=='instrument_type'){
                    $('#'+key).append(`<option value="${item.id}">${item.name}</option>`)
                    }
                })
            });
        })
    })

</script>
@endpush