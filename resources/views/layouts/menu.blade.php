@section('')
<ul class="nav flex-column">
    <li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
        <a class="nav-link" href="/">
            <i class="fas fa-building"></i><span>Dashboard</span>
        </a>
        <a class="nav-link" href="/users">
            <i class="fas fa-building"></i><span>Usuarios</span>
        </a>
        <a class="nav-link" href="/roles">
            <i class="fas fa-building"></i><span>Roles</span>
        </a>
        <a class="nav-link" href="/films">
            <i class="fas fa-building"></i><span>Peliculas</span>
        </a>
    </li>
</ul>

