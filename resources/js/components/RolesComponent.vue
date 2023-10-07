<template>
    <div class="container">

        <div class="mt-5">
            <table class="table table-hover">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(role, index) in roles" class="text-center align-middle">
                        <th scope="row">{{ index + 1 }}</th>
                        <td class="text-start">{{ role.name }}</td>
                        <td class="text-start">{{ role.descripcion }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

  <script>
  export default {
    data() {
      return {
        roles: [],
      };
    },
    mounted() {
      this.getRoles();
    },
    methods: {
      getRoles() {

        this.roles = [
          { id: 1, name: 'Administrador', descripcion: 'Es el usuario administrador del sistema.' },
          { id: 2, name: 'Veterinario',  descripcion: 'El usuario solo tiene acceso a los modulos de usuarios, veterinaria y cliente.' },
          { id: 3, name: 'Recepcionista',  descripcion: 'El usuario solo tiene acceso al modulo cliente.' },
        ];
      },
    },
  };
  </script>
