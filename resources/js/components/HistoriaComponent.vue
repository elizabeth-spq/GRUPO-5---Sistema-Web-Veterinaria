<template>
    <div class="container border border-2 rounded">
      <div class="container border-bottom border-2 mb-3 mt-3">
        <h3 class="modal-title">Historias Clinicas</h3>
      </div>
      <div class="modal-content">
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <!-- Primera Columna - File Input y Nombre de Mascota -->
              <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                  <!-- Div para mostrar la imagen -->
                  <div class="container mb-3 rounded" style="width: 230px; height: 230px; background-image: url('https://us.123rf.com/450wm/elena3567/elena35672112/elena3567211200047/179578981-ilustraci%C3%B3n-de-un-perro-y-un-gato-mirando-en-una-direcci%C3%B3n-sobre-un-fondo-blanco-con-una-sombra.jpg?ver=6');">
                  </div>
                  <!-- Div para mostrar la imagen -->
                  <input class="mt-5" type="file" name="foto" id="foto" accept="image/*" @change="cargarImagen" />
                  <div id="requiredFoto" class="form-text text-danger" v-if="historia.foto == ''">
                    Archivos no superiores a 5 Mbs
                  </div>
                  <h3>Seleccione la Mascota</h3>
                  <select class="form-select" id="Mascota" aria-label="Floating label select example" aria-describedby="requiredMascota" v-model="historia.mascota_id" @change="filtrarHistorias">
                    <option value="0" disabled>Seleccione...</option>
                    <option v-for="mascota in mascotas" :value="mascota.id">
                      <p style="font-size: 20px; font-weight: lighter;">{{ mascota.nombre }}</p>
                    </option>
                  </select>
                  <br>
                  <!-- Agregar un div para mostrar la información del cliente -->
                </div>
              </div><!--class="col-12 col-md-6"-->
  
              <div class="col-12 col-md-6">
                <h3>Citas de la mascota</h3>
                <div class="mt-5 mb-3">
                    <button type="button" class="btn btn-primary px-4" @click="nuevaHistoria()" v-if="canCreate">Nueva Historia</button>
                    <button type="button" class="btn btn-info px-4 ms-2" @click="mostrarTodasLasHistorias">Lista de Historias</button>
                </div>

                <br>
                <div class="accordion accordion-flush" id="accordionHistorias">
                  <template v-if="historiasFiltradas.length > 0">
                    <div v-for="(historia, historiaIndex) in historiasFiltradas" :key="historiaIndex">
                      <div class="accordion-item">
                        <h2 class="accordion-header" :id="'headingHistoria' + historiaIndex">
                          <button class="accordion-button rounded mb-1" style="background-color: rgb(224, 224, 224);" type="button" data-bs-toggle="collapse" :data-bs-target="'#collapseHistoria' + historiaIndex" aria-expanded="true" :aria-controls="'collapseHistoria' + historiaIndex">
                            Historia N° {{ historiaIndex + 1 }}
                          </button>
                        </h2>
                        <div :id="'collapseHistoria' + historiaIndex" class="accordion-collapse collapse" :aria-labelledby="'headingHistoria' + historiaIndex" data-bs-parent="#accordionHistorias">
                          <div class="accordion-body">
                            <!-- Detalles de la historia clínica -->
                            <p>Nombre del paciente: {{ historia.mascota.nombre }}</p>
                            <p>Id de la cita: {{ historia.cita_id }}</p>
                            <p>Tipo de cita: {{ getNombreTipoCita(historia.tipo_id) }}</p>
                            <p>Notas de la Cita: {{ historia.notas_cita }}</p>
                            <p>Receta: {{ historia.receta }}</p>
                            <p>Procedimiento: {{ historia.procedimiento }}</p>
                            <p>Fecha de Creación: {{ historia.fecha_creacion }}</p>
                            <p>Resultados de Examenes: {{ historia.resultados_examenes }}</p>
                            <p>Archivos adjuntados: {{ historia.archivos_adjuntos }}</p>
                            <p>Vacunacion: {{ historia.vacunacion }}</p>
                            <h6>Estado: </h6>
                            <p>{{ historia.estado_historia > 0 ? 'Activo' : 'Inactivo' }}</p>
                            <hr>
                          </div>
                        </div>
                      </div>
                    </div>
                  </template>
                  <template v-else>
                    <p>No hay historias clínicas registradas para esta mascota.</p>
                  </template>
                </div>
              </div>
            </div><!--row-->
          </div><!--container-->
        </div><!--class="modal-body"-->
      </div><!--class="modal-content"-->
    </div><!--class="container border border-2 rounded"-->


    <!--formulario de creacion de mascota-->

    <div class="modal" tabindex="-1" id="mdl-historia">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo historia clinica</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 form-floating mb-3">
                                <select class="form-select" id="Paciente" aria-label="Floating label select example"
                                    aria-describedby="requiredPaciente" v-model="historia.mascota_id" @change="seleccionarDueñoPorMascota">
                                    <option value="0" disabled>Seleccione...</option>
                                    <option v-for="mascota in mascotas" :value="mascota.id">{{ mascota.nombre }}</option>
                                </select>
                                <label for="paciente" class="ms-2">Paciente *</label>
                                <div id="requiredPaciente" class="form-text text-danger" v-if="historia.mascota_id == 0">
                                    Obligtorio
                                </div>
                            </div>
                            
                            <div class="col-12 form-floating mb-3">
                                <select class="form-select" id="Dueño" aria-label="Floating label select example"
                                    aria-describedby="requiredDueño" v-model="historia.cliente_id">
                                    <option value="0" disabled>Seleccione...</option>
                                    <option v-for="cliente in clientes" :value="cliente.id">{{ cliente.nombre }} {{
                                        cliente.apellido }}</option>
                                </select>
                                <label for="dueño" class="ms-2">Dueño *</label>
                                <div id="requiredDueño" class="form-text text-danger" v-if="historia.cliente_id == 0">
                                    Obligtorio
                                </div>
                            </div>

                            <div class="col-12 form-floating mb-3">
                                <select class="form-select" id="Cita" aria-label="Floating label select example"
                                        aria-describedby="requiredCita" v-model="historia.cita_id" @change="seleccionarTipoCitaPorCita">
                                    <option value="0" disabled>Seleccione...</option>
                                    <option v-for="cita in citas" :value="cita.id">{{ cita.id }} - {{ cita.fec_ini }}</option>
                                </select>
                                <label for="cita" class="ms-2">Cita *</label>
                                <div id="requiredCita" class="form-text text-danger" v-if="historia.cliente_id == 0">
                                    Obligtorio
                                </div>
                            </div>

                            <div class="col-12 form-floating mb-3">
                                <select class="form-select" id="tipoCita" aria-label="Floating label select example"
                                    aria-describedby="requiredTipoCita" v-model="historia.tipo_id">
                                    <option value="0" disabled>Seleccione...</option>
                                    <option v-for="tipoCita in tiposCitas" :value="tipoCita.id">{{ tipoCita.nombre }} -
                                         precio: S/.{{ tipoCita.precio }}</option>
                                </select>
                                <label for="cita" class="ms-2">Tipo de Cita *</label>
                                <div id="requiredCita" class="form-text text-danger" v-if="historia.cliente_id == 0">
                                    Obligtorio
                                </div>
                            </div>

                            <div class="col-12 form-floating mb-3">
                                <input type="text" class="form-control" id="notas" placeholder="notas *"
                                    aria-describedby="requiredNotas" v-model="historia.notas_cita">
                                <label class="ms-2" for="floatingInput">notas de la cita *</label>
                                <div id="requiredNotas" class="form-text text-danger" v-if="historia.notas_cita == ''">
                                    Obligtorio, ejemplo: Boris, Parchis
                                </div>
                            </div>

                            <div class="col-12 form-floating mb-3">
                                <input type="text" class="form-control" id="receta" placeholder="receta *"
                                    aria-describedby="requiredReceta" v-model="historia.receta">
                                <label class="ms-2" for="floatingInput">receta *</label>
                                <div id="requiredReceta" class="form-text text-danger" v-if="historia.receta == ''">
                                    Obligtorio, ejemplo: Boris, Parchis
                                </div>
                            </div>

                            <div class="col-12 form-floating mb-3">
                                <input type="text" class="form-control" id="procedimiento" placeholder="procedimiento *"
                                    aria-describedby="requiredProcedimiento" v-model="historia.procedimiento">
                                <label class="ms-2" for="floatingInput">procedimiento *</label>
                                <div id="requiredProcedimiento" class="form-text text-danger" v-if="historia.procedimiento == ''">
                                    Obligtorio, ejemplo: Boris, Parchis
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="ms-2" for="fec">Fecha de Creacion *</label>
                                <input id="fec" type="text" class="form-control" placeholder="02/02/2000"
                                    v-model="historia.fecha_creacion" aria-describedby="requiredFec" />
                                <div id="requiredFec" class="form-text text-danger" v-show="historia.fecha_creacion == ''">
                                    Obligtorio, ejemplo: 02/02/2000
                                </div>
                            </div>

                            <div class="col-12 form-floating mb-3">
                                <input type="text" class="form-control" id="resul_examenes" placeholder="resultados *"
                                    aria-describedby="requiredResultados" v-model="historia.resultados_examenes">
                                <label class="ms-2" for="floatingInput">Resultados de examenes *</label>
                                <div id="requiredResultados" class="form-text text-danger" v-if="historia.resultados_examenes == ''">
                                    Obligtorio, ejemplo: Boris, Parchis
                                </div>
                            </div>

                            <!--<div class="col-12 form-floating mb-3">
                                <label class="ms-2" for="archivos_adjuntos">archivos complementarios *</label>
                                <br>
                                <br>
                                <input type="file" @change="handleFileUpload" class="form-control" multiple>
                                <div id="requiredAdjunto" class="form-text text-danger">
                                    Opcional, ejemplo: radiografías, docs, etc.
                                </div>
                            </div>-->

                            <div class="col-12 form-floating mb-3">
                                <input type="text" class="form-control" id="vacunacion" placeholder="vacunacion *"
                                    aria-describedby="requiredVacunacion" v-model="historia.vacunacion">
                                <label class="ms-2" for="floatingInput">describa sus vacunas *</label>
                                <div id="requiredVacunacion" class="form-text text-danger" v-if="historia.vacunacion == ''">
                                    Opcional, ejemplo: distemper, antipulgas y etc.
                                </div>
                            </div>

                            <div class="col-12">
                                <h6>Estado</h6>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="vetStatus"
                                        v-model="historia.estado_historia" :checked="historia.estado_historia == 1 ? true : false">
                                    <label class="form-check-label" for="vetStatus">
                                        <span v-if="historia.estado_historia > 0">Activo</span>
                                        <span v-else>Inactivo</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" :disabled="is_disabled" @click="guardarHistoria()">Guardar
                        registro</button>
                </div>           
            </div>
        </div>
    </div>
    
    <!--formulario de creacion de mascota-->            
