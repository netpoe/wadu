<template>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>{{ thead.user }}</th>
          <th>{{ thead.status }}</th>
          <th>{{ thead.paymentType }}</th>
          <th>{{ thead.paymentStatus }}</th>
          <th>{{ thead.address }}</th>
          <th>{{ thead.processedBy }}</th>
          <td></td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in orders" class="order-row" :class="classBindings(order)">
          <td>{{ order.id }}</td>
          <td>{{ order.user.contact.whatsapp }}</td>
          <td>{{ order.status.description }}</td>
          <td><span v-if="order.payment_type">{{ order.payment_type.description }}</span></td>
          <td><span v-if="order.payment_status">{{ order.payment_status.description }}</span></td>
          <td>
            <span v-if="order.address">
              {{order.address.street}}, {{order.address.interior_number}}. {{order.address.city}}, {{order.address.state.name}} - {{order.address.country.name}}
            </span>
          </td>
          <td><span v-if="order.processed_by_user_id">{{ order.processor.info.full_name }}</span></td>
          <td>
            <a :href="order.show_route" class="btn btn-sm btn-light">{{ tbody.seeOrder }}</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
  export default {
    data: function(){
      return {
        thead: {
          user: '',
          status: '',
          paymentType: '',
          paymentStatus: '',
          address: '',
          products: '',
          processedBy: '',
        },
        tbody: {
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
