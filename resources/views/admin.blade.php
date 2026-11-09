<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#DE0171">
    <title inertia>{{ config('app.name', 'Nirwana Tour Lampung') }} - Admin Portal</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/Logo-Nirwana.png') }}">

    <!-- Google Fonts & Font Awesome 6 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    @inertiaHead
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-800 selection:bg-[#DE0171] selection:text-white">
    @inertia
</body>
</html>
