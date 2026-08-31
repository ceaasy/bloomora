@extends('layouts.app')

@section('title', 'Data Admin - Bloomora')
@section('page-title', 'ADMIN PAGE')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="color: #4A3F3F;">Data Admin</h1>
        <a href="{{ route('admin.admin.create') }}" class="btn text-white"
            style="background-color: #9C2B3A; border-color: #9C2B3A;">
            <span class="fa fa-plus-circle me-1"></span> Create New
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/default-avatar.png') }}"
                                    alt="Foto {{ $user->name }}" width="40" height="40" class="rounded-circle"
                                    style="object-fit: cover;">
                            </td>
                            <td>
                                <a href="{{ route('admin.admin.show', encrypt($user->id)) }}"
                                    class="btn btn-link text-dark p-0 mx-2">
                                    <span class="fa fa-eye"></span>
                                </a>
                                <a href="{{ route('admin.admin.edit', encrypt($user->id)) }}" class="btn btn-link p-0 mx-2"
                                    style="color: #0d6efd;">
                                    <span class="fa fa-edit"></span>
                                </a>
                                <a href="#"
                                    onclick="handleDestroy('{{ route('admin.admin.destroy', encrypt($user->id)) }}')"
                                    class="btn btn-link text-danger p-0 mx-2">
                                    <span class="fa fa-trash"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form id="form-destroy" action="" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script type="text/javascript">

        function handleDestroy(url) {
            Swal.fire({
                title: "Apakah anda menghapus?",
                text: "Kamu tidak bisa mengembalikan data yang sudah dihapus",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-destroy').attr('action', url);
                    $('#form-destroy').submit();
                };
            });

            // if (confirm('Apakah kamu akan menghapus data?')) {
            //     $('#form-destroy').attr('action', url);
            //     $('#form-destroy').submit();
            // }
        }
    </script>

    @if (Session::has('success'))
        <script type="text/javascript">
            Swal.fire({
                title: "Berhasil!",
                text: "{{ Session::get('success') }}",
                icon: "success",
                draggable: true
            });
        </script>
    @endif
@endpush
