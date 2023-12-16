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
                  <select class="form-select" id="Mascota" aria-label="Floating label select example" aria-describedby="requiredMascota" v-model="historia.mascota_id">
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
                <div class="mt-5">
                    <button type="button" class="btn btn-primary px-4" @click="nuevaHistoria()"  v-if="canCreate">Nueva Historia </button>
                </div>
                <br>
                <div class="accordion accordion-flush" id="accordionHistorias">
                  <template v-if="historias.length > 0">
                    <div v-for="(historia, historiaIndex) in historias" :key="historiaIndex">
                      <div class="accordion-item">
                        <h2 class="accordion-header" :id="'headingHistoria' + historiaIndex">
                          <button class="accordion-button rounded mb-1" style="background-color: rgb(224, 224, 224);" type="button" data-bs-toggle="collapse" :data-bs-target="'#collapseHistoria' + historiaIndex" aria-expanded="true" :aria-controls="'collapseHistoria' + historiaIndex">
                            Historia N° {{ historiaIndex + 1 }}
                          </button>
                        </h2>
                        <div :id="'collapseHistoria' + historiaIndex" class="accordion-collapse collapse show" :aria-labelledby="'headingHistoria' + historiaIndex" data-bs-parent="#accordionHistorias">
                          <div class="accordion-body">
                            <!-- Detalles de la historia clínica -->
                            <p>Nombre del paciente: {{ historia.mascota.nombre }}</p>
                            <p></p>
                            <p>Tipo de cita: {{ getNombreTipoCita(historia.cita_id) }}</p>
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
                                    aria-describedby="requiredCita" v-model="historia.cita_id">
                                    <option value="0" disabled>Seleccione...</option>
                                    <option v-for="cita in citas" :value="cita.id">{{ getNombreTipoCita(cita.tipo_id) }} -
                                         {{ cita.fec_ini }}</option>
                                </select>
                                <label for="cita" class="ms-2">Cita *</label>
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

                            <div class="col-12 form-floating mb-3">
                                <label class="ms-2" for="archivos_adjuntos">archivos complementarios *</label>
                                <br>
                                <br>
                                <input type="file" @change="handleFileUpload" class="form-control" multiple>
                                <div id="requiredAdjunto" class="form-text text-danger">
                                    Opcional, ejemplo: radiografías, docs, etc.
                                </div>
                            </div>

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
import { ref, reactive } from 'vue';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
export default {
    setup() {
        const canCreate = ref(window.canCreate);
        const error_message = ref("")
        const animales = ref([]);
        const citas = ref([]);
        const tiposCitas = ref([]);
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
        
        function nuevaHistoria() {
            console.log('Valor de canCreate:', canCreate.value);
            cleanForm()
            historia.estado_historia = 1;
            openModal()
        }
        function cleanForm() {
            historia.id = 0,
                historia.mascota_id = 0,
                historia.cliente_id = 0,
                historia.cita_id = 0,
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
        async function guardarHistoria() {
            try {
                await enviarDatosFormulario();

            } catch (error) {
                console.error('Error al guardar la historia:', error);
                alert('Error al guardar la historia. Por favor, intenta de nuevo.');
            }
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
        function obtenerTiposCitas() {
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
                error_message.value = error;
                console.error("There was an error!", error);
            });
        }
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
        const enviarDatosFormulario = async () => {
            const formData = new FormData();

            for (const file of historia.archivos_adjuntos) {
                const fileName = file.name;
                formData.append('archivos_adjuntos[]', fileName);
            }

            // Adjunta otros datos necesarios (puedes agregar más según tus necesidades)
            formData.append('mascota_id', historia.mascota_id);
            formData.append('cliente_id', historia.cliente_id);
            formData.append('cita_id', historia.cita_id);
            formData.append('notas_cita', historia.notas_cita);
            formData.append('receta', historia.receta);
            formData.append('procedimiento', historia.procedimiento);
            formData.append('fecha_creacion', historia.fecha_creacion);
            formData.append('resultados_examenes', historia.resultados_examenes);
            formData.append('vacunacion', historia.vacunacion);
            formData.append('foto', historia.foto);
            formData.append('estado_historia', historia.estado_historia);
            // ... otros datos

            try {
                const response = await fetch('http://127.0.0.1:8000/historias', {
                    method: 'POST',
                    body: formData,
                });
                // Imprime la respuesta completa del servidor en la consola del navegador
                console.log('Respuesta completa del servidor:', response);

                // Imprime la respuesta del servidor en la consola del navegador
                const responseData = await response.json();
                console.log('Respuesta del servidor:', responseData);
            } catch (error) {
                console.error('Error al realizar la solicitud POST:', error);
                throw error; // Propaga el error para que pueda ser manejado en la función llamadora (guardarHistoria)
            }
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
            canCreate,
            razas,
            animales,

            obtenerMascotas,
            obtenerHistorias,
            obtenerCitas,
            obtenerNomClientes,
            obtenerCitasPorMascota,
            obtenerTiposCitas,
            getNombreTipoCita,
            mostrarCalendario,
            guardarHistoria,
            nuevaHistoria,
            seleccionarDueñoPorMascota,
            handleFileUpload,
            enviarDatosFormulario,
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
    }
}
</script>
