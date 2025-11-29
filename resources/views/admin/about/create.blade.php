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
                    <li class="breadcrumb-item"><a href="{{route('about.index')}}">{{$page}}</a></li>
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
        <a class="btn btn-dark btn-sm btn-flat float-right" href="{{ route('about.index') }}"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
    </div>
    <form method="post" action="{{ route('about.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $about->id ?? '' }}">
        <div class="card-body">
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                       <label>Welcome Message<sup>*</sup></label>
                       <textarea name="welcome" id="welcome" tabindex="1" class="form-control">{{ !empty($about->welcome) ? $about->welcome : '' }}</textarea>
                       @if ($errors->has('welcome'))
                         <span class="text-danger">{{ $errors->first('welcome') }}</span>
                       @endif
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                       <label>Welcome Message - Arabic<sup>*</sup></label>
                       <textarea name="welcome_ar" id="welcome_ar" tabindex="2" class="form-control" style="direction: rtl; text-align: right;">{{ !empty($about->welcome_ar) ? $about->welcome_ar : '' }}</textarea>
                       @if ($errors->has('welcome_ar'))
                         <span class="text-danger">{{ $errors->first('welcome_ar') }}</span>
                       @endif
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                       <label>Health & Safty Policy<sup>*</sup></label>
                       <textarea name="glimbse" id="glimbse" tabindex="3" class="form-control">{{ !empty($about->glimbse) ? $about->glimbse : '' }}</textarea>
                       @if ($errors->has('glimbse'))
                         <span class="text-danger">{{ $errors->first('glimbse') }}</span>
                       @endif
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                       <label>Health & Safty Policy - Arabic<sup>*</sup></label>
                       <textarea name="glimbse_ar" id="glimbse_ar" tabindex="4" class="form-control" style="direction: rtl; text-align: right;">{{ !empty($about->glimbse_ar) ? $about->glimbse_ar : '' }}</textarea>
                       @if ($errors->has('glimbse_ar'))
                         <span class="text-danger">{{ $errors->first('glimbse_ar') }}</span>
                       @endif
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                       <label>Our Journey<sup>*</sup></label>
                       <textarea name="our_journey" id="our_journey" tabindex="5" class="form-control">{!! old('our_journey', $about->our_journey ?? '') !!}</textarea>
                       @if ($errors->has('our_journey'))
                         <span class="text-danger">{{ $errors->first('our_journey') }}</span>
                       @endif
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                       <label>Our Journey - Arabic<sup>*</sup></label>
                       <textarea name="our_journey_ar" id="our_journey_ar" tabindex="6" class="form-control" style="direction: rtl; text-align: right;">{!! old('our_journey_ar', $about->our_journey_ar ?? '') !!}</textarea>
                       @if ($errors->has('our_journey_ar'))
                         <span class="text-danger">{{ $errors->first('our_journey_ar') }}</span>
                       @endif
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                       <label>Vision<sup>*</sup></label>
                       <textarea name="vision" id="vision" tabindex="7" class="form-control">{{ !empty($about->vision) ? $about->vision : '' }}</textarea>
                       @if ($errors->has('vision'))
                         <span class="text-danger">{{ $errors->first('vision') }}</span>
                       @endif
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                       <label>Vision - Arabic<sup>*</sup></label>
                       <textarea name="vision_ar" id="vision_ar" tabindex="8" class="form-control" style="direction: rtl; text-align: right;">{{ !empty($about->vision_ar) ? $about->vision_ar : '' }}</textarea>
                       @if ($errors->has('vision_ar'))
                         <span class="text-danger">{{ $errors->first('vision_ar') }}</span>
                       @endif
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                       <label>Our Commitment & Collaboration<sup>*</sup></label>
                       <textarea name="mission" id="mission" tabindex="9" class="form-control">{{ !empty($about->mission) ? $about->mission : '' }}</textarea>
                       @if ($errors->has('mission'))
                         <span class="text-danger">{{ $errors->first('mission') }}</span>
                       @endif
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                       <label>Our Commitment & Collaboration - Arabic<sup>*</sup></label>
                       <textarea name="mission_ar" id="mission_ar" tabindex="10" class="form-control" style="direction: rtl; text-align: right;">{{ !empty($about->mission_ar) ? $about->mission_ar : '' }}</textarea>
                       @if ($errors->has('mission_ar'))
                         <span class="text-danger">{{ $errors->first('mission_ar') }}</span>
                       @endif
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                       <label>Why Choose Us<sup>*</sup></label>
                       <textarea name="whychoose" id="whychoose" tabindex="11" class="form-control">{{ !empty($about->whychoose) ? $about->whychoose : '' }}</textarea>
                       @if ($errors->has('whychoose'))
                         <span class="text-danger">{{ $errors->first('whychoose') }}</span>
                       @endif
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                       <label>Why Choose Us - Arabic<sup>*</sup></label>
                       <textarea name="whychooseus_ar" id="whychooseus_ar" tabindex="12" class="form-control" style="direction: rtl; text-align: right;">{{ !empty($about->whychooseus_ar) ? $about->whychooseus_ar : '' }}</textarea>
                       @if ($errors->has('whychooseus_ar'))
                         <span class="text-danger">{{ $errors->first('whychooseus_ar') }}</span>
                       @endif
                   </div>
               </div>

               
               <div class="col-md-3">
                   <div class="form-group">
                       <label for="customFile">Image</label>
                       <div id="photo_preview2" class="mt-2">
                           @if(!empty($about->image))
                               <img src="{{ asset('storage/abouts/'.$about->image) }}" style="width: 150px; height: 150px; margin: 5px;">
                           @else
                               <img src="{{ asset('uploads/avatar.png') }}" style="width: 150px; height: 150px;">
                           @endif
                       </div><br>
                       <div class="input-group">
                           <div class="custom-file">
                               <input type="file" class="custom-file-input" id="customFile2" tabindex="13" name="image">
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
            <button type="submit" id="submitBtn" tabindex="14" class="btn btn-primary  btn-flat"><i class="fas fa-save"></i> Save</button>
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
    $('#our_journey_ar').summernote({
        height: 170,
        callbacks: {
            onInit: function() {
                $('#our_journey_ar').next().find('.note-editable')
                    .css('direction', 'rtl')
                    .css('text-align', 'right');
            }
        }
    });
    $('#whychoose').summernote({
        height: 170 // Set height in pixels (adjust as needed)
    });
    $('#whychooseus_ar').summernote({
        height: 170,
        callbacks: {
            onInit: function() {
                $('#whychooseus_ar').next().find('.note-editable')
                    .css('direction', 'rtl')
                    .css('text-align', 'right');
            }
        }
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