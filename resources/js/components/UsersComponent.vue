<template>
    <div class="container">
        <div class="mt-5">
            <button type="button" class="btn btn-primary px-4" @click="nuevoUsuario()">Nuevo Usuario del Sistema</button>
        </div>
        <div class="mt-5">
            <table class="table table-hover">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Correo Electrónico</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in users" class="text-center align-middle">
                        <th scope="row">{{ index + 1 }}</th>
                        <td class="text-start">{{ user.name }}</td>
                        <td class="text-start">{{ user.email }}</td>
                        <td>
                            <div class="row g-1">
                                <div class="col"> <button type="button" class="btn btn-warning w-100"
                                        @click="editarUsuario(user)">Editar</button></div>
                                <div class="col"> <button type="button" class="btn btn-danger w-100"
                                        @click="eliminarUsuario(user.id)">Eliminar</button></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="mdl-user">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="user.id > 0">Editar usuario</h5>
                    <h5 class="modal-title" v-else>Nuevo usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 form-floating mb-3">
                                <input type="text" class="form-control" id="name" placeholder="Nombre *"
                                    aria-describedby="requiredNombre" v-model="user.name">
                                <label class="ms-2" for="floatingInput">Nombre *</label>
                                <div id="requiredNombre" class="form-text text-danger" v-if="user.name == ''">
                                    Obligtorio, ejemplo: Ana Lucía
                                </div>
                            </div>
                            <div class="col-12 form-floating mb-3">
                                <input type="text" class="form-control" id="email" placeholder="Correo *"
                                    aria-describedby="requiredEmail" v-model="user.email">
                                <label class="ms-2" for="floatingInput">Email *</label>
                                <div id="requiredEmail" class="form-text text-danger" v-if="user.email== ''">
                                    Obligtorio, ejemplo: López Rojas
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"  v-if="user.id > 0"
                        @click="actualizarUsuario(user.id)">Actualizar registro</button>
                    <button type="button" class="btn btn-primary" v-else
                        @click="guardarUsuario()">Guardar registro</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="mdl-delete">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body align-self-center">
                    <span class="text-center text-danger">Esta acción NO se puede REVERTIR</span> <br>
                    <span class="text-center">¿Esta seguro de eliminar este registro?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="eliminarRegistro(user.id)">Eliminar
                        registro</button>
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
        const modal_user = reactive({
            mdl_user: null,
        })
        const modal_delete = reactive({
            mdl_delete: null,
        })
        const users = ref([])
        const user = reactive({
            id: 0,
            name: "",
            email: "",
        })
        function actualizarUsuario(Id) {
            console.log(user)
            fetch("http://127.0.0.1:8000/users/" + Id, {
                method: "PUT",
                headers: {
                    Accept: "Application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(user),
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
            getUsers();
            closeModal();
        }
        function cleanForm() {
            user.id = 0
            user.name = ""
            user.email = ""
        }
        function closeModal() {
            modal_user.mdl_user.hide()
            cleanForm()
        }
        function closeModalDelete() {
            modal_delete.mdl_delete.hide()
        }
        function editarUsuario(user_tabla) {
            cleanForm()
            user.id = user_tabla.id
            user.name = user_tabla.name
            user.email = user_tabla.email
            openModal()
        }
        function eliminarUsuario(Id) {
            user.id = Id
            openModalDetele()
        }
        function eliminarRegistro(Id) {
            fetch("http://127.0.0.1:8000/users/" + Id, {
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
                    getUsers();
                    closeModalDelete()
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        function getUsers() {
            fetch("http://127.0.0.1:8000/users", {
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
                    users.value = data;
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }
        function guardarUsuario() {
            fetch("http://127.0.0.1:8000/users", {
                method: "POST",
                headers: {
                    Accept: "Application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(user),
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

            getUsers();
            closeModal();
        }
        function nuevoUsuario() {
            cleanForm()
            openModal()
        }
        function openModal() {
            modal_user.mdl_user.show()
        }
        function openModalDetele() {
            modal_delete.mdl_delete.show()
        }


        return {
            error_message,
            modal_user,
            modal_delete,
            user,
            users,
            actualizarUsuario,
            nuevoUsuario,
            editarUsuario,
            eliminarUsuario,
            eliminarRegistro,
            getUsers,
            guardarUsuario
        }
    },
    mounted() {
        console.log('Component mounted.')
        this.getUsers();
        this.modal_user.mdl_user = new bootstrap.Modal('#mdl-user', {})
        this.modal_delete.mdl_delete = new bootstrap.Modal('#mdl-delete', {})
    }
}
</script>


