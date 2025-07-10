<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                 <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}">Books</a></li>
                 <li class="nav-item"><a class="nav-link" href="{{ route('authors.index') }}">Authors</a></li>
                 <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Categories</a></li>
                 <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                 <li class="nav-item"><a class="nav-link" href="{{ route('borrowings.history') }}">Borrowing's History </a></li>
                 <li class="nav-item"><a class="nav-link" href="{{ route('fines.all') }}">Fines</a></li>
                @auth
                    {{-- Log out button --}}
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm" type="submit">Log out</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Log in </a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
