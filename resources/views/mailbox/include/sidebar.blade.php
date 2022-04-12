<div class="card h-100">
    <div class="card-header d-flex justify-content-center m-2 p-0">
        <button class="btn m-0 p-2" data-bs-toggle="modal" data-bs-target="#AddMail"> <h5>Compose</h5> </button>
    </div>
    <div class="card-body">
        <ul class="p-0 text-center list-unstyled">
            <a href="{{route('mailbox')}}" class="m-3">
                <li class="list-group-item">
                    Inbox
                </li>
            </a>
            <a href="" class="m-3">
                <li class="list-group-item">
                    Marked              
                </li>
            </a>
            <a href="{{route('draft')}}" class="m-3">
                <li class="list-group-item">
                    Draft             
                </li>
            </a> 
            <a href="{{route('sent')}}" class="m-3">
                <li class="list-group-item">
                    Sent           
                </li>
            </a>   
        </ul>
    </div>
    
</div>
