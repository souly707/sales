<!DOCTYPE html>

<!-- beautify ignore:start -->
<html
lang="ar"
class="light-style layout-menu-fixed"
dir="rtl"
data-theme="theme-default"
data-assets-path="{{ asset('backend') }}/assets/"
data-template="vertical-menu-template-free"
>

    {{-- Head --}}
    @include('partials.backend.head')

<body style=" font-family: 'Noto Kufi Arabic',
sans-serif;">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        {{-- Sidebar --}}
        @include('partials.backend.sidebar')
        {{-- Sidebar --}}

        <!-- Layout container -->
        <div class="layout-page">


        {{-- Navbar --}}
        @include('partials.backend.navbar')
        {{-- / Navbar --}}

        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">

                {{-- @include('partials.backend.flash') --}}
            @yield('content')

            </div>

            {{-- Footer --}}

            @include('partials.backend.footer')

            {{-- / Footer --}}

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    @include('partials.backend.scripts')
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>