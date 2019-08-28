<template>
    <div class="row">
        <div class="col-4">
            <div class="card card-default">
                <div class="card-header">Orders</div>
                <div class="card-body p-0">
                    <ul class="list-unstyled" style="height: 300px; overflow-y: scroll" v-chat-scroll>
                        <li class="p-2" v-for="(order, index) in orders" :key="index">
                            <a href="#" v-on:click="open(order)">
                                <div class="alert alert-primary" role="alert">
                                    <strong>{{ order.description }} - R$ {{ order.value }}</strong>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card card-default">
                <div class="card-header">Order Details</div>
                <div class="card-body">
                    <h1>{{ this.selectedOrder.description }}</h1>
                    <h3 v-if="this.selectedOrder.value">R$ {{ this.selectedOrder.value }}</h3>
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
                orders: [],
                time: new Date().getTime(),
                selectedOrder: {}
            }
        },
        created(){
            this.fetchMessages();
            this.setOnline();

            window.addEventListener('beforeunload', this.beforeUnload);

            Echo.private('new-order.' + this.user.id)
                .listen('NewOrder', (event) => {
                    console.log(event);
                    this.orders.push(event.order);
                });
        },
        methods: {
            fetchMessages() {
                axios.get('fetch-orders?t=' + this.time).then(response => {
                    this.orders = response.data;
                });
            },
            open(order){
                this.selectedOrder = order;
            },
            setOnline(){
                axios.get('set-online?t=' + this.time);
            },
            beforeUnload(){
                axios.get('set-offline?t=' + this.time);
            }
        }
    }
</script>
