@extends('layouts.app')

@section('title', 'Detail - Product Page')
@section('page-title', 'PRODUCT PAGE')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail - Product page</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>No</th>
                            <td>{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <th width="180">Photo</th>
                            <td>
                                @if ($product->photo)
                                    <img src="{{ asset('storage/' . $product->photo) }}" alt="Foto {{ $product->name }}"
                                        width="80" height="80" class="rounded" style="object-fit: cover;">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th width="180">Name</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>{{ $product->category }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $product->description ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>{{ $product->stock }}</td>
                        </tr>
                        <tr>
                            <th>Price (S)</th>
                            <td>Rp. {{ number_format($product->price_small, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Price (M)</th>
                            <td>Rp. {{ number_format($product->price_medium, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Price (L)</th>
                            <td>Rp. {{ number_format($product->price_large, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Customization Options</th>
                            <td>
                                @if ($product->customization_options && count($product->customization_options) > 0)
                                    <ul class="mb-0 ps-3">
                                        @foreach ($product->customization_options as $option)
                                            <li>{{ $option['name'] }} +Rp.
                                                {{ number_format($option['price'], 0, ',', '.') }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Terdaftar Pada</th>
                            <td>{{ $product->created_at->format('d F Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Diperbarui Pada</th>
                            <td>{{ $product->updated_at->format('d F Y H:i:s') }}</td>
                        </tr>
                    </table>
                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.products.index') }}" class="btn text-white"
                        style="background-color: #6c757d; border-color: #6c757d;">
                        <span class="fa fa-arrow-left"></span>
                        Back
                    </a>
                    <a href="{{ route('admin.products.edit', encrypt($product->id)) }}" class="btn text-white"
                        style="background-color: #0d6efd; border-color: #0d6efd;">
                        <span class="fa fa-edit"></span> Update
                    </a>
                    <a href="#"
                        onclick="handleDestroy('{{ route('admin.products.destroy', encrypt($product->id)) }}')"
                        class="btn btn-danger">
                        <span class="fa fa-trash"></span> Delete
                    </a>
                </div>

            </div>
        </div>
    </div>
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
        }
    </script>
@endpush
