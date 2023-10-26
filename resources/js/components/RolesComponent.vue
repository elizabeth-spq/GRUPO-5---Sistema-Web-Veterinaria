<template>
    <div class="container">
        <div class="mt-5">
            <button type="button" class="btn btn-primary px-4" @click="nuevoPermiso()">Nuevo Permiso</button>
        </div>
        <div class="mt-5">
            <table class="table table-hover">
                <thead>
                    <tr class="table-dark align-middle text-center">
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Permisos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(role, index) in roles" class="text-center align-middle">
                        <th scope="row">{{ index + 1 }}</th>
                        <td class="text-start">{{ role.nombre }}</td>
                        <td>
                            <span v-if="role.nombre === 'administrador'" class="badge red-badge">Todos los permisos</span>
                            <span v-else class="badge blue-badge" v-for="(permission, index) in role.permissions" :key="index">
                                {{ permission.nombre }}
                            </span>
                        </td>
                        <td>
                            <div class="row g-1">
                            <div class="col">
                                <button type="button" class="btn btn-warning w-100" @click="editarPermiso(role)">Editar</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-danger w-100" @click="eliminarPermiso(role.id)">Eliminar</button>
                            </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="modal" tabindex="-1" id="mdl-create">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-if="permission.id < 0">Nuevo permiso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 form-floating mb-3">
                                    <input type="text" class="form-control" id="name" placeholder="Nombre *"
                                        aria-describedby="requiredNombre" v-model="permission.nombre">
                                    <label class="ms-2" for="floatingInput">Nombre del Permiso *</label>
                                    <div id="requiredNombre" class="form-text text-danger" v-if="permission.nombre == ''">
                                        Obligtorio
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="guardarPermiso()">Guardar registro</button>
                    </div>
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
        const modal_create = reactive({
              mdl_create: null,
        })
        const roles = ref([])
        const role = reactive({
            id: 0,
            nombre: "",
        })
        const permissions = ref([]);
        const permission = reactive({
            nombre: "",
        });

        function obtenerRoles() {
            fetch("http://127.0.0.1:8000/roles", {
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
                    roles.value = data;
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
            });
        }

        function guardarPermiso() {
            if (!permission.nombre) {
                alert("El nombre del permiso es obligatorio.");
                return;
            }
            const nuevoPermiso = {
                nombre: permission.nombre,
            };
            fetch("http://127.0.0.1:8000/permisos", {
                method: "POST",
                headers: {
                    Accept: "Application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(nuevoPermiso),
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
                    console.error("Hubo un error al guardar el permiso creado:", error);
                });

            obtenerRoles();
            closeModalCreate();
        }
        function nuevoPermiso() {
            cleanForm()
            openModalCreate()
        }
        function openModalCreate() {
            modal_create.mdl_create.show()
        }
        function cleanForm() {
            permission.nombre = ""
        }
        function closeModalCreate() {
            modal_create.mdl_create.hide()
            cleanForm()
        }
        return{
            role,
            roles,
            permission,
            permissions,
            error_message,
            modal_create,

            guardarPermiso,
            nuevoPermiso,
            obtenerRoles,
            openModalCreate,
            closeModalCreate,
            cleanForm,

            }
        },
    mounted() {
        this.obtenerRoles();
        this.modal_create.mdl_create = new bootstrap.Modal('#mdl-create', {})
    }
}
</script>
