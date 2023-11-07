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

    <input id="fecNac" type="text" class="form-control" placeholder="02/02/2000" v-model="error_message"
        aria-describedby="requiredFecNac" />


    <div class="modal" tabindex="-1" id="mdl-cita">
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
                            <div class=" form-floating col-12">
                                    <select class="form-select" id="tipoCita" aria-label="Floating label select example"
                                        aria-describedby="requiredTipoCita" v-model="cita.tipo_id"
                                        :disabled="cita.tipo_id > 0 ? true : false">
                                        <option value="0" selected disabled>Seleccione ...</option>
                                        <option v-for="(tipo, index) in tipos" :value="tipo.tiempo">{{ tipo.nombre }}</option>
                                    </select>
                                    <label for="tipoCita">Tipo Doc. *</label>
                                    <div id="requiredTipoCita" class="form-text text-danger"
                                        v-if="cita.tip_doc == ''">
                                        Obligtorio
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" v-if="cita.id > 0"
                        @click="actualizarCita(cita.id)">Actualizar registro</button>
                    <button type="button" class="btn btn-primary"  v-else
                        @click="guardarCita()">
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
        const modal_cita = reactive({
            mdl_cita: null,
        })
        const tipos = ref([])
        const tipo = reactive({
            id:0,
            nombre:"",
            tiempo:0,
            precio:0.0,
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
                //console.log($('#fecNac').val);
                error_message.value = $("#fecNac").val();
                var startDateTime = error_message.value
                console.log(startDateTime)
                var newDateTime = moment(startDateTime).startOf('hours').add(0.34, 'hours').format('YYYY-MM-DD HH:mm');
                console.log(newDateTime);
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
        function obtenerTipoCita(){
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
        function openModalReservarCita(){
            modal_cita.mdl_cita.show()
        }
        function reservarCita() {
            cleanForm()
            openModalReservarCita()
        }
        return {
            cita,
            citas,
            error_message,
            error_message_two,
            modal_cita,
            tipos,
            tipo,
            mostrarCalendarioNac,
            obtenerCitas,
            obtenerTipoCita,
            reservarCita,
        }
    },
    mounted() {
        console.log("Component mounted")
        this.mostrarCalendarioNac()
        this.obtenerCitas()
        this.obtenerTipoCita()
        this.modal_cita.mdl_cita = new bootstrap.Modal('#mdl-cita', {})
    }
}
</script>
