<template>
    <div class="container">
        <div class="mt-5">
            <button type="button" class="btn btn-primary px-4" @click="nuevoVeterinario()">Nuevo Veterinario</button>
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
                            {{ veterinario.fec_nac }}
                        </td>
                        <td>
                            <span v-if="veterinario.tip_doc == 1">DNI</span>
                            <span v-if="veterinario.tip_doc == 2">Pasaporte</span>
                            <span v-if="veterinario.tip_doc == 3">Carné</span>
                        </td>
                        <td>{{ veterinario.documento }}</td>
                        <td>{{ veterinario.num_telefono }}</td>
                        <td>
                            {{ veterinario.especialidad.nombre }}
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
                                <div class="col"> <button type="button" class="btn btn-warning w-100"
                                        @click="editarVeterinario(veterinario)">Editar</button></div>
                                <div class="col"> <button type="button" class="btn btn-danger w-100"
                                        @click="eliminarVeterinario(veterinario.id)">Eliminar</button></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="mdl-veterinario">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="veterinario.id > 0">Editar veterinario</h5>
                    <h5 class="modal-title" v-else>Nuevo veterinario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 d-flex mb-3">
                                <div class=" form-floating col-3">
                                    <select class="form-select" id="tipDoc" aria-label="Floating label select example"
                                        aria-describedby="requiredDocumento" v-model="veterinario.tip_doc"
                                        :disabled="veterinario.id > 0 ? true : false" @click="cleanNombres">
                                        <option value="0" selected disabled>Seleccione ...</option>
                                        <option value="1">DNI</option>
                                        <option value="2">Pasaporte</option>
                                        <option value="3">Carné</option>
                                    </select>
                                    <label for="tipDoc">Tipo Doc. *</label>
                                    <div id="requiredDocumento" class="form-text text-danger"
                                        v-if="veterinario.tip_doc == ''">
                                        Obligtorio
                                    </div>
                                </div>
                                <div class="col-9 ps-3" v-if="veterinario.tip_doc == '1'">
                                    <div class="input-group">
                                        <input type="number" id="documento-dni" class="form-control" placeholder="Nº DNI  *"
                                            aria-label="Recipient's username" aria-describedby="requiredDni"
                                            v-model="veterinario.documento" @input="filtroDocumento(veterinario.tip_doc)"
                                            :disabled="veterinario.id > 0 ? true : false">
                                        <button class="btn btn-outline-secondary" type="button" id="requiredDni"
                                            @click="consultarDni(veterinario.documento)"
                                            :disabled="veterinario.documento < 10000000 ? true : false">Consultar</button>
                                    </div>
                                    <div id="requiredDni" class="form-text text-danger text-start"
                                        v-if="veterinario.documento < 10000000">
                                        Mínimo 8 dígitos, ejemplo: 78455511
                                    </div>
                                    <div id="requiredDni" class="form-text text-danger text-start" v-if="error_message">
                                        {{ error_message }}
                                    </div>
                                </div>
                                <div class="form-floating col-9 ps-3"
                                    v-if="veterinario.tip_doc == '3' || veterinario.tip_doc == '2'">
                                    <input type="text" class="form-control" id="documento-carne"
                                        placeholder="Carné / Pasaporte *" aria-describedby="requiredCarne"
                                        v-model="veterinario.documento" @input="filtroDocumento(veterinario.tip_doc)">
                                    <label class="ms-2" for="floatingInput">Carné / Pasaporte *</label>
                                    <div id="requiredCarne" class="form-text text-danger text-start"
                                        v-if="veterinario.documento.length < 8">
                                        Mínimo 8 dígitos y máximo 15 dígitos
                                    </div>
                                </div>

                            </div>

                            <div class="col-12 form-floating mb-3 ">
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre *"
                                    aria-describedby="requiredNombre" v-model="veterinario.nombre"
                                    :readonly="veterinario.tip_doc == 1 ? true : false">
                                <label class="ms-2" for="floatingInput">Nombre *</label>
                                <div id="requiredNombre" class="form-text text-danger" v-if="veterinario.nombre == ''">
                                    Obligtorio, ejemplo: Ana Lucía
                                </div>
                            </div>
                            <div class="col-12 form-floating mb-3">
                                <input type="text" class="form-control" id="apellido" placeholder="Apellido *"
                                    aria-describedby="requiredApellido" v-model="veterinario.apellido"
                                    :readonly="veterinario.tip_doc == 1 ? true : false">
                                <label class="ms-2" for="floatingInput">Apellido *</label>
                                <div id="requiredApellido" class="form-text text-danger" v-if="veterinario.apellido == ''">
                                    Obligtorio, ejemplo: López Rojas
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="ms-2" for="fecNac">Fecha de Nacimiento *</label>
                                <input id="fecNac" type="text" class="form-control" placeholder="02/02/2000"
                                    v-model="veterinario.fec_nac" aria-describedby="requiredFecNac" />
                                <div id="requiredFecNac" class="form-text text-danger" v-show="veterinario.fec_nac == ''">
                                    Obligtorio, ejemplo: 02/02/2000
                                </div>
                            </div>
                            <div class="col-12 form-floating mb-3">
                                <input type="text" class="form-control" id="telefono" placeholder="Telefono *"
                                    aria-describedby="requiredTelefono" v-model="veterinario.num_telefono">
                                <label class="ms-2" for="floatingInput">Telefono *</label>
                                <div id="requiredTelefono" class="form-text text-danger"
                                    v-if="veterinario.num_telefono == ''">
                                    Obligtorio, ejemplo: 054-145287 ó 95741244
                                </div>
                            </div>
                            <div class=" form-floating col-12">
                                <select class="form-select" id="tipDoc" aria-label="Floating label select example"
                                    aria-describedby="requiredDocumento" v-model="veterinario.espec_id">
                                    <option value="0" selected disabled>Seleccione ...</option>
                                    <option value="1">Medicina Interna</option>
                                    <option value="2">Cirugía</option>
                                    <option value="3">Fisioterapia</option>
                                    <option value="4">Anestesiología</option>
                                    <option value="5">Cardiología</option>
                                    <option value="6">Dermatología</option>
                                    <option value="7">Neurología</option>
                                    <option value="8">Oftalmología</option>
                                    <option value="9">Oncología</option>
                                    <option value="10">Medicina de Fauna silvestre</option>
                                    <option value="11">Radiología</option>
                                    <option value="12">Ultrasonografía</option>
                                    <option value="13">Radiología</option>

                                </select>
                                <label for="tipDoc" class="ms-2">Especialidad *</label>
                                <div id="requiredDocumento" class="form-text text-danger"
                                    v-if="veterinario.especialidad == 0">
                                    Obligtorio
                                </div>
                            </div>
                            <div class=" form-floating col-12">
                                <select class="form-select" id="horario" aria-label="Floating label select example"
                                    aria-describedby="requiredhorario" v-model="veterinario.horario_id">
                                    <option value="0" selected disabled>Seleccione ...</option>
                                    <option value="1">Completa</option>
                                    <option value="2">Parcial/M</option>
                                    <option value="3">Parcial/T</option>
                                </select>
                                <label for="horario" class="ms-2">Jornada *</label>
                                <div id="requiredhorario" class="form-text text-danger" v-if="veterinario.horario_id == 0">
                                    Obligtorio
                                </div>
                            </div>
                            <div class="col-12">
                                <h6>Estado</h6>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="vetStatus"
                                        v-model="veterinario.estado" :checked="veterinario.estado == 1 ? true : false">
                                    <label class="form-check-label" for="vetStatus">
                                        <span v-if="veterinario.estado > 0">Activo</span>
                                        <span v-else>Inactivo</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" v-if="veterinario.id > 0"
                        @click="actualizarVeterinario(veterinario.id)">Actualizar registro</button>
                    <button type="button" class="btn btn-primary" :disabled="is_disabled" v-else
                        @click="guardarVeterinario()">Guardar
                        registro</button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="mdl-delete">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar veterinario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body align-self-center">
                    <span class="text-center text-danger">Esta acción NO se puede REVERTIR</span> <br>
                    <span class="text-center">¿Esta seguro de eliminar este registro?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="eliminarRegistro(veterinario.id)">Eliminar
                        registro</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="mdl-prev">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registro existente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body align-self-center">
                    <span class="text-center text-danger">Ya existe un registo con el DNI ingresado</span>

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
        const is_disabled = ref(false)
        const modal_vet = reactive({
            mdl_vet: null,
        })
        const modal_delete = reactive({
            mdl_delete: null,
        })
        const modal_alert = reactive({
            prev_vet: null,
        })
        const veterinarios = ref([])
        const veterinario = reactive({
            id: 0,
            nombre: "",
            apellido: "",
            fec_nac: "",
            tip_doc: 0,
            documento: "",
            num_telefono: "",
            espec_id: 0,
            estado: 0,
            horario_id: 0,
            usu_registro: 0,
            usu_ult_mod: 0,
        })
        const reniecs = ref([])
        const reniec = reactive({
            razonSocial: "",
            tipoDocumento: "",
            numeroDocumento: "",
            nombre: "",
            apellidoPaterno: "",
            apellidoMaterno: "",
            nombres: ""
        })

        function actualizarVeterinario(Id) {
            //console.log(veterinario)
            fetch("http://127.0.0.1:8000/veterinarios/" + Id, {
                method: "PUT",
                headers: {
                    Accept: "Application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(veterinario),
            })
                .then(async (response) => {
                    //const data = await response.json();
                    if (!response.ok) {
                        const error =
                            "error"
                        return Promise.reject(error);
                    }
                    getVerinarios();
                    closeModal();
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });

        }
        function cleanForm() {
            veterinario.id = 0
            veterinario.nombre = ""
            veterinario.apellido = ""
            veterinario.fec_nac = ""
            veterinario.tip_doc = 0
            veterinario.documento = ""
            veterinario.num_telefono = ""
            veterinario.especialidad = 0
            veterinario.estado = 1
            veterinario.horario_id = 0
            veterinario.usu_registro = 0
            veterinario.usu_ult_mod = 0
        }
        function closeModal() {
            modal_vet.mdl_vet.hide()
            cleanForm()
        }
        function closeModalDelete() {
            modal_delete.mdl_delete.hide()
        }
        function consultarDni(dni) {
            fetch("http://127.0.0.1:8000/reniec/" + dni, {
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
                    if (data.error) {
                        error_message.value = data.error
                        //console.log(error_message.value)
                    } else {
                        veterinario.apellido = data.apellidoPaterno + ' ' + data.apellidoMaterno
                        veterinario.nombre = data.nombres
                        //console.log(veterinario.apellido)
                    }
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        function cleanNombres() {
            if (veterinario.tip_doc == 1 || veterinario.tip_doc == 2 || veterinario.tip_doc == 3) {
                veterinario.documento = "";
                veterinario.nombre = "";
                veterinario.apellido = "";
            }
        }
        function desabilitar() {
            is_disabled.value = veterinario.documento == "" ||
                veterinario.documento.length < 8 ||
                veterinario.documento < 10000000 ||
                veterinario.nombre == "" ||
                veterinario.apellido == "" ||
                veterinario.fec_nac == "" ||
                veterinario.tip_doc == 0 ||
                veterinario.num_telefono == "" ||
                //veterinario.espec_id == 0 ||
                veterinario.horario_id == 0 ? true : false;
            console.log(is_disabled.value)
        }
        function editarVeterinario(veterinario_tabla) {
            cleanForm()
            veterinario.id = veterinario_tabla.id
            veterinario.nombre = veterinario_tabla.nombre
            veterinario.apellido = veterinario_tabla.apellido
            veterinario.fec_nac = veterinario_tabla.fec_nac
            veterinario.tip_doc = veterinario_tabla.tip_doc
            veterinario.documento = veterinario_tabla.documento
            veterinario.num_telefono = veterinario_tabla.num_telefono
            veterinario.especialidad = veterinario_tabla.especialidad
            veterinario.estado = veterinario_tabla.estado
            veterinario.horario_id = veterinario_tabla.horario_id
            openModal()
        }
        function eliminarVeterinario(Id) {
            veterinario.id = Id
            openModalDetele()
        }
        function eliminarRegistro(Id) {
            fetch("http://127.0.0.1:8000/veterinarios/" + Id, {
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
                    getVerinarios();
                    closeModalDelete()
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        function filtroDocumento(tipo) {
            if (tipo == 1) {
                if (veterinario.documento < 0 || veterinario.documento > 99999999) {
                    veterinario.documento = '';
                    error_message.value = ""
                }
            }
            if (tipo == 2 || tipo == 3) {
                if (veterinario.documento.length < 0 || veterinario.documento.length > 15) {
                    veterinario.documento = '';
                    error_message.value = "Mínimo 8 dígitos y máximo 15 dígitos"
                }
            }

        }
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
        function guardarVeterinario() {
            fetch("http://127.0.0.1:8000/veterinarios", {
                method: "POST",
                headers: {
                    Accept: "Application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(veterinario),
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
                        openModalRegistrado()
                    } else {
                        getVerinarios();
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
                showDropdowns: true,
                minYear: 1940,
                maxYear: 2005,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
            $("#fecNac").on("change", function () {
                veterinario.fec_nac = $("#fecNac").val();
            });
        }
        function nuevoVeterinario() {
            cleanForm()
            openModal()
        }
        function openModal() {
            modal_vet.mdl_vet.show()
        }
        function openModalRegistrado() {
            modal_alert.prev_vet.show()
        }
        function openModalDetele() {
            modal_delete.mdl_delete.show()
        }
        watch(veterinario, (newVet, oldVet) => {
            error_message.value = ""
            desabilitar()
        })

        return {
            error_message,
            is_disabled,
            modal_vet,
            modal_delete,
            modal_alert,
            veterinario,
            veterinarios,
            reniecs,
            reniec,
            actualizarVeterinario,
            cleanForm,
            cleanNombres,
            consultarDni,
            desabilitar,
            editarVeterinario,
            eliminarVeterinario,
            eliminarRegistro,
            filtroDocumento,
            getVerinarios,
            guardarVeterinario,
            mostrarCalendarioNac,
            nuevoVeterinario,

        }
    },

    mounted() {
        this.getVerinarios();
        this.modal_vet.mdl_vet = new bootstrap.Modal('#mdl-veterinario', {})
        this.modal_delete.mdl_delete = new bootstrap.Modal('#mdl-delete', {})
        //this.modal_alert.prev_vet = new bootstrap.Modal('#mdl-prev', {})
        this.modal_alert.prev_vet = new bootstrap.Modal('#mdl-prev',{})
        this.mostrarCalendarioNac()


    }

}
</script>
