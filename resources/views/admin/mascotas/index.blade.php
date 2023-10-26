@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <script>
            window.canCreate = @can('crear', App\Models\Mascota::class) true @else false @endcan;
            window.canEdit = @can('editar', App\Models\Mascota::class) true @else false @endcan;
            window.canDelete = @can('eliminar', App\Models\Mascota::class) true @else false @endcan;
        </script>
        <mascotas-component/>
    </div>
@endsection
