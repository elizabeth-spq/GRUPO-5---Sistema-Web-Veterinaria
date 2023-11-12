<template>
    <div class="container">
      <div class="mt-5">
        <button type="button" class="btn btn-primary px-4" @click="nuevoUsuario()">Nuevo Usuario</button>
      </div>
      <div class="mt-5">
        <table class="table table-hover">
          <thead>
            <tr class="table-dark align-middle text-center">
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Apellidos</th>
              <th scope="col">Correo Electrónico</th>
              <th scope="col">Rol</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user, index) in users">
              <th scope="row">{{ index + 1 }}</th>
              <td>{{ user.name }}</td>
              <td>{{ user.apellido }}</td>
              <td>{{ user.email }}</td>
              <td>
                  <span v-if="user.rol_id==1">administrador</span>
                  <span v-if="user.rol_id==2">veterinario</span>
                  <span v-if="user.rol_id==3">recepcionista</span>
              </td>
              <td>
                <div class="row g-1">
                  <div class="col">
                    <button type="button" class="btn btn-warning w-100" v-if="!user.isDeactivated" @click="editarUsuario(user)">Editar</button>
                  </div>
                  <div class="col">
                    <button type="button" class="btn btn-danger w-100" @click="eliminarUsuario(user.id)">Eliminar</button>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="modal" tabindex="-1" id="mdl-create">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="user.id < 0">Nuevo usuario</h5>
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
                                    Obligtorio
                                </div>
                            </div>
                            <div class="col-12 form-floating mb-3">
                                <input type="text" class="form-control" id="apellido" placeholder="Apellido *"
                                    aria-describedby="requiredApellido" v-model="user.apellido">
                                <label class="ms-2" for="floatingInput">Apellido *</label>
                                <div id="requiredApellido" class="form-text text-danger" v-if="user.apellido == ''">
                                    Obligtorio
                                </div>
                            </div>
                            <div class="col-12 form-floating mb-3">
                                <input type="email" class="form-control" id="email" placeholder="Correo *"
                                    aria-describedby="requiredEmail" v-model="user.email">
                                <label class="ms-2" for="floatingInput">Email *</label>
                                <div id="requiredEmail" class="form-text text-danger" v-if="user.email== ''">
                                    Obligtorio
                                </div>
                            </div>
                            <div class="col-12 form-floating mb-3">
                                <input type="password" class="form-control" id="password" placeholder="Contraseña *"
                                    aria-describedby="requiredPassword" v-model="user.password">
                                <label class="ms-2" for="floatingInput">Contraseña *</label>
                                <div id="requiredPassword" class="form-text text-danger" v-if="user.password == '' && user.confirmPassword == ''">
                                    Obligtorio
                                </div>
                            </div>
                            <div class="col-12 form-floating mb-3">
                                <input type="password" class="form-control" id="confirmPassword" placeholder="Contraseña *"
                                    aria-describedby="requiredConfirmPassword" v-model="user.confirmPassword">
                                <label class="ms-2" for="floatingInput">Confirme la Contraseña *</label>
                                <div id="requiredConfirmPassword" class="form-text text-danger" v-if="user.password !== '' && user.confirmPassword == ''">
                                    Obligtorio
                                </div>
                            </div>
                            <div class="form-text text-danger" v-if="user.password !== '' && user.confirmPassword !== user.password">
                                Las contraseñas no coinciden
                            </div>
                            <div class=" form-floating col-12">
                                <select class="form-select" id="id" aria-label="Floating label select example"
                                    aria-describedby="requiredRol" v-model="user.rol_id">
                                    <option value="0" selected disabled>Seleccione ...</option>
                                    <option value="2">veterinario</option>
                                    <option value="3">recepcionista</option>
                                </select>
                                <label for="rol" class="ms-2">Rol *</label>
                                <div id="requiredRol" class="form-text text-danger"
                                    v-if="user.name == 0">
                                    Obligtorio
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="guardarUsuario()">Guardar registro</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="mdl-edit">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="user.id > 0">Editar usuario</h5>
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
                                </div>
                            </div>
                            <div class="col-12 form-floating mb-3">
                                <input type="text" class="form-control" id="apellido" placeholder="Apellido *"
                                    aria-describedby="requiredApellido" v-model="user.apellido">
                                <label class="ms-2" for="floatingInput">Apellido *</label>
                                <div id="requiredApellido" class="form-text text-danger" v-if="user.apellido == ''">
                                </div>
                            </div>
                            <div class="col-12 form-floating mb-3">
                                <input type="email" class="form-control" id="email" placeholder="Correo *"
                                    aria-describedby="requiredEmail" v-model="user.email">
                                <label class="ms-2" for="floatingInput">Email *</label>
                                <div id="requiredEmail" class="form-text text-danger" v-if="user.email== ''">
                                </div>
                            </div>
                            <div class="col-12 form-floating mb-3">
                                <input type="password" class="form-control" id="password" placeholder="Contraseña *"
                                    aria-describedby="requiredPassword" v-model="user.password">
                                <label class="ms-2" for="floatingInput">Nueva Contraseña *</label>
                                <div id="requiredPassword" class="form-text text-danger" v-if="user.password== ''">
                                </div>
                            </div>
                            <div class="col-12 form-floating mb-3">
                                <input type="password" class="form-control" id="confirmPassword" placeholder="Contraseña *"
                                    aria-describedby="requiredConfirmPassword" v-model="user.confirmPassword">
                                <label class="ms-2" for="floatingInput">Confirme la Contraseña *</label>
                                <div id="requiredConfirmPassword" class="form-text text-danger" v-if="user.confirmPassword== ''">
                                </div>
                            </div>
                            <div class="form-text text-danger" v-if="user.password !== '' && user.confirmPassword !== user.password">
                                Las contraseñas no coinciden
                            </div>
                            <div class="form-floating col-12 mb-3">
                                <select class="form-select" id="id" aria-label="Floating label select example"
                                    aria-describedby="requiredRol" v-model="user.rol_id">
                                    <option value="0" selected disabled>Seleccione ...</option>
                                    <option value="2">veterinario</option>
                                    <option value="3">recepcionista</option>
                                </select>
                                <label for="rol" class="ms-2">Rol *</label>
                                <div id="requiredRol" class="form-text text-danger"
                                    v-if="user.name == 0">
                                </div>
                            </div>
                            <div class="form-floating col-12 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="switchDeactivar" v-model="user.isDeactivated" @change="confirmarDesactivacion">
                                    <label class="form-check-label" for="switchDeactivar">Desactivar Usuario</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="actualizarUsuario(user.id)">Actualizar registro</button>
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

    <div class="modal" tabindex="-1" id="mdl-desactivar">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Desactivar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body align-self-center">
                    <span class="text-center text-danger">ESTA ACCIÓN NO SE PUEDE REVERTIR</span> <br>
                    <span class="text-center">¿Está seguro de desactivar al usuario?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" @click="mostrarCampoMotivoDesactivacion">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="mdl-motivo">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Motivo de Desactivación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <label for="motivoDesactivacion">Ingrese el motivo de desactivación:</label>
                    <textarea class="form-control" id="motivoDesactivacion" v-model="user.motivoDesactivacion"></textarea>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" @click="guardarMotivoDesactivacion">Aceptar</button>
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
          const modal_edit = reactive({
              mdl_edit: null,
          })
          const modal_delete = reactive({
              mdl_delete: null,
          })
          const modal_desactivar = reactive({
            mdl_desactivar: null,
          })
          const modal_motivo = reactive({
            mdl_motivo: null,
          })
            const users = ref([])
            const user = reactive({
                id: 0,
                name: "",
                apellido: "",
                email: "",
                password: '',
                confirmPassword: '',
                rol_id: 0,
                isDeactivated: false,
                motivoDesactivacion: ''
            })

            function confirmarDesactivacion() {
                openModalDesactivar()
            };


            function mostrarCampoMotivoDesactivacion() {
                closeModalDesactivar()
                openModalMotivo()
            };

            function guardarMotivoDesactivacion() {
                if (user.motivoDesactivacion.trim() === '') {
                    alert('Por favor, ingresa un motivo para desactivar al usuario.');
                return;
            }
                closeModalMotivo()
            };

            function actualizarUsuario(Id) {
                if (user.password !== '' && user.password !== user.confirmPassword) {
                    error_message.value = "Las contraseñas no coinciden";
                    return;
                }
                if (user.isDeactivated) {
                    if (!user.motivoDesactivacion) {
                        error_message.value = "Se requiere un motivo para desactivar al usuario";
                        return;
                    }
                    user.estado = 1;
                    user.motivoDeDesactivacion = user.motivoDesactivacion;
                    alert('La cuenta ha sido desactivada. Ya no podrá realizar ninguna acción.');
                }
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
                                "Hubo un erro al actualizar el usuario"
                            return Promise.reject(error);
                        }

                    })
                    .catch((error) => {
                        error_message.value = error;
                        console.error("Hubo un error en la actualización del usuario:", error);
                    });
                obtenerUsuario();
                closeModalEdit();
            }
            function cleanForm() {
                    user.id = 0
                    user.name = ""
                    user.apellido = ""
                    user.email = ""
                    user.password = '',
                    user.confirmPassword = '',
                    user.rol_id = 0
                    user.isDeactivated = false,
                    user.motivoDesactivacion = ''
            }
            function closeModalCreate() {
                modal_create.mdl_create.hide()
                cleanForm()
            }
            function closeModalEdit() {
                modal_edit.mdl_edit.hide()
                cleanForm()
            }
            function closeModalDelete() {
                modal_delete.mdl_delete.hide()
            }
            function closeModalDesactivar() {
                modal_desactivar.mdl_desactivar.hide()
            }
            function closeModalMotivo() {
                modal_motivo.mdl_motivo.hide()
            }
            function editarUsuario(user_tabla) {
                cleanForm()
                user.id = user_tabla.id
                user.name = user_tabla.name
                user.apellido = user_tabla.apellido
                user.email = user_tabla.email
                user.password = ''
                user.confirmPassword = ''
                user.rol_id = user_tabla.rol_id
                user.isDeactivated = false;
                user.motivoDesactivacion = user_tabla.motivoDeDesactivacion || '';
                openModalEdit()
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
                        obtenerUsuario();
                        closeModalDelete()
                    })
                    .catch((error) => {
                        error_message.value = error;
                        //console.error("There was an error!", error);
                    });
            }

            function obtenerUsuario() {
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
                        //console.log(data)
                        users.value = data;
                    })
                    .catch((error) => {
                        error_message.value = error;
                        console.error("There was an error!", error);
                    });
            }

            function guardarUsuario() {
                if (user.password !== '' && user.password !== user.confirmPassword) {
                    error_message.value = "Las contraseñas no coinciden";
                    return;
                }
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
                        console.error("Hubo un error al guardar el usuario creado:", error);
                    });

                obtenerUsuario();
                closeModalCreate();
            }
            function nuevoUsuario() {
                cleanForm()
                openModalCreate()
            }
            function openModalCreate() {
                modal_create.mdl_create.show()
            }
            function openModalEdit() {
                modal_edit.mdl_edit.show()
            }
            function openModalDetele() {
                modal_delete.mdl_delete.show()
            }
            function openModalDesactivar() {
                modal_desactivar.mdl_desactivar.show()
            }
            function openModalMotivo() {
                modal_motivo.mdl_motivo.show()
            }

            return{
                error_message,
                modal_create,
                modal_edit,
                modal_delete,
                modal_desactivar,
                modal_motivo,
                user,
                users,

                confirmarDesactivacion,
                mostrarCampoMotivoDesactivacion,
                guardarMotivoDesactivacion,
                actualizarUsuario,
                nuevoUsuario,
                editarUsuario,
                eliminarUsuario,
                eliminarRegistro,
                obtenerUsuario,
                guardarUsuario
            }
        },
        mounted() {
        this.obtenerUsuario();
        this.modal_create.mdl_create = new bootstrap.Modal('#mdl-create', {})
        this.modal_edit.mdl_edit = new bootstrap.Modal('#mdl-edit', {})
        this.modal_delete.mdl_delete = new bootstrap.Modal('#mdl-delete', {})
        this.modal_desactivar.mdl_desactivar = new bootstrap.Modal('#mdl-desactivar', {})
        this.modal_motivo.mdl_motivo = new bootstrap.Modal('#mdl-motivo', {})
    }
}
</script>


