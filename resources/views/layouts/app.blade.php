<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bloomora Admin')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/datatables/datatables.min.css') }}">

    @vite(['resources/sass/app.scss'])
    @stack('styles')
</head>

<body>

    <div class="d-flex">

        @include('layouts.inc.sidebar')

        <div class="flex-fill d-flex flex-column" style="min-height: 100vh;">

            @include('layouts.inc.navbar_admin')

            <main class="p-4 flex-fill">
                @yield('content')
            </main>

            @include('layouts.inc.footer')

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No data available",
                    zeroRecords: "No matching records found",
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                }
            });
        });
    </script>

    <script>
        let previousOrderCount = null;

        function checkNewOrders() {
            fetch('{{ route('admin.notifications.orders') }}')
                .then(response => response.json())
                .then(data => {

                    const badge = document.getElementById('orderNotificationBadge');

                    if (!badge) return;

                    const currentCount = data.count;

                    // Tampilkan / sembunyikan badge
                    if (currentCount > 0) {
                        badge.textContent = currentCount > 99 ? '99+' : currentCount;
                        badge.classList.remove('d-none');
                    } else {
                        badge.classList.add('d-none');
                    }

                    if (previousOrderCount === null) {
                        previousOrderCount = currentCount;
                        return;
                    }

                    if (currentCount > previousOrderCount) {

                        if (Notification.permission === 'granted') {
                            new Notification('Bloomora', {
                                body: 'Ada pesanan baru yang masuk!',
                                icon: '{{ asset('img/logo2.jpeg') }}'
                            });
                        }

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'info',
                            title: 'Pesanan baru masuk!',
                            text: 'Ada pesanan baru yang perlu diproses.',
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true
                        });
                    }

                    previousOrderCount = currentCount;
                })
                .catch(error => {
                    console.error('Gagal mengecek pesanan:', error);
                });
        }

        checkNewOrders();

        setInterval(checkNewOrders, 10000); <
        script >
            document.getElementById('orderNotificationLink')?.addEventListener('click', function() {
                const badge = document.getElementById('orderNotificationBadge');

                if (badge) {
                    badge.classList.add('d-none');
                    badge.textContent = '0';
                }

                previousOrderCount = 0;
            });
    </script>

    @stack('scripts')

    @if (Session::has('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ Session::get('success') }}",
                    icon: "success"
                });
            });
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Gagal!",
                    text: "{{ Session::get('error') }}",
                    icon: "error"
                });
            });
        </script>
    @endif

</body>

</html>
