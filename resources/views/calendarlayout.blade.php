<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Other head content --}}
    @yield('custom-styles') {{-- For custom styles per page --}}
</head>
<body>
    {{-- Page content --}}
    @yield('content')

    {{-- Scripts --}}
    @stack('scripts') {{-- Make sure this is placed before the closing body tag --}}
</body>
</html>
