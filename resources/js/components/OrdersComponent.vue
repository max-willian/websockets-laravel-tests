<template>
    <div class="row">
        <div class="col-8">
            <div class="card card-default">
                <div class="card-header">Orders</div>
                <div class="card-body p-0">
                    <ul class="list-unstyled" style="height: 300px; overflow-y: scroll" v-chat-scroll>
                        <li class="p-2" v-for="(message, index) in messages" :key="index">
                            <strong>{{ message.user.name }}</strong>
                            {{ message.message }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card card-default">
                <div class="card-header">Active Users</div>
                <div class="card-body">
                    <ul>
                        <li class="py-2" v-for="(user, index) in users" :key="index">
                            {{ user.name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                messages: [],
                newMessage: '',
                users: []
            }
        },
        created(){
            this.fetchMessages();

            window.addEventListener('beforeunload', this.beforeUnload);

            Echo.private('new-order.' + this.user.id)
                .listen('NewOrder', (event) => {
                    console.log(event);
                    // this.messages.push(event.message);
                });
        },
        methods: {
            fetchMessages() {
                axios.get('messages').then(response => {
                    this.messages = response.data;
                });
            },
            beforeUnload(){
                alert('Adeus');
                axios.post('chat/webhook', { user: this.user });
                Echo.leaveChannel('presence-chat');
            }
        }
    }
</script>
