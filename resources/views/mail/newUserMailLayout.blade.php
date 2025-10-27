<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Egjus Mail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <h1 class="display-4 text-danger">Username:{{ $details['username'] }}</h1>
    <h1 class="display-4">Password:{{ $details['show_password'] }}</h1>
    <h1 class="display-4">Phone: {{ $details['phone'] }}</h1>
    <h1 class="display-4">Website: http://egjus.com/ </h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>