<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>
        body { background: #f8f9fa; }
        .login-card { max-width: 500px; margin: auto; margin-top: 10vh; }
    </style>
</head>
<body>
    <div class="login-card card shadow">
        <div class="card-body">
            <h3 class="text-center p-2 mb-5">Log in </h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ url('/login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email </label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>
                <div class="mb-5">
                    <label for="password" class="form-label">Password </label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-dark w-100">Log in</button>
            </form>
            <div class="mt-3 text-center">
                <a href="{{ url('/') }}" class="link-dark text-decoration-none">return</a>
            </div>
        </div>
    </div>
</body>
</html>
