<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios';

const route = useRoute();
const order = ref({});
const orderItems = ref([]);

const fetchOrderDetails = async () => {
    const token = localStorage.getItem('token');
   try {
        const response = await axios.get(`/api/getOrderDetails/${route.params.orderId}`, {
            headers:{
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        orderItems.value = response.data.orderItem;
        order.value = response.data.order

  } catch (error) {
   console.error('Error fetching order details:', error)
  }

   
}

onMounted(() => {
  fetchOrderDetails()
})

</script>

<template>
       <section class="product-tabs section-padding position-relative">
    <div class="page-content py-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="row">
              <div class="col-12 col-md-9">
                <div class="dashboard-content px-3 px-md-5">
                  <div class="row">
                    <!-- Shipping Details Card -->
                    <div class="col-12 col-md-6 mb-4">
                      <div class="card h-100">
                        <div class="card-header bg-light fw-bold">
                          <h4 class="mb-0">Shipping Details</h4>
                        </div>
                        <div class="card-body bg-light">
                          <table class="table table-borderless">
                            <tbody>
                              <tr>
                                <th>Shipping Address</th>
                                <td> {{ order.adress }}</td>
                              </tr>
                              <tr>
                                <th>Shipping Phone:</th>
                                <td>{{ order.phone }}</td>
                              </tr>
                              <!-- Add other shipping details similarly -->
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                    <!-- Invoice Card -->
                    <div class="col-12 col-md-6 mb-4">
                      <div class="card h-100">
                        <div class="card-header bg-light fw-bold">
                          <h4 class="mb-0">
                             <span class="text-danger">Invoice: {{ order.invoice_no }}</span> 
                          </h4>
                        </div>
                        <div class="card-body bg-light">
                          <table class="table table-borderless">
                            <tbody>
                              <tr>
                                <th>Name:</th>
                                <td>{{ order.name }}</td>
                              </tr>
                              <!-- Add other invoice details similarly -->
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Order Items Table -->
                  <div class="table-responsive mt-4">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Image</th>
                          <th>Product Name</th>
                          <th>Product Code</th>
                          <th>Color</th>
                          <th>Size</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Sub Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="item in orderItems" :key="item.id">
                          <td>
                           <img :src="`/uploads/product/product_photo/${item?.img}`" class="img-fluid" style="width: 80px; height: 80px;" > 
                          </td> 
                            <td>{{ item?.get_products?.product_name }}</td>
                           <td>{{ item?.get_products?.product_code }}</td>
                           <td>{{ item?.color || '....' }}</td> 
                           <td>{{ item?.size || '....' }}</td>
                           <td>{{ item.quantity }}</td> 
                          <td> 
                             ৳ {{ item.price }}<br>
                          </td>   
                          <td> 
                              ৳ {{ item.price * item.quantity }}
                          </td> 
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      </section>
</template>

<style scoped>
.table th {
  font-weight: 600;
}

.badge {
  padding: 0.5em 1em;
}

@media (max-width: 768px) {
  .dashboard-content {
    padding: 1rem !important;
  }
  
  .table-responsive {
    font-size: 0.9rem;
  }
}
</style>