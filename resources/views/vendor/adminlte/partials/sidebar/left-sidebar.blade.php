<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">

        <div style="padding-bottom: 20px;white-space: normal;padding-top: 20px;" class="user-panel">
            <div style="left: 0px!important;text-align: center;padding-top: 5px;padding-bottom: 0px;line-height: 25px;padding-left: 5px; display: flex;
                        flex-wrap: wrap; justify-content: center;" class="pull-left info">
                <p style="font-size: 18px!important;line-height: 20px;margin-left: 0px;color: #fff;" class="title-yamaha">
                    <b>Sistema de Cotizaciones</b>
                </p>
                <p style="font-size: 18px!important;line-height: 20px;margin-left: 0px;color: #fff;" class="title-yamaha">
                    <b>YAMAHA</b>
                </p>
            </div>
        </div>

        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>

</aside>