</template>  

<script>
import { ref, reactive, watchEffect } from 'vue';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
export default {
    setup() {
        const canCreate = ref(window.canCreate);
        const error_message = ref("")
        const animales = ref([]);
        const citas = ref([]);
        const tiposCitas = ref([]);
        const tipoCita = reactive({
            id: 0,
            nombre: "",
            tiempo: 0,
            precio: 0
        })
        const razas = ref([]);
        const mascotas = ref([]);
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
            estado: 0,
            raza: {}
        })
        const is_disabled = ref(false)
        const clientes = ref([]);
        const historias = ref([]);
        const historia = reactive({
            id: 0,
            cita_id: 0,
            mascota_id: 0,
            cliente_id: 0,
            tipo_id: 0,
            notas_cita: "",
            receta: "",
            procedimiento: "",
            fecha_creacion: "",
            resultados_examenes: "",
            archivos_adjuntos: null,
            vacunacion: "",
            foto: "",
            estado_historia: 0
        })
        const modal_historia = reactive({
            mdl_his: null,
        })
        
        const historiasFiltradas = ref([]);
    
        const filtrarHistorias = () => {
            if (historia && historia.mascota_id !== undefined) {
                historiasFiltradas.value = historias.value.filter(
                    historiaItem => historiaItem.mascota_id === historia.mascota_id
                );
            } else {
                historiasFiltradas.value = historias.value;
            }
        };
        function mostrarTodasLasHistorias() {
            historiasFiltradas.value = historias.value;
        }
        function nuevaHistoria() {
            cleanForm()
            historia.estado_historia = 1;
            openModal()
        }
        function cleanForm() {
            historia.id = 0,
                historia.mascota_id = 0,
                historia.cliente_id = 0,
                historia.cita_id = 0,
                historia.tipo_id= 0,
                historia.notas_cita = "",
                historia.receta = "",
                historia.procedimiento = "",
                historia.fecha_creacion = "",
                historia.resultados_examenes = "",
                historia.archivos_adjuntos = "",
                historia.vacunacion = "",
                historia.foto = "",
                historia.estado_historia = 0
        }
        function openModal() {
            modal_historia.mdl_his.show()
        }
        function closeModal() {
            modal_historia.mdl_his.hide()
            cleanForm()
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
        const seleccionarDueñoPorMascota = () => {
            const mascotaSeleccionada = mascotas.value.find(m => m.id === historia.mascota_id);
            if (mascotaSeleccionada) {
                historia.cliente_id = mascotaSeleccionada.cliente_id;
                // Después de seleccionar la mascota, obtenemos las citas de esa mascota
                obtenerCitasPorMascota(historia.mascota_id);
            }
        };
        function guardarHistoria() {
            fetch("http://127.0.0.1:8000/historias", {
                method: "POST",
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(historia),
            })
            .then(async (response) => {
                if (!response.ok) {
                    const error = await response.json();
                    throw new Error(error.message || "Error al guardar la historia");
                }

                // Si la respuesta es exitosa, puedes manejarla aquí si es necesario
                const responseData = await response.json();
                console.log("Respuesta exitosa:", responseData);
            })
            .then(() => {
                // Realizar acciones adicionales después de una respuesta exitosa
                obtenerMascotas();
                closeModal();
            })
            .catch((error) => {
                // Manejar errores de la solicitud o respuestas JSON no exitosas
                error_message.value = error.message;
                console.error("Error en la solicitud:", error);
            });
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
        function obtenerHistorias() {
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
                    console.log(citas.value);;
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        const obtenerCitasPorMascota = (mascotaId) => {
            fetch(`http://127.0.0.1:8000/mascotas/${mascotaId}/citas`, {
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
                    console.log(citas.value);
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        };
        const obtenerTipoCitasPorCita = (citaId) => {
            fetch(`http://127.0.0.1:8000/citas/${citaId}/tipocitas`, {
                method: "GET",
            })
                .then(async (response) => {
                    const data = await response.json();
                    if (!response.ok) {
                        const error =
                            data && data.detail ? data.detail : response.statusText;
                        return Promise.reject(error);
                    }
                    tiposCitas.value = data;
                    console.log(tiposCitas.value);
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        };
        const seleccionarTipoCitaPorCita = () => {
            if (historia.cita_id !== 0 && historia.tipo_id === 0) {
                const citaSeleccionada = citas.value.find(cita => cita.id === historia.cita_id);
                if (citaSeleccionada) {
                    historia.tipo_id = citaSeleccionada.tipo_id;
                }
            }
        };

        const obtenerTiposCitas = () => {
            fetch("http://127.0.0.1:8000/tipocitas", {
                method: "GET",
            })
            .then(async (response) => {
                const data = await response.json();
                if (!response.ok) {
                const error = data && data.detail ? data.detail : response.statusText;
                return Promise.reject(error);
                }
                tiposCitas.value = data;
            })
            .catch((error) => {
                console.error("There was an error!", error);
            });
        };
        function getNombreTipoCita(tipoCitaId) {
            const tipoCita = tiposCitas.value.find(tipo => tipo.id === tipoCitaId);
            return tipoCita ? tipoCita.nombre : 'Desconocido';
        }
        function mostrarCalendario() {
            $('#fec').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1980,
                maxYear: parseInt(moment().format('YYYY'), 10),
                maxDate: moment(),
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
            $("#fec").on("change", function () {
                mascota.fec_nac = $("#fec").val();
            });
        }
        const handleFileUpload = (event) => {
            const files = event.target.files;
            historia.archivos_adjuntos = files;
        };
        return {
            error_message,
            is_disabled,
            historia,
            historias,
            modal_historia,
            mascota,
            mascotas,
            clientes,
            citas,
            tiposCitas,
            tipoCita,
            canCreate,
            razas,
            animales,
            historiasFiltradas,

            obtenerMascotas,
            obtenerHistorias,
            obtenerCitas,
            obtenerNomClientes,
            obtenerCitasPorMascota,
            obtenerTipoCitasPorCita,
            obtenerTiposCitas,
            getNombreTipoCita,
            mostrarCalendario,
            guardarHistoria,
            nuevaHistoria,
            seleccionarDueñoPorMascota,
            seleccionarTipoCitaPorCita,
            handleFileUpload,
            filtrarHistorias,
            mostrarTodasLasHistorias,
        }
    },
    mounted() {
        console.log('Component mounted.')
        this.obtenerHistorias();
        this.obtenerMascotas();
        this.obtenerNomClientes();
        this.obtenerCitas();
        this.obtenerTiposCitas();
        this.modal_historia.mdl_his = new bootstrap.Modal('#mdl-historia', {})
        this.mostrarCalendario();
        this.mostrarTodasLasHistorias();
        this.seleccionarTipoCitaPorCita();
    }
}
</script>
