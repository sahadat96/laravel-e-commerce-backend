<script setup>
  import { reactive, ref, onMounted, computed } from 'vue';
  import { useRouter } from 'vue-router';
  import { useCartStore } from '@/store/cartManagment';
  import { useAuthStore } from '@/store/auth';
  import axios from 'axios';
  import { storeToRefs } from 'pinia';
  import Swal from "sweetalert2";

  
  const cartStore = useCartStore();
  const authStore = useAuthStore();
  const { user } = storeToRefs( authStore );
  const loading = ref(false);
  const userData = ref({});
  const divisions = ref([]);
  const districts = ref([]);
  const states = ref([]);
  const modifiedFields = ref(new Set());
  const message = ref('');
  const router =useRouter();
  
  const formData = reactive({
    name: '',
    phone: '',
    email: '',
    division_id: '',
    district_id: '',
    state_id: '',
    address: '',
    note: '',
    payment_method: 'cash_on_delivery'
  });

  const get_user = async () => {
    await authStore.getUser();
        userData.value =  user.value;
    }
    
  // Load initial data
  onMounted(async () => {
    await loadDivisions();
    await cartStore.fetchCartItems();
    await get_user();
  });

  // Input handlers
const handleInputChange = (field, value) => {
  formData[field] = value
  modifiedFields.value.add(field)
}

const getFinalFormData = () => {
  const finalData = { ...formData }
  
  Object.keys(finalData).forEach(field => {
    if (!modifiedFields.value.has(field) && user.value?.[field]) {
      finalData[field] = user.value[field]
    }
  })
  
  return finalData
}

  const placeOrder = async () => {
  try {
      loading.value = true
      const finalData = getFinalFormData()
      
       const response = await axios.post('/api/place-order', { ...finalData }, {
        headers: 
          {
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            }
      });

     message.value = response.data.message;

      if(response.data.stauts === true){
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: message.value,
            showConfirmButton: false,
            timer: 1700
        });
        
        router.push({ name:'user_account' });
      }

  } catch (error) {
    console.error('Order placement failed:', error)
    // Handle error
  } finally {
    loading.value = false
  }
}

  // Load location data
  async function loadDivisions() {
     try {
      const response = await axios.get('/api/divisions');
      divisions.value = response.data.division;
    } catch (error) {
      console.error('Error loading division:', error);
      divisions.value = [];
    }
  }
  
  async function loadDistricts() {
    if(formData.division_id) { 
        try {
        const response = await axios.get(`/api/districts/${formData.division_id}`);
        districts.value = response.data.distric;
      } catch (error) {
        console.error('Error loading districts:', error);
        districts.value = [];
      }  
    }
  }
  
  async function loadStates() {
    if(formData.district_id) { 
        try {
          const response = await axios.get(`/api/states/${formData.district_id}`)
          states.value = response.data.state
          } catch (error) {
            console.error('Error loading states:', error);
            states.value = [];
          }  
    }
    
  }
  
 </script>

