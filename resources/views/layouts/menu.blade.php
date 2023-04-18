<li class="nav-item">
    <a href="{{ route('roles.index') }}"
       class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
        <p>Roles</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('kriterias.index') }}"
       class="nav-link {{ Request::is('kriterias*') ? 'active' : '' }}">
        <p>Kriterias</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('kriteriadetails.index') }}"
       class="nav-link {{ Request::is('kriteriadetails*') ? 'active' : '' }}">
        <p>Kriteriadetails</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('siswas.index') }}"
       class="nav-link {{ Request::is('siswas*') ? 'active' : '' }}">
        <p>Siswas</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('penilaians.index') }}"
       class="nav-link {{ Request::is('penilaians*') ? 'active' : '' }}">
        <p>Penilaians</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('penilaianDetails.index') }}"
       class="nav-link {{ Request::is('penilaianDetails*') ? 'active' : '' }}">
        <p>Penilaian Details</p>
    </a>
</li>


