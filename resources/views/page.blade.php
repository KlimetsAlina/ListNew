<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>List</title> <!-- Зависит от страницы -->

    {{-- STYLE   --}}
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<nav>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="films">Фильмы</a></li>
        <li><a href="serials">Сериалы</a></li>
        <li><a href="books">Книги</a></li>
        <li><a href="music">Музыка</a></li>
        <li><a href="other">Другое</a></li>
    </ul>
</nav>

@yield('content')

</body>
</html>
