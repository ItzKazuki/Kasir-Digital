<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    {{-- style internal or external --}}
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet"
        href="https://unpkg.com/bs-brain@2.0.4/components/error-404s/error-404-1/assets/css/error-404-1.css">

</head>

<body>
    <!-- Error 404 Template 1 - Bootstrap Brain Component -->
    <section class="py-3 py-md-5 min-vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h2 class="d-flex justify-content-center align-items-center gap-2 mb-4">
                            <span id="code1" class="display-1 fw-bold">4</span>
                            <i id="code2" class="bi bi-exclamation-circle-fill text-danger display-4"></i>
                            <span id="code3" class="display-1 fw-bold bsb-flip-h">4</span>
                        </h2>
                        <h3 class="h2 mb-2">Oops! You're lost.</h3>
                        <p class="mb-5">The page you are looking for was not found. @yield('code')</p>
                        <a class="btn bsb-btn-5xl btn-dark rounded-pill px-5 fs-6 m-0" href="{{ route('home') }}"
                            role="button">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<script>
    let code = @yield('code');
    errorCode = code.toString().split('')

    document.getElementById("code1").textContent = errorCode[0];
    // document.getElementById("code2").className = "bi bi-emoji-frown-fill text-warning display-4";
    document.getElementById("code2").className = errorCode[1] === "0" ? "bi bi-emoji-frown-fill text-warning display-4" : "bi bi-exclamation-circle-fill text-danger display-4";
    // document.getElementById("code2").textContent = errorCode[1];
    document.getElementById("code3").textContent = errorCode[2];

    lorem iplsum daksdan dkanjaajf

</script>

</html>
