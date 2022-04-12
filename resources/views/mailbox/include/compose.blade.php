
<div class="modal fade" id="AddMail" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">New Message
                <button class="btn-close float-right mail-close" data-bs-dismiss="modal" aria-label="Close" onclick="cancel()"></button>
            </div>  
            <div class="modal-body">
                <form>
                    <div>
                        <span>To:</span>
                        <input type="text" name="to" class="w-80 border-0"> <span id="cc">Cc: </span><span id="bcc"> Bcc:</span>
                    </div>
                    <div class="cc hide-item">
                        <hr>
                        <span>Cc:</span>
                        <input type="text" name="cc" class="w-90 border-0">
                        <a class="btn-close cc-close w-0"></a>
                    </div>
                    <div class="bcc hide-item">
                        <hr>
                        <span>Bcc:</span>
                        <input type="text" name="bcc" class="w-90 border-0">
                        <a class="btn-close bcc-close w-0"></a>
                    </div>
                    <hr>
                    <div>
                        <input type="text" name="subject" class="w-100 border-0" placeholder="Subject:">
                    </div>
                    <hr>
                    <div>
                        <textarea name="content" class="w-100 border-0" rows="5" placeholder="Type your text here..."></textarea>
                    </div>
                    <hr>
                    <div>
                        <a class="btn btn-primary" onclick="send(0)">Send</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $('#cc').css('cursor','pointer')
    $('#bcc').css('cursor','pointer')
    $('#cc').click(()=>{
        $('.cc').removeClass('hide-item')
    })
    $('#bcc').click(()=>{
        $('.bcc').removeClass('hide-item')
    })
    $('.cc-close').click(()=>{
        $('.cc').addClass('hide-item')
    })
    $('.bcc-close').click(()=>{
        $('.bcc').addClass('hide-item')
    })
    let data={}

    function send(draft,type="mail"){

        let flag=false
        if(type=='mail'){
            flag=Validation()
            data={}
            if(flag){
                generateData(0)
                resetCompose()
            }
            else{
                data={}
            }
            
        }
        else{
            if(draft){
                data={}
                generateData(draft)
                resetCompose()
            }
            else{
                data={}
            }
        }
        
        if(Object.keys(data).length){
            console.log(data)
            $.ajax({
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data:JSON.stringify(data),
            url: api_url+'master/send/mail',
            }).done((response)=>{
                $('#AddMail').modal('hide')
            })
        }
        
    }

    function generateData(draft){
        data={
            'to':$('input[name=to]').val(),
            'cc':$('input[name=cc]').val(),
            'bcc':$('input[name=bcc]').val(),
            'subject':$('input[name=subject]').val(),
            'content':$('textarea[name=content]').val(),
            'from':'{{ Session::get("user")["email"] }}',
            'file':0,
            'status':draft?0:1,
            'draft':draft
        }
        return data
    }

    function Validation(){
        let flag

        if($('input[name=to]').val()){
            $('.valid_employee').html('')
            return flag=true
        }else{
            $('input[name=to]').prop('placeholder','Field is required')
            return flag=false
        }

    }

    function cancel(){       
        let flag

        if($('input[name=to]').val() || $('input[name=bcc]').val() || $('input[name=cc]').val() || $('input[name=subject]').val() || $('input[name=content]').val() || $('textarea[name=content]').val()){
            flag= 1
        }
        else{
            flag= 0
        }

        send(flag,'cancel')
        
    }

    function resetCompose(){
        $('form').trigger('reset')
        $('input[name=to]').prop('placeholder','')
        if(!$('.cc').hasClass('hide-item')){
            $('.cc').addClass('hide-item')
        }
        if(!$('.bcc').hasClass('hide-item')){
            $('.bcc').addClass('hide-item')
        }
    }

    </script>
@endpush