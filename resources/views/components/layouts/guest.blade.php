<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Login' }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <style>
        .fa,
        .fas,
        .far,
        .fal,
        .fab {
            font-family: "Font Awesome 6 Free", "Font Awesome 6 Pro", "Font Awesome 6 Brands" !important;
        }

        .fas {
            font-weight: 900 !important;
        }

        /* Enhanced card sizing for better appearance */
        .login-box,
        .register-box {
            width: 450px !important;
            margin: 5% auto;
        }

        .login-card-body,
        .register-card-body {
            padding: 30px !important;
        }

        .card {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
            border-radius: 15px !important;
            border: none !important;
        }

        .login-logo a,
        .register-logo a {
            font-size: 2.2rem !important;
            font-weight: 700 !important;
            margin-bottom: 25px !important;
            display: block;
        }

        .login-box-msg {
            font-size: 1.1rem !important;
            margin-bottom: 25px !important;
            color: #666 !important;
            font-weight: 500 !important;
        }

        .input-group {
            margin-bottom: 20px !important;
        }

        .form-control {
            padding: 12px 15px !important;
            font-size: 1rem !important;
            border-radius: 8px 0 0 8px !important;
        }

        .input-group-text {
            padding: 12px 15px !important;
            border-radius: 0 8px 8px 0 !important;
            background: #f8f9fa !important;
            border-left: none !important;
        }

        .btn-primary {
            padding: 12px 20px !important;
            font-size: 1rem !important;
            font-weight: 600 !important;
            border-radius: 8px !important;
            transition: all 0.3s ease !important;
        }

        .btn-primary:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3) !important;
        }

        /* Better spacing for links */
        .card-body p:last-child {
            margin-top: 20px !important;
        }

        .card-body p a {
            color: #007bff !important;
            text-decoration: none !important;
            font-weight: 500 !important;
        }

        .card-body p a:hover {
            text-decoration: underline !important;
        }

        /* Background enhancement */
        .login-page {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {

            .login-box,
            .register-box {
                width: 90% !important;
                margin: 10px auto !important;
            }

            .login-card-body,
            .register-card-body {
                padding: 20px !important;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body class="hold-transition login-page min-vh-100">
    {{ $slot }}

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha384-1VBKjFa3ZJJbB4KwK3sGCr9a3YDLlY8VC5nQw2I6wKrHLp8CY8TzJd8Vr9I/oXDn" crossorigin="anonymous">
    </script>

    <!-- Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <!-- AdminLTE -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>



    @stack('scripts')
</body>

</html>