<template>
    <main class="main">
      <div class="container mb-80 mt-50">
        <!-- Header Section -->
        <div class="row">
          <div class="col-lg-8 mb-40">
            <h1 class="heading-2 mb-10">Checkout</h1>
            <div class="d-flex justify-content-between">
              <h6 class="text-body">There are <span class="text-brand">{{ cartStore.cartCount }}</span> products in your cart</h6>
            </div>
          </div>
        </div>
  
        <div class="row">
          <!-- Billing Details Form -->
          <div class="col-lg-7">
            <form  @submit.prevent="placeOrder()">
              <h4 class="mb-30">Billing Details</h4>
              
              <!-- Personal Info -->
              <div class="row">
                <div class="form-group col-lg-6">
                  <input 
                    :value="user?.name"
                    @input="handleInputChange('name', $event.target.value)"
                    type="text" 
                    required 
                    placeholder="Full Name *"
                  >
                </div>
                <div class="form-group col-lg-6">
                  <input 
                    :value="user?.phone"
                    @input="handleInputChange('phone', $event.target.value)" 
                    type="text" 
                    required 
                    placeholder="Phone *"
                  >
                </div>
              </div>
  
              <!-- Location Selectors -->
              <div class="row shipping_calculator">
                <div class="form-group col-lg-6">
                  <select 
                     v-model="formData.division_id"
                    @change="loadDistricts()"
                    class="form-control"
                  >
                    <option value="">Select Division</option>
                    <option 
                      v-for="division in divisions" 
                      :key="division.id"
                      :value="division.id"
                    >
                      {{ division.division_name }}
                    </option>
                  </select>
                </div>
  
                <div class="form-group col-lg-6">
                  <select 
                    v-model="formData.district_id"
                    @change="loadStates()"
                    class="form-control"
                  >
                    <option value="">Select District</option>
                    <option 
                      v-for="district in districts" 
                      :key="district.id"
                      :value="district.id"
                    >
                      {{ district.distric_name }}
                    </option>
                  </select>
                </div>
  
                <div class="form-group col-lg-6">
                  <select 
                    v-model="formData.state_id"
                    class="form-control"
                  >
                    <option value="">Select State</option>
                    <option 
                      v-for="state in states" 
                      :key="state.id"
                      :value="state.id"
                    >
                      {{ state.state_name }}
                    </option>
                  </select>
                </div>
              </div>
  
              <!-- Additional Fields -->
              <div class="row">
                <div class="form-group col-lg-12">
                  <input 
                    :value="user?.email"
                    @input="handleInputChange('email', $event.target.value)"
                    type="email"
                    required
                    placeholder="Email *"
                  >
                </div>
                <div class="form-group col-lg-12">
                  <input 
                    :value="user?.address"
                    @input="handleInputChange('address', $event.target.value)"
                    type="text"
                    required
                    placeholder="address *"
                  >
                </div>
                <div class="form-group col-lg-12">
                  <textarea 
                    v-model="formData.note"
                    rows="5"
                    required
                    placeholder="Order notes"
                  ></textarea>
                </div>
              </div>
            </form>
          </div>
  
          <!-- Order Summary -->
          <div class="col-lg-5">
            <div class="border p-40 cart-totals ml-30 mb-50">
              <h4>Order Summary</h4><br>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr v-for="item in cartStore.cartItems" :key="item.id">
                      <td>
                        <img :src="`/uploads/product/product_photo/${item.image}`" :alt="item.product_name" class="img-sm">
                        {{ item.product_name }}
                        <span>x {{ item.qnt }} </span>
                      </td>
                      <td>৳{{  item.price * item.qnt }}</td>
                    </tr>
                    <tr>
                      <td>Subtotal:</td>
                      <td>৳{{  cartStore.totalPrice }} </td>
                    </tr>
                    <tr>
                      <td>Delivery:</td>
                      <td>৳{{ cartStore.total_deliveryCharge }}</td>
                    </tr>
                    <tr>
                      <td><strong>Total:</strong></td>
                      <td><strong><h5 class="text-brand">৳{{ cartStore.grand_total }}</h5></strong></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Payment Options -->
            <div class="payment ml-30">
              <h4>Payment Method</h4>
              <div class="payment_option">
                <div class="form-check">
                  <input 
                    v-model="formData.payment_method"
                    type="radio"
                    value="cash_on_delivery"
                    id="cod"
                  >
                  <label for="cod">Cash on Delivery</label>
                </div>
                <div class="form-check">
                  <input 
                    v-model="formData.payment_method"
                    type="radio"
                    value="online_payment"
                    id="online"
                  >
                  <label for="online">Online Payment</label>
                </div>
              </div>
  
              <button   type="submit" class="btn btn-fill-out btn-block mt-30" :disabled="loading" @click="placeOrder()" >
                {{ loading ? 'Processing...' : 'Place an Order' }}
              <i class="fi-rs-sign-out ml-15"></i></button>
            </div>
          </div>
        </div>
      </div>
    </main>
  </template>
  
  
  <style scoped>
  .img-sm {
    width: 60px;
    height: 60px;
    object-fit: cover;
  }
  
  .form-group {
    margin-bottom: 1rem;
  }
  
  .payment_option {
    margin: 1rem 0;
  }

  </style>
  