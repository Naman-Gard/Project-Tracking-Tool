@extends('layouts.backend')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
    <div class="col-12">
        <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible text-white" role="alert">
                <span class="text-sm success-message">{{session('success')}}</span>
                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="alert alert-success alert-dismissible hide-item text-white" role="alert">
                <span class="text-sm success-message">{{session('success')}}</span>
                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="bg-gradient-primary d-flex justify-content-between shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">All Milestones</h6>
            <button class="btn btn-secondary mx-5 float-right btn-sm Milestone-add" data-bs-toggle="modal" data-bs-target="#AddMiles">Add</button>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                <tr class="">
                    <th scope="col">SL no.</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date</th>
                    <th scope="col">Amount</th>
                    <th scope="col" class="action">Actions</th>
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




<div class="modal fade" id="DeleteMile" >
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


<div class="modal fade" id="AddMiles" >
    <div class="modal-dialog">
        <div class="modal-content">
        
        <div class="modal-body p-0">
            
        
            <div class="card">
                <div class="modal-header">
                    Add Milestone
                </div>
                <form>
                    @csrf
                <div class="modal-body">
                    
                    <div class="form-group mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Milestone Date</label>
                    <input class="form-control" name="milestone_date" type="date"  value="{{old('milestone_date')}}" autocomplete="off">
                    <span class="text-danger valid_milestone_date"></span>
                    </div>

                    <div class="form-group mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Milestone Description</label>
                    <!-- <input class="form-control" name="desc" type="text" placeholder="Description" value="{{old('desc')}}" autocomplete="off"> -->
                    <textarea class="form-control" name="milestone_description" placeholder="Milestone Description" value="{{old('milestone_description')}}"></textarea>
                    <span class="text-danger valid_milestone_description"></span>
                    </div>

                    <div class="form-group mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Amount(%)</label>
                    <input class="form-control" name="milestone_percent_amount" type="number" placeholder="Milestone Percentage Amount" value="{{old('milestone_percent_amount')}}" autocomplete="off">
                    <span class="text-danger valid_milestone_percent_amount"></span>
                    </div>

                    <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Amount</label>
                    <input class="form-control" name="milestone_amount" type="number" placeholder="Milestone Amount" value="{{old('milestone_amount')}}" autocomplete="off">
                    <span class="text-danger valid_milestone_amount"></span>
                    </div>
                    
                    
                    
                </div>

                <div class="modal-footer">
                    <a  class="btn btn-secondary btn-sm m-1" data-bs-dismiss="modal">Close</a>
                    <input type="button" class="btn btn-primary add-mem-btn btn-sm m-1" onclick="addMiles()" value="Add">
                </div>
                </form> 
            </div>


        
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditMile" >
    <div class="modal-dialog">
        <div class="modal-content">
        
        <div class="modal-body p-0">
            
        
            <div class="card">
                <div class="modal-header">
                    Edit Milestone
                </div>
                <form>
                    @csrf
                <div class="modal-body">
                    
                    <div class="form-group mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Milestone Date</label>
                    <input class="form-control" name="milestone_edit_date" type="date" autocomplete="off">
                    <span class="text-danger valid_milestone_edit_date"></span>
                    </div>

                    <div class="form-group mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Milestone Description</label>
                    <!-- <input class="form-control" name="desc" type="text" placeholder="Description" value="{{old('desc')}}" autocomplete="off"> -->
                    <textarea class="form-control" name="milestone_edit_description" placeholder="Milestone Description"></textarea>
                    <span class="text-danger valid_milestone_edit_description"></span>
                    </div>

                    <div class="form-group mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Amount(%)</label>
                    <input class="form-control" name="milestone_edit_percent_amount" type="number" placeholder="Milestone Percentage Amount" autocomplete="off">
                    <span class="text-danger valid_milestone_edit_percent_amount"></span>
                    </div>

                    <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Amount</label>
                    <input class="form-control" name="milestone_edit_amount" type="number" placeholder="Milestone Amount" value="{{old('milestone_amount')}}" autocomplete="off">
                    <span class="text-danger valid_milestone_edit_amount"></span>
                    </div>
                    
                    
                    
                </div>

                <div class="modal-footer">
                    <a  class="btn btn-secondary btn-sm m-1" data-bs-dismiss="modal">Close</a>
                    <input type="button" class="btn btn-primary edit-mem-btn btn-sm m-1" value="Edit">
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
    let id=atob(url.split('milestones/')[1])
    let p_mile_id
    let work_orders
    let milestones

    function deleteMile(id){
        p_mile_id=id
    }

    function EditMile(id){
        $('.valid_milestone_edit_date').html('')
        $('.valid_milestone_edit_percent_amount').html('')
        $('.valid_milestone_edit_amount').html('')
        $('.valid_milestone_edit_description').html('')
        p_mile_id=id
        milestone=milestones.filter((mile)=>{
                return mile.id==id
        })
        if(milestone.length!=0){
            $("input[name=milestone_edit_date]").val(milestone[0].milestone_date)
            $("input[name=milestone_edit_percent_amount]").val(milestone[0].milestone_percent_amount)
            $("input[name=milestone_edit_amount]").val(milestone[0].milestone_amount)
            $("textarea[name=milestone_edit_description]").val(milestone[0].milestone_description)
        }
        
    }

    $(".edit-mem-btn").click(()=>{

        let flag=EditValidation()

        if(flag){
            let data={
                'mile_id':p_mile_id,
                'milestone_date':$("input[name=milestone_edit_date]").val(),
                'milestone_percent_amount':$("input[name=milestone_edit_percent_amount]").val(),
                'milestone_amount':$("input[name=milestone_edit_amount]").val(),
                'milestone_description':$("textarea[name=milestone_edit_description]").val()
            }
            var route = '{{ route("miles-by-project", ":id") }}'
            route = route.replace(':id', btoa(id))

            $.ajax({
                type: "POST",
                contentType: "application/json",
                dataType: "json",
                data:JSON.stringify(data),
                url: api_url+'master/project/milestone/edit',
            }).done((response)=>{
            sessionStorage.setItem("message", "Milestone Edited Successfully");
            window.location=route
            })
        }
        
    })

    $(".delete-mem-btn").click(()=>{
        let data={
            mile_id:p_mile_id
        }

        var route = '{{ route("miles-by-project", ":id") }}'
        route = route.replace(':id', btoa(id))

        $.ajax({
                type: "POST",
                contentType: "application/json",
                dataType: "json",
                data:JSON.stringify(data),
                url: api_url+'master/project/milestone/delete',
            }).done((response)=>{
            sessionStorage.setItem("message", "Milestone Deleted Successfully");
            window.location=route
            })
    })

    function Validation(){

        let flag=[]

        if($("input[name=milestone_date]").val()){
            $('.valid_milestone_date').html('')
            flag.push(true)
        }else{
            $('.valid_milestone_date').html('The milestone date field is required.')
            flag.push(false)
        }

        if($("input[name=milestone_percent_amount]").val()){
            $('.valid_milestone_percent_amount').html('')
            flag.push(true)
        }else{
            $('.valid_milestone_percent_amount').html('The amount(%) field is required.')
            flag.push(false)
        }

        if($("input[name=milestone_amount]").val()){
            $('.valid_milestone_amount').html('')
            flag.push(true)
        }else{
            $('.valid_milestone_amount').html('The amount field is required.')
            flag.push(false)
        }

        if($("textarea[name=milestone_description]").val()){
            $('.valid_milestone_description').html('')
            flag.push(true)
        }else{
            $('.valid_milestone_description').html('The description field is required.')
            flag.push(false)
        }

        if(flag.includes(false)){
            return false
        }
        else{
            return true
        }

    }

    $(document).ready(()=>{
        if(sessionStorage.getItem("message")){
            $('.success-message').html(sessionStorage.getItem("message"))
            $('.alert-success').removeClass('hide-item')
            setTimeout(()=>{removeMessage("message")},2000)
        }

        const filters={
            'project_id':{
                '_eq':id
            }
        }

        $.ajax({
        type: "GET",
        url: api_url+'items/work_orders?limit=-1&&filter='+JSON.stringify(filters),
        }).done((response)=>{
            work_orders=response.data
            var i=1
            $.ajax({
            type: "GET",
            url: api_url+'items/milestones?limit=-1&&filter='+JSON.stringify(filters),
            }).done((response)=>{
            milestones=response.data
            if(milestones.length!=0){
                milestones.forEach((mile)=>{
                var mile_id=mile.id
                $('.t-content').append('<tr><th scope="col">'+i+'</th><td>'+mile.milestone_description+'</td><td>'+mile.milestone_date+'</td><td>'+mile.milestone_amount+'</td><td class="action"><button class="btn btn-primary m-1 btn-sm" onclick="EditMile('+mile_id+')" data-bs-toggle="modal" data-bs-target="#EditMile">Edit</button><button class="btn btn-danger m-1 btn-sm" onclick="deleteMile('+mile_id+')" data-bs-toggle="modal" data-bs-target="#DeleteMile">Delete</button></td></tr>')
                i=i+1
                })
            }
            else{
                $('.t-content').append('<tr><td></td><td></td><td class="text-start">No Data Found!</td><td></td><td></td></tr>')
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
            checkAddMiles()
            })
        })
        
    })

    function addMiles(){
        let flag=Validation()
        if(flag){
            let data={
                'project_id':id,
                'milestone_date':$("input[name=milestone_date]").val(),
                'milestone_percent_amount':$("input[name=milestone_percent_amount]").val(),
                'milestone_amount':$("input[name=milestone_amount]").val(),
                'milestone_description':$("textarea[name=milestone_description]").val()
            }
            console.log(data)
            var route = '{{ route("miles-by-project", ":id") }}'
            route = route.replace(':id', btoa(id))
            $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/add/milestone_details',
            }).done((response)=>{
                sessionStorage.setItem("message", "Milesone Added Successfully");
                window.location=route
            })
        }
    }

    function checkAddMiles(){
        if(work_orders[0].milestones-milestones.length==0){
            $('.Milestone-add').prop('disabled',true)
        }
        else{
            $('.Milestone-add').prop('disabled',false)
        }
    }

    function EditValidation(){

        let flag=[]

        if($("input[name=milestone_edit_date]").val()){
            $('.valid_milestone_edit_date').html('')
            flag.push(true)
        }else{
            $('.valid_milestone_edit_date').html('The milestone date field is required.')
            flag.push(false)
        }

        if($("input[name=milestone_edit_percent_amount]").val()){
            $('.valid_milestone_edit_percent_amount').html('')
            flag.push(true)
        }else{
            $('.valid_milestone_edit_percent_amount').html('The amount(%) field is required.')
            flag.push(false)
        }

        if($("input[name=milestone_edit_amount]").val()){
            $('.valid_milestone_edit_amount').html('')
            flag.push(true)
        }else{
            $('.valid_milestone_edit_amount').html('The amount field is required.')
            flag.push(false)
        }

        if($("textarea[name=milestone_edit_description]").val()){
            $('.valid_milestone_edit_description').html('')
            flag.push(true)
        }else{
            $('.valid_milestone_edit_description').html('The description field is required.')
            flag.push(false)
        }

        if(flag.includes(false)){
            return false
        }
        else{
            return true
        }

    }

</script>
@endpush