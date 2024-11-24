@if (Auth::check())
    <script>
        @php
            $roleRoutes = [
                'admin' => route('filament.admin.pages.dashboard'),
                'user' => route('dashboard'),
            ];

            // Menentukan rute dashboard berdasarkan role
            $dashboardRoute = $roleRoutes[Auth::user()->role] ?? route('dashboard');
        @endphp

        // Melakukan redirect ke halaman dashboard yang sesuai
        window.location.href = "{{ $dashboardRoute }}";
    </script>
@else
    <script>
        // Jika pengguna belum login, arahkan ke halaman login
        window.location.href = "{{ route('login') }}";
    </script>
@endif
