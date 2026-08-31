@extends('layouts.app')

@section('title', 'Data Product - Bloomora')
@section('page-title', 'PRODUCT PAGE')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="color: #4A3F3F;">Data Product</h1>
        <a href="{{ route('admin.products.create') }}" class="btn text-white"
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
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Stock</th>
                            <th>Price (S)</th>
                            <th>Price (M)</th>
                            <th>Price (L)</th>
                            <th>Customization Options</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if ($product->photo)
                                        <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}"
                                            width="50" height="50" style="object-fit: cover;">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category }}</td>
                                <td title="{{ $product->description }}">{{ Str::limit($product->description, 40) }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>Rp. {{ number_format($product->price_small, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($product->price_medium, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($product->price_large, 0, ',', '.') }}</td>
                                <td>
                                    @if ($product->customization_options && count($product->customization_options) > 0)
                                        <ul class="mb-0 ps-3">
                                            @foreach (array_slice($product->customization_options, 0, 2) as $option)
                                                <li>{{ $option['name'] }} +Rp.
                                                    {{ number_format($option['price'], 0, ',', '.') }}</li>
                                            @endforeach
                                            @if (count($product->customization_options) > 2)
                                                <li class="text-muted">+{{ count($product->customization_options) - 2 }}
                                                    lainnya</li>
                                            @endif
                                        </ul>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.products.show', encrypt($product->id)) }}"
                                        class="btn btn-link text-dark p-0 mx-2">
                                        <span class="fa fa-eye"></span>
                                    </a>
                                    <a href="{{ route('admin.products.edit', encrypt($product->id)) }}"
                                        class="btn btn-link p-0 mx-2" style="color: #0d6efd;">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                    <a href="#"
                                        onclick="handleDestroy('{{ route('admin.products.destroy', encrypt($product->id)) }}')"
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
