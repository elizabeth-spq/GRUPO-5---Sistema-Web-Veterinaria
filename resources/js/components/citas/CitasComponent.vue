<template>
    <input id="fecNac" type="text" class="form-control" placeholder="02/02/2000" v-model="error_message"
        aria-describedby="requiredFecNac" />


</template>
<script>
import { ref, reactive } from 'vue';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
export default {
    setup() {
        const error_message = ref("")
        const error_message_two = ref("")
        const cita = reactive({
            nombre:"Este componente funciona"
        })

        function mostrarCalendarioNac() {
            $('#fecNac').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                minDate: moment().startOf('hour'),
                maxDate: moment().startOf('year').add(1, 'year'),
                locale: {
                    format: 'YYYY-MM-DD HH:mm'
                }
            });
            $("#fecNac").on("change", function () {
                //console.log($('#fecNac').val);
                error_message.value = $("#fecNac").val() ;
                var startDateTime = error_message.value
                console.log(startDateTime)
                var newDateTime = moment(startDateTime).startOf('hours').add(0.34, 'hours').format('YYYY-MM-DD HH:mm');
                console.log(newDateTime);
            });
        }

        return {
            cita,
            error_message,
            error_message_two,
            mostrarCalendarioNac,
        }
    },
    mounted() {
        console.log("Component mounted")
        this.mostrarCalendarioNac()
    }
}
</script>
