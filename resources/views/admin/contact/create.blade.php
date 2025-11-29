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
                    <li class="breadcrumb-item"><a href="{{route('contact.index')}}">{{$page}}</a></li>
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
        <a class="btn btn-dark btn-sm btn-flat float-right" href="{{route('contact.index')}}"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
    </div>
    <form method="post" action="{{ route('contact.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $contact->id ?? '' }}">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Phone</label>
                        <div id="phone-wrapper">
                            @php $phones = json_decode($contact->phones ?? '[]'); @endphp
                            @if (!empty($phones))
                                @foreach ($phones as $index => $phone)
                                    <div class="input-group mb-2">
                                        <input type="text" name="phones[]" tabindex="1" class="form-control" value="{{ $phone }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger remove-phone"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="input-group mb-2">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success add-phone"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            @else
                                <div class="input-group mb-2">
                                    <input type="text" name="phones[]" tabindex="1" class="form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success add-phone"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if ($errors->has('phones'))
                          <span class="text-danger">{{ $errors->first('phones') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Email </label>
                        <input type="text" name="email" tabindex="2" value="{{ old('email', $contact->email ?? '') }}" class="form-control">
                        @if ($errors->has('email'))
                          <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="addresses">Address</label>
                        <div id="address-wrapper">
                            @php 
                                $addresses = json_decode($contact->addresses ?? '[]', true); 
                            @endphp
                            @if (!empty($addresses))
                                @foreach ($addresses as $index => $adr)
                                    <div class="input-group mb-2 address-group">
                                        <div class="w-100 mb-2">
                                            <textarea name="addresses[]" id="addresses" rows="3" class="form-control" tabindex="3">{{ $adr['address'] ?? '' }}</textarea>
                                        </div>
                                        <div class="w-100 mb-2">
                                            <div id="photo_preview_{{ $index }}" class="mb-2">
                                                @if(!empty($addresses[$index]['image']))
                                                    <img src="{{ asset('storage/' . $addresses[$index]['image']) }}" style="width: 150px; height: 150px;">
                                                @endif
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input address-image-input" data-preview="photo_preview_{{ $index }}" name="address_images[]">
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger remove-address"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="input-group mb-2">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success add-address"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            @else
                                <div class="input-group mb-2 address-group">
                                    <div class="w-100 mb-2">
                                        <textarea name="addresses[]" id="addresses" rows="3" class="form-control" tabindex="3"></textarea>
                                    </div>
                                    <div class="w-100 mb-2">
                                        <div id="photo_preview_0" class="mb-2"></div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input address-image-input" data-preview="photo_preview_0" name="address_images[]">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success add-address"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if ($errors->has('addresses'))
                          <span class="text-danger">{{ $errors->first('addresses') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Facebook </label>
                        <input type="text" name="facebook" tabindex="4" value="{{ old('facebook', $contact->facebook ?? '') }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Instagram </label>
                        <input type="text" name="instagram" tabindex="5" value="{{ old('instagram', $contact->instagram ?? '') }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>LinkedIN </label>
                        <input type="text" name="linkedin" tabindex="6" value="{{ old('linkedin', $contact->linkedin ?? '') }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>X [Twitter] </label>
                        <input type="text" name="x" tabindex="7" value="{{ old('x', $contact->x ?? '') }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Location Map </label>
                        <input type="text" name="locations" tabindex="8" value="{{ old('locations', $contact->locations ?? '') }}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer" align="center">
            <button type="submit" id="submitBtn" tabindex="9" class="btn btn-primary  btn-flat"><i class="fas fa-save"></i> Save</button>
            <button type="reset" value="Reset" id="resetbtn" tabindex="p" class="btn btn-secondary  btn-flat"><i class="fas fa-undo-alt"></i> Reset</button>
            
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(function () {
    // Add phone input
    $('.add-phone').click(function () {
        $('#phone-wrapper').append(`
            <div class="input-group mb-2">
                <input type="text" name="phones[]" class="form-control" placeholder="Enter phone number">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-phone"><i class="fas fa-minus"></i></button>
                </div>
            </div>
        `);
    });

    // Remove phone input
    $(document).on('click', '.remove-phone', function () {
        $(this).closest('.input-group').remove();
    });

    // Add map input
    $('.add-address').click(function () {
        const index = $('.address-group').length;
        const newBlock = `
            <div class="input-group mb-2 address-group">
                <div class="w-100 mb-2">
                    <textarea name="addresses[]" rows="3" class="form-control" tabindex="3"></textarea>
                </div>
                <div class="w-100 mb-2">
                    <div id="photo_preview_${index}" class="mb-2"></div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input address-image-input" data-preview="photo_preview_${index}" name="address_images[]">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-address"><i class="fas fa-minus"></i></button>
                </div>
            </div>
        `;
        $('#address-wrapper').append(newBlock);
        bsCustomFileInput.init();
    });

    // Remove map input
    $(document).on('click', '.remove-address', function () {
        $(this).closest('.address-group').remove();
    });

    // Preview selected image
    $(document).on('change', '.address-image-input', function () {
        let previewId = $(this).data('preview');
        let previewContainer = $('#' + previewId);
        previewContainer.html('');

        Array.from(this.files).forEach(file => {
            let reader = new FileReader();
            reader.onload = function (e) {
                previewContainer.append(
                    `<img src="${e.target.result}" style="width: 150px; height: 150px; margin: 5px;">`
                );
            };
            reader.readAsDataURL(file);
        });

        let fileName = Array.from(this.files).map(f => f.name).join(', ');
        $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
    });
});

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