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
                    <li class="breadcrumb-item"><a href="{{route('testimonials.index')}}">{{$page}}</a></li>
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
        <h3 class="card-title"><i class="fas fa-users"></i> View {{$page}}</h3>  
        <div class="ml-auto"> 
            <a href="{{ route('testimonials.create') }}" class="btn btn-sm btn-primary"> <i class="fas fa-plus-circle"></i> Create</a> &nbsp;
            <a href="{{ route('testimonials.edit', ['id' => $testimonial->id]) }}" class="btn btn-sm btn-info"> <i class="fas fa-pencil-alt"></i> Edit</a> &nbsp;
            <a href="{{ route('testimonials.index') }}" class="btn btn-sm btn-dark"> <i class="fa fa-arrow-circle-left"></i> Back</a> &nbsp;
        </div> 
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" style="margin-bottom: 10px;">
                <tbody>
                    <tr>
                        <td style="background-color:#096ca5; color:#fff;">Client-Name</td>
                        <td><b style="color:#096ca5;">{{ $testimonial->client_name }}</b>
                        </td>
                    </tr>
                </tbody>
            </table>
       </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <div>
                                @if(!empty($testimonial) && !empty($testimonial->image))
                                    <p><img src="{{asset('storage/testimonials/'.$testimonial->image)}}" alt="Testimonials Photo" style="width: 150px; height: 150px;"></p>
                                @else
                                    <p><img src="{{asset('uploads/employees/avatar.png')}}" alt="Testimonials Photo" style="width: 150px; height: 150px;"></p>
                                @endif 
                            </div>
                        </td>
                        <td>
                            <span>Company :</span>
                            <label>{{ $testimonial->company }}</label>
                        </td>
                        <td>
                            <span>Position :</span>
                            <label>{{ $testimonial->position }}</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <span>Description :</span>
                            <label>{!! $testimonial->message !!}</label>
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

        var table = $("#applicant_table").DataTable({
            "responsive": false, "lengthChange": true, "autoWidth": false, scrollX: true,
            "buttons": [
                {
                    extend: 'copy',
                    title: exportTitle,
                    filename: exportFilename,
                    text: 'Copy',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'csv',
                    title: exportTitle,
                    filename: exportFilename,
                    text: 'CSV',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'excel',
                    title: exportTitle,
                    filename: exportFilename,
                    text: 'Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'pdf',
                    title: exportTitle,
                    filename: exportFilename,
                    text: 'PDF',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'print',
                    title: exportTitle,
                    text: 'Print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'colvis',
                    text: 'Column Visibility'
                }
            ]
        }).buttons().container().appendTo('#applicant_table_wrapper .col-md-6:eq(0)');
        
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