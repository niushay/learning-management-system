<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Learning Management System</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('loader.css') }}" />
    @vite(['resources/ts/main.ts', "resources/ts/pages/{$page['component']}.vue"])

    @inertiaHead
</head>

<body>
@routes
@inertia
</body>

</html>
