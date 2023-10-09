<template>
    <div class="container">
      <div class="mt-5">
        <button type="button" class="btn btn-primary px-4" @click="nuevoUsuario()">Nuevo Usuario</button>
      </div>
      <div class="mt-5">
        <table class="table table-hover">
          <thead>
            <tr class="table-dark">
              <th scope="col">#</th>
              <th scope="col">Usuario</th>
              <th scope="col">Correo Electrónico</th>
              <th scope="col">Rol</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user, index) in users" :key="user.id" class="text-center align-middle">
              <th scope="row">{{ index + 1 }}</th>
              <td class="text-start">{{ user.name }}</td>
              <td class="text-start">{{ user.email }}</td>
              <!-- <td> {{ user.role ? user.role.name : 'Sin Rol' }}</td> Mostramos el rol o 'Sin Rol' si no tiene uno -->
              <td>
                <span v-for="role in user.roles" :key="role.id">{{ role.name }}</span>
              </td>
              <td>
                <div class="row g-1">
                  <div class="col">
                    <button type="button" class="btn btn-warning w-100" @click="editarUsuario(user)">Editar</button>
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
                            <div class=" form-floating col-12">
                                <select class="form-select" id="id" aria-label="Floating label select example"
                                    aria-describedby="requiredRol" v-model="roles.name">
                                    <option value="0" selected disabled>Seleccione ...</option>
                                    <option value="1">administrador</option>
                                    <option value="2">veterinario</option>
                                    <option value="3">recepcionista</option>
                                </select>
                                <label for="id" class="ms-2">Rol *</label>
                                <div id="requiredRol" class="form-text text-danger"
                                    v-if="roles.name == 0">
                                    Obligtorio
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
  import { ref, reactive, onMounted } from 'vue';
  import * as bootstrap from 'bootstrap';

  export default {
    setup() {
      const modalUser = ref(null);
      const modalDelete = ref(null);

      const error_message = ref("");
      const users = ref([]);
      const user = reactive({
        id: 0,
        name: "",
        email: "",
        role_id: 0, // Agregamos un campo para el rol
      });

      const roles = ref([]);
      const role = ref({
        id: 0,
        name: "",
      });

      function actualizarUsuario() {
      fetch(`/api/usuarios/${user.id}`, {
        method: "PUT",
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
        body: JSON.stringify(user),
      })
        .then(async (response) => {
          if (!response.ok) {
            const data = await response.json();
            const error = data && data.detail ? data.detail : response.statusText;
            return Promise.reject(error);
          }
          // Actualizamos el usuario en la lista
          const updatedUserIndex = users.value.findIndex((u) => u.id === user.id);
          if (updatedUserIndex !== -1) {
            users.value[updatedUserIndex] = {
              ...user,
              role: roles.value.find((r) => r.id === user.role_id),
            };
          }
          closeModal();
        })
        .catch((error) => {
          error_message.value = error;
          console.error("Hubo un error al actualizar el usuario.", error);
        });
    }

      function cleanForm() {
        user.id = 0;
        user.name = "";
        user.email = "";
        user.role_id = 0; // Limpiamos el campo de rol
      }

      function closeModal() {
        modalUser.value.hide();
        cleanForm();
      }

      function closeModalDelete() {
        modalDelete.value.hide();
      }

      function editarUsuario(selectedUser) {
        user.id = selectedUser.id;
        user.name = selectedUser.name;
        user.email = selectedUser.email;
        user.role_id = selectedUser.role_id; // Asignamos el rol del usuario
        modalUser.value.show();
      }

      function eliminarUsuario(userId) {
        user.id = userId;
        modalDelete.value.show();
      }

      function eliminarRegistro(userId) {
      fetch(`/api/usuarios/${userId}`, {
        method: "DELETE",
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then(async (response) => {
          if (!response.ok) {
            const data = await response.json();
            const error = data && data.detail ? data.detail : response.statusText;
            return Promise.reject(error);
          }
          // Eliminamos el usuario de la lista
          users.value = users.value.filter((u) => u.id !== userId);
          closeModalDelete();
        })
        .catch((error) => {
          error_message.value = error;
          console.error("Hubo un error al eliminar el usuario.", error);
        });
    }

      function getUsers() {
        fetch("http://127.0.0.1:8000/users", {
          method: "GET",
        })
          .then(async (response) => {
            const data = await response.json();
            if (!response.ok) {
              const error = data && data.detail ? data.detail : response.statusText;
              return Promise.reject(error);
            }
            users.value = data;
          })
          .catch((error) => {
            error_message.value = error;
            console.error("Hubo un error al obtener la lista de usuarios.", error);
          });

        fetch("http://127.0.0.1:8000/roles", {
          method: "GET",
        })
          .then(async (response) => {
            const data = await response.json();
            if (!response.ok) {
              const error = data && data.detail ? data.detail : response.statusText;
              return Promise.reject(error);
            }
            roles.value = data;
          })
          .catch((error) => {
            error_message.value = error;
            console.error("Hubo un error al obtener la lista de roles.", error);
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
              const data = await response.json();
              const error = data && data.detail ? data.detail : response.statusText;
              return Promise.reject(error);
            }
            getUsers();
            closeModal();
          })
          .catch((error) => {
            error_message.value = error;
            console.error("Hubo un error al guardar el usuario.", error);
          });
      }

      function nuevoUsuario() {
        cleanForm();
        modalUser.value.show();
      }

      // Inicializar modales
      onMounted(() => {
        modalUser.value = new bootstrap.Modal('#mdl-user', {});
        modalDelete.value = new bootstrap.Modal('#mdl-delete', {});
      });

      // Cargar la lista de usuarios y roles al montar el componente
      getUsers();

      return {
        error_message,
        user,
        users,
        roles,
        actualizarUsuario,
        nuevoUsuario,
        editarUsuario,
        eliminarUsuario,
        eliminarRegistro,
        getUsers,
        guardarUsuario,
        cleanForm,
        closeModal,
        closeModalDelete,
      };
    },
  };
  </script>


