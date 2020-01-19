<template>
<b-container fluid style="height: calc(100vh - 56px);">
        <b-row no-gutters>
            <b-col cols="4">
                <contact-list-component 
                @conversationSelected="changeActiveConversation($event)">
                    </contact-list-component>   
            </b-col>
            <b-col cols="8">
                <active-conversation-component
                v-if="selectedConversation"
                :contact-id="selectedConversation.contact_id"
                :contact-name="selectedConversation.contact_name"
                :messages="messages"
                ></active-conversation-component>
            </b-col>
        </b-row>
</b-container>
</template>

<script>
    export default {
        props: {
            //recibe del exterior
            userId: Number
        },
      
      data() {
            return {
             selectedConversation: null,
             messages: [],
             marcos : 'marcos',
             
            };
        },
        mounted() {
            console.log('MOUNTED', this.marcos)

          //  this.metoMensaje('uno');
         /*      var channel = Echo.channel('marcos');
                channel.listen('.MessageSent', function(data) {
                    console.log('data.message',data.message,this.marcos);
                    const message = data.message;
                    console.log('.message',message);
                    console.log('MENSAJES ...', this.messages,this.userId,this.marcos);
                    
                    message.written_by_me = (this.userId == message.from_id);
                   // this.messages.push(message);
                    console.log('dat.message 2',data.message);
                    console.log('mensaje---2-->',message);
                    this.metoMensaje(message); 
                    

            });   */



            Echo.channel('marcos')
		    .listen('.MessageSent', (data) => {
		    	const message = data.message;
		    	message.written_by_me = (this.userId == message.from_id);
		    	console.log('message',message);
                this.messages.push(message);
                console.log('mensajes : ',this.messages);
                
		    });



        },
        methods: {
            metoMensaje(message)  {
                console.log('dengro de metoMensaje',message,this.messages);
                
            },
            changeActiveConversation(conversation) {
                console.log('Nueva conv seleccionada', conversation,this.selectedConversation);
                this.selectedConversation = conversation;
                this.getMessages();
                console.log('Nueva conv seleccionada222', this.messages);

            },
             getMessages() {
                console.log('getMessages mounted.');

                axios.get(`api/messages?contact_id=${this.selectedConversation.contact_id}`)
                .then((response=> {
                    console.log('Ac getMessages()' ,response.data);
                    this.messages=response.data;
                                    console.log('this.Messages .',this.messages);

                    }


                )
                
                );
            },

        }
    }
</script>