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
                    <li class="breadcrumb-item"><a href="{{route('services.index')}}">Services</a></li>
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
        <a class="btn btn-dark btn-sm btn-flat float-right" href="{{route('services.index')}}"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
    </div>
    <form method="post" action="{{ route('services.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $service->id ?? '' }}">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" tabindex="1" class="form-control" value="{{ !empty($service->name) ? $service->name : '' }}">
                        @if ($errors->has('name'))
                          <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Name [Arabic]</label>
                        <input type="text" name="name_ar" tabindex="2" class="form-control" value="{{ !empty($service->name_ar) ? $service->name_ar : '' }}" style="direction: rtl; text-align: right;">
                        @if ($errors->has('name_ar'))
                          <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                        @endif
                    </div>
                </div>

                 <div class="col-md-12">
                    <div class="form-group">
                        <label>Details</label>
                        <textarea style="height: 100px;" name="details" id="details" tabindex="3" class="form-control">{!! old('details', $service->details ?? '') !!}</textarea>
                        @if ($errors->has('details'))
                          <span class="text-danger">{{ $errors->first('details') }}</span>
                        @endif
                    </div>
                </div>

                 <div class="col-md-12">
                    <div class="form-group">
                        <label>Details [Arabic]</label>
                        <textarea style="height: 100px;" name="details_ar" id="details_ar" tabindex="4" class="form-control">{!! old('details_ar', $service->details_ar ?? '') !!}</textarea>
                        @if ($errors->has('details_ar'))
                          <span class="text-danger">{{ $errors->first('details_ar') }}</span>
                        @endif
                    </div>
                </div>

                 <div class="col-md-12">
                    <div class="form-group">
                        <label>Meta Title</label>
                        <textarea style="height: 100px;" name="meta_title" tabindex="5" class="form-control">{{ !empty($service->meta_title) ? $service->meta_title : '' }}</textarea>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Meta Description</label>
                        <textarea style="height: 100px;" name="description" id="description" tabindex="6" class="form-control">{{ !empty($service->description) ? $service->description : '' }}</textarea>
                        @if ($errors->has('description'))
                          <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                </div>

                 <div class="col-md-12">
                    <div class="form-group">
                        <label>Keywords</label>
                        <textarea style="height: 100px;" name="keyword" tabindex="7" class="form-control">{{ !empty($service->keyword) ? $service->keyword : '' }}</textarea>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="customFile">Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile2" tabindex="8" name="image">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div><br>
                        <div id="photo_preview2" class="mt-2">
                            @if(!empty($service->image))
                                <img src="{{ asset('storage/services/'.$service->image) }}" style="width: 150px; height: 150px; margin: 5px;">
                            @else
                                <img src="{{ asset('uploads/avatar.png') }}" style="width: 150px; height: 150px;">
                            @endif
                        </div>
                    </div>
                </div>

                 <div class="col-md-8">
                    <div class="form-group">
                        <label>Image Alt-Tag</label>
                        <input type="text" name="image_alt_tag" tabindex="9" class="form-control" value="{{ !empty($service->image_alt_tag) ? $service->image_alt_tag : '' }}">
                        @if ($errors->has('image_alt_tag'))
                          <span class="text-danger">{{ $errors->first('image_alt_tag') }}</span>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        <div class="card-footer" align="center">
            <button type="submit" id="submitBtn" tabindex="10" class="btn btn-primary  btn-flat"><i class="fas fa-save"></i> Save</button>
            <button type="reset" value="Reset" id="resetbtn" tabindex="p" class="btn btn-secondary  btn-flat"><i class="fas fa-undo-alt"></i> Reset</button>
            
        </div>
    </form>
</div>
@endsection

@section('scripts')
<style>
    /* Only apply Arabic font to this specific Summernote editor */
    #details_ar + .note-editor .note-editable {
        font-family: 'Tajawal', sans-serif !important;
        direction: rtl !important;
        text-align: right !important;
    }
</style>
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

// Summernote
    $('#details').summernote({
        height: 170 // Set height in pixels (adjust as needed)
    });
    $('#details_ar').summernote({
        height: 170
    });
    
</script>
@endsection