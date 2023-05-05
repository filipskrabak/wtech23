document.querySelector('#searchBarBtn').addEventListener('click', function(e) {
    if(document.querySelector('#searchBar').classList.contains('d-none')) {
        document.querySelector('#searchBar').classList.remove('d-none');
        document.querySelector('#floatingSearch').focus();
    }
    else {
        document.querySelector('#searchBar').classList.add('d-none');
    }
})

document.querySelectorAll('.dropdown').forEach(function(element) {
    element.addEventListener('mouseenter', function() {
        if(window.innerWidth > 576) {
            element.querySelector('a').classList.add('show');
            element.querySelector('a').setAttribute('aria-expanded', 'true');
            element.querySelector('div').setAttribute('data-bs-popper', 'none');
            element.querySelector('div').classList.add('show');
        }
    })
    element.addEventListener('mouseleave', function() {
        if(window.innerWidth > 576) {
            element.querySelector('a').classList.remove('show');
            element.querySelector('a').setAttribute('aria-expanded', 'false');
            element.querySelector('div').removeAttribute('data-bs-popper', 'none');
            element.querySelector('div').classList.remove('show');
        }
    })
})

// Auto-Close BS alert
setTimeout(function () {

    $('#alert').alert('close');
}, 3000);

document.querySelector("#img-input").onchange = evt => {
    const [file] = document.querySelector("#img-input").files
    if (file) {
        document.querySelector("#img-preview").src = URL.createObjectURL(file)
    }
  }
