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
            mails.forEach((mail)=>{
              $('#inbox-content').append(mail.subject+`<br>`)
            })
        }       
        getPermissions()
        })       
    })

</script>
@endpush