@extends('layouts.customer')

@section('title', 'Beri Ulasan')

@section('content')
    <div class="container py-4">

        <div class="p-4 rounded-4" style="background-color: #FBE3EC; max-width: 600px; margin: 0 auto;">

            <h4 class="fw-bold mb-4" style="color: #D6336C;">Beri Ulasan</h4>

            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="d-flex align-items-center justify-content-center rounded-3"
                    style="width: 60px; height: 60px; background-color: #FFFAF7; overflow: hidden;">
                    <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}"
                        style="max-width: 100%; max-height: 100%; object-fit: cover;">
                </div>
                <p class="mb-0 fw-semibold" style="color: #4A3F3F;">{{ $product->name }}</p>
            </div>

            <form action="{{ route('customer.reviews.store', [$order->id, $product->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <p class="fw-semibold mb-2" style="color: #4A3F3F;">Rating</p>
                <div class="mb-4" id="ratingStars">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="fa fa-star star-option" data-value="{{ $i }}"
                            style="font-size: 1.5rem; color: #ccc; cursor: pointer;"></span>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="ratingInput" value="">

                <p class="fw-semibold mb-2" style="color: #4A3F3F;">Komentar</p>
                <textarea name="comment" rows="4" class="form-control mb-4" placeholder="Ceritakan pengalaman kamu..."></textarea>

                <p class="fw-semibold mb-2" style="color: #4A3F3F;">Upload Foto (Opsional)</p>
                <input type="file" name="photo" accept="image/*" class="form-control mb-4">

                <div class="d-flex gap-2">
                    <button type="submit" class="btn rounded-pill flex-fill py-2"
                        style="background-color: #D6336C; color: white;">
                        Kirim Ulasan
                    </button>
                    <a href="{{ route('customer.orders.show', $order->id) }}" class="btn rounded-pill flex-fill py-2"
                        style="border: 1px solid #B96F84; color: #B96F84;">
                        Batal
                    </a>
                </div>
            </form>

        </div>

    </div>

    <script>
        let selectedRating = 0;
        const stars = document.querySelectorAll('.star-option');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                selectedRating = this.dataset.value;
                document.getElementById('ratingInput').value = selectedRating;
                updateStars();
            });
        });

        function updateStars() {
            stars.forEach(star => {
                star.style.color = star.dataset.value <= selectedRating ? '#f0ad4e' : '#ccc';
            });
        }
    </script>
@endsection
