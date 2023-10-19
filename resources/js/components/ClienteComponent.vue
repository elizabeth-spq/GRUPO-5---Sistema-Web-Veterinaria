<template>
    <div class="container">
        <div class="mt-5">
            <button type="button" class="btn btn-primary px-4" @click="nuevoCliente()">Nuevo Cliente </button>
        </div>
        <div class="mt-5">
            <table class="table table-hover">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Tip_Doc</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(cliente,index) in clientes">
                        <th scope="row">{{index + 1}}</th>
                        <td>{{ cliente.nombre }}</td>
                        <td>{{ cliente.apellido }}</td>
                        <td>
                            <span v-if="cliente.tip_doc==1">DNI</span>
                            <span v-if="cliente.tip_doc==2">Pasaporte</span>
                            <span v-if="cliente.tip_doc==3">Carné</span>
                        </td>
                        <td>{{ cliente.documento }}</td>
                        <td>{{ cliente.telefono }}</td>
                        <td>{{ cliente.direccion }}</td>
                        <td>{{ cliente.email }}</td>
                        <td>
                            <span v-if="cliente.estado==0">Inactivo</span>
                            <span v-else="cliente.estado==1">Activo</span>
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

    <div class="modal" tabindex="-1" id="mdl-cliente">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="cliente.id > 0">Editar cliente</h5>
                    <h5 class="modal-title" v-else>Nuevo cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 form-floating mb-3">
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre *"
                                    aria-describedby="requiredNombre" v-model="cliente.nombre">
                                <label class="ms-2" for="floatingInput">Nombre *</label>
                                <div id="requiredNombre" class="form-text text-danger" v-if="cliente.nombre == ''">
                                    Obligtorio, ejemplo: Ana Lucía
                                </div>
                            </div>

                            <div class="col-12 form-floating mb-3">
                                <input type="text" class="form-control" id="apellido" placeholder="Apellido *"
                                    aria-describedby="requiredApellido" v-model="cliente.apellido">
                                <label class="ms-2" for="floatingInput">Apellido *</label>
                                <div id="requiredApellido" class="form-text text-danger" v-if="cliente.apellido == ''">
                                    Obligtorio, ejemplo: López Rojas
                                </div>
                            </div>

                            <div class="col-12 d-flex">
                                <div class=" form-floating col-4">
                                    <select class="form-select" id="tipDoc" aria-label="Floating label select example"
                                        aria-describedby="requiredDocumento" v-model="cliente.tip_doc">
                                        <option value="0" selected disabled>Seleccione ...</option>
                                        <option value="1">DNI</option>
                                        <option value="2">Pasaporte</option>
                                        <option value="3">Carné</option>
                                    </select>
                                    <label for="tipDoc">Tipo Documento *</label>
                                    <div id="requiredDocumento" class="form-text text-danger"
                                        v-if="cliente.tip_doc == ''">
                                        Obligtorio
                                    </div>
                                </div>
                                <div class="form-floating col-8 ">
                                    <input type="text" class="form-control" id="documento" placeholder="Documento *"
                                        aria-describedby="requiredDocumento" v-model="cliente.documento">
                                    <label class="ms-2" for="floatingInput">Documento *</label>
                                    <div id="requiredDocumento" class="form-text text-danger"
                                        v-if="cliente.documento == 0">
                                        Obligtorio, ejemplo: 78455511
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 form-floating mb-3">
                                <input type="text" class="form-control" id="telefono" placeholder="Telefono *"
                                    aria-describedby="requiredTelefono" v-model="cliente.telefono">
                                <label class="ms-2" for="floatingInput">Telefono *</label>
                                <div id="requiredTelefono" class="form-text text-danger"
                                    v-if="cliente.telefono == ''">
                                    Obligtorio, ejemplo: 054-145287 ó 95741244
                                </div>
                            </div>

                            <div class="col-12 form-floating mb-3">
                                <input type="text" class="form-control" id="direccion" placeholder="Direccion *"
                                    aria-describedby="requiredDireccion" v-model="cliente.direccion">
                                <label class="ms-2" for="floatingInput">Direccion *</label>
                                <div id="requiredDireccion" class="form-text text-danger" v-if="cliente.direccion == ''">
                                    Obligtorio, ejemplo: Av.Marical Castilla
                                </div>
                            </div>

                            <div class="col-12 form-floating mb-3">
                                <input type="email" class="form-control" id="email" placeholder="Email *"
                                    aria-describedby="requiredEmail" v-model="cliente.email">
                                <label class="ms-2" for="floatingInput">Email *</label>
                                <div id="requiredEmail" class="form-text text-danger" v-if="cliente.email == ''">
                                    Obligtorio, ejemplo: fabricio@gmial.com
                                </div>
                            </div>

                            <div class="col-12">
                                <h6>Estado</h6>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="cliStatus"
                                        v-model="cliente.estado" :checked="cliente.estado == 1 ? true : false">
                                    <label class="form-check-label" for="cliStatus">
                                        <span v-if="cliente.estado > 0">Activo</span>
                                        <span v-else>Inactivo</span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" v-if="cliente.id > 0"
                        @click="actualizarCliente(cliente.id)">Actualizar registro</button>
                    <button type="button" class="btn btn-primary" v-else @click="guardarCliente()">Guardar
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
    export default{
        setup(){
            const error_message = ref("")
            const modal_cliente = reactive({
            mdl_cli: null,
            })
            const modal_delete = reactive({
            mdl_delete: null,
        })
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
            function actualizarCliente(Id) {
            console.log(cliente)
            fetch("http://127.0.0.1:8000/clientes" + Id, {
                method: "PUT",
                headers: {
                    Accept: "Application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(cliente),
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
            obtenerClientes();
            closeModal();
        }
        function cleanForm() {
            cliente.id = 0
            cliente.nombre = ""
            cliente.apellido = ""
            cliente.tip_doc = 0
            cliente.documento = ""
            cliente.telefono = ""
            cliente.direccion = ""
            cliente.email = ""
            cliente.estado = 0
        }
        
        function closeModal(){
            modal_cliente.mdl_cli.hide()
            cleanForm()
        }
        function closeModalDelete() {
            modal_delete.mdl_delete.hide()
        }

        function editarCliente(cliente_tabla) {
            cleanForm()
            cliente.id = cliente_tabla.id
            cliente.nombre = cliente_tabla.nombre
            cliente.apellido = cliente_tabla.apellido
            cliente.tip_doc = cliente_tabla.tip_doc
            cliente.documento = cliente_tabla.documento
            cliente.telefono = cliente_tabla.telefono
            cliente.direccion = cliente_tabla.direccion
            cliente.email = cliente_tabla.email
            cliente.estado = cliente_tabla.estado
            openModal()
        }

        function eliminarCliente(Id) {
            cliente.id = Id
            openModalDetele()
        }

        function eliminarRegistroCli(Id) {
            fetch("http://127.0.0.1:8000/clientes" + Id, {
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
                    obtenerClientes();
                    closeModalDelete()
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
        }

        //
            function obtenerClientes() {
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
                })
                .catch((error) => {
                    error_message.value = error;
                    console.error("There was an error!", error);
                });
            }

            function guardarCliente(){
                fetch("http://127.0.0.1:8000/clientes", {
                method: "POST",
                headers: {
                    Accept: "Application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(cliente),
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

                obtenerClientes();
                closeModal();
            }

            function nuevoCliente(){
                cleanForm()
                openModal()
            }

            function openModal(){
                modal_cliente.mdl_cli.show()
            }
            function openModalDetele() {
            modal_delete.mdl_delete.show()
        }

            return{
                error_message,
                modal_cliente,
                modal_delete,
                cliente,
                clientes,
                
                actualizarCliente,
                nuevoCliente,
                editarCliente,
                eliminarCliente,
                eliminarRegistroCli,
                obtenerClientes,
                guardarCliente,
            }
        },
        mounted(){
            console.log('Component mounted.')
            this.obtenerClientes();
            this.modal_cliente.mdl_cli = new bootstrap.Modal('#mdl-cliente', {})
            this.modal_delete.mdl_delete = new bootstrap.Modal('#mdl-delete', {})
        }
    }
</script>
