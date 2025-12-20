<!doctype html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mesara</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px;">
    <header style="display:flex; gap:12px; align-items:center; margin-bottom:18px;">
        <strong style="font-size:18px;">Mesara</strong>
        <nav style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="/proizvodi">Public katalog</a>
            <span>|</span>
            <a href="/proizvods">Proizvodi</a>
            <a href="/dobavljacs">Dobavljači</a>
            <a href="/materijals">Materijali</a>
            <a href="/kupacs">Kupci</a>
            <a href="/nabavkas">Nabavke</a>
            <a href="/fakturas">Fakture</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
