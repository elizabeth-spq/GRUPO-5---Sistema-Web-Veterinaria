@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <script>
            window.canCreate = @can('crear', App\Models\Historia::class) true @else false @endcan;
            window.canEdit = @can('editar', App\Models\Historia::class) true @else false @endcan;
            window.canDelete = @can('eliminar', App\Models\Historia::class) true @else false @endcan;
        </script>
        <historia-component/>
    </div>
@endsection
