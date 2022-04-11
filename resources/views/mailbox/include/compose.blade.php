
<div class="modal fade" id="AddMail" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">New Message
                <button class="btn-close float-right mail-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>  
            <div class="modal-body">
                            <div>
                                <span>To:</span>
                                <input type="text" name="to" class="w-80 border-0"> <span id="cc">Cc: </span><span id="bcc"> Bcc:</span>
                            </div>
                            <div class="cc hide-item">
                                <hr>
                                <span>Cc:</span>
                                <input type="text" name="cc" class="w-90 border-0">
                                <button class="btn-close cc-close w-0"></button>
                            </div>
                            <div class="bcc hide-item">
                                <hr>
                                <span>Bcc:</span>
                                <input type="text" name="bcc" class="w-90 border-0">
                                <button class="btn-close bcc-close w-0"></button>
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
                                <button class="btn btn-primary" onclick="send()">Send</button>
                            </div>
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

    function send(){
        const flag=Validation()
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
    </script>
@endpush