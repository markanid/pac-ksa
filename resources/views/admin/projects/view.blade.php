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
                    <li class="breadcrumb-item"><a href="{{route('projects.index')}}">{{$page}}</a></li>
                    <li class="breadcrumb-item active">{{$title}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('body')
<div class="card card-primary card-outline">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="far fa-image"></i> View {{$page}}</h3>  
        <div class="ml-auto"> 
            <a href="{{ route('projects.create') }}" class="btn btn-sm btn-primary"> <i class="fas fa-plus-circle"></i> Create</a> &nbsp;
            <a href="{{ route('projects.edit', ['id' => $project->id]) }}" class="btn btn-sm btn-info"> <i class="fas fa-pencil-alt"></i> Edit</a> &nbsp;
            <a href="{{ route('projects.index') }}" class="btn btn-sm btn-dark"> <i class="fa fa-arrow-circle-left"></i> Back</a> &nbsp;
        </div> 
    </div>
    <div class="card-body">
        
        <div class="table-responsive">
            <table class="table table-bordered" style="margin-bottom: 10px;">
                <tbody>
                    <tr>
                        <td style="background-color:#096ca5; color:#fff;">Portfolio-Name</td>
                        <td><b style="color:#096ca5;">{{ $project->name }}</b>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td rowspan="2">
                            <span>Desktop Image :</span>
                            <div>
                                @if(!empty($project) && !empty($project->desktop_image))
                                    <img src="{{ asset('storage/projects/' . $project->desktop_image) }}" alt="{{ $project->image_alt_tag }}" class="img-fluid rounded" style="max-height: 200px;">
                                @else
                                    <img src="{{ asset('uploads/employees/avatar.png') }}" alt="Portfolio Photo" class="img-fluid rounded" style="max-height: 200px;">
                                @endif
                            </div>
                        </td>
                        <td rowspan="2">
                            <span>Mobile Image :</span>
                            <div>
                                @if(!empty($project) && !empty($project->mobile_image))
                                    <img src="{{ asset('storage/projects/mobile/' . $project->mobile_image) }}" alt="{{ $project->image_alt_tag }}" class="img-fluid rounded" style="max-height: 200px;">
                                @else
                                    <img src="{{ asset('uploads/employees/avatar.png') }}" alt="Portfolio Photo" class="img-fluid rounded" style="max-height: 200px;">
                                @endif
                            </div>
                        </td>
                        <td>
                            <span>Category :</span>
                            <label>{{ $project->category->name ?? '' }}</label>
                        </td>
                        <td>
                            <span>Published-Date :</span>
                            <label>{{ \Carbon\Carbon::parse($project->date)->format('d/m/Y') ?? '' }}</label>
                        </td>
                        <td>
                            <span>Country :</span>
                            <label>{{ $project->country ?? '' }}</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Industry :</span>
                            <label>{{ $project->industry ?? '' }}</label>
                        </td>
                        <td>
                            <span>Website :</span>
                            <label>{{ $project->website ?? '' }}</label>
                        </td>
                        <td>
                            <span>Keyword :</span>
                            <label>{{ $project->keyword ?? '' }}</label>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <span>Image Alt-Tag :</span>
                            <label>{{ $project->image_alt_tag ?? '' }}</label>
                        </td>
                        <td>
                            <span>Meta Title :</span>
                            <label>{{ $project->meta_title ?? '' }}</label>
                        </td>
                        <td colspan="3">
                            <span>Meta Description :</span>
                            <label>{{ $project->meta_description ?? '' }}</label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                let deleteUrl = this.getAttribute('data-url');
    
                Swal.fire({
                    title: "Are you sure?",
                    text: "This action cannot be undone!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = deleteUrl;
                    }
                });
            });
        });
    });
</script>
<script>
    $(document).ready(function(){
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        
        // Check for the flash message and display the SweetAlert2 popup
        @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            });
        @endif
        @if(session('info'))
            Toast.fire({
                icon: 'info',
                title: '{{ session('info') }}'
            });
        @endif
    });
</script>
@endsection