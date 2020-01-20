<template>
    <div>
        <b-form class="my-3 mx-2">
                    <b-form-input class="text-center"
                    type="text"
                    placeholder="Buscar Contacto">

                    </b-form-input>
        </b-form>

        <b-list-group>
                    <contact-component 
                    v-for="conversation in conversations"
                    :key="conversation.id"
                    :conversation="conversation"
                    @click.native="selectConversation(conversation)">
                    </contact-component>
                    
        </b-list-group>  
    </div>
</template>
<script>
    export default {
        //variable viene del exterior
        props: {
            // propiedad que se recibe de forma externa
            conversations : Array
        },
        
        data() {
            return {
               

            };
           
        },
        mounted() {
            console.log('ContactListComponent mounted.  GETCONVERSATIONS')
           // ya no lo llamam this.getConversations();
        },
        methods:{
           
            selectConversation(conversation) {
                console.log(conversation);
                //emite evento 
                this.$emit('conversationSelected',conversation);
            }
        }
    }
</script>
