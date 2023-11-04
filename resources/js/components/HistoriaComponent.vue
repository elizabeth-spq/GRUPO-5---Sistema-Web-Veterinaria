<template>
    <div class="container">
        <div class="mt-5">
            <table class="table table-hover">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">Codigo de Mascota</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Dueño</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(mascota, index) in mascotas">
                        <th scope="row">{{ index + 1 }}</th>
                        <td>{{ mascota.mascota_id }}</td>
                        <td>{{ mascota.nombre }}</td>
                        <td>{{ mascota.cliente.nombre }} {{ mascota.cliente.apellido }}</td>
                        <td>
                            <i :class="historia.estado == 1 ? 'bi bi-check2-circle' : 'bi bi-exclamation-circle'">
                                <span v-if="historia.estado == 1">Activo</span>
                                <span v-else>Inactivo</span>
                            </i>
                        </td>
                        <td>
                            <div class="row g-1">
                                <div class="col"> <button type="button" class="btn btn-danger w-100"
                                        @click="detalleHistoria(historia.id)">Detalle de Historia</button></div>
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
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
export default {
    setup() {
        const canCreate = ref(window.canCreate);
        const canEdit = ref(window.canEdit);
        const canDelete = ref(window.canDelete);
        const error_message = ref("")
        const is_disabled = ref(false)
        const mascotas = ref([])
        const mascota = reactive({
            id: 0,
            nombre: "",
            cliente_id: 0,
            animal_id: 0,
            raza_id: 0,
            fec_nac: "",
            sexo: 0,
            color: "",
            altura: 0,
            peso: 0,
            estirilizado: 0,
            vacunas: 0,
            estado: 0
        })
        const clientes = ref([])
        const historias = ref([])
        const historia = reactive({
            id: 0,
            mascota_id: 0,
            foto: "",
            documentos: "",
            estado: 0,
        })
        function guardarHistoria() {
            fetch("http://127.0.0.1:8000/historias", {
                method: "POST",
                headers: {
                    Accept: "Application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(historia),
            })
                .then(async (response) => {
                    if (!response.ok) {
                        const error =
                            "error";
                        return Promise.reject(error);
                    }

                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });

            obtenerHistorias();
            closeModal();
        }
        function obtenerMascotas() {
            fetch("http://127.0.0.1:8000/mascotas", {
                method: "GET",
            })
                .then(async (response) => {
                    const data = await response.json();
                    if (!response.ok) {
                        const error =
                            data && data.detail ? data.detail : response.statusText;
                        return Promise.reject(error);
                    }
                    //console.log(data)
                    mascotas.value = data;
                    console.log(mascotas.value);
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        function obtenerClientes() {
            fetch("http://127.0.0.1:8000/clientes", {
                method: "GET",
            })
                .then(async (response) => {
                    const data = await response.json();
                    if (!response.ok) {
                        const error =
                            data && data.detail ? data.detail : response.statusText;
                        return Promise.reject(error);
                    }
                    //console.log(data)
                    clientes.value = data;
                    console.log(clientes.value);
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        /*function obtenerHistorias() {
            fetch("http://127.0.0.1:8000/historias", {
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
                    historias.value = data;
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }*/
        return {
            error_message,
            historia,
            historias,
            mascota,
            mascotas,
            is_disabled,
            canCreate,
            canEdit,
            canDelete,

            obtenerClientes,
            obtenerMascotas,
            //obtenerHistorias,
            guardarHistoria,
        }
    },
    mounted() {

        console.log('Component mounted.')
        this.obtenerHistorias();
        this.obtenerMascotas();
        this.obtenerClientes();
    }
}
</script>
