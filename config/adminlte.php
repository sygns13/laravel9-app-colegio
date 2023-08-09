<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => '',
    'title_prefix' => 'IE Ricardo Palma | ',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => true,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>SGA</b> IE Ricardo Palma',
    #'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img' => 'images/logo.jpg',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'SGA IE',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-info',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => 'bg-info',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-info elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-info navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'admin',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => false,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        /* [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ], */
        //Directiva Can si tiene el rol
        [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],

        ['header' => 'MENÚ PRINCIPAL'],

        [
            'text'        => 'Inicio',
            'url'         => 'admin',
            'icon'        => 'fas fa-fw fa-home',
            'icon_color'  => 'white',
            'can'         => ['admin', 'director', 'docente', 'alumno']
        ],

       /*  [
            'text'        => 'Legajo',
            'url'         => 'admin/legajo',
            'icon'        => 'fas fa-fw fa-folder',
            'icon_color'  => 'white',
            'can'         => ['admin', 'director']
        ], */

        [
            'text'        => 'Legajo',
            'icon'        => 'fas fa-fw fa-folder',
            'icon_color'  => 'white',
            'can'         => ['admin', 'director', 'docente', 'alumno'],
            'submenu' => [
                [
                    'text' => 'Registrar Nueva',
                    'url'  => 'admin/legajo-nuevo',
                    //'can'  => ['admin', 'director'],
                ],
                [
                    'text' => 'Ver fichas',
                    'url'  => 'admin/legajo-fichas',
                    //'can'  => ['admin', 'director'],
                ],

            ]
        ],

        [
            'text'        => 'Tablas Base',
            'icon'        => 'fas fa-fw fa-server',
            'icon_color'  => 'white',
            'can'         => ['admin', 'director', 'docente'],
            'submenu' => [
                [
                    'text' => 'Datos de la IE',
                    'url'  => 'admin/ie',
                    'can'  => ['admin', 'director'],
                ],
                [
                    'text' => 'Gestión de Secciones',
                    'url'  => 'admin/secciones',
                    'can'  => ['admin', 'director'],
                ],
                [
                    'text' => 'Gestión de Cursos',
                    'url'  => 'admin/cursos',
                    'can'  => ['admin', 'director', 'docente'],
                ],
                [
                    'text' => 'Gestión de Horas',
                    'url'  => 'admin/horas',
                    'can'  => ['admin', 'director'],
                ],
                [
                    'text' => 'Gestión de Resoluciones',
                    'url'  => 'admin/resoluciones',
                    'can'  => ['admin', 'director'],
                ],

            ]
        ],
        [
            'text' => 'Docentes',
            'url'  => 'admin/docentes',
            'icon' => 'fas fa-fw fa-user-secret',
            'can'  => ['admin', 'director']
        ],

        [
            'text'        => 'Gestión Académica',
            'icon'        => 'fas fa-fw fa-graduation-cap',
            'icon_color'  => 'white',
            'can'         => ['admin', 'director', 'docente'],
            'submenu' => [
                [
                    'text' => 'Gestión del Año Escolar',
                    'url'  => 'admin/ciclo',
                    'can'  => ['admin', 'director']
                ],
                [
                    'text' => 'Gestión de Horarios',
                    'url'  => 'admin/horario',
                    'can'  => ['admin', 'director']
                ],
                [
                    'text' => 'Matrículas',
                    'url'  => 'admin/matriculas',
                    'can'  => ['admin', 'director']
                ],
                [
                    'text' => 'Matrícula Masiva',
                    'url'  => 'admin/matricula-masiva',
                    'can'  => ['admin', 'director']
                ],
                [
                    'text' => 'Asignación de Cursos',
                    'url'  => 'admin/asignacion-cursos',
                    'can'  => ['admin', 'director']
                ],
                [
                    'text' => 'Nómina de Matrícula',
                    'url'  => 'admin/nominas',
                    'can'  => ['admin', 'director']
                ],
                [
                    'text' => 'Nómina de Matrícula',
                    'url'  => 'admin/docnominas',
                    'can'  => ['docente']
                ],
                [
                    'text' => 'Conclusión de Matrículas',
                    'url'  => 'admin/conclusion-matriculas',
                    'can'  => ['admin', 'director']
                ],

            ]
        ],
        [
            'text'        => 'Módulo Control',
            'icon'        => 'fas fa-fw fa-clock',
            'icon_color'  => 'white',
            'can'         => ['admin', 'director'],
            'submenu' => [
                [
                    'text' => 'Asistencia de Docentes',
                    'url'  => 'admin/asistencia-docente',
                    'can'  => ['admin', 'director']
                ],

            ]
        ],
        [
            'text'        => 'Gestión Docente',
            'icon'        => 'fas fa-fw fa-folder',
            'icon_color'  => 'white',
            'can'  => ['docente'],
            'submenu' => [
                [
                    'text' => 'Lista de Alumnos',
                    'url'  => 'admin/lista-alumnos',
                ],
                [
                    'text' => 'Lista de Cursos',
                    'url'  => 'admin/lista-cursos',
                ],
                [
                    'text' => 'Registro de Asistencia',
                    'url'  => 'admin/asistencia',
                ],
                [
                    'text' => 'Registro de Calificaciones',
                    'url'  => 'admin/calificacion',
                ],

            ]
        ],

        [
            'text'        => 'Lista de Cursos',
            'url'         => 'admin/listado-cursos',
            'icon'        => 'fas fa-fw fa-book',
            'icon_color'  => 'white',
            'can'         => ['alumno']
        ],
        [
            'text'        => 'Horario del Alumno',
            'url'         => 'admin/horario-alumno',
            'icon'        => 'fas fa-fw fa-calendar',
            'icon_color'  => 'white',
            'can'         => ['alumno']
        ],
        [
            'text'        => 'Asistencia del Alumno',
            'url'         => 'admin/asistencia-alumno',
            'icon'        => 'fas fa-fw fa-bars',
            'icon_color'  => 'white',
            'can'         => ['alumno']
        ],









        [
            'text'        => 'Reportes Generales',
            'icon'        => 'fas fa-fw fa-print',
            'icon_color'  => 'white',
            'can'         => ['admin', 'director', 'docente', 'alumno'],
            'submenu' => [
                [
                    'text' => 'Horarios por Sección',
                    'url'  => 'admin/reporte-horarios',
                    'can'  => ['admin', 'director']
                ],
                [
                    'text' => 'Horarios por Sección',
                    'url'  => 'admin/reporte-doc-horarios',
                    'can'  => ['docente']
                ],
                [
                    'text' => 'Horarios por Sección',
                    'url'  => 'admin/reporte-alu-horarios',
                    'can'  => ['alumno']
                ],

                [
                    'text' => 'Asistencia por Sesiones',
                    'url'  => 'admin/asistencia-sesiones',
                    'can'  => ['admin', 'director']
                ],
                [
                    'text' => 'Asistencia por Sesiones',
                    'url'  => 'admin/asistencia-doc-sesiones',
                    'can'  => ['docente']
                ],
                [
                    'text' => 'Asistencia por Sesiones',
                    'url'  => 'admin/asistencia-alu-sesiones',
                    'can'  => ['alumno']
                ],

                [
                    'text' => 'Reporte de Calificaciones',
                    'url'  => 'admin/calificaciones',
                ],
                

            ]
        ],

        /* [
            'text'        => 'pages',
            'url'         => 'admin/pages',
            'icon'        => 'far fa-fw fa-file',
            'label'       => 4,
            'label_color' => 'success',
        ],
        ['header' => 'account_settings'],
        [
            'text' => 'profile',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-user',
        ],
        [
            'text' => 'change_password',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-lock',
        ], */
        /* [
            'text'    => 'multilevel',
            'icon'    => 'fas fa-fw fa-share',
            'submenu' => [
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
                [
                    'text'    => 'level_one',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'level_two',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'level_two',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
            ],
        ], */
        /* ['header' => 'labels'],
        [
            'text'       => 'important',
            'icon_color' => 'red',
            'url'        => '#',
        ],
        [
            'text'       => 'warning',
            'icon_color' => 'yellow',
            'url'        => '#',
        ],
        [
            'text'       => 'information',
            'icon_color' => 'cyan',
            'url'        => '#',
        ], */
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Helpersjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'js/core/helpers.js',
                ],
            ],
        ],
        'Vuejs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'js/vue.js',
                ],
            ],
        ],
        'Axios' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'js/axios.min.js',
                ],
            ],
        ],
        'Toastr' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/toastr/toastr.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/toastr/toastr.min.css',
                ],
            ],
        ],
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/select2/js/select2.full.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2/css/select2.min.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/chart.js/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2/sweetalert2.all.min.js',
                ],
            ],
        ],
        'Pace' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/pace-progress/themes/blue/pace-theme-loading-bar.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/pace-progress/pace.min.js',
                ],
            ],
        ],
        'Stepper' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/bs-stepper/css/bs-stepper.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bs-stepper/js/bs-stepper.min.js',
                ],
            ],
        ],
        'Hightcharts' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'js/hightcharts/highcharts.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'js/hightcharts/modules/exporting.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'js/hightcharts/modules/export-data.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'js/hightcharts/modules/accessibility.js',
                ],
            ],
        ],
        
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
