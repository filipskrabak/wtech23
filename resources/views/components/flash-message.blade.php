@if(session()->has('message'))
    <div class="flash-message">
        <p>
            {{session('message')}}
        </p>
    </div>
@endif
