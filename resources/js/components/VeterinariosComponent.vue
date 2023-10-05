<template>
    <div class="container">
        <div class="mt-5">
            <button type="button" class="btn btn-primary px-4">Nuevo Veterinario</button>
        </div>
        <div class="mt-5">
            <table class="table table-hover">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">E-mail/Usuario</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Num. Contacto</th>
                        <th scope="col">Especialidad</th>
                        <th scope="col">Horario de Atención</th>
                        <th scope="col">Estado</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="row g-1">
                                <div class="col"> <button type="button" class="btn btn-warning w-100">Editar</button></div>
                                <div class="col"> <button type="button" class="btn btn-danger w-100">Eliminar</button></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
