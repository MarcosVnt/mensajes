<template>

<b-container fluid style="height: calc(100vh - 56px);">
        <b-row no-gutters>
            <b-col cols="4">
                <contact-list-component 
                @conversationSelected="changeActiveConversation($event)"
                :conversations="conversations">
                    </contact-list-component>   
            </b-col>
            <b-col cols="8">
                <active-conversation-component
                v-if="selectedConversation"
                :contact-id="selectedConversation.contact_id"
                :contact-name="selectedConversation.contact_name"
                :messages="messages"
                @messageCreated="addMessage($event)"
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
             conversations : []
             
            };
        },
        mounted() {
            console.log('MOUNTED', this.marcos)

            this.getConversations();
            console.log(`users.${this.userId}`);

            Echo.private(`users.${this.userId}`)
		    .listen('.MessageSent', (data) => {
		    	const message = data.message;
		    
                console.log('laravel - message',message);
                message.written_by_me = false;  // si lo recibimos no lo enviamos nosotros.

                this.addMessage(message);
		    });

            Echo.join('messenger')
                // al conectarnos tenemos acceso a tres eventos..
                // user tiene los usuarios que se van conectando...
                .here((users) => {
                    //
                    console.log('online',users);
                    users.forEach((user) => this.changeStatus(user, true));
                })
                /* .joining((user) => {
                  this.changeStatus(user,true)
 */             .joining(
                    user => this.changeStatus(user, true)    
                )
                .leaving(
                    user =>this.changeStatus(user,false)
                );



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

            addMessage(message){

               // const conversation = conversations.find(function (conversation)
                const conversation = this.conversations.find( (conversation) => { 
                    return conversation.contact_id == message.from_id ||
                    conversation.contact_id == message.to_id;
                });

                const author = this.userId === message.from_id ? 'Tu' : conversation.contact_name;
                conversation.last_message = `${author}: ${message.content}`;
                //conversation.last_message = message.content;
                conversation.last_time = message.created_at;


                if(this.selectedConversation.contact_id == message.from_id
                || this.selectedConversation.contact_id == message.to_id
                ){
                                console.log('message',message);
                                this.messages.push(message);
                                console.log('mensajes : ',this.messages);
                }



            },

             getConversations() {
                
                axios.get('api/conversations')
                .then((response) => {
                    this.conversations = response.data;
                    console.log('CL getConversations ', this.conversations);
                   

                });

            },
            changeStatus(user, status){
                      const index = this.conversations.findIndex((conversation) =>{
                        return conversation.contact_id == user.id
                    });
                    console.log('index',index,'user.id',user.id,'conversations',this.conversations);
                    if (index >= 0){
                    this.$set(this.conversations[index],'online' , status);
                    }

            }

        }
    }
</script>