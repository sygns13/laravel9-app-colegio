
@if($user->tipo_user_id == 1 || $user->tipo_user_id == 2)
    @include('admin.inicio.admin')
@elseif($user->tipo_user_id == 3)
    @include('admin.inicio.docente')
    @include('admin.inicio.form')
@endif