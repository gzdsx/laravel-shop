<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Title</title>
</head>
<body>
<div id="app">
    <Hello name="hello" :items="items"></Hello>
</div>
<script src="{{asset('js/web.js')}}"></script>
</body>
</html>
