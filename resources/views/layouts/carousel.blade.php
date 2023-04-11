<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
    </div>
    <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="{{ asset('img/slider/collection.png') }}" alt="New Collection">
        <div class="container">
        <div class="carousel-caption">
            <h1>New Collection</h1>
            <p>Take a look at our newest clothing</p>
            <p><a class="btn btn-lg btn-primary" href="./product-archive.html">Browse</a></p>
        </div>
        </div>
    </div>
    <div class="carousel-item">
        <img src="{{ asset('img/slider/collection.png') }}" alt="New Collection">
        <div class="container">
        <div class="carousel-caption">
            <h1>On Sale</h1>
            <p>Don't miss our sale</p>
            <p><a class="btn btn-lg btn-primary" href="./product-archive.html">Learn more</a></p>
        </div>
        </div>
    </div>
    <div class="carousel-item">
        <img src="{{ asset('img/slider/collection.png') }}" alt="New Collection">
        <div class="container">
        <div class="carousel-caption">
            <h1>New user bonus</h1>
            <p>Register now and get 10% off.</p>
            <p><a class="btn btn-lg btn-primary" href="./register.html">Register</a></p>
        </div>
        </div>
    </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
    </button>
</div>