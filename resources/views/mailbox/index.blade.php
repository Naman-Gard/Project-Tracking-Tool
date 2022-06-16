@extends('mailbox.include.index')

@section('mailbox-content')
<div class="card h-100">
    <div id="inbox-content">

    </div>
</div>
@endsection 

@push('scripts')
<script>

    $(document).ready(()=>{

        const filters={
            "to":{
                "_eq":'{{ Session::get("user")["email"] }}'
            },
            'draft':{
                "_eq":0
            },
            'status':{
                "_eq":1
            }
        }

        $.ajax({
        type: "GET",
        url: api_url+'items/mail?limit=-1&&filter='+JSON.stringify(filters),
        }).done((response)=>{
        const mails=response.data
        if(mails.length!=0){
            innerhtml=`<table class="table align-items-center mb-0">
            <thead/>
            <tbody class="t-content">`
            mails.forEach((mail)=>{
                innerhtml+='<tr><td>From: '+mail.from+'</td><td>'+mail.subject+' - '+mail.content+'</td></tr>'
            })
            innerhtml+=`
            </tbody>
            </table>`
            $('#inbox-content').append(innerhtml)
        }       
        getPermissions()
        })       
    })

</script>
@endpush