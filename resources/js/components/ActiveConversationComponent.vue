<template>
    <b-row>
        <b-col cols="8">
            <b-card 
                  footer-bg-variant="light"
                  footer-border-variant="dark"
                  title="Conversación activa"
                  class="h-100">

                   <message-conversation-component
                    v-for="message in messages"
                    :key="messages.id"
                    :written-by-me="message.written_by_me">
                    {{message.content}}
              </message-conversation-component>
           
                <div slot="footer">
                    <b-form class="mb-0" @submit.prevent="postMessage"
                    autocomplete="off">

                        <b-input-group>
                            <b-form-input class="text-center"
                                v-model = "newMessage"
                                type="text"
                                placeholder="Escribe un mensaje ...">
                            </b-form-input>

                            <b-input-group-append>
                                <b-button type="submit" variant="primary">Enviar</b-button>
                            </b-input-group-append>
                        </b-input-group>

                    </b-form>
                </div>
          </b-card>
        </b-col>
        <b-col cols="4">
            <b-img rounded="circle" blank width="60" height="60" blank-color="#777" alt="img" class="m-1" />
            <p>{{contactName}}</p>
            <hr>
            <b-form-checkbox>
                Desactivar notificaciones
            </b-form-checkbox>
        </b-col>
    </b-row>
</template>

<script>
    export default {

        props: {
            contactId: Number,
            contactName : String
        },
        data() {
            return {
                messages: [],
                newMessage : '',

            };
            
        },
        mounted() {
            this.getMessages();
            console.log(' cargo mensajes en AC MOUNTED', this.contactId);

            
            
        },
        methods: {
            getMessages() {
                console.log('getMessages mounted.');

           /*  var channel = Echo.channel('my-channel');
                channel.listen('.MessageSent', function(data) {
                    //alert(JSON.stringify(data));
                    console.log('eeechoooo',data);
            });

            var channell = Echo.channel('my-channel');
                channell.listen('.MessageSent', function(e)  { 
                            console.log('MC - MOUNTD - ECHO CHANES EXAMPLE',e)
                        });

                console.log('getMessages mounted.2222222222222222222',channel);
                console.log('getMessages mounted.333333333333333l',channell); */





                axios.get(`api/messages?contact_id=${this.contactId}`).then((response=> 
                {
                    console.log('Ac getMessages()' ,response.data);
                    this.messages=response.data}
                    ));
            },

            postMessage() {
                
                const params = {
                    to_id:this.contactId,
                    content: this.newMessage,
                };

                console.log('Enviando Mensaje', params);

                axios.post('api/messages',params)
                .then((response=> 
                {
                    if(response.data.success){
                         this.newMessage = '';
                         this.getMessages();
                
                    }
                 }
                ));
            }


        }
        ,
            watch: {
                contactId(val) {
                    console.log('AC .watch :',val);
                    console.log(`contactId => $(this.contactId)`);
                    this.getMessages();

                }
            },

    }
</script>