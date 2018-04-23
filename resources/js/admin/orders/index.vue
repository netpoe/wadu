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
          <th>{{ thead.products }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in orders">
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
          <td>
            <p v-for="orderProduct in order.products"><span v-if="orderProduct.product.info">{{ orderProduct.product.info.name }}</span></p>
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
        },
        orders: []
      }
    },
    mounted() {
      console.log('Component mounted.')
    }
  }
  </script>
