<template>
<b-container fluid style="height: calc(100vh - 56px);">
        <b-row no-gutters>
            <b-col cols="4">
                <contact-list-component @conversationSelected="changeActiveConversation($event)">
                    </contact-list-component>   
            </b-col>
            <b-col cols="8">
                <active-conversation-component
                v-if="selectedConversation"
                :contact-id="selectedConversation.contact_id"
                :contact-name="selectedConversation.contact_name"
                ></active-conversation-component>
            </b-col>
        </b-row>
</b-container>
</template>

<script>
    export default {
      
      data() {
            return {
             selectedConversation: null
            };
        },
        mounted() {
                            console.log('MC - MOUNTD - ECHO CHANES EXAMPLE');// imprimimos inform.

            Echo.channel('example')// canal
            .listen('MessageSent', (e) => { //evennto
                console.log('MC - MOUNTD - ECHO CHANES EXAMPLE',e);// imprimimos inform.
             });
        },
        methods: {
            changeActiveConversation(conversation) {
                console.log('Nueva conv seleccionada', conversation,this.selectedConversation);
                this.selectedConversation = conversation;
            }

        }
    }
</script>