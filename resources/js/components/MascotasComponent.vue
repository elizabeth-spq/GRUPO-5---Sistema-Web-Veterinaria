<template>
    <div class="container">
        <div class="mt-5">
            <button type="button" class="btn btn-primary px-4" @click="nuevaMascota()">Nueva Mascota </button>
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
                    <tr v-for="(mascota,index) in mascotas">
                        <th scope="row">{{ index + 1 }}</th>
                        <td>{{ mascota.nombre }}</td>
                        <td>{{ mascota.cliente_id }}</td>
                        <td>
                            <span v-if="mascota.animal_id==1">Gato</span>
                            <span v-if="mascota.animal_id==2">Perro</span>
                        </td>
                        <td>
                            <span v-if="mascota.raza_id==1">Mestizo</span>
                            <span v-if="mascota.raza_id==2">Viringo</span>
                            <span v-if="mascota.raza_id==3">Labrador retriever</span>
                            <span v-if="mascota.raza_id==4">Pastor alemán</span>
                            <span v-if="mascota.raza_id==5">Yorkshire terrier</span>
                            <span v-if="mascota.raza_id==6">Beagle</span>
                            <span v-if="mascota.raza_id==7">Golder retriever</span>
                            <span v-if="mascota.raza_id==8">Bulldog</span>
                            <span v-if="mascota.raza_id==9">Boxer</span>
                            <span v-if="mascota.raza_id==10">Poodle</span>
                            <span v-if="mascota.raza_id==11">Shih tzu</span>
                            <span v-if="mascota.raza_id==12">Chow chow</span>
                            <span v-if="mascota.raza_id==13">Pekines</span>
                            <span v-if="mascota.raza_id==14">Mestizo</span>
                        </td>
                        <td>{{ mascota.fec_nac }}</td>
                        <td>
                            <span v-if="mascota.sexo==1">macho</span>
                            <span v-if="mascota.sexo==2">hembra</span>
                        </td>
                        <td>{{ mascota.color }}</td>
                        <td>{{ mascota.altura }}</td>
                        <td>{{ mascota.peso }}</td>
                        <td>
                            <span v-if="mascota.estirilizado==1">Si</span>
                            <span v-if="mascota.estirilizado==2">No</span>
                        </td>
                        <td>
                            <span v-if="mascota.vacunas==1">Si</span>
                            <span v-if="mascota.vacunas==2">No</span>
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
                                    @click="editarMascota(mascota)">Editar</button></div>
                                <div class="col"> <button type="button" class="btn btn-danger w-100"
                                    @click="eliminarMascota(mascota.id)">Eliminar</button></div>
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
                                        aria-describedby="requiredDueño" v-model="clienteSeleccionado">
                                    <option value="">Seleccione...</option>
                                    <option v-for="cliente in clientes" :value="cliente.id">{{ cliente.nombre }}</option>
                                </select>
                                <label for="dueño" class="ms-2">Dueño *</label>
                                <div id="requiredDueño" class="form-text text-danger" v-if="!clienteSeleccionado">
                                    Obligtorio
                                </div>
                            </div>
                            
                            <!--Seccion de raza y especie-->
                            <div class="col-12 d-flex">
                                <div class=" form-floating col-6 mb-3">
                                    <select class="form-select" id="Animal" aria-label="Floating label select example"
                                            aria-describedby="requiredAnimal" v-model="animalSeleccionado">
                                        <option value="">Seleccion...</option>
                                        <option v-for="animal in animales" :value="animal.id">{{ animal.nombre }}</option>
                                    </select>
                                    <label for="animal" class="ms-2">Animal *</label>
                                    <div id="requiredAnimal" class="form-text text-danger" v-if="!animalSeleccionado">
                                        Obligtorio
                                    </div>
                                </div>
                                <div class=" form-floating col-6 mb-3">
                                    <select class="form-select" id="Raza" aria-label="Floating label select example"
                                            aria-describedby="requiredRaza" v-model="razaSeleccionado">
                                        <option value="">Seleccione...</option>
                                        <option v-for="raza in razas" :value="raza.id">{{ raza.nombre }}</option>
                                    </select>
                                    <label for="raza" class="ms-2">Raza *</label>
                                    <div id="requiredRaza" class="form-text text-danger" v-if="!razaSeleccionado">
                                        Obligtorio
                                    </div>
                                </div>
                            </div>
                            <!--Seccion de raza y especie-->

                            <div class="col-12 mb-3">
                                <label class="ms-2" for="fecNac">Fecha de Nacimiento *</label>
                                <input type="date" class="form-control" id="fecNac" aria-describedby="requiredFecNac"
                                    v-model="mascota.fec_nac">
                                <div id="requiredFecNac" class="form-text text-danger" v-if="mascota.fec_nac == ''">
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
                                        <div id="requiredEstirilizado" class="form-text text-danger" v-if="mascota.estirilizado == 0">
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
                        @click="actualizarMascota(mascota.id)">Actualizar registro</button>
                    <button type="button" class="btn btn-primary" v-else @click="guardarMascota()">Guardar
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
import { ref, reactive } from 'vue';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
    export default {
        setup() {
            const error_message = ref("")
            const animales = ref([])
            const animalSeleccionado = ref('')
            const razas = ref([])
            const razaSeleccionado = ref('')
            const clientes = ref([])
            const clienteSeleccionado = ref('')
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
            function closeModal(){
                modal_mascota.mdl_mas.hide()
                cleanForm()
            }
            function closeModalDelete() {
            modal_delete.mdl_delete.hide()
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
            function nuevaMascota() {
                cleanForm()
                openModal()
            }
            function openModal(){
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

            function guardarMascota(){
                mascota.cliente_id = clienteSeleccionado.value;
                mascota.animal_id = animalSeleccionado.value;
                mascota.raza_id = razaSeleccionado.value;
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
                        //console.log(data)
                        animales.value = data;
                        console.log(animales.value);
                    })
                    .catch((error) => {
                        error_message.value = error;
                        console.error("There was an error!", error);
                    });
            }function obtenerNomRazas() {
                fetch("http://127.0.0.1:8000/razas", {
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
                        razas.value = data;
                        console.log(razas.value);
                    })
                    .catch((error) => {
                        error_message.value = error;
                        console.error("There was an error!", error);
                    });
                    
            }
            return{
                error_message,
                modal_mascota,
                modal_delete,
                mascota,
                mascotas,
                modal_mascota,
                animales,
                animalSeleccionado,
                clientes,
                clienteSeleccionado,
                razas,
                razaSeleccionado,

                actualizarMascota,
                guardarMascota,
                nuevaMascota,
                editarMascota,
                eliminarMascota,
                eliminarRegistro,
                obtenerNomAnimales,
                obtenerNomClientes,
                obtenerNomRazas,
                obtenerMascotas,
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.obtenerMascotas()
            this.obtenerNomAnimales()
            this.obtenerNomClientes()
            this.obtenerNomRazas()
            this.modal_mascota.mdl_mas = new bootstrap.Modal('#mdl-mascota', {})
            this.modal_delete.mdl_delete = new bootstrap.Modal('#mdl-delete', {})
        }
    }
</script>
