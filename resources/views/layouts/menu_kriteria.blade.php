@foreach ($menus as $menu)
    <li class="nav-item">
        <a href="{{ route('kriteriadetails.index', $menu->id) }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $menu->nama }}</p>
        </a>
    </li>
@endforeach
