<div class="left-side-menu">

    <div class="slimscroll-menu" id="left-side-menu-container">

        <!-- LOGO -->
        <a href="index.html" class="logo text-center">
            <span class="logo-lg">
                <img src="{{ asset('admin/images/logo.png') }}" alt="" height="16">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('admin/images/logo_sm.png') }}" alt="" height="16">
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
                            <span class="badge badge-success float-right">3</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}">
                            Usuarios
                            <span class="badge badge-success float-right">3</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('configuration.index') }}">
                            Configuraciones
                            <span class="badge badge-success float-right">3</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="side-nav-title side-nav-item">SISTEMA</li>

            <li class="side-nav-item">
                <a href="{{ route('categories.index') }}" class="side-nav-link">
                    <i class="dripicons-view-apps"></i>
                    <span> Categorías </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('products.index') }}" class="side-nav-link">
                    <i class="dripicons-view-apps"></i>
                    <span> Productos </span>
                </a>
            </li>

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

            <li class="side-nav-item">
                <a href="{{ route('banners.index') }}" class="side-nav-link">
                    <i class="dripicons-view-apps"></i>
                    <span> Banner </span>
                </a>
            </li>

        </ul>

        <!-- Help Box -->
        <div class="help-box text-white text-center">
            <a href="javascript: void(0);" class="float-right close-btn text-white">
                <i class="mdi mdi-close"></i>
            </a>
            <img src="{{ asset('admin/images/help-icon.svg') }}" height="90" alt="Helper Icon Image" />
            <h5 class="mt-3">Unlimited Access</h5>
            <p class="mb-3">Upgrade to plan to get access to unlimited reports</p>
            <a href="javascript: void(0);" class="btn btn-outline-light btn-sm">Upgrade</a>
        </div>
        <!-- end Help Box -->
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
