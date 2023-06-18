<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        'documentoMatricula' => [
            'driver' => 'local',
            'root' => public_path('web/matricula/traslados'),
            'visibility' => 'public',
            'throw' => false,
         ],

         'fotoPerfil' => [
            'driver' => 'local',
            'root' => public_path('web/perfil/admin'),
            'visibility' => 'public',
            'throw' => false,
         ],

         'imgMision' => [
            'driver' => 'local',
            'root' => public_path('web/img/mision'),
            'visibility' => 'public',
            'throw' => false,
         ],

         'imgVision' => [
            'driver' => 'local',
            'root' => public_path('web/img/vision'),
            'visibility' => 'public',
            'throw' => false,
         ],

         'fotoPerfilDocente' => [
            'driver' => 'local',
            'root' => public_path('web/perfil/docente'),
            'visibility' => 'public',
            'throw' => false,
         ],

         'planAnual' => [
            'driver' => 'local',
            'root' => public_path('web/curso/plananual'),
            'visibility' => 'public',
            'throw' => false,
         ],

         'fotoPerfilAlumno' => [
            'driver' => 'local',
            'root' => public_path('web/perfil/alumno'),
            'visibility' => 'public',
            'throw' => false,
         ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
