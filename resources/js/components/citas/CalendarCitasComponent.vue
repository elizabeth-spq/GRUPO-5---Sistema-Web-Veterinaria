<template>
    <h1>Calendar component</h1>

</template>
<script>
import { ref, reactive } from 'vue';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
export default {
    setup() {
        const error_message = ref("")


        return {
            error_message,

        }
    },
    mounted() {
        console.log("Component mounted")

    }
}
</script>
