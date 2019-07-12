<div class="left-side-menu">

    <div class="slimscroll-menu" id="left-side-menu-container">

        <!-- LOGO -->
        <a href="index.html" class="logo text-center">
            <span class="logo-lg">
                <!--<img src="{{ asset('admin/images/logo.png') }}" alt="" height="16">-->
                <h1 class="text-white"><b>LOGO</b></h1>
            </span>
            <span class="logo-sm">
                <!--<img src="{{ asset('admin/images/logo_sm.png') }}" alt="" height="16">-->
                <h1 class="text-white"><b>LOGO</b></h1>
            </span>
        </a>

        <!--- Sidemenu -->
        <ul class="metismenu side-nav">

            <li class="side-nav-item">
                <a href="{{ route('admin.home') }}" class="side-nav-link active" aria-expanded="false">
                    <i class="dripicons-home"></i>
                    <span> Inicio </span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">Interno</li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="dripicons-view-apps"></i>
                    <span> Accesos </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('roles.index') }}">
                            Roles
                            <span class="badge badge-success float-right">{{ $total_roles }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}">
                            Usuarios
                            <span class="badge badge-success float-right">{{ $total_users }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('configuration.index') }}">
                            Configuraciones
                            <span class="badge badge-success float-right">{{ $total_configurations }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="side-nav-title side-nav-item">SISTEMA</li>

            <li class="side-nav-item">
                <a href="{{ route('topics.index') }}" class="side-nav-link">
                    <i class="dripicons-view-apps"></i>
                    <span> Temas </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('faqs.index') }}" class="side-nav-link">
                    <i class="dripicons-view-apps"></i>
                    <span> Preguntas frecuentes </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('pages.index') }}" class="side-nav-link">
                    <i class="dripicons-view-apps"></i>
                    <span> Páginas </span>
                </a>
            </li>

        </ul>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
