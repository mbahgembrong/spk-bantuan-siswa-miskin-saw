@if (Auth::user()->role->role == 'admin')
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
                <a href="{{ route('kriterias.index') }}"
                    class="nav-link  {{ Request::is('kriterias*') ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>Kriteria</p>
                </a>

            </li>

            <li class="nav-item">
                <a href="#"
                    class="nav-link {{ Request::is('kriteriadetails*') ? 'menu-is-opening menu-open' : '' }}">
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
        <a href="{{ route('bantuans.index') }}" class="nav-link {{ Request::is('bantuans*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-copy"></i>
            <p>Bantuan</p>
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
                const pathName = window.location.pathname.slice(1).split('/');
                if (pathName[0] === 'kriteriadetails') {
                    $('#riteriaDetailMenu').addClass('active')
                    $('#kriteriaDetailMenu').find('li').each((index, element) => {
                        if ($(element).data('id') == pathName[1]) {
                            $(element).find('a').addClass('active');
                        }
                    });
                } else
                    $('#riteriaDetailMenu').removeClass('active')
            }
        </script>
    @endpush
@endif
<li class="nav-item">
    <a href="#" class="nav-link {{ Request::is('laporan*') ? 'menu-is-opening menu-open' : '' }}">
        <i class="nav-icon fas fa-sitemap"></i>
        <p>
            Daftar Laporan
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>

    <ul class="nav nav-treeview" style="{{ Request::is('laporan*') ? 'display: block;' : 'display: none;' }}">
        <li class="nav-item">
            <a href="{{ route('laporan.prestasi', []) }}"
                class="nav-link  {{ Request::is('laporan/prestasi') ? 'active' : '' }} ">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Prestasi</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('laporan.nilai', []) }}"
                class="nav-link  {{ Request::is('laporan/nilai') ? 'active' : '' }} ">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Nilai</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('laporan.bantuan', []) }}"
                class="nav-link  {{ Request::is('laporan/bantuan') ? 'active' : '' }} ">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Bantuan</p>
            </a>
        </li>
    </ul>
</li>
