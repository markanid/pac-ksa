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
                    <li class="breadcrumb-item"><a href="{{route('sliders.index')}}">{{$page}}</a></li>
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
        <a class="btn btn-dark btn-sm btn-flat float-right" href="{{ route('sliders.index') }}"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
    </div>
    <form method="post" action="{{ route('sliders.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $sliders->id ?? '' }}">
        <div class="card-body">
            <div class="row">

               <div class="col-md-6">
                    <div class="form-group">
                        <label>title </label>
                        <input type="text" name="title" tabindex="2" class="form-control" value="{{ !empty($sliders->title) ? $sliders->title : '' }}">
                        @if ($errors->has('title'))
                          <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                </div>

               
                 
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Heading 1</label>
                        <input type="text" name="heading_1" tabindex="2" class="form-control" value="{{ !empty($sliders->heading_1) ? $sliders->heading_1 : '' }}">
                        @if ($errors->has('heading_1'))
                          <span class="text-danger">{{ $errors->first('heading_1') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Heading 2</label>
                        <input type="text" name="heading_2" tabindex="2" class="form-control" value="{{ !empty($sliders->heading_2) ? $sliders->heading_2 : '' }}">
                        @if ($errors->has('heading_2'))
                          <span class="text-danger">{{ $errors->first('heading') }}</span>
                        @endif
                    </div>
                </div>

                 <div class="col-md-6">
    <div class="form-group">
        <label>Sector</label>
        <select name="section" tabindex="6" class="form-control">
          
            <option value="Team" {{ old('sector', $project->section ?? '') == '' ? 'selected' : '' }}>Team</option>
           
        </select>
        @if ($errors->has('section'))
            <span class="text-danger">{{ $errors->first('section') }}</span>
        @endif
    </div>
</div>
               <div class="col-md-3">
                   <div class="form-group">
                       <label for="customFile">Image</label>
                       <div id="photo_preview2" class="mt-2">
                           @if(!empty($sliders->image))
                               <img src="{{ asset('storage/sliders/'.$sliders->image) }}" style="width: 150px; height: 150px; margin: 5px;">
                           @else
                               <img src="{{ asset('uploads/avatar.png') }}" style="width: 150px; height: 150px;">
                           @endif
                       </div><br>
                       <div class="input-group">
                           <div class="custom-file">
                               <input type="file" class="custom-file-input" id="customFile2" tabindex="6" name="image">
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
            <button type="submit" id="submitBtn" tabindex="7" class="btn btn-primary  btn-flat"><i class="fas fa-save"></i> Save</button>
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

    // Summernote
    $('#our_journey').summernote({
        height: 170 // Set height in pixels (adjust as needed)
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