@extends('layouts.backend')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
    <div class="col-12">
        <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary d-flex justify-content-between shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Mailbox</h6>
            </div>
            <div class="row m-4">
                <div class="col-md-3">
                    @include('mailbox.include.sidebar')
                </div>
                <div class="col-md-9">
                    @yield('mailbox-content')
                </div>
            </div>
            
        </div>
    </div>
    </div>
</div>

@include('mailbox.include.compose')
@endsection