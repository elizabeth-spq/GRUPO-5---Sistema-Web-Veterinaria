<template>
    <div class="container">
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
                    tabindex="0">
                    <div id="leyenda" class="mt-3">
                        <h6>Estados de cita</h6>
                        <div class="d-flex flex-wrap">
                            <div class="mt-1 me-2">
                                <i class="bi bi-circle-fill text-success"></i>
                                <span> Programada </span>
                            </div>
                            <div class="mt-1 me-2">
                                <i class="bi bi-circle-fill text-warning"></i>
                                <span> En atención </span>
                            </div>
                            <div class="mt-1 me-2">
                                <i class="bi bi-circle-fill text-info"></i>
                                <span> Atendida </span>
                            </div>
                            <div class="mt-1 me-2">
                                <i class="bi bi-circle-fill text-danger"></i>
                                <span> Cancelada </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button @click="obtenerDate(next_last_dates.last_start_week, next_last_dates.last_end_week)"><i
                                class="bi bi-chevron-left fs-5"></i></button>
                        <button @click="obtenerDate(next_last_dates.next_start_week, next_last_dates.next_end_week)"><i
                                class="bi bi-chevron-right fs-5"></i></button>
                    </div>
                    <div id="calendario" class="container text-center mt-2">
                        <div class="row row-cols-6">
                            <div class="col-2 border border-bottom-0"></div>
                            <div class="col-2 border border-bottom-0" v-for="(dia, index) in dias">
                                <div v-html="dia"></div>
                            </div>
                        </div>
                        <div class="row row-cols-6">
                            <div class="col-2 border-start">Horas</div>
                            <div class="col-2 border-start border-end" v-for="(date, index) in fechas">
                                <div v-html="date"></div>
                            </div>
                        </div>

                        <div id="medicos" class="row row-cols-6 border-bottom" v-for="hora in horas">
                            <div class="col-2 border border-end">{{ hora.hora_ini }} - {{ hora.hora_fin }}
                                <input type="text" class="d-none" v-model="hora.hora_ini">
                                <input type="text" class="d-none" v-model="hora.hora_fin">
                            </div>
                            <div class="col-2 border border-start-0 d-flex flex-wrap" v-for="(date, index) in fechas">
                                <div v-for="veterinario in veterinarios">
                                    <button id="estado" class="btn rounded-circle m-1"
                                        :class="mostrarEstadoCita(veterinario, hora.hora_ini, hora.hora_fin, date)"
                                        @click="reservarCita(veterinario, hora.hora_ini, hora.hora_fin, date)"
                                        :disabled="desabilitaFechaAnterior(date)"
                                        :data-hover="veterinario.especialidad.nombre">
                                        {{ veterinario.especialidad.codigo }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                @click="mostrarDetalle(cita)">Detalle</button>
                                        </div>
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
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                                aria-selected="true">Cita</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane"
                                aria-selected="false">Pago</button>
                        </li>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                        tabindex="0">
                        <div>
                            <h5 class="modal-title" v-if="cita.id > 0">Editar Cita</h5>
                            <h5 class="modal-title" v-else>Registrar Cita</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <h6>Veterinario</h6>
                                        <select class="form-select" v-model="cita.vet_id" disabled>
                                            <option></option>
                                            <option v-for="(veterinario, index) in veterinarios" :value="veterinario.id">{{
                                                veterinario.nombre }} {{ veterinario.apellido }}</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h6>Especialidad</h6>
                                        <select class="form-select" v-model="cita.espec_id" disabled>
                                            <option></option>
                                            <option v-for="(especialidad, index) in especialidades"
                                                :value="especialidad.id">{{
                                                    especialidad.nombre }}</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h6>Fecha y hora</h6>
                                        <input id="fecNac" type="text" class="form-control" disabled />
                                    </div>


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
                                            data-placeholder="Seleccione una mascota"
                                            :disabled="cita.cliente_id == 0 ? true : false">
                                            <option></option>
                                            <option v-for="mascota in mascotas" :value="mascota.id">{{ mascota.nombre }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h6>Tipo de cita</h6>
                                        <select class="form-select" id="single-select-tipo-cita"
                                            data-placeholder="Seleccione un tipo de cita">
                                            <option></option>
                                            <option v-for="(tipo, index) in tipos" :value="tipo.id">{{ tipo.nombre }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-floating col-12 mb-3">
                                        <textarea class="form-control" placeholder="Leave a comment here"
                                            id="floatingTextarea2" style="height: 100px"
                                            v-model="cita.observaciones"></textarea>
                                        <label class="ms-3" for="floatingTextarea2">Observaciones</label>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h6>Cargos Adicionales</h6>
                                        <select class="col-12 form-select" id="multiple-cargos-adicionales"
                                            data-placeholder="Seleccione Cargos Adicionales" multiple>
                                            <option value="50.00">Baño de la mascota</option>
                                            <option value="35.00">Corte de pelo</option>
                                        </select>
                                    </div>
                                    <div class="col-12  mt-3">
                                        <select class="form-select" v-show="cita.id > 0" v-model="cita.estado_cita">
                                            <option value="1" selected>Programada</option>
                                            <option value="2">En atención</option>
                                            <option value="3">Atendida</option>
                                            <option value="4">Cancelada</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mt-4 d-flex">
                                        <label for="staticSubtotal" class="col-sm-5 col-form-label">Sub total (S/.)</label>
                                        <div class="col-sm-7">
                                            <input type="text" readonly class="form-control-plaintext" id="staticSubtotal"
                                                v-model="cita.subtotal">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2 d-flex">
                                        <label for="staticMonto" class="col-sm-5 col-form-label">Monto Adicional
                                            (S/.)</label>
                                        <div class="col-sm-7">
                                            <input type="text" readonly class="form-control-plaintext" id="staticMonto"
                                                v-model="cita.monto_adicional">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2 d-flex">
                                        <label for="staticTotal" class="col-sm-5 col-form-label">Total (S/.)</label>
                                        <div class="col-sm-7">
                                            <input type="text" readonly class="form-control-plaintext" id="staticTotal"
                                                v-model="cita.total">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2 d-flex">
                                        <label for="staticPagoPrevio" class="col-sm-5 col-form-label">Pago previo
                                            (S/.)</label>
                                        <div class="col-sm-7">
                                            <input type="text" readonly class="form-control-plaintext" id="staticPagoPrevio"
                                                v-model="cita.pago_previo">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2 d-flex">
                                        <label for="staticPagoPendiente" class="col-sm-5 col-form-label">Pago pendiente
                                            (S/.)</label>
                                        <div class="col-sm-7">
                                            <input type="text" readonly class="form-control-plaintext"
                                                id="staticPagoPendiente" v-model="cita.pago_pendiente">
                                        </div>
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
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                        tabindex="0">
                        <div class="container">
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="inputPassword6" class="col-form-label">Tipo de documento</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" id="inputPassword6" class="form-control"
                                        aria-describedby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="inputPassword6" class="col-form-label">Documento</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" id="inputPassword6" class="form-control"
                                        aria-describedby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="inputPassword6" class="col-form-label">RUC / DNI / Pasapote / Carné</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" id="inputPassword6" class="form-control"
                                        aria-describedby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="inputPassword6" class="col-form-label">Nombre</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" id="inputPassword6" class="form-control"
                                        aria-describedby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="inputPassword6" class="col-form-label">Dirección</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" id="inputPassword6" class="form-control"
                                        aria-describedby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="inputPassword6" class="col-form-label">Fecha de emisión</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" id="inputPassword6" class="form-control"
                                        aria-describedby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="inputPassword6" class="col-form-label">Fecha de vencimiento</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" id="inputPassword6" class="form-control"
                                        aria-describedby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="inputPassword6" class="col-form-label">Moneda</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" id="inputPassword6" class="form-control"
                                        aria-describedby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="inputPassword6" class="col-form-label">Subtotal</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" id="inputPassword6" class="form-control"
                                        aria-describedby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="inputPassword6" class="col-form-label">Impuesto</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" id="inputPassword6" class="form-control"
                                        aria-describedby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="inputPassword6" class="col-form-label">Monto Total</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" id="inputPassword6" class="form-control"
                                        aria-describedby="passwordHelpInline">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal" id="mdl-detalle">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detaller de Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="d-flex mb-2">
                                <div class="col-6">Tipo de cita</div>
                                <div class="col-6">
                                    <input type="text" readonly class="form-control" v-model="tipo.nombre">
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="col-6">Cliente</div>
                                <div class="col-6">
                                    <input type="text" readonly class="form-control" v-model="cliente.nombre">
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="col-6">Mascota</div>
                                <div class="col-6">
                                    <input type="text" readonly class="form-control" v-model="mascota.nombre">
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="col-6">Especialidad</div>
                                <div class="col-6">
                                    <input type="text" readonly class="form-control" v-model="especialidad.nombre">
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="col-6">Fecha de Inicio</div>
                                <div class="col-6">
                                    <input type="text" readonly class="form-control" v-model="cita.fec_ini">
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="col-6">Fecha de fin</div>
                                <div class="col-6">
                                    <input type="text" readonly class="form-control" v-model="cita.fec_fin">
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="col-6">Veterinario</div>
                                <div class="col-6">
                                    <input type="text" readonly class="form-control" v-model="veterinario.nombre">
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="col-6">Obseraciones</div>
                                <div class="col-6">
                                    <input type="text" readonly class="form-control">
                                </div>
                            </div>

                            <div class="d-flex mb-2">
                                <div class="col-6">Subtotal</div>
                                <div class="col-6">
                                    <input type="text" readonly class="form-control" v-model="cita.subtotal">
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="col-6">Monto Adicional</div>
                                <div class="col-6">
                                    <input type="text" readonly class="form-control" v-model="cita.monto_adicional">
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="col-6">Total</div>
                                <div class="col-6">
                                    <input type="text" readonly class="form-control" v-model="cita.total">
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="col-6">Pago previo</div>
                                <div class="col-6">
                                    <input type="text" readonly class="form-control" v-model="cita.pago_previo">
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="col-6">Pago pendiente</div>
                                <div class="col-6">
                                    <input type="text" readonly class="form-control" v-model="cita.pago_pendiente">
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="col-6">Estado</div>
                                <div class="col-6">
                                    <input type="text" readonly class="form-control" v-model="cita.estado_cita">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { ref, reactive, watch } from 'vue';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
export default {
    setup() {
        const error_message = ref("")
        const bkg_espec = ref("")
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
        const fechas = ref([])
        const next_last_dates = reactive({
            next_start_week: "",
            next_end_week: "",
            last_start_week: "",
            last_end_week: "",
        })
        const dias = ref([])

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
        const hora = reactive({
            id: 0,
            hora_ini: "",
            hora_fin: ""
        })
        const horas = ref([])
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
        const modal_detalle = reactive({
            mdl_detalle: null,
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
            espec_id: 0,
        })


        function cleanForm() {
            cita.id = 0
            cita.tipo_id = 0
            cita.cliente_id = 0
            cita.mascota_id = 0
            cita.espec_id = 0
            cita.fec_ini = ""
            cita.fec_fin = ""
            cita.vet_id = 0
            cita.observaciones = ""
            cita.cargos_adicionales = ""
            cita.subtotal = 0.0
            cita.monto_adicional = 0.0
            cita.total = 0.0
            cita.pago_previo = 0.0
            cita.pago_pendiente = 0.0
            cita.estado_cita = 1
            $('#single-select-tipo-cita').val(0).trigger("change")
            $('#single-select-cliente').val(0).trigger("change")
            $('#single-select-mascota').val(0).trigger("change")
            $("#fecNac").val('').trigger("change");
            $('#multiple-cargos-adicionales').val([]).trigger("change")
            cliente.id = 0
            cliente.nombre = ""
            cliente.apellido = ""
            cliente.tip_doc = 0
            cliente.documento = ""
            cliente.telefono = ""
            cliente.direccion = ""
            cliente.email = ""
            cliente.estado = 0
            especialidad.id = 0
            especialidad.nombre = ""
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
            tipo.id = 0
            tipo.nombre = ""
            tipo.tiempo = 0
            tipo.precio = 0.0
            veterinario.id = 0
            veterinario.nombre = ""
            veterinario.apellido = ""
            veterinario.especialidad = 0
        }
        function cleanMascota() {
            mascotas.value = []
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
        function closeModal() {
            modal_cita.mdl_cita.hide()
        }
        function desabilitaFechaAnterior(fec) {
            //const todayDate = new Date().toISOString().slice(0, 10);
            //const todayDate = new Date().toLocaleDateString('az', {timeZone: 'America/Lima'})
            const todayDate = moment().format('YYYY-MM-DD');
            if (fec < todayDate) {
                return true
            } else {
                return false
            }
        }
        function guardarCita() {
            cita.estado_cita = 1
            fetch("http://127.0.0.1:8000/citas", {
                method: "POST",
                headers: {
                    Accept: "Application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(cita),
            })
                .then(async (response) => {
                    const data = await response.json();
                    if (!response.ok) {
                        const error =
                            "error";
                        return Promise.reject(error);
                    }
                    console.log(data)
                    if (data.message) {
                        cleanForm()
                        //openModalRegistrado()
                    } else {
                        obtenerCitas();
                        closeModal();
                    }

                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        function mostrarCalendarioNac() {
            $('#fecNac').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                minDate: moment().startOf('hour'),
                maxDate: moment().startOf('year').add(1, 'year'),
                locale: {
                    format: 'YYYY-MM-DD HH:mm'
                }
            });
            $("#fecNac").on("change", function () {
                cita.fec_ini = $("#fecNac").val();
                cita.fec_fin = moment(cita.fec_ini).startOf('hours').add(0.5, 'hours').format('YYYY-MM-DD HH:mm');
                console.log(cita.fec_ini + '-' + cita.fec_fin)
            });
        }
        function mostrarDetalle(cita_table) {
            cleanForm()
            cliente.nombre = cita_table.cliente.nombre
            cliente.apellido = cita_table.cliente.apellido
            tipo.nombre = cita_table.tipo.nombre
            mascota.nombre = cita_table.mascota.nombre
            especialidad.nombre = cita_table.especialidad.nombre
            veterinario.nombre = cita_table.veterinario.nombre
            veterinario.apellido = cita_table.veterinario.apellido
            cita.fec_ini = cita_table.fec_ini
            cita.fec_fin = cita_table.fec_fin
            cita.observaciones = cita_table.observaciones
            cita.subtotal = cita_table.subtotal
            cita.monto_adicional = cita_table.monto_adicional
            cita.total = cita_table.total
            cita.pago_previo = cita_table.pago_previo
            cita.pago_pendiente = cita_table.pago_pendiente
            cita.estado_cita = cita_table.estado_cita
            openModalDetalle()
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
                if (cita.cliente_id > 0) {
                    obenerMascotasByCliente(cita.cliente_id);
                }

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
                cita.mascota_id = $("#single-select-mascota").val();
            });
        }


        function mostrarSelectMultipleCargos() {
            $('#multiple-cargos-adicionales').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
                dropdownParent: $('#mdl-cita .modal-content')
            });
            $("#multiple-cargos-adicionales").on("change", function () {
                const cargos = $("#multiple-cargos-adicionales").select2('data')
                //console.log(cargos)
                cita.cargos_adicionales = JSON.stringify($("#multiple-cargos-adicionales").val())
                let total = 0
                for (let e of cargos) {
                    total += parseFloat(e.element.value);
                }
                cita.monto_adicional = total
                cita.total = cita.monto_adicional + cita.subtotal
                cita.pago_previo = 0.0
                cita.pago_pendiente = cita.total
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
                    console.log(data)
                    clientes.value = data;
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        function obtenerDate(start, end) {
            fetch("http://127.0.0.1:8000/horas/date", {
                method: "POST",
                headers: {
                    Accept: "Application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    start_date: start,
                    end_date: end
                })
            })
                .then(async (response) => {
                    const data = await response.json();
                    if (!response.ok) {
                        const error =
                            data && data.detail ? data.detail : response.statusText;
                        return Promise.reject(error);
                    }
                    console.log(data)
                    fechas.value = data.fechas;
                    dias.value = data.dias;
                    next_last_dates.next_start_week = data.nextStartDate
                    next_last_dates.next_end_week = data.nextEndDate
                    next_last_dates.last_start_week = data.lastStartDate
                    next_last_dates.last_end_week = data.lastEndDate
                    console.log(next_last_dates)

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
        function obtenerHora() {
            fetch("http://127.0.0.1:8000/horas", {
                method: "GET",
            })
                .then(async (response) => {
                    const data = await response.json();
                    if (!response.ok) {
                        const error =
                            data && data.detail ? data.detail : response.statusText;
                        return Promise.reject(error);
                    }
                    horas.value = data;
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
                    cita.subtotal = data.precio
                    cita.total = cita.subtotal + cita.monto_adicional
                    cita.pago_previo = 0.0
                    cita.pago_pendiente = cita.total

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
        function obtenerVerinarios() {
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
                    veterinarios.value = data;

                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        function obtenerVeterinariosByEspecAndFec(espec_id, fec_ini) {

            fetch("http://127.0.0.1:8000/veterinarios/espec/" + espec_id + "/date/" + fec_ini, {
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
        function openModalDetalle() {
            modal_detalle.mdl_detalle.show()
        }
        function openModalReservarCita() {
            modal_cita.mdl_cita.show()
        }
        function reservarCita(veterinario_calendar, hora_ini, hora_fin, fecha) {
            cleanForm()
            cita.vet_id = veterinario_calendar.id
            cita.espec_id = veterinario_calendar.espec_id
            $("#fecNac").val(fecha + ' ' + hora_ini).trigger("change");
            openModalReservarCita()
        }
        function mostrarEstadoCita(vet, hora_ini, hora_fin, date) {
            let reservas_list = citas.value
            console.log(reservas_list)
            let estado = 'bg-secondary-subtle'
            let fec_initial = date + ' ' + hora_ini
            reservas_list.map((item) => {
                if (item.fec_ini == fec_initial && item.vet_id == vet.id) {
                    if (item.estado_cita == 1) {
                        estado = 'bg-success-subtle'
                    } else if (item.estado_cita == 2) {
                        estado = 'bg-warning-subtle'
                    } else if (item.estado_cita == 3) {
                        estado = 'bg-info-subtle'
                    } else {
                        estado = 'bg-danger-subtle'
                    }
                }
            });
            return estado;
        }
        /*
        watch(veterinario, (newVet, oldVet) => {
            error_message.value = ""
            colors()
        })*/
        return {
            bkg_espec,
            cita,
            citas,
            cliente,
            clientes,
            dias,
            fechas,
            error_message,
            error_message_two,
            especialidades,
            especialidad,
            hora,
            horas,
            modal_cita,
            modal_detalle,
            mascotas,
            mascota,
            next_last_dates,
            tipos,
            tipo,
            tiempo_cita,
            veterinarios,
            veterinario,
            mostrarEstadoCita,
            guardarCita,
            desabilitaFechaAnterior,
            mostrarCalendarioNac,
            mostrarDetalle,
            mostrarSelectSingleTipo,
            mostrarSelectSingleCLiente,
            mostrarSelectSingleMascota,
            mostrarSelectMultipleCargos,
            obtenerCitas,
            obtenerCliente,
            obtenerDate,
            obtenerHora,
            obtenerTipoId,
            obtenerTipoCita,
            obtenerEspecialidad,
            obtenerVerinarios,
            obtenerVeterinariosByEspecAndFec,
            reservarCita,

        }
    },
    mounted() {
        this.mostrarCalendarioNac()
        this.obtenerCitas()
        this.obtenerCliente()
        this.obtenerDate()
        this.obtenerHora()
        this.obtenerVerinarios()
        this.obtenerEspecialidad()
        this.obtenerTipoCita()
        this.mostrarSelectSingleTipo()
        this.mostrarSelectSingleCLiente()
        this.mostrarSelectSingleMascota()
        this.mostrarSelectMultipleCargos()
        this.modal_cita.mdl_cita = new bootstrap.Modal('#mdl-cita', {})
        this.modal_detalle.mdl_detalle = new bootstrap.Modal('#mdl-detalle', {})
    }
}
</script>
