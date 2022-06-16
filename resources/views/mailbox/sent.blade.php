@extends('mailbox.include.index')

@section('mailbox-content')
<div class="card h-100">
    <div id="sent-content">

    </div>
</div>
@endsection 

@push('scripts')
<script>

    $(document).ready(()=>{

        const filters={
            'from':{
                "_eq":'{{ Session::get("user")["email"] }}'
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
                innerhtml+='<tr><td>To: '+mail.to+'</td><td>'+mail.subject+' - '+mail.content+'</td></tr>'
            //   $('#sent-content').append(mail.to+`<br>`)
            })

            innerhtml+=`
            </tbody>
            </table>`

            $('#sent-content').append(innerhtml)
        }
        else{
            $('#sent-content').append('No Data Found')
        }
        
        getPermissions()
        })       
    })

</script>
@endpush