@extends('layouts.backend')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                @if(session('Successfully-Uploaded'))
                <div class="alert alert-success alert-dismissible text-white" role="alert">
                <span class="text-sm success-message">{{session('Successfully-Uploaded')}}</span>
                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                @endif
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Upload File</h6>
                </div>
                </div>
            <div class="card-body">
            <form class="was-validated" method="POST" action="{{ route('upload-employee-csv') }}" enctype="multipart/form-data">
                @csrf
                <!--  -->
                <div class="mb-3">
                    <input type="file" class="form-control" name="file" aria-label="file example" required>
                    <div class="invalid-feedback">Please Choose CSV file for upload</div>
                </div>

                <div class="mb-3 text-center">
                    <button class="btn btn-primary Data_add" type="submit">Upload </button>
                </div>
            </form>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection