@extends('layouts.backend')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Add Work Order</h6>
                </div>
                </div>
            <div class="card-body">
                <form>

                    <div class="row">

                        <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Number</label>
                        <input class="form-control" name="work_order_number" type="text" placeholder="Work Order Number" value="{{old('work_order_number')}}" autocomplete="off">
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
                            <label for="exampleInputEmail1" class="form-label">Work Order Type</label>
                            <select name="work_order_type" class="form-control" id="work_order_type">
                                <option value="">Select</option>
                            </select>
                        <span class="text-danger valid_work_order_type"></span>
                        </div>

                        <div class="col-md-6">
                            <label for="exampleInputEmail1" class="form-label">Billing Type</label>
                            <select name="billing_type" class="form-control" id="billing_type">
                                <option value="">Select</option>
                            </select>
                        <span class="text-danger valid_billing_type"></span>
                        </div>
                    
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Empanelment</label>
                        <input class="form-control" name="empanelment" type="text" placeholder="Empanelment" value="{{old('empanelment')}}" autocomplete="off">
                        <span class="text-danger valid_empanelment"></span>
                        </div>

                        <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Value</label>
                        <input class="form-control" name="work_order_value" type="number" placeholder="Work Order Value" value="{{old('work_order_value')}}" autocomplete="off">
                        <span class="text-danger valid_work_order_value"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Date</label>
                        <input class="form-control" name="work_order_date" type="date" value="{{old('work_order_date')}}" autocomplete="off">
                        <span class="text-danger valid_work_order_date"></span>
                        </div>

                        <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Validity Date</label>
                        <input class="form-control" name="work_order_validity_date" type="date" value="{{old('work_order_validity_date')}}" autocomplete="off">
                        <span class="text-danger valid_work_order_validity_date"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Milestones</label>
                        <input class="form-control" name="no_of_milestones" type="text" placeholder="Number of Milestones" value="{{old('no_of_milestones')}}" autocomplete="off">
                        <span class="text-danger valid_no_of_milestones"></span>
                        </div>

                        <!-- <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Milestone Date</label>
                        <input class="form-control" name="milestone_date" type="date"  value="{{old('milestone_date')}}" autocomplete="off">
                        <span class="text-danger valid_milestone_date"></span>
                        </div> -->
                    </div>

                    <!-- <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Milestone Description</label>
                    <input class="form-control" name="desc" type="text" placeholder="Description" value="{{old('desc')}}" autocomplete="off">
                    <textarea class="form-control" name="milestone_description" placeholder="Milestone Description" value="{{old('milestone_description')}}"></textarea>
                    <span class="text-danger valid_milestone_description"></span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Amount(%)</label>
                        <input class="form-control" name="milestone_percent_amount" type="number" placeholder="Milestone Percentage Amount" value="{{old('milestone_percent_amount')}}" autocomplete="off">
                        <span class="text-danger valid_milestone_percent_amount"></span>
                        </div>

                        <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Amount</label>
                        <input class="form-control" name="milestone_amount" type="number" placeholder="Milestone Amount" value="{{old('milestone_amount')}}" autocomplete="off">
                        <span class="text-danger valid_milestone_amount"></span>
                        </div>
                    </div> -->

                    

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
    let url=window.location.href
    let id=url.split('add/')[1]
 
    function Submit(){

        const flag=orderValidations() 
        
        if(flag){
            
            let data={
                'number':$("input[name=work_order_number]").val(),
                'project_id':$("select[name=project]").val(),
                'type':$("select[name=work_order_type]").val(),
                'billing_type':$("select[name=billing_type]").val(),
                'empanelment':$("input[name=empanelment]").val(),
                'value':$("input[name=work_order_value]").val(),
                'date':$("input[name=work_order_date]").val(),
                'validity_date':$("input[name=work_order_validity_date]").val(),
                'no_of_milestones':$("input[name=no_of_milestones]").val(),
                // 'milestone_date':$("input[name=milestone_date]").val(),
                // 'milestone_percent_amount':$("input[name=milestone_percent_amount]").val(),
                // 'milestone_amount':$("input[name=milestone_amount]").val(),
                // 'milestone_description':$("textarea[name=milestone_description]").val()
            }
            // console.log(data)
            $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/add/work_order_details',
            }).done((response)=>{
                sessionStorage.setItem("message", "Work Order Added Successfully");
                window.location='{{route("work-orders")}}'
            })
            
        }      

    }

    function orderValidations(){

        let flag=[]

        if($("input[name=work_order_number]").val()){
            $('.valid_work_order_number').html('')
            flag.push(true)
        }else{
            $('.valid_work_order_number').html('The work order number field is required.')
            flag.push(false)
        }

        if($("select[name=project]").val()){
            $('.valid_project').html('')
            flag.push(true)
        }else{
            $('.valid_project').html('The project field is required.')
            flag.push(false)
        }

        if($("input[name=empanelment]").val()){
            $('.valid_empanelment').html('')
            flag.push(true)
        }else{
            $('.valid_empanelment').html('The empanelment field is required.')
            flag.push(false)
        }

        if($("input[name=work_order_value]").val()){
            $('.valid_work_order_value').html('')
            flag.push(true)
        }else{
            $('.valid_work_order_value').html('The value field is required.')
            flag.push(false)
        }

        if($("input[name=work_order_date]").val()){
            $('.valid_work_order_date').html('')
            flag.push(true)
        }else{
            $('.valid_work_order_date').html('The date field is required.')
            flag.push(false)
        }

        if($("input[name=work_order_validity_date]").val()){
            $('.valid_work_order_validity_date').html('')
            flag.push(true)
        }else{
            $('.valid_work_order_validity_date').html('The validity date field is required.')
            flag.push(false)
        }

        if($("input[name=no_of_milestones]").val()){
            $('.valid_no_of_milestones').html('')
            flag.push(true)
        }else{
            $('.valid_no_of_milestones').html('The milestones field is required.')
            flag.push(false)
        }

        // if($("input[name=milestone_date]").val()){
        //     $('.valid_milestone_date').html('')
        //     flag.push(true)
        // }else{
        //     $('.valid_milestone_date').html('The milestone date field is required.')
        //     flag.push(false)
        // }

        // if($("input[name=milestone_percent_amount]").val()){
        //     $('.valid_milestone_percent_amount').html('')
        //     flag.push(true)
        // }else{
        //     $('.valid_milestone_percent_amount').html('The amount(%) field is required.')
        //     flag.push(false)
        // }

        // if($("input[name=milestone_amount]").val()){
        //     $('.valid_milestone_amount').html('')
        //     flag.push(true)
        // }else{
        //     $('.valid_milestone_amount').html('The amount field is required.')
        //     flag.push(false)
        // }

        // if($("textarea[name=milestone_description]").val()){
        //     $('.valid_milestone_description').html('')
        //     flag.push(true)
        // }else{
        //     $('.valid_milestone_description').html('The description field is required.')
        //     flag.push(false)
        // }

        if($("select[name=work_order_type]").val()){
            $('.valid_work_order_type').html('')
            flag.push(true)
        }else{
            $('.valid_work_order_type').html('The work order type field is required.')
            flag.push(false)
        }

        if($("select[name=billing_type]").val()){
            $('.valid_billing_type').html('')
            flag.push(true)
        }else{
            $('.valid_billing_type').html('The billing type field is required.')
            flag.push(false)
        }
        
        if(flag.includes(false)){
            return false
        }
        else{
            return true
        }
    }

    $('document').ready(()=>{
        
        $.ajax({
        type: "GET",
        url: api_url+'master/orderdetails',
        }).done((response)=>{
            order_data=response.data
            remove_project_ids=order_data['work_orders'].map((item)=>{
                return item.project_id
            })
            $.each( order_data, function( key, value ) {
                value.forEach((item)=>{
                    if(key=='project_name'){
                        if(id!=undefined && item.id==atob(id)){
                            $('#'+key).append(`<option value="${item.id}" selected>${item.project_name}</option>`)
                        }
                        else{
                            if(!remove_project_ids.includes(item.id.toString())){
                                $('#'+key).append(`<option value="${item.id}">${item.project_name}</option>`)
                            }
                        }
                    }
                    else{
                    $('#'+key).append(`<option value="${item.id}">${item.name}</option>`)
                    }
                })
            });
        })
    })

</script>
@endpush