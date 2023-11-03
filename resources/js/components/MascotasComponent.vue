<template>
    <div class="container">
        <div class="mt-5">
            <button type="button" class="btn btn-primary px-4" @click="nuevaMascota()"  v-if="canCreate">Nueva Mascota </button>
        </div>
        <div class="mt-5">
            <table class="table table-hover">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Dueño</th>
                        <th scope="col">Especie</th>
                        <th scope="col">Raza</th>
                        <th scope="col">Fec nacimiento</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Color</th>
                        <th scope="col">Altura</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Esterilizado</th>
                        <th scope="col">Vacunas</th>
                        <th scope="col">Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(mascota, index) in mascotas">
                        <th scope="row">{{ index + 1 }}</th>
                        <td>{{ mascota.nombre }}</td>
                        <td>{{ mascota.cliente.nombre }} {{ mascota.cliente.apellido }}</td>
                        <td>
                            <span v-if="mascota.animal_id == 1">Gato</span>
                            <span v-if="mascota.animal_id == 2">Perro</span>
                        </td>
                        <td>
                            <span v-if="mascota.raza_id == 1">Mestizo</span>
                            <span v-if="mascota.raza_id == 2">Viringo</span>
                            <span v-if="mascota.raza_id == 3">Labrador retriever</span>
                            <span v-if="mascota.raza_id == 4">Pastor alemán</span>
                            <span v-if="mascota.raza_id == 5">Yorkshire terrier</span>
                            <span v-if="mascota.raza_id == 6">Beagle</span>
                            <span v-if="mascota.raza_id == 7">Golder retriever</span>
                            <span v-if="mascota.raza_id == 8">Bulldog</span>
                            <span v-if="mascota.raza_id == 9">Boxer</span>
                            <span v-if="mascota.raza_id == 10">Poodle</span>
                            <span v-if="mascota.raza_id == 11">Shih tzu</span>
                            <span v-if="mascota.raza_id == 12">Chow chow</span>
                            <span v-if="mascota.raza_id == 13">Pekines</span>
                            <span v-if="mascota.raza_id == 14">Mestizo</span>
                        </td>
                        <td>{{ mascota.fec_nac }}</td>
                        <td>
                            <span v-if="mascota.sexo == 1">macho</span>
                            <span v-if="mascota.sexo == 2">hembra</span>
                        </td>
                        <td>{{ mascota.color }}</td>
                        <td>{{ mascota.altura }}</td>
                        <td>{{ mascota.peso }}</td>
                        <td>
                            <span v-if="mascota.estirilizado == 1">Si</span>
                            <span v-if="mascota.estirilizado == 2">No</span>
                        </td>
                        <td>
                            <span v-if="mascota.vacunas == 1">Si</span>
                            <span v-if="mascota.vacunas == 2">No</span>
                        </td>
                        <td>
                            <i :class="mascota.estado == 1 ? 'bi bi-check2-circle' : 'bi bi-exclamation-circle'">
                                <span v-if="mascota.estado == 1">Activo</span>
                                <span v-else>Inactivo</span>
                            </i>
                        </td>
                        <td>
                            <div class="row g-1">
                                <div class="col"> <button type="button" class="btn btn-warning w-100"
                                        @click="editarMascota(mascota)"  v-if="canEdit">Editar</button></div>
                                <div class="col"> <button type="button" class="btn btn-danger w-100"
                                        @click="eliminarMascota(mascota.id)"  v-if="canDelete">Eliminar</button></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!--formulario de creacion de mascota-->

    <div class="modal" tabindex="-1" id="mdl-mascota">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="mascota.id > 0">Editar mascota</h5>
                    <h5 class="modal-title" v-else>Nuevo mascota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 form-floating mb-3">
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre *"
                                    aria-describedby="requiredNombre" v-model="mascota.nombre">
                                <label class="ms-2" for="floatingInput">Nombre *</label>
                                <div id="requiredNombre" class="form-text text-danger" v-if="mascota.nombre == ''">
                                    Obligtorio, ejemplo: Boris, Parchis
                                </div>
                            </div>

                            <div class="col-12 form-floating mb-3">
                                <select class="form-select" id="Dueño" aria-label="Floating label select example"
                                    aria-describedby="requiredDueño" v-model="mascota.cliente_id">
                                    <option value="0" disabled>Seleccione...</option>
                                    <option v-for="cliente in clientes" :value="cliente.id">{{ cliente.nombre }} {{
                                        cliente.apellido }}</option>
                                </select>
                                <label for="dueño" class="ms-2">Dueño *</label>
                                <div id="requiredDueño" class="form-text text-danger" v-if="mascota.cliente_id == 0">
                                    Obligtorio
                                </div>
                            </div>

                            <!--Seccion de raza y especie-->
                            <div class="col-12 d-flex">
                                <div class=" form-floating col-6 mb-3">
                                    <select class="form-select" id="Animal" aria-label="Floating label select example"
                                        aria-describedby="requiredAnimal" v-model="mascota.animal_id"
                                        @click="obtenerNomRazas(mascota.animal_id)">
                                        <option value="" disabled>Seleccione...</option>
                                        <option v-for="animal in animales" :value="animal.id">{{ animal.nombre }}</option>
                                    </select>
                                    <label for="animal" class="ms-2">Animal *</label>
                                    <div id="requiredAnimal" class="form-text text-danger" v-if="mascota.animal_id == 0">
                                        Obligtorio
                                    </div>
                                </div>
                                <div class=" form-floating col-6 mb-3">
                                    <select class="form-select" id="Raza" aria-label="Floating label select example"
                                        aria-describedby="requiredRaza" v-model="mascota.raza_id">
                                        <option value="0" disabled>Seleccione...</option>
                                        <option v-for="raza in razas" :value="raza.id">{{ raza.nombre }}</option>
                                    </select>
                                    <label for="raza" class="ms-2">Raza *</label>
                                    <div id="requiredRaza" class="form-text text-danger" v-if="mascota.raza_id == 0">
                                        Obligtorio
                                    </div>
                                </div>
                            </div>
                            <!--Seccion de raza y especie-->
                            <div class="col-12 mb-3">
                                <label class="ms-2" for="fecNac">Fecha de Nacimiento *</label>
                                <input id="fecNac" type="text" class="form-control" placeholder="02/02/2000"
                                    v-model="mascota.fec_nac" aria-describedby="requiredFecNac" />
                                <div id="requiredFecNac" class="form-text text-danger" v-show="mascota.fec_nac == ''">
                                    Obligtorio, ejemplo: 02/02/2000
                                </div>
                            </div>

                            <div class=" form-floating col-12 mb-3">
                                <select class="form-select" id="sexo" aria-label="Floating label select example"
                                    aria-describedby="requiredsexo" v-model="mascota.sexo">
                                    <option value="0" selected disabled>Seleccione ...</option>
                                    <option value="1">Macho</option>
                                    <option value="2">Hembra</option>
                                </select>
                                <label for="sexo" class="ms-2">Sexo *</label>
                                <div id="requiredsexo" class="form-text text-danger" v-if="mascota.sexo == 0">
                                    Obligtorio
                                </div>
                            </div>
                            <div class="col-12 form-floating mb-3">
                                <input type="text" class="form-control" id="color" placeholder="Color *"
                                    aria-describedby="requiredColor" v-model="mascota.color">
                                <label class="ms-2" for="floatingInput">Color *</label>
                                <div id="requiredColor" class="form-text text-danger" v-if="mascota.color == ''">
                                    Obligtorio, ejemplo: Blanco con manchas negras
                                </div>
                            </div>

                            <div class="col-12 d-flex">
                                <div class=" form-floating col-6 mb-3">
                                    <input type="text" class="form-control" id="Altura" placeholder="Altura *"
                                        aria-describedby="requiredAltura" v-model="mascota.altura">
                                    <label class="ms-2" for="floatingInput">Altura (Cm)*</label>
                                    <div id="requiredAltura" class="form-text text-danger" v-if="mascota.altura == ''">
                                        Obligtorio, ejemplo: 1.25 cm
                                    </div>
                                </div>
                                <div class=" form-floating col-6 mb-3">
                                    <input type="text" class="form-control" id="Peso" placeholder="Peso *"
                                        aria-describedby="requiredPeso" v-model="mascota.peso">
                                    <label class="ms-2" for="floatingInput">Peso (Kg) *</label>
                                    <div id="requiredPeso" class="form-text text-danger" v-if="mascota.peso == ''">
                                        Obligtorio, ejemplo: 65.7 kg
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 d-flex">
                                <div class=" form-floating col-6 mb-3">
                                    <select class="form-select" id="Estirilizado" aria-label="Floating label select example"
                                        aria-describedby="requiredEstirilizado" v-model="mascota.estirilizado">
                                        <option value="0" selected disabled>Seleccione ...</option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                    </select>
                                    <label for="Est" class="ms-2">Estirilizado *</label>
                                    <div id="requiredEstirilizado" class="form-text text-danger"
                                        v-if="mascota.estirilizado == 0">
                                        Obligtorio
                                    </div>
                                </div>
                                <div class=" form-floating col-6 mb-3">
                                    <select class="form-select" id="Vacunas" aria-label="Floating label select example"
                                        aria-describedby="requiredVacuna" v-model="mascota.vacunas">
                                        <option value="0" selected disabled>Seleccione ...</option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                    </select>
                                    <label for="Vac" class="ms-2">Vacunas completas *</label>
                                    <div id="requiredVacuna" class="form-text text-danger" v-if="mascota.vacunas == 0">
                                        Obligtorio
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <h6>Estado</h6>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="vetStatus"
                                        v-model="mascota.estado" :checked="mascota.estado == 1 ? true : false">
                                    <label class="form-check-label" for="vetStatus">
                                        <span v-if="mascota.estado > 0">Activo</span>
                                        <span v-else>Inactivo</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" v-if="mascota.id > 0"
                        @click="actualizarMascota(mascota.id)" :disabled="is_disabled">Actualizar registro</button>
                    <button type="button" class="btn btn-primary" :disabled="is_disabled" v-else @click="guardarMascota()">Guardar
                        registro</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="mdl-delete">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar mascota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body align-self-center">
                    <span class="text-center text-danger">Esta acción NO se puede REVERTIR</span> <br>
                    <span class="text-center">¿Esta seguro de eliminar este registro?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="eliminarRegistro(mascota.id)">Eliminar
                        registro</button>
                </div>
            </div>
        </div>
    </div>

    <!--formulario de creacion de mascota-->
</template>

<script>
import { ref, reactive, watch } from 'vue';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
export default {
    setup() {
        const canCreate = ref(window.canCreate);
        const canEdit = ref(window.canEdit);
        const canDelete = ref(window.canDelete);
        const error_message = ref("")
        const animal = reactive({
            id: 0,
            nombre: ""
        })
        const animales = ref([])
        const raza = reactive({
            id: 0,
            nombre: "",
            animal_id: 0
        })
        const is_disabled = ref(false)
        const razas = ref([])
        const clientes = ref([])
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
        const modal_mascota = reactive({
            mdl_mas: null,
        })
        const modal_delete = reactive({
            mdl_delete: null,
        })
        function actualizarMascota(Id) {
            console.log(mascota)
            fetch("http://127.0.0.1:8000/mascotas/" + Id, {
                method: "PUT",
                headers: {
                    Accept: "Application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(mascota),
            })
                .then(async (response) => {
                    //const data = await response.json();
                    if (!response.ok) {
                        const error =
                            "error"
                        return Promise.reject(error);
                    }

                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
            obtenerMascotas();
            closeModal();
        }
        function cleanForm() {
            mascota.id = 0,
                mascota.nombre = "",
                mascota.cliente_id = 0,
                mascota.animal_id = 0,
                mascota.raza_id = 0,
                mascota.fec_nac = "",
                mascota.sexo = 0,
                mascota.color = "",
                mascota.altura = 0,
                mascota.peso = 0,
                mascota.estirilizado = 0,
                mascota.vacunas = 0,
                mascota.estado = 0
        }
        function closeModal() {
            modal_mascota.mdl_mas.hide()
            cleanForm()
        }
        function closeModalDelete() {
            modal_delete.mdl_delete.hide()
        }
        function desabilitar() {
            is_disabled.value = mascota.nombre == "" ||
                mascota.cliente_id == 0 ||
                mascota.animal_id == 0 ||
                mascota.raza_id == 0 ||
                mascota.fec_nac == "" ||
                mascota.sexo == 0 ||
                mascota.color == "" ||
                mascota.altura == 0 ||
                mascota.peso == 0 ||
                mascota.estirilizado == 0 ||
                mascota.vacunas == 0
                 ? true : false;
        }
        function editarMascota(mascota_tabla) {
            cleanForm()
            mascota.id = mascota_tabla.id
            mascota.nombre = mascota_tabla.nombre
            mascota.cliente_id = mascota_tabla.cliente_id
            mascota.animal_id = mascota_tabla.animal_id
            mascota.raza_id = mascota_tabla.raza_id
            mascota.fec_nac = mascota_tabla.fec_nac
            mascota.sexo = mascota_tabla.sexo
            mascota.color = mascota_tabla.color
            mascota.altura = mascota_tabla.altura
            mascota.peso = mascota_tabla.peso
            mascota.estirilizado = mascota_tabla.estirilizado
            mascota.vacunas = mascota_tabla.vacunas
            mascota.estado = mascota_tabla.estado
            openModal()
        }
        function eliminarMascota(Id) {
            mascota.id = Id
            openModalDetele()
        }
        function eliminarRegistro(Id) {
            fetch("http://127.0.0.1:8000/mascotas/" + Id, {
                method: "DELETE",
                headers: {
                    Accept: "Application/json",
                    "Content-Type": "application/json",
                },
            })
                .then(async (response) => {
                    const data = await response.json();
                    if (!response.ok) {
                        const error =
                            data && data.detail ? data.detail : response.statusText;
                        return Promise.reject(error);
                    }
                    obtenerMascotas();
                    closeModalDelete()
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        function mostrarCalendarioNac() {
            $('#fecNac').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1980,
                maxYear: parseInt(moment().format('YYYY'), 10),
                maxDate: moment(),
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
            $("#fecNac").on("change", function () {
                mascota.fec_nac = $("#fecNac").val();
            });
        }
        function nuevaMascota() {
            cleanForm()
            mascota.estado = 1;
            mascota.animal_id = 2;
            openModal()
        }
        function openModal() {
            modal_mascota.mdl_mas.show()
        }
        function openModalDetele() {
            modal_delete.mdl_delete.show()
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
                    console.log(data)
                    mascotas.value = data;
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }

        function guardarMascota() {
            fetch("http://127.0.0.1:8000/mascotas", {
                method: "POST",
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(mascota),
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

            obtenerMascotas();
            closeModal();
        }
        function obtenerNomClientes() {
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
        function obtenerNomAnimales() {
            fetch("http://127.0.0.1:8000/animales", {
                method: "GET",
            })
                .then(async (response) => {
                    const data = await response.json();
                    if (!response.ok) {
                        const error =
                            data && data.detail ? data.detail : response.statusText;
                        return Promise.reject(error);
                    }
                    animales.value = data;

                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        } function obtenerNomRazas(Id) {
            fetch("http://127.0.0.1:8000/razas/" + Id, {
                method: "GET",
            })
                .then(async (response) => {
                    const data = await response.json();
                    if (!response.ok) {
                        const error =
                            data && data.detail ? data.detail : response.statusText;
                        return Promise.reject(error);
                    }
                    razas.value = data;
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });

        }
        watch(mascota, (newVet, oldVet) => {
            error_message.value = ""
            desabilitar()
        })

        return {
            error_message,
            is_disabled,
            modal_mascota,
            modal_delete,
            mascota,
            mascotas,
            modal_mascota,
            animales,
            animal,
            clientes,
            raza,
            razas,
            canCreate,
            canEdit,
            canDelete,
            actualizarMascota,
            guardarMascota,
            nuevaMascota,
            desabilitar,
            editarMascota,
            eliminarMascota,
            eliminarRegistro,
            mostrarCalendarioNac,
            obtenerNomAnimales,
            obtenerNomClientes,
            obtenerNomRazas,
            obtenerMascotas,
        }
    },
    mounted() {
        this.obtenerMascotas()
        this.obtenerNomAnimales()
        this.obtenerNomClientes()
        this.modal_mascota.mdl_mas = new bootstrap.Modal('#mdl-mascota', {})
        this.modal_delete.mdl_delete = new bootstrap.Modal('#mdl-delete', {})
        this.mostrarCalendarioNac()
    }
}
</script>
