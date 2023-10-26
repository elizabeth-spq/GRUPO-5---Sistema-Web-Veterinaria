@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <script>
            window.canCreate = @can('crear', App\Models\Cliente::class) true @else false @endcan;
            window.canEdit = @can('editar', App\Models\Cliente::class) true @else false @endcan;
            window.canDelete = @can('eliminar', App\Models\Cliente::class) true @else false @endcan;
        </script>
        <cliente-component/>
    </div>
@endsection
