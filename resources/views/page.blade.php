<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$contentType}}</title> <!-- TODO -->

    {{-- STYLE   --}}
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<nav>
    <ul>
        @foreach($menu as $element)
            <li {{ (Request::path() === $element->link) ? "class=selected" : '' }}>
                <a href="{{ $element->link }}">{{ $element->name }}</a>
            </li>
        @endforeach
    </ul>
</nav>

@yield('content')

</body>
</html>
