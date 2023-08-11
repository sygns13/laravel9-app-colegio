
@if($user->tipo_user_id == 1 || $user->tipo_user_id == 2)
    @include('admin.inicio.admin')
@elseif($user->tipo_user_id == 3)
    @include('admin.inicio.docente')
    @include('admin.inicio.form')
@elseif($user->tipo_user_id == 4)
    @include('admin.inicio.alumno')
    @include('admin.inicio.form')
@elseif($user->tipo_user_id == 5)
    @include('admin.inicio.apoderado')
    @include('admin.inicio.form')
@endif