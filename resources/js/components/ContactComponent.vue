<template>
 <b-list-group-item :variant="variant">
        <b-row class="p-2" align-h="center">
            <b-col cols="12" md="3" class="text-center">
                <b-img rounded="circle" blank width="60" height="60" blank-color="#777" alt="img" class="m-1" />
            </b-col>
            <b-col cols="6" align-self="center" class="d-none d-md-block">


                <p class="mb-1"> 
                    
                    
                    <status-component :online="conversation.online" /> 


                    {{ conversation.contact_name }}</p>
                <p class="text-muted small mb-1">{{ conversation.last_message }}</p>
            </b-col>      
            <b-col cols="3" class="d-none d-md-block">
                <p class="text-muted small">{{ lastTime }}</p>
            </b-col>        
        </b-row>
    </b-list-group-item>
</template>

<script>
    export default {
        //variable viene del exterior
        props: {
            variant:String,
            conversation : Object
        
        },
        
        data() {
            return {
               /*  name: 'Juan Ramos',
                lastMessage: 'Tú: Hasta luego',
                lastTime: '1:37 pm' */
            };
        },
        
        computed: {
            lastTime() {
                return moment(this.conversation.last_time, "YYYY-MM-DD hh:mm:ss").locale('es').fromNow();

            }
        },
        mounted() {
            console.log('CONTACT COMPONETN',this.conversation)
        }
    }
</script>
