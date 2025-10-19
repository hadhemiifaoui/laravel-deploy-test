<!doctype html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" 
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Users Page</title>
    @livewireStyles
</head>
<body>
    <h1>Tasks</h1>

       <livewire:users />

    @livewireScripts
</body>
</html>
