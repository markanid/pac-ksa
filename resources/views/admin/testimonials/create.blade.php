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
                    <li class="breadcrumb-item"><a href="{{route('testimonials.index')}}">{{ $page }}</a></li>
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
        <a class="btn btn-dark btn-sm btn-flat float-right" href="{{route('testimonials.index')}}"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
    </div>
    <form method="post" action="{{ route('testimonials.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $testimonial->id ?? '' }}">
        <div class="card-body">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Client-Name</label>
                        <input type="text" name="client_name" tabindex="1" class="form-control" value="{{ !empty($testimonial->client_name) ? $testimonial->client_name : '' }}">
                        @if ($errors->has('client_name'))
                          <span class="text-danger">{{ $errors->first('client_name') }}</span>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Position</label>
                        <input type="text" name="position" tabindex="2" class="form-control" value="{{ !empty($testimonial->position) ? $testimonial->position : '' }}">
                        @if ($errors->has('position'))
                          <span class="text-danger">{{ $errors->first('position') }}</span>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Company-Name</label>
                        <input type="text" name="company" tabindex="3" class="form-control" value="{{ !empty($testimonial->company) ? $testimonial->company : '' }}">
                        @if ($errors->has('company'))
                          <span class="text-danger">{{ $errors->first('company') }}</span>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="message" id="message" tabindex="4" class="form-control">{!! old('message', $testimonial->message ?? '') !!}</textarea>
                        @if ($errors->has('message'))
                          <span class="text-danger">{{ $errors->first('message') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="customFile">Image</label>
                        <div id="photo_preview2" class="mt-2">
                            @if(!empty($testimonial->image))
                                <img src="{{ asset('storage/testimonials/'.$testimonial->image) }}" style="width: 150px; height: 150px; margin: 5px;">
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

$(function () {
    // Summernote
    $('#message').summernote({
        height: 170 // Set height in pixels (adjust as needed)
    });

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })

$(document).ready(function() {
    $('#reservationdate').datetimepicker({
        format: 'DD/MM/YYYY'
    });
});
</script>
@endsection