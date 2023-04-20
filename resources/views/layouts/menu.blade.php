<li class="nav-item">
    <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-cog"></i>
        <p>Role</p>
    </a>
</li>

<li class="nav-item">
    <a href="#"
        class="nav-link {{ Request::is('kriteriadetails*') || Request::is('kriterias*') ? 'menu-is-opening menu-open' : '' }}">
        <i class="nav-icon fas fa-sitemap"></i>
        <p>
            Daftar Kriteria
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview"
        style="{{ Request::is('kriteriadetails*') || Request::is('kriterias*') ? 'display: block;' : 'display: none;' }}">
        <li class="nav-item">
            <a href="{{ route('kriterias.index') }}" class="nav-link  {{ Request::is('kriterias*') ? 'active' : '' }} ">
                <i class="nav-icon fas fa-cogs"></i>
                <p>Kriteria</p>
            </a>

        </li>

        <li class="nav-item">
            <a href="#" class="nav-link {{ Request::is('kriteriadetails*') ? 'menu-is-opening menu-open' : '' }}">
                <i class="nav-icon fas fa-sitemap"></i>
                <p>
                    Kriteria Detail
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview"
                style="{{ Request::is('kriteriadetails*') ? 'display: block;' : 'display: none;' }}"
                id="kriteriaDetailMenu">
            </ul>
        </li>

    </ul>
</li>


<li class="nav-item">
    <a href="{{ route('siswas.index') }}" class="nav-link {{ Request::is('siswas*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Siswa</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('penilaians.index') }}" class="nav-link {{ Request::is('penilaians*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-copy"></i>
        <p>Penilaian</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('penilaianDetails.index') }}"
        class="nav-link {{ Request::is('penilaianDetails*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-copy"></i>
        <p>Penilaian Detail</p>
    </a>
</li>


@push('third_party_scripts')
    <script>
        $(function() {
            $.get("{{ route('menu') }}").then((result) => {
                if (result) {
                    $('#kriteriaDetailMenu').html(result)
                    addActiveSubMenu()
                }
            }).catch((err) => {
                console.log(err);
            });
        })

        function addActiveSubMenu() {
            if (window.location.pathname.slice(1) === 'kriteriadetails')
                $('#riteriaDetailMenu').addClass('active')
            else
                $('#riteriaDetailMenu').removeClass('active')
        }
    </script>
@endpush
