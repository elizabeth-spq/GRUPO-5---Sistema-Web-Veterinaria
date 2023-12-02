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
                    <div class="row">
                      <figure class="col-12 mt-3 figure">
                        <img :src="imagenSeleccionada" class="figure-img img-fluid rounded" alt="..."/>
                      </figure>
                    </div>
                  </div>
                  <!-- Div para mostrar la imagen -->
  
                  <input class="mt-5" type="file" name="foto" id="foto" accept="image/*"
                    @change="cargarImagen"/>
                  <div id="requiredNombre" class="form-text text-danger" v-if="historia.foto == ''">
                    Archivos no superiores a 5 Mbs
                  </div>
                  <h3>Seleccione la Mascota</h3>
                  <select class="form-select" id="Mascota" aria-label="Floating label select example" aria-describedby="requiredMascota" v-model="historia.mascota_id"
                    @change="mostrarInformacionCliente">
                    <option value="0" disabled>Seleccione...</option>
                    <option v-for="mascota in mascotas" :value="mascota.id">
                        <p style="font-size: 20px; font-weight: lighter;">
                            {{ mascota.nombre }}
                        </p>
                    </option>
                  </select>
                  <br>
  
                  <!-- Agregar un div para mostrar la información del cliente -->
                  <div v-if="historia.mascota_id !== 0">
                    <div v-if="historia.mascota && historia.mascota.cliente">
                        <h3>Dueño: </h3>
                        <p style="font-size: 20px; font-weight: lighter;">
                            {{ historia.mascota.cliente.nombre }} {{ historia.mascota.cliente.apellido }}
                        </p>
                        <h3>Animal: </h3>
                        <p style="font-size: 20px; font-weight: lighter;">
                            {{ historia.tipoAnimal }}
                        </p>
                        <h3>Raza:</h3>
                        <p style="font-size: 20px; font-weight: lighter;">
                            {{ historia.raza }}
                        </p>
                        <h3>Sexo de la mascota:</h3>
                        <p style="font-size: 20px; font-weight: lighter;">
                            {{ historia.sexoMascota }}
                        </p>
                        <h3>Fecha de nacimiento</h3>
                        <p style="font-size: 20px; font-weight: lighter;">
                            {{ historia.fechaNacimientoMascota }} 
                        </p>
                        <h3>Altura de la mascota:</h3>
                        <p style="font-size: 20px; font-weight: lighter;">
                            {{ historia.alturaMascota }} cm
                        </p>
                        <h3>Peso de la mascota:</h3>
                        <p style="font-size: 20px; font-weight: lighter;">
                            {{ historia.pesoMascota }} Kg
                        </p>
                        <h3>Esterilizado:</h3>
                        <p style="font-size: 20px; font-weight: lighter;">
                        {{ historia.esterilizadoMascota }}
                        </p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Segunda Columna - Otros Campos o Contenido -->
              <div class="col-12 col-md-6">
                <h3>Citas de la mascota</h3>
                <div class="accordion accordion-flush" id="accordion">
                    <div v-for="(cita, index) in citas" :key="index" class="accordion-item border rounded" style="background-color:rgb(223, 223, 223);">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" style="background-color: rgb(185, 185, 185);" type="button" data-bs-toggle="collapse" :data-bs-target="'#collapse' + index" aria-expanded="false" :aria-controls="'collapse' + index">
                                {{ cita.fec_ini }} - {{ cita.observaciones || 'Sin descripción' }}
                            </button>
                        </h2>
                        <div :id="'collapse' + index" class="accordion-collapse collapse" :aria-labelledby="'heading' + index" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <!-- Detalles de la cita, puedes personalizar esta sección según tus necesidades -->
                                <p>Fecha de Fin: {{ cita.fec_fin }}</p>

                                <p>Estado: {{ cita.estado_cita === 1 ? 'Activa' : 'Inactiva' }}</p>
                                <p>Total: {{ cita.total }}</p>
                                <!-- Agrega más detalles según tu estructura de datos -->
                                <label for="notas_cita">Notas de la cita:</label>
                                <textarea v-model="historia.notas_cita" class="form-control"></textarea>

                                <label for="receta">Receta:</label>
                                <textarea v-model="historia.receta" class="form-control"></textarea>

                                <label for="procedimiento">Procedimiento:</label>
                                <textarea v-model="historia.procedimiento" class="form-control"></textarea>

                                <label for="resultados_examenes">Resultados de examenes:</label>
                                <textarea v-model="historia.resultados_examenes" class="form-control"></textarea>

                                <label for="fecha_creacion">fecha de Creacion:</label>
                                <input type="date" v-model="historia.fecha_creacion" class="form-control">

                                <label for="archivos_adjuntos">Archivos complementarios:</label>
                                <input type="file" @change="handleFileUpload" class="form-control" multiple>
                                <div id="requiredNombre" class="form-text text-danger">
                                    Opcional, ejemplo: radiografias, docs, etc.
                                </div>
                                <br>
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
                                <div class="modal-footer">
                                    <button class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="citas.length === 0">
                    <p>No hay citas registradas para esta mascota.</p>
                </div>
              </div>
            </div><!--row-->
          </div><!--container-->
        </div><!--modal-body-->
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
        const animales = ref([])
        const citas = ref([])
        const razas = ref([])
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
            estado: 0,
            raza: {}
        })
        const clientes = ref([])
        const historias = ref([])
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
            archivos_adjuntos: "",
            vacunacion: "",
            foto: "",
            estado_historia: 0
        })
        const imagenSeleccionada = ref(""); // Almacena la ruta de la imagen seleccionada

        function cargarImagen(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = (e) => {
                    imagenSeleccionada.value = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        
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
                    
                    // Asignar la lista de mascotas a la variable mascotas
                    mascotas.value = data;

                    // Luego, obtener la información de cada cliente de las mascotas
                    obtenerInformacionClientes();
                    obtenerInformacionRazas();
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
        async function obtenerInformacionClientes() {
            // Iterar sobre la lista de mascotas y obtener la información del cliente para cada una
            for (const mascota of mascotas.value) {
                try {
                    const response = await fetch(`http://127.0.0.1:8000/clientes/${mascota.cliente_id}`);
                    const data = await response.json();

                    if (!response.ok) {
                        const error = data && data.detail ? data.detail : response.statusText;
                        return Promise.reject(error);
                    }

                    // Asignar la información del cliente a la mascota correspondiente
                    mascota.cliente = data;
                } catch (error) {
                    error_message.value = error;
                    console.error("There was an error!", error);
                }
            }
        }
        async function obtenerInformacionRazas() {
            for (const mascota of mascotas.value) {
                try {
                    const response = await fetch(`http://127.0.0.1:8000/razas/details/${mascota.raza_id}`);
                    const data = await response.json();

                    if (!response.ok) {
                        const error = data && data.detail ? data.detail : response.statusText;
                        return Promise.reject(error);
                    }

                    // Asignar la información de la raza a la mascota correspondiente
                    mascota.raza = data;
                } catch (error) {
                    error_message.value = error;
                    console.error("There was an error!", error);
                }
            }
        }
        async function obtenerCitas(idMascota) {
            try {
                const response = await fetch(`http://127.0.0.1:8000/mascotas/${idMascota}/citas`);
                const data = await response.json();

                if (!response.ok) {
                    console.error('Error en la respuesta:', data);
                    return Promise.reject(data);
                }

                // Asignar la lista de citas a la variable citas
                citas.value = data;
            } catch (error) {
                console.error('Error en la solicitud:', error);
                error_message.value = error;
            }
        }
        function mostrarInformacionCliente() {
            const mascotaSeleccionada = mascotas.value.find(m => m.id === historia.mascota_id);
            if (mascotaSeleccionada) {
                historia.mascota = mascotaSeleccionada;
                historia.tipoAnimal = mascotaSeleccionada.animal ? mascotaSeleccionada.animal.nombre : 'Desconocido';
                historia.raza = mascotaSeleccionada.raza ? mascotaSeleccionada.raza.nombre : 'Desconocida';
                historia.sexoMascota = mascotaSeleccionada.sexo === 1 ? 'Macho' : 'Hembra';
                historia.fechaNacimientoMascota = mascotaSeleccionada.fec_nac;
                historia.alturaMascota = mascotaSeleccionada.altura;
                historia.pesoMascota = mascotaSeleccionada.peso;
                historia.esterilizadoMascota = mascotaSeleccionada.estirilizado === 1 ? 'Sí' : 'No';
                obtenerCitas(historia.mascota_id);
            }
        }
        return {
            error_message,
            historia,
            historias,
            imagenSeleccionada,
            mascota,
            mascotas,
            clientes,
            citas,
            razas,
            animales,

            obtenerMascotas,
            obtenerHistorias,
            obtenerCitas,
            guardarHistoria,
            cargarImagen,
            obtenerInformacionClientes,
            obtenerInformacionRazas,
            mostrarInformacionCliente,
        }
    },
    mounted() {
        console.log('Component mounted.')
        this.obtenerHistorias();
        this.obtenerMascotas();
        this.obtenerInformacionClientes();
        this.obtenerInformacionRazas();
    }
}
</script>
