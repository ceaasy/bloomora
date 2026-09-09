@extends('layouts.app')

@section('title', 'Review Page - Admin')
@section('page-title', 'REVIEW')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="color: #4A3F3F;">Daftar Ulasan</h1>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Photo</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $review->customer->name }}</td>
                            <td>{{ $review->product->name }}</td>
                            <td>
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="fa fa-star"
                                        style="color: {{ $i <= $review->rating ? '#f0ad4e' : '#ccc' }};"></span>
                                @endfor
                            </td>
                            <td>{{ $review->comment ?? '-' }}</td>
                            <td>
                                @if ($review->photo)
                                    <img src="{{ asset('storage/' . $review->photo) }}" alt="foto ulasan"
                                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 6px;">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($review->is_visible)
                                    <span class="badge" style="background-color: #d4edda; color: #155724;">Visible</span>
                                @else
                                    <span class="badge" style="background-color: #f8d7da; color: #721c24;">Hidden</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.reviewmanagements.show', $review->id) }}"
                                    class="btn btn-link text-dark p-0 mx-2">
                                    <span class="fa fa-eye"></span>
                                </a>

                                <form action="{{ route('admin.reviewmanagements.toggle', $review->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm"
                                        style="background-color: {{ $review->is_visible ? '#f8d7da' : '#d4edda' }}; border: none;">
                                        {{ $review->is_visible ? 'Sembunyikan' : 'Tampilkan' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        @if (Session::has('success'))
            Swal.fire({
                title: "Berhasil!",
                text: "{{ Session::get('success') }}",
                icon: "success",
                draggable: true
            });
        @endif
    </script>
@endpush
