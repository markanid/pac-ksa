@extends('admin.layout')

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('features.index')}}">{{$page}}</a></li>
                    <li class="breadcrumb-item active">{{$title}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('body')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-users"></i> Create {{$page}}</h3>
        <a class="btn btn-dark btn-sm btn-flat float-right" href="{{route('features.index')}}"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
    </div>
    <form method="post" action="{{ route('features.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $feature->id ?? '' }}">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" tabindex="1" class="form-control" value="{{ !empty($feature->name) ? $feature->name : '' }}">
                        @if ($errors->has('name'))
                          <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="description" tabindex="2" class="form-control">{{ !empty($feature->description) ? $feature->description : '' }}</textarea>
                        @if ($errors->has('description'))
                          <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        <div class="card-footer" align="center">
            <button type="submit" id="submitBtn" tabindex="3" class="btn btn-primary  btn-flat"><i class="fas fa-save"></i> Save</button>
            <button type="reset" value="Reset" id="resetbtn" tabindex="p" class="btn btn-secondary  btn-flat"><i class="fas fa-undo-alt"></i> Reset</button>
            
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
$(function () {
    bsCustomFileInput.init();
    
    $.validator.setDefaults({
        submitHandler: function (form) {
            $('#submitBtn').prop('disabled', true); // Disable the submit button
            form.submit();
        }
    });
});
</script>
@endsection