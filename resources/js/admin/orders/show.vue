<template>
  <div class="container" v-if="loaded">
    <h1><a :href="routes.ordersIndex"><i class="icon-chevron-left"></i></a> Orden {{ order.id }}</h1>
    <div v-if="order.processor">
      <h2 v-if="order.processor.info.first_name">{{ messages.processedBy }}: {{ order.processor.info.full_name }}</h2>
      <h2 v-else>{{ messages.processedBy }}: {{ order.processor.email }}</h2>
    </div>

    <div class="row">
      <div class="col-sm-9">
        <p>{{ messages.status }}: {{ order.status.description }}</p>
        <p>{{ messages.paymentStatus }}: {{ order.payment_status.description }}</p>
        <p>{{ messages.paymentType }}: {{ order.payment_type.description }}</p>

        <div v-if="order.address">
          <h5>Enviar a:</h5>
          <p>{{ order.address.to_string }}</p>
        </div>

        <div v-if="order.products.length > 0">
          <h5>Productos</h5>
          <div v-for="orderProduct in order.products">
            <p>{{ orderProduct.amount }} {{ orderProduct.product.info.name }}</p>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div v-if="order.can_be_processed">
          <a :href="routes.ordersProcess" class="btn btn-block btn-primary">{{ messages.processOrder }}</a>
        </div>
        <div v-if="order.can_be_shipped">
          <a :href="routes.ordersProcess" class="btn btn-block btn-primary">{{ messages.processOrder }}</a>
          <a :href="routes.ordersReadyToShip" class="btn btn-block btn-success">{{ messages.readyToShip }}</a>
          <a :href="routes.ordersShip" class="btn btn-block btn-success">{{ messages.shipOrder }}</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data: function(){
      return {
        loaded: false,
        order: {},
        routes: {
          ordersIndex: '',
          ordersProcess: '',
          ordersReadyToShip: '',
          ordersShip: '',
        },
        messages: {
          processedBy: '',
          status: '',
          paymentStatus: '',
          paymentType: '',
          processOrder: '',
          readyToShip: '',
          shipOrder: '',
        },
      }
    },
    mounted() {
      console.log('Component mounted.')
    },
    methods: {

    },
  }
</script>
