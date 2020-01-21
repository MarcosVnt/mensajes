<template>
    <div>
        
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
