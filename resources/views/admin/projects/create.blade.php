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
                    <li class="breadcrumb-item"><a href="{{route('projects.index')}}">{{ $page }}</a></li>
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
        <h3 class="card-title"><i class="far fa-image"></i> {{$title}}</h3>
        <a class="btn btn-dark btn-sm btn-flat float-right" href="{{route('projects.index')}}"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
    </div>
    @error('category_id.0')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    <form id="projectForm" method="post" action="{{ route('projects.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $project->id ?? '' }}">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Project-Name</label>
                        <input type="text" name="name" tabindex="1" class="form-control" value="{{ old('name', $project->name ?? '') }}">
                        @if ($errors->has('name'))
                          <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Project-Name [Arabic]</label>
                        <input type="text" name="name_ar" tabindex="2" class="form-control" value="{{ old('name_ar', $project->name_ar ?? '') }}" style="direction: rtl; text-align: right;">
                        @if ($errors->has('name_ar'))
                          <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Keywords</label>
                        <textarea style="height: 100px;" name="keyword" tabindex="3" class="form-control">{{ !empty($project->keyword) ? $project->keyword : '' }}</textarea>
                    </div>
                </div>
            </div>  
            <hr class="my-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customFile">Desktop Image</label>
                        <div id="photo_preview1" class="mt-2">
                            @if(!empty($project->desktop_image))
                                <img src="{{ asset('storage/projects/'.$project->desktop_image) }}" style="width: 150px; height: 150px; margin: 5px;">
                            @else
                                <img src="{{ asset('uploads/avatar.png') }}" style="width: 150px; height: 150px;">
                            @endif
                        </div><br>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile1" tabindex="4" name="desktop_image">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            @if ($errors->has('desktop_image'))
                            <span class="text-danger">{{ $errors->first('desktop_image') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Image Alt-Tag</label>
                        <input type="text" name="image_alt_tag" tabindex="5" class="form-control" value="{{ old('image_alt_tag', $project->image_alt_tag ?? '') }}">
                        @if ($errors->has('image_alt_tag'))
                            <span class="text-danger">{{ $errors->first('image_alt_tag') }}</span>
                        @endif
                    </div>
                </div>  
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Meta Title</label>
                        <input type="text" name="meta_title" tabindex="6" class="form-control" value="{{ old('meta_title', $project->meta_title ?? '') }}">
                        @if ($errors->has('meta_title'))
                            <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                        @endif
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Meta Description</label>
                        <textarea style="height: 100px;" name="meta_description" tabindex="7" class="form-control">{{ !empty($project->meta_description) ? $project->meta_description : '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer" align="center">
            <button type="submit" id="submitBtn" tabindex="8" class="btn btn-primary  btn-flat"><i class="fas fa-save"></i> Save</button>
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
</script>
@endsection