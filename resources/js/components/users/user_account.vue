<script setup>
import axios from 'axios';
import { useRouter } from 'vue-router';
import { onMounted, ref } from 'vue';
import { useAuthStore } from '@/store/auth';
import { storeToRefs } from 'pinia';

const orders = ref({});
const router = useRouter();
const authStore = useAuthStore();
const { user } = storeToRefs( authStore );
const userData = ref([]);

const get_user = async () => {
   await authStore.getUser();
   userData.value = user.value;
}

onMounted(() => {
   get_order();
   get_user();
});

 async function get_order(){
    
      const token = localStorage.getItem('token')

      try {
        const response = await axios.get('/api/get_order', {
        headers: {
          'Authorization': `Bearer ${token}`,
          'Accept': 'application/json'
         }
      });

      orders.value = response.data.get_order;

  } catch (error) {
    console.error('Order placement failed:', error)
  }
 }

const getStatusBadgeClass = (status) => {
  const statusClasses = {
    pending: 'bg-warning',
    confirm: 'bg-info',
    processing: 'bg-danger',
    shiped: 'bg-success',
    delivered: 'bg-success',
    received: 'bg-success'
  };
  return `badge rounded-pill ${statusClasses[status] || 'bg-secondary'}`;
};

const viewOrderDetails = (orderId) => {
//   router.push(`/order/details/${orderId}`);
   router.push({name:'order_details', params: { orderId: orderId } });
};

//Log Out
const logOut = () => {
    authStore.logout();
}

const downloadInvoice = async (orderId) => {
  try {
    const response = await axios.get(`/api/order/invoice/${orderId}`, {
      responseType: 'blob',
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      }
    });
    
    const url = window.URL.createObjectURL(new Blob([response.data]));
    const link = document.createElement('a');
    link.href = url;
    link.setAttribute('download', `invoice-${orderId}.pdf`);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  } catch (error) {
    console.error('Error downloading invoice:', error);
  }
};


 </script>

<template>
  <main class="main pages">
     
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                                    <a class="nav-link" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false">
                                                        <i class="bi bi-sliders me-2"></i>Dashboard
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link active" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false">
                                                        <i class="bi bi-bag me-2"></i>Orders
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true">
                                                        <i class="bi bi-geo-alt me-2"></i>My Address
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true">
                                                        <i class="bi bi-person me-2"></i>Account details
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" @click="authStore.logout()">
                                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                                    </a>
                                                </li>
                                        </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content account dashboard-content pl-50">
                                    <div class="tab-pane fade" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">User Name: {{ userData.name }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <p>Wellcome To Paikari Mela
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="tab-pane fade active show" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                            <div class="card">
                                            <div class="card-header">
                                            <h3 class="mb-0">Your Orders</h3>
                                            </div>
                                            <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                <thead>
                                                    <tr>
                                                    <th>Sl</th>
                                                    <th>Order No</th>
                                                    <th>Date</th>
                                                    <th>Total Amount</th>
                                                    <th>Payment</th>
                                                    <th>Invoice No</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(order, index) in orders" :key="order.id">
                                                            <td data-label="Sl">{{ index + 1 }}</td>
                                                            <td data-label="Order No">{{ order.order_number }}</td>
                                                            <td data-label="Date">{{ order.order_date }}</td>
                                                            <td data-label="Total Amount">৳ {{ order.total_amount }}</td>
                                                            <td data-label="Payment">{{ order.payment_type }}</td>
                                                            <td data-label="Invoice No">{{ order.invoice_no }}</td>
                                                            <td data-label="Status">
                                                                <span :class="getStatusBadgeClass(order.status)">
                                                                    {{ order.status.charAt(0).toUpperCase() + order.status.slice(1) }}
                                                                </span>
                                                            </td>
                                                            <td data-label="Actions">
                                                                <button class="btn-sm btn-success" @click="viewOrderDetails(order.id)">
                                                                    View
                                                                </button>
                                                            </td>
                                                        </tr>
                                                </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">Orders tracking</h3>
                                            </div>
                                            <div class="card-body contact-from-area">
                                                <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <form class="contact-form-style mt-30 mb-50" action="#" method="post">
                                                            <div class="input-style mb-20">
                                                                <label>Order ID</label>
                                                                <input name="order-id" placeholder="Found in your order confirmation email" type="text">
                                                            </div>
                                                            <div class="input-style mb-20">
                                                                <label>Billing email</label>
                                                                <input name="billing-email" placeholder="Email you used during checkout" type="email">
                                                            </div>
                                                            <button class="submit submit-auto-width" type="submit">Track</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card mb-3 mb-lg-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">Shipping Address</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <address>
                                                          {{ userData.address }}
                                                        </address>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade " id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Account Details</h5>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td class="fw-bold">Name</td>
                                                            <td>{{ userData.name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Email Address</td>
                                                            <td>{{ userData.email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Phone Number</td>
                                                            <td>{{ userData.phone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Address</td>
                                                            <td>{{ userData.address }}</td>
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
            </div>
        </div>
    </main>
</template>
  
<style scoped>
    @media only screen and (max-width: 767px) {
    .table-responsive {
        overflow-x: hidden;
    }

    .table thead {
        display: none;
    }

    .table tbody tr {
        display: block;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
    }

    .table tbody tr td {
        display: block;
        text-align: right;
        padding: 8px;
        position: relative;
        border: none;
    }

    .table tbody tr td:before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 50%;
        padding-left: 8px;
        font-weight: 600;
        text-align: left;
    }

    /* Specific styling for action buttons */
    .table td:last-child {
        text-align: center;
    }

    .table .btn-sm {
        margin: 5px;
        min-width: 100px;
    }

    /* Status badge adjustments */
    .table td span[class*="badge"] {
        display: inline-block;
        width: auto;
        min-width: 100px;
    }
}
</style>
  