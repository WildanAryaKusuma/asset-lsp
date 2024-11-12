<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Marketplace</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
</head>

<body>
    @include('partials.navbar.main')

    <div class="container mt-4">
        @yield('container')
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var errorAlert = document.getElementById("error-alert");
            var successAlert = document.getElementById("success-alert");

            if (errorAlert) {
                setTimeout(function() {
                    errorAlert.style.display = "none";
                }, 2700);
            }

            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.display = "none";
                }, 2700);
            }
        });
    </script>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
