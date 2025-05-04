<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxStay - Luxury Hotel & Resort</title>
    <meta name="description" content="Experience luxury redefined at LuxStay. Book your perfect stay in our elegant rooms and suites.">
    <meta name="author" content="LuxStay">
    <meta property="og:title" content="LuxStay - Luxury Hotel & Resort">
    <meta property="og:description" content="Experience luxury redefined at LuxStay. Book your perfect stay in our elegant rooms and suites.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://lovable.dev/opengraph-image-p98pqg.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@luxstay">
    <meta name="twitter:image" content="https://lovable.dev/opengraph-image-p98pqg.png">
    <link rel="icon" type="image/png" href="/favicon.ico">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap">
    <!-- FontAwesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream-light text-gray-900 font-sans" style="font-family: 'Inter', 'Playfair Display', serif;">
    <div id="app" class="min-h-screen flex flex-col">
        @yield('content')
    </div>
</body>
</html>
