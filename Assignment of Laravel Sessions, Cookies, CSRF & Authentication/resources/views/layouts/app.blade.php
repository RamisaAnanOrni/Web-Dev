<!doctype html>
<html lang="en" class="h-100" data-theme="{{ request()->cookie('theme', 'light') }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'To‑Do')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">


  {{-- Bootstrap 5 --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  
  {{-- DataTables (Bootstrap 5 integration) --}}
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
  <style>
    body { background: var(--bg); }
    /* Light/Dark variables */
    :root { --bg:#f6f7fb; --card:#fff; --text:#222; }
    [data-theme="dark"] { --bg:#0f172a; --card:#111827; --text:#e5e7eb; }
    
    
    .gf-card { background: var(--card); color: var(--text); border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,.08); }
    .gf-title { font-weight: 700; }
    .gf-muted { color: #64748b; }
    .theme-toggle { cursor:pointer; }
    a, a:visited { color: inherit; }
  </style>
@stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg" style="background:var(--card)">
  <div class="container">
    <a class="navbar-brand gf-title" href="{{ route('tasks.index') }}">To‑Do</a>
    <div class="ms-auto d-flex align-items-center gap-3">
      <span class="theme-toggle" id="js-theme-toggle" title="Toggle theme">🌓</span>
      @auth
          <span class="gf-muted">{{ auth()->user()->name }}</span>
          <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="btn btn-sm btn-outline-secondary">Logout</button>
          </form>
      @endauth
    </div>
</div>
</nav>


<main class="flex-grow-1 py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="p-4 gf-card">
          @yield('content')
        </div>
      </div>
    </div>
  </div>
</main>


<footer class="py-3 text-center gf-muted">Made with Laravel • {{ date('Y') }}</footer>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>


<script>
(function(){
  const el = document.documentElement; // <html>
  const key = 'theme';
  const getCookie = (name) => document.cookie.split('; ').find(row => row.startsWith(name+'='))?.split('=')[1];
  const setCookie = (name, value, days=365) => {
    const d = new Date(); d.setTime(d.getTime() + (days*24*60*60*1000));
    document.cookie = `${name}=${value}; expires=${d.toUTCString()}; path=/`;
};
// apply on load
const theme = getCookie(key) || 'light';
el.set
