<!doctype html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tasks Page</title>
    @livewireStyles
</head>
<body>
    <h1>Tasks</h1>

    <livewire:tasks />

    @livewireScripts
</body>
</html>
