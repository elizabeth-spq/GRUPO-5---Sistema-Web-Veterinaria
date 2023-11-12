<template>
    <div class="container">
        <div class="mt-1">
            <button type="button" class="btn btn-primary px-4" @click="reservarCita()">Reservar Cita</button>
        </div>
        <div class="mt-3">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">Calendario</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Lista</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                    tabindex="0">...
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-dark align-middle text-center">
                                <th scope="col">#</th>
                                <th scope="col">Tipo de Cita</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Mascota</th>
                                <th scope="col">Especialidad</th>
                                <th scope="col">Fecha de Inicio</th>
                                <th scope="col">Fecha de fin</th>
                                <th scope="col">Veterinario</th>
                                <th scope="col">Total</th>
                                <th scope="col">Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(cita, index) in citas" class="text-center align-middle">
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ cita.tipo.nombre }}</td>
                                <td>{{ cita.cliente.nombre }} {{ cita.cliente.apellido }}</td>
                                <td>{{ cita.mascota.nombre }}</td>
                                <td>{{ cita.especialidad.nombre }}</td>
                                <td>{{ cita.fec_ini }}</td>
                                <td>{{ cita.fec_fin }}</td>
                                <td>{{ cita.veterinario.nombre }} {{ cita.veterinario.apellido }}</td>
                                <td>{{ cita.total }}</td>
                                <td>
                                    <span v-if="cita.estado_cita == 1">Programada</span>
                                    <span v-if="cita.estado_cita == 2">En atención</span>
                                    <span v-if="cita.estado_cita == 3">Atendida</span>
                                    <span v-if="cita.estado_cita == 4">Cancelada</span>
                                </td>
                                <td>
                                    <div class="row g-1">
                                        <div class="col"> <button type="button" class="btn btn-warning w-100"
                                                @click="mostrarDetalle(cita)">Detalle</button></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <div class="modal" id="mdl-cita">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="cita.id > 0">Editar Cita</h5>
                    <h5 class="modal-title" v-else>Registrar Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <h6>Cliente</h6>
                                <select class="form-select" id="single-select-cliente"
                                    data-placeholder="Seleccione un cliente">
                                    <option></option>
                                    <option v-for="cliente in clientes" :value="cliente.id">{{ cliente.nombre }} {{
                                        cliente.apellido }}</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <h6>Mascota</h6>
                                <select class="form-select" id="single-select-mascota"
                                    data-placeholder="Seleccione una mascota" :disabled="cita.cliente_id==0 ? true:false">
                                    <option></option>
                                    <option v-for="mascota in mascotas" :value="mascota.id">{{ mascota.nombre }}</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <h6>Tipo de cita</h6>
                                <select class="form-select" id="single-select-tipo-cita"
                                    data-placeholder="Seleccione un tipo de cita">
                                    <option></option>
                                    <option v-for="(tipo, index) in tipos" :value="tipo.id">{{ tipo.nombre }}</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <h6>Fecha y hora</h6>
                                <input id="fecNac" type="text" class="form-control" placeholder="02/02/2000"
                                    v-model="error_message" aria-describedby="requiredFecNac" :disabled="cita.tipo_id==0 ? true:false" />
                            </div>
                            <div class="col-12 mb-3">
                                <h6>Especialidad</h6>
                                <select class="form-select" id="single-select-especialidad"
                                    data-placeholder="Seleccione una especialidad">
                                    <option></option>
                                    <option v-for="(especialidad, index) in especialidades" :value="especialidad.id">{{ especialidad.nombre }}</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <h6>Veterinario</h6>
                                <select class="form-select" id="single-select-veterinario"
                                    data-placeholder="Seleccione una especialidad" :disabled="cita.espec_id==0 ? true:false">
                                    <option></option>
                                    <option v-for="(veterinario, index) in veterinarios" :value="veterinario.id">{{ veterinario.nombre }} {{ veterinario.apellido }}</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" v-if="cita.id > 0"
                        @click="actualizarCita(cita.id)">Actualizar registro</button>
                    <button type="button" class="btn btn-primary" v-else @click="guardarCita()">
                        Guardar registro
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { ref, reactive } from 'vue';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
export default {
    setup() {
        const error_message = ref("")
        const tiempo_cita = ref("")
        const error_message_two = ref("")
        const cita = reactive({
            id: 0,
            tipo_id: 0,
            cliente_id: 0,
            mascota_id: 0,
            espec_id: 0,
            fec_ini: "2023-11-03 09:00:00",
            fec_fin: "2023-11-03 09:30:00",
            vet_id: 0,
            observaciones: "",
            cargos_adicionales: "",
            subtotal: 0.0,
            monto_adicional: 0.0,
            total: 0.0,
            pago_previo: 0.0,
            pago_pendiente: 0.0,
            estado_cita: 0,
        })
        const citas = ref([])
        const clientes = ref([])
        const cliente = reactive({
            id: 0,
            nombre: "",
            apellido: "",
            tip_doc: 0,
            documento: "",
            telefono: "",
            direccion: "",
            email: "",
            estado: 0,
        })
        const especialidades = ref([])
        const especialidad = reactive({
            id: 0,
            nombre: "",
        })
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
        const modal_cita = reactive({
            mdl_cita: null,
        })
        const tipos = ref([])
        const tipo = reactive({
            id: 0,
            nombre: "",
            tiempo: 0,
            precio: 0.0,
        })
        const veterinarios = ref([])
        const veterinario = reactive({
            id: 0,
            nombre: "",
            apellido: "",
            especialidad: 0,
        })
        function cleanForm() {
            cita.id = 0,
                cita.tipo_id = 0,
                cita.cliente_id = 0,
                cita.mascota_id = 0,
                cita.espec_id = 0,
                cita.fec_ini = "",
                cita.fec_fin = "",
                cita.vet_id = 0,
                cita.observaciones = "",
                cita.cargos_adicionales = "",
                cita.subtotal = 0.0,
                cita.monto_adicional = 0.0,
                cita.total = 0.0,
                cita.pago_previo = 0.0,
                cita.pago_pendiente = 0.0,
                cita.estado_cita = 0
        }
        function cleanMascota() {
            mascotas.value=[]
            mascota.id = 0
            mascota.nombre = ""
            mascota.cliente_id = 0
            mascota.animal_id = 0
            mascota.raza_id = 0
            mascota.fec_nac = ""
            mascota.sexo = 0
            mascota.color = ""
            mascota.altura = 0
            mascota.peso = 0
            mascota.estirilizado = 0
            mascota.vacunas = 0
            mascota.estado = 0
        }
        function mostrarCalendarioNac() {
            $('#fecNac').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                minDate: moment().startOf('hour'),
                maxDate: moment().startOf('year').add(1, 'year'),
                locale: {
                    format: 'YYYY-MM-DD HH:mm'
                }
            });
            $("#fecNac").on("change", function () {
                cita.fec_ini = $("#fecNac").val();
                cita.fec_fin = moment(cita.fec_ini).startOf('hours').add(tiempo_cita.value, 'hours').format('YYYY-MM-DD HH:mm');
            });
        }
        function mostrarSelectSingleTipo() {
            $('#single-select-tipo-cita').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $('#mdl-cita .modal-content')
            });
            $("#single-select-tipo-cita").on("change", function () {
                cita.tipo_id = $("#single-select-tipo-cita").val();
                obtenerTipoId(cita.tipo_id);
            });
        }
        function mostrarSelectSingleCLiente() {
            $('#single-select-cliente').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $('#mdl-cita .modal-content')
            });
            $("#single-select-cliente").on("change", function () {
                cleanMascota()
                cita.cliente_id = $("#single-select-cliente").val();
                obenerMascotasByCliente(cita.cliente_id);
            });
        }
        function mostrarSelectSingleMascota() {
            $('#single-select-mascota').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $('#mdl-cita .modal-content')
            });
            $("#single-select-mascota").on("change", function () {
                cita.cliente_id = $("#single-select-mascota").val();
            });
        }

        function mostrarSelectSingleEspecialidad() {
            $('#single-select-especialidad').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $('#mdl-cita .modal-content')
            });
            $("#single-select-especialidad").on("change", function () {
                cita.espec_id = $("#single-select-especialidad").val();
            });
        }
        function obtenerCitas() {
            fetch("http://127.0.0.1:8000/citas", {
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
                    citas.value = data;
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        function obtenerCliente() {
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
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        function obtenerEspecialidad() {
            fetch("http://127.0.0.1:8000/especialidades", {
                method: "GET",
            })
                .then(async (response) => {
                    const data = await response.json();
                    if (!response.ok) {
                        const error =
                            data && data.detail ? data.detail : response.statusText;
                        return Promise.reject(error);
                    }
                    especialidades.value = data;
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        function obenerMascotasByCliente(Id) {
            fetch("http://127.0.0.1:8000/mascotas/cliente/" + Id, {
                method: "GET",
            })
                .then(async (response) => {
                    const data = await response.json();
                    if (!response.ok) {
                        const error =
                            data && data.detail ? data.detail : response.statusText;
                        return Promise.reject(error);
                    }

                    mascotas.value = data
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        function obtenerTipoId(Id) {
            fetch("http://127.0.0.1:8000/tipocitas/" + Id, {
                method: "GET",
            })
                .then(async (response) => {
                    const data = await response.json();
                    if (!response.ok) {
                        const error =
                            data && data.detail ? data.detail : response.statusText;
                        return Promise.reject(error);
                    }
                    tiempo_cita.value = data.tiempo
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        function obtenerTipoCita() {
            fetch("http://127.0.0.1:8000/tipocitas", {
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
                    tipos.value = data;
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        function obtenerVeterinarios(){
            fetch("http://127.0.0.1:8000/veterinarios/filtro/?especialidad="+1+"&fec_ini="+2023, {
                method: "GET",
            })
                .then(async (response) => {
                    const data = await response.json();
                    if (!response.ok) {
                        const error =
                            data && data.detail ? data.detail : response.statusText;
                        return Promise.reject(error);
                    }
                    veterinarios.value = data;
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        function openModalReservarCita() {
            modal_cita.mdl_cita.show()
        }
        function reservarCita() {
            cleanForm()
            openModalReservarCita()
        }
        return {
            cita,
            citas,
            cliente,
            clientes,
            error_message,
            error_message_two,
            especialidades,
            especialidad,
            modal_cita,
            mascotas,
            mascota,
            tipos,
            tipo,
            tiempo_cita,
            veterinarios,
            veterinario,
            mostrarCalendarioNac,
            mostrarSelectSingleTipo,
            mostrarSelectSingleCLiente,
            mostrarSelectSingleMascota,
            mostrarSelectSingleEspecialidad,
            obtenerCitas,
            obtenerCliente,
            obtenerTipoId,
            obtenerTipoCita,
            obtenerEspecialidad,
            obtenerVeterinarios,
            reservarCita,
        }
    },
    mounted() {
        console.log("Component mounted")
        this.mostrarCalendarioNac()
        this.obtenerCitas()
        this.obtenerCliente()
        this.obtenerEspecialidad()
        this.obtenerTipoCita()
        this.obtenerVeterinarios()
        this.mostrarSelectSingleTipo()
        this.mostrarSelectSingleCLiente()
        this.mostrarSelectSingleMascota()
        this.mostrarSelectSingleEspecialidad()
        this.modal_cita.mdl_cita = new bootstrap.Modal('#mdl-cita', {})

    }
}
</script>
