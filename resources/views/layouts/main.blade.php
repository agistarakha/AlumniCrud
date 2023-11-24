<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alumni</title>
  @vite('resources/css/app.css')
<script src="https://unpkg.com/htmx.org@1.9.5"
 integrity="sha384-xcuj3WpfgjlKF+FXhSQFQ0ZNr39ln+hwjN3npfM9VBnUskLolQAcN80McRIVOPuO"
 crossorigin="anonymous"></script> 

</head>
<body>

<nav class="bg-blue-500 p-4 mb-4">
        <a href="{{ route('alumni.index') }}" class="text-white hover:underline">Alumni</a>
        <span class="text-white mx-4">|</span>
        <a href="{{ route('majors.index') }}" class="text-white hover:underline">Jurusan</a>
    </nav>
    <div class="p-2">
        @yield('content')
    </div>
</body>
</html>