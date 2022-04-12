@extends('mailbox.include.index')

@section('mailbox-content')
<div class="card h-100">
    <div id="draft-content">

    </div>
</div>
@endsection 

@push('scripts')
<script>

    $(document).ready(()=>{

        const filters={
            'draft':{
                "_eq":1
            },
        }

        $.ajax({
        type: "GET",
        url: api_url+'items/mail?limit=-1&&filter='+JSON.stringify(filters),
        }).done((response)=>{
        const mails=response.data
        if(mails.length!=0){
            mails.forEach((mail)=>{
              $('#draft-content').append(mail.from+`<br>`)
            })
        }
        else{
            
        }
        
        getPermissions()
        })       
    })

</script>
@endpush