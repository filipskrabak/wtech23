<nav class="navbar navbar-expand-sm bg-light admin-nav">
    <div class="container-fluid">
        <div class="collapse navbar-collapse collapsibleNav" id="navbarNav" >
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link {{ (request()->is('dashboard/products')) ? 'active' : '' }}" href="/dashboard/products">Products</a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ (request()->is('dashboard/users')) ? 'active' : '' }}" href="/dashboard/users">Users</a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ (request()->is('dashboard/orders')) ? 'active' : '' }}"  href="/dashboard/orders">Orders</a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ (request()->is('dashboard/attribute-values')) ? 'active' : '' }}"  href="/dashboard/attribute-values">Attribute Values</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
