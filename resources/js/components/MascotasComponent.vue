<template>
    <div class="container">
        <div class="mt-5">
            <button type="button" class="btn btn-primary px-4">Nueva Mascota </button>
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
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(mascota,index) in mascotas">
                        <th scope="row">{{ index + 1 }}</th>
                        <td>{{ mascota.nombre }}</td>
                        <td>{{ mascota.cliente_id }}</td>
                        <td>
                            <span v-if="mascota.animal_id==1">Perro</span>
                            <span v-if="mascota.animal_id==2">Gato</span>
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
                        </td>
                        <td>{{ mascota.fec_nac }}</td>
                        <td>
                            <span v-if="mascota.sexo==0">macho</span>
                            <span v-if="mascota.sexo==1">hembra</span>
                        </td>
                        <td>{{ mascota.color }}</td>
                        <td>{{ mascota.altura }}</td>
                        <td>{{ mascota.peso }}</td>
                        <td>
                            <span v-if="mascota.estirilizado==0">No</span>
                            <span v-if="mascota.estirilizado==1">Si</span>
                        </td>
                        <td>
                            <span v-if="mascota.vacunas==0">No</span>
                            <span v-if="mascota.vacunas==1">Si</span>
                        </td>
                        <td>
                            <span v-if="mascota.estado==0">No citado</span>
                            <span v-if="mascota.estado==1">Citado</span>
                            <span v-if="mascota.estado==2">Internado</span>
                        </td>
                        <td>
                            <div class="row g-1">
                                <div class="col"> <button type="button" class="btn btn-warning w-100">Editar</button></div>
                                <div class="col"> <button type="button" class="btn btn-danger w-100">Eliminar</button></div>
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
            const error_message = ref("")
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
                    })
                    .catch((error) => {
                        error_message.value = error;
                        console.error("There was an error!", error);
                    });
            }
            return{
                error_message,
                mascota,
                mascotas,
                obtenerMascotas,
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.obtenerMascotas()
        }
    }
</script>
