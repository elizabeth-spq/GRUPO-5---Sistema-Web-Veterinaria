<template>
    <div class="container">
        <div class="mt-5">
            <button type="button" class="btn btn-primary px-4">Nuevo Veterinario</button>
        </div>
        <div class="mt-5">
            <table class="table table-hover">
                <thead>
                    <tr class="table-dark align-middle text-center">
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Fec. Nacimiento</th>
                        <th scope="col">Tip. Documento</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Contacto</th>
                        <th scope="col">Especialidad</th>
                        <th scope="col">Jornada</th>
                        <th scope="col">Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(veterinario, index) in veterinarios" class="text-center align-middle">
                        <th scope="row">{{ index + 1 }}</th>
                        <td class="text-start">{{ veterinario.nombre }}</td>
                        <td class="text-start">{{ veterinario.apellido }}</td>
                        <td>
                            <input type="datetime" disabled v-model="veterinario.fec_nac">
                        </td>
                        <td>
                            <span v-if="veterinario.tip_doc == 1">DNI</span>
                            <span v-if="veterinario.tip_doc == 2">Pasaporte</span>
                            <span v-if="veterinario.tip_doc == 3">Carné</span>
                        </td>
                        <td>{{ veterinario.documento }}</td>
                        <td>{{ veterinario.num_telefono }}</td>
                        <td>
                            <span v-if="veterinario.especialidad == 1">Medicina Interna</span>
                            <span v-if="veterinario.especialidad == 2">Cirugía</span>
                            <span v-if="veterinario.especialidad == 3">Fisioterapia </span>
                            <span v-if="veterinario.especialidad == 4">Anestesiología</span>
                            <span v-if="veterinario.especialidad == 5">Cardiología </span>
                            <span v-if="veterinario.especialidad == 6">Dermatología </span>
                            <span v-if="veterinario.especialidad == 7">Neurología </span>
                            <span v-if="veterinario.especialidad == 8">Oftalmología </span>
                            <span v-if="veterinario.especialidad == 9">Oncología </span>
                            <span v-if="veterinario.especialidad == 10">Medicina de Fauna silvestre </span>
                            <span v-if="veterinario.especialidad == 11">Radiología </span>
                            <span v-if="veterinario.especialidad == 12">Ultrasonografía </span>
                            <span v-if="veterinario.especialidad == 13">Radiología </span>
                        </td>
                        <td>
                            <span v-if="veterinario.horario_id == 1">Completo</span>
                            <span v-if="veterinario.horario_id == 2">Parcial/M</span>
                            <span v-if="veterinario.horario_id == 3">Parcial/T</span>
                        </td>
                        <td>
                            <i :class="veterinario.estado == 1 ? 'bi bi-check2-circle' : 'bi bi-exclamation-circle'">
                                <span v-if="veterinario.estado == 1">Activo</span>
                                <span v-else>Inactivo</span>
                            </i>
                        </td>
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
import { ref, reactive } from 'vue';
export default {
    setup() {
        const veterinarios = ref([])
        const veterinario = reactive({
            id: 0,
            nombre: "",
            apellido: "",
            fec_nac: "",
            tip_doc: 0,
            documento: "",
            num_telefono: "",
            especialidad: 0,
            estado: 0,
            horario_id: 0,
            usu_registro: 0,
            usu_ult_mod: 0,
        })

        function getVerinarios() {
            fetch("http://127.0.0.1:8000/veterinarios", {
                method: "GET",
            })
                .then(async (response) => {
                    const data = await response.json();
                    if (!response.ok) {
                        const error =
                            data && data.detail ? data.detail : response.statusText;
                        return Promise.reject(error);
                    }
                    console.log(data)
                    veterinarios.value = data;
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        function nuevoUsuario() {
            console.log("nuevo usuario")
        }
        return {
            veterinario,
            veterinarios,
            nuevoUsuario,
            getVerinarios,
        }
    },
    mounted() {
        console.log('Component mounted.')
        this.getVerinarios()
    }
}
</script>
