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
                                placeholder="1Escribe un mensaje ...">
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
            <p>Usuario seleccionado</p>
            <hr>
            <b-form-checkbox>
                Desactivar notificaciones
            </b-form-checkbox>
        </b-col>
    </b-row>
</template>

<script>
    export default {
        data() {
            return {
                messages: [],
                newMessage : '',

            };
            
        },
        mounted() {
            this.getMessages();
            
        },
        methods: {
            getMessages() {
                console.log('getMessages mounted.')
                axios.get('api/messages').then((response=> 
                {
                    console.log(response.data);
                    this.messages=response.data}
                    ));
            },

            postMessage() {
                
                const params = {
                    to_id:2,
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
    }
</script>