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
                    <li class="breadcrumb-item"><a href="{{route('blogs.index')}}">{{ $page }}</a></li>
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
        <a class="btn btn-dark btn-sm btn-flat float-right" href="{{route('blogs.index')}}"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
    </div>
    <form method="post" action="{{ route('blogs.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $blog->id ?? '' }}">
        <div class="card-body">
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" name="date" id="date" tabindex="1" class="form-control datetimepicker-input" data-target="#reservationdate" value="{{ old('date', isset($blog) ? \Carbon\Carbon::parse($blog->date)->format('d/m/Y') : now()->format('d/m/Y')) }}" />
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            @if ($errors->has('date'))
                              <span class="text-danger">{{ $errors->first('date') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Heading</label>
                        <input type="text" name="heading" tabindex="2" class="form-control" value="{{ !empty($blog->heading) ? $blog->heading : '' }}">
                        @if ($errors->has('heading'))
                          <span class="text-danger">{{ $errors->first('heading') }}</span>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Details</label>
                        <textarea style="height: 100px;" name="details" id="details" tabindex="3" class="form-control">{!! old('details', $blog->details ?? '') !!}</textarea>
                        @if ($errors->has('details'))
                          <span class="text-danger">{{ $errors->first('details') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Keywords</label>
                        <textarea style="height: 100px;" name="keyword" tabindex="4" class="form-control">{{ old('keyword', $blog->keyword ?? '') }}</textarea>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="customFile">Image</label>
                        <div id="photo_preview2" class="mt-2">
                            @if(!empty($blog->image))
                                <img src="{{ asset('storage/blogs/'.$blog->image) }}" style="width: 150px; height: 150px; margin: 5px;">
                            @else
                                <img src="{{ asset('uploads/avatar.png') }}" style="width: 150px; height: 150px;">
                            @endif
                        </div><br>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile2" tabindex="5" name="image">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="card-footer" align="center">
            <button type="submit" id="submitBtn" tabindex="6" class="btn btn-primary  btn-flat"><i class="fas fa-save"></i> Save</button>
            <button type="reset" value="Reset" id="resetbtn" tabindex="p" class="btn btn-secondary  btn-flat"><i class="fas fa-undo-alt"></i> Reset</button>
            
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
$(function () {
    bsCustomFileInput.init();
     $('#customFile2').on('change', function() {
        let previewContainer = $('#photo_preview2');
        previewContainer.html('');

        Array.from(this.files).forEach(file => {
            let reader = new FileReader();
            reader.onload = function (e) {
                previewContainer.append(
                    `<img src="${e.target.result}" style="width: 150px; height: 150px; margin: 5px;">`
                );
            }
            reader.readAsDataURL(file);
        });

        let fileName = Array.from(this.files).map(f => f.name).join(', ');
        $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
    });
    
    $.validator.setDefaults({
        submitHandler: function (form) {
            $('#submitBtn').prop('disabled', true); // Disable the submit button
            form.submit();
        }
    });
});

$(document).ready(function() {
    $('#reservationdate').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    // Summernote
    $('#details').summernote({
        height: 170 // Set height in pixels (adjust as needed)
    });
});
</script>
@endsection