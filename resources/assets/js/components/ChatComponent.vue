<template>
    <div class="col-lg-3 col-md-6 col-sm-8 col-xs-12 float-right">
        <div class="card card-default shadow-lg">
            <template v-if="minimize">
                <div @click="close()" class="card-header bg-light shadow d-flex justify-content-between">
                    <div>Chat</div>
                    <div><i class="mdi mdi-minus-box-outline"></i></div>
                </div>
            </template>

            <template v-if="!minimize">
                <div @click="open()" class="card-header bg-light shadow d-flex justify-content-between">
                    <div>Chat</div>
                    <div><i class="mdi mdi-open-in-new"></i></div>
                </div>
            </template>

            <template v-if="minimize">
                <div class="card-body chat-box" id="chatBox">
                    <div class="text-center" v-if="(messages.length >= 25) && (messages.length > 0)">
                        <div @click="loadChatHistory()" class="btn btn-secondary">Load More</div>
                    </div>
                    <div class="text-center" v-if="messages.length < 1">
                        Send your first message!
                    </div>
                    <div v-for="message in messages">
                        <div class="message-line">
                            <div :class="messageColor(message)">
                                <small class="small-message-text">{{message.user.name}} - {{moment(message.created_at).fromNow()}}</small>
                                <div class="message-text" v-html="message.text"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <div class="form-group">
                        <input type="text" class="form-control" id="text" name="text" v-model="text" @keydown="typing" @keyup.enter="sendMessage" placeholder="Send a message" autocomplete="off">
                        <!-- TODO: Add person typing message -->
                        <span class="text-muted" v-if="activePeer" v-text="activePeer.name + ' is typing...'"></span>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                messages: [],
                text: '',
                history: [],
                loadingMessages: true,
                sendingFlag: false,
                chatBox: null,
                minimize: false,
                typingTimer: null,
                activePeer: null,
                audio: new Audio('/audio/open-ended.mp3')
            };
        },
        props: ['auth_user'],
        created() {
            this.listenOnChatChanel();
            this.getMessages();
        },
        computed: {
        },
        watch: {
            messages: function () {
                if(this.messages.length > 0 && this.minimize){
                    this.scrollToBottom();
                }
            }
        },
        methods: {
            getMessages: function () {
                this.loadingMessages = true;
                axios.get('/api/chat')
                    .then((response) => {
                        this.messages = response.data;
                        this.loadingMessages = false;
                    })
                    .catch((e) => {
                        this.loadingMessages = false;
                        console.log(e);
                    });
            },
            sendMessage: function () {
                if(! this.sendingFlag){
                    this.sendingFlag = true;
                    axios.post('/api/chat', {
                        text: this.text,
                        user_id: this.auth_user.id
                        })
                        .then((response) => {
                            this.text = '';
                            this.sendingFlag = false;
                        })
                        .catch((e) => {
                            console.log(e);
                            this.sendingFlag = false;
                        });
                }
            },
            messageColor: function (message) {
                if(this.auth_user.id === message.user.id){
                    return 'messageFromMe shadow-md';
                } else {
                    return 'message shadow-md';
                }
            },
            scrollToBottom: function () {
                setTimeout(() => {
                    this.chatBox = document.getElementById("chatBox");
                    this.chatBox.scrollTop = this.chatBox.scrollHeight;
                }, 100);
            },
            loadChatHistory: function () {
                axios.get('/api/chat/history/' + (this.messages[0].id))
                    .then((response) => {
                        this.messages = response.data;
                    })
                    .catch((e) => {
                        console.log(e);
                    });
            },
            close: function () {
                this.minimize = false;
            },
            open: function () {
                this.minimize = true;
                this.scrollToBottom();
            },
            typing: function () {
                window.Echo.private('chat')
                    .whisper('typing', {
                        name: this.auth_user.name
                    });
            },
            listenOnChatChanel: function () {
                if ('Notification' in window) {
                    Notification.requestPermission();
                }

                window.Echo.private('chat')
                    .listen('sendMessage', e => {
                        this.messages.push(e.message);
                        this.playNotificationSound();
                        if((this.auth_user.id) != (e.message.user.id)){
                            new Notification(e.message.text);
                        }
                    });

                window.Echo.private('chat')
                    .listenForWhisper('typing', e => {
                        this.activePeer = e;
                        if(this.typingTimer) clearTimeout(this.typingTimer);

                        this.typingTimer = setTimeout(() => {
                            this.activePeer = false;
                        }, 2000);
                    });
            },
            playNotificationSound: function () {
                this.audio.play();
            }
        }

    }
</script>