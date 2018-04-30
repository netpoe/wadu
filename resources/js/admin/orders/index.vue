<template>
  <div class="orders-index">
    <article class="order" v-for="order in orders" :class="classBindings(order)">
      <div class="row no-gutters">
        <div class="col-8 left">
          <div class="top">
            <a :href="order.show_route">
              <div class="id">
                <small>{{ messages.order }}</small>
                <span>{{ order.id }}</span>
              </div>
              <div class="status">
                <small>{{ messages.status }}</small>
                <span>{{ order.status.description }}</span>
              </div>
              <div class="payment-status">
                <small>{{ messages.paymentStatus }}</small>
                <span v-if="order.payment_status">{{ order.payment_status.description }}</span>
              </div>
              <div class="payment-type">
                <small>{{ messages.paymentType }}</small>
                <span v-if="order.payment_type">{{ order.payment_type.description }}</span>
              </div>
            </a>
          </div>
          <div class="bottom">
            <div class="user">
              <small>{{ messages.user }}</small>
              <a href="#">{{ order.user.contact.whatsapp }}</a>
            </div>
          </div>
        </div>
        <div class="col-4 right">
          <div class="top">
            <div class="processed-by">
              <small>{{ messages.processedBy }}</small>
              <span v-if="order.processed_by_user_id">{{ order.processor.info.full_name }}</span>
            </div>
          </div>
          <div class="bottom">
            <div class="actions">
              <nav>
                <a :href="order.show_route" class="btn btn-sm btn-dark">{{ messages.seeOrder }}</a>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </article>
  </div>
</template>

<script>
  export default {
    data: function(){
      return {
        messages: {
          order: '',
          actions: '',
          user: '',
          status: '',
          paymentType: '',
          paymentStatus: '',
          address: '',
          products: '',
          processedBy: '',
          seeOrder: '',
          processOrder: '',
          shipOrder: '',
        },
        orderStatus: {},
        orders: []
      }
    },
    mounted() {
      console.log('Component mounted.')
    },
    methods: {
      classBindings(order){
        var classes = {};

        var paymentStatus = order.payment_status ? order.payment_status.value : '';
        classes['payment-status-' + paymentStatus] = order.payment_status != null;

        var paymentType = order.payment_type ? order.payment_type.value : '';
        classes['payment-type-' + paymentType] = order.payment_type != null;

        classes[`${paymentType}-${paymentStatus}`] = order.payment_type && order.payment_status;

        return classes;
      },
    },
  }
</script>
