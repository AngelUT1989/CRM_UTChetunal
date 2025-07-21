<nav class="sidebar" id="sidebar">
    <ul class="list-group list-group-flush">
        <a href="{{ route('home') }}" class="list-group-item list-group-item-action">
            <i class="bi bi-people-fill"></i> Dashboard
        </a>
        <a href="{{ route('prospectos.index') }}" class="list-group-item list-group-item-action">
            <i class="bi bi-people-fill"></i> Gestionar prospectos
        </a>
        <a href="{{ route('solicitudes.index') }}" class="list-group-item list-group-item-action">
            <i class="bi bi-people-fill"></i> Solicitudes
        </a>
        <a href="{{ route('reportes.index') }}" class="list-group-item list-group-item-action">
            <i class="bi bi-people-fill"></i> Reportes
        </a>
        <a href="{{ route('tramites.index') }}" class="list-group-item list-group-item-action">
            <i class="bi bi-people-fill"></i> Trámites
        </a>
        <li class="list-group-item">
            <i class="bi bi-envelope-fill"></i> Enviar comunicaciones
        </li>
        <li class="list-group-item">
            <i class="bi bi-person-fill-gear"></i> Administrar usuarios
        </li>

        
        <li class="list-group-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-link p-0 text-decoration-none text-danger">
                    <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                </button>
            </form>
        </li>
    </ul>
</nav>
