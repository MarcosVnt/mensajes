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
        
        data() {
            return {
                conversations: [],

            };
           
        },
        mounted() {
            console.log('ContactListComponent mounted.  GETCONVERSATIONS')
            this.getConversations();
        },
        methods:{
            getConversations() {
                
                axios.get('api/conversations')
                .then((response) => {
                    this.conversations = response.data;
                    console.log('CL getConversations ', this.conversations);

                });

            },
            selectConversation(conversation) {
                console.log(conversation);
                this.$emit('conversationSelected',conversation);
            }
        }
    }
</script>
