<!doctype html>
<html lang="en">

<head>
  <title>@yield('title') - Clothing Store</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous"
    referrerpolicy="no-referrer">
  <!-- Main CSS -->
  <link href="{{ asset('css/styles.css?v=2') }}" rel="stylesheet">
  <!-- Product Gallery slider CSS -->
  <link rel='stylesheet' href='https://sachinchoolur.github.io/lightslider/dist/css/lightslider.css'>
  <link rel="icon" href="/img/sitelogo.svg" type="image/svg+xml">
</head>

<body class="@auth
    logged-in
@else
    not-logged-in
@endif">
  <x-flash-message />
  <header>
    <!-- Top nav with logo, buttons -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('img/sitelogo.svg') }}" width="30" height="30" class="d-inline-block align-top" alt="">
            Clothing Store
        </a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target=".collapsibleNav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse collapsibleNav">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <button class="btn nav-link my-2 my-sm-0 border-0" type="submit" id="searchBarBtn"><span><i class="fa-solid fa-magnifying-glass"></i> Search</span></button>
                </li>
                @auth
                <li class="nav-item">
                  <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user"></i> Profile</a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownProfile">
                      <li><a class="dropdown-item" href="/edit"><i class="fa-solid fa-user-pen"></i> Edit details</a></li>
                      @can('admin', App\Models\User::class)
                      <li><a class="dropdown-item" href="/dashboard/products"><i class="fa-solid fa-gauge"></i> Admin dashboard</a></li>
                      @else
                      <li><a class="dropdown-item" href="/orders"><i class="fa-solid fa-list"></i> My orders</a></li>
                      @endcan
                      <li>
                        <form class="inline" method="POST" action="/logout">
                          @csrf
                          <button type="submit" class="dropdown-item"><i class="fa-solid fa-right-from-bracket"></i> Log out</button>
                        </form>
                      </li>
                    </ul>
                    </div>
                </li>
                @else
                <li class="nav-item">
                  <a class="nav-link" href="/login"><i class="fa-solid fa-right-to-bracket"></i> Log in</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/register"><i class="fa-solid fa-user-plus"></i> Register</a>
                </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="/cart"><i class="fa-solid fa-cart-shopping"></i>
                        Cart @if ($cartCount > 0) {{ "(".$cartCount.")" }} @endif
                    </a>
                </li>
            </ul>
        </div>
      </div>
    </nav>
    <!-- Search Bar -->
    <div class="bg-dark d-none" id="searchBar">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 p-3">
            <form action="/products" method="GET">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingSearch" placeholder="Black T-shirt..." name="search" value="{{ request('search') }}">
                    <label for="floatingSearch">Black T-shirt...</label>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <nav class="navbar navbar-expand-sm navbar-light bg-light py-0 py-sm-2">
      <div class="container">
        <div class="collapse navbar-collapse collapsibleNav">
            <ul class="navbar-nav m-auto mt-2 mt-lg-0">
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/" aria-current="page">Home</a>
              </li>
              <li class="nav-item dropdown position-static">
                  <a class="nav-link dropdown-toggle {{ app('request')->input('gender') == "Women" ? 'active' : '' }}" href="#" id="women-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Women</a>
                  <div class="dropdown-menu nav-dropdown w-100 mt-0 border-0 rounded-0 bg-light" aria-labelledby="women-dropdown">
                      <div class="container">
                          <div class="row mb-4">
                            <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                              <h4>Clothing</h4>
                              <div class="list-group list-group-flush">
                                <a href="/products?gender=Women&category=T-Shirts" class="list-group-item list-group-item-action bg-light">T-shirts</a>
                                <a href="/products?gender=Women&category=Shirts" class="list-group-item list-group-item-action bg-light">Shirts</a>
                                <a href="/products?gender=Women&category=Hoodies" class="list-group-item list-group-item-action bg-light">Hoodies</a>
                                <a href="/products?gender=Women&category=Jeans" class="list-group-item list-group-item-action bg-light">Jeans</a>
                                <a href="/products?gender=Women&category=Jackets" class="list-group-item list-group-item-action bg-light">Jackets</a>
                              </div>
                            </div>
                            <div class="col-lg-3 d-none d-lg-block mb-3 mb-lg-0">
                            </div>
                            <div class="col-md-6 col-lg-6 mb-3 mb-lg-0 d-none d-md-block">
                              <picture>
                                  <source srcset="{{ asset('slides/1.svg') }}" type="image/svg+xml">
                                  <img src="{{ asset('slides/1.svg') }}" class="img-fluid" alt="image">
                                </picture>
                            </div>
                          </div>
                      </div>
                  </div>
              </li>
              <li class="nav-item dropdown position-static">
                  <a class="nav-link dropdown-toggle {{ app('request')->input('gender') == "Men" ? 'active' : '' }}" href="#" id="men-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Men</a>
                  <div class="dropdown-menu nav-dropdown w-100 mt-0 border-0 rounded-0 bg-light" aria-labelledby="men-dropdown">
                      <div class="container">
                          <div class="row mb-4">
                            <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                              <h4>Clothing</h4>
                              <div class="list-group list-group-flush">
                                <a href="/products?gender=Men&category=T-Shirts" class="list-group-item list-group-item-action bg-light">T-shirts</a>
                                <a href="/products?gender=Men&category=Shirts" class="list-group-item list-group-item-action bg-light">Shirts</a>
                                <a href="/products?gender=Men&category=Hoodies" class="list-group-item list-group-item-action bg-light">Hoodies</a>
                                <a href="/products?gender=Men&category=Jeans" class="list-group-item list-group-item-action bg-light">Jeans</a>
                                <a href="/products?gender=Men&category=Jackets" class="list-group-item list-group-item-action bg-light">Jackets</a>
                              </div>
                            </div>
                            <div class="col-lg-3 d-none d-lg-block mb-3 mb-lg-0">
                            </div>
                            <div class="col-md-6 col-lg-6 mb-3 mb-lg-0 d-none d-md-block">
                              <picture>
                                  <source srcset="{{ asset('slides/2.svg') }}" type="image/svg+xml">
                                  <img src="{{ asset('slides/2.svg') }}" class="img-fluid" alt="image">
                                </picture>
                            </div>
                          </div>
                      </div>
                  </div>
              </li>
              <li class="nav-item">
                  <a class="nav-link  {{ app('request')->input('price-to') == 10 ? 'active' : '' }}" href="/products?price-to=10">Sale</a>
              </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main>
    @yield('content')
  </main>
  <footer class="container">
    <div class="row py-5 border-top">
      <div class="col-md-5">
        <a class="navbar-brand mb-2 d-flex align-items-center" href="/">
          <img src="{{ asset('img/sitelogo.svg') }}" width="30" height="30" class="d-inline-block align-top me-2" alt="">
          Clothing Store
        </a>
        <p class="text-muted">
          Made by Filip Škrabák, Patrik Prizbul, Samuel Krempaský</p>
        <p class="text-muted">© 2023</p>
      </div>
      <div class="col-md-1">
      </div>
      <div class="col-md-2">
        <h5 class="footer-section">About us</h5>
        <ul class="nav flex-column footer-links">
          <li class="nav-item mb-2"><a href="./shipping" class="nav-link p-0 text-muted">Shipping</a></li>
          <li class="nav-item mb-2"><a href="./terms" class="nav-link p-0 text-muted">Terms and conditions</a></li>
          <li class="nav-item mb-2"><a href="./payment" class="nav-link p-0 text-muted">Payment options</a></li>
        </ul>
      </div>
      <div class="col-md-2">
        <h5 class="footer-section">User</h5>
        <ul class="nav flex-column footer-links">
            @auth
                <li class="nav-item mb-2"><a href="/edit" class="nav-link p-0 text-muted">Edit details</a></li>
                <li class="nav-item mb-2"><a href="/orders" class="nav-link p-0 text-muted">My orders</a></li>
            @else
                <li class="nav-item mb-2"><a href="/login" class="nav-link p-0 text-muted">Log in</a></li>
                <li class="nav-item mb-2"><a href="/register" class="nav-link p-0 text-muted">Register</a></li>
            @endif
        </ul>
      </div>
      <div class="col-md-2">
        <h5 class="footer-section">Shop</h5>
        <ul class="nav flex-column footer-links">
          <li class="nav-item mb-2"><a href="/products?gender=Men" class="nav-link p-0 text-muted">Men</a></li>
          <li class="nav-item mb-2"><a href="/products?gender=Women" class="nav-link p-0 text-muted">Women</a></li>
          <li class="nav-item mb-2"><a href="/products?price-to=10" class="nav-link p-0 text-muted">On Sale</a></li>
        </ul>
      </div>
    </div>
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"
    integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous">
  </script>
  <!-- TODO: include in product page only -->
  <script src='https://sachinchoolur.github.io/lightslider/dist/js/lightslider.js'></script>
  <script>
    $(window).bind("load", function () {
      $('#lightSlider').lightSlider({ gallery: true, item: 1, loop: true, slideMargin: 0, thumbItem: 9, adaptiveHeight: true });
      $('.product-gallery-slider').css('opacity', '1');
    });
  </script>

  <script src="{{ asset('js/main.js?v=1') }}"></script>
</body>

</html>
