<script setup>
   import { reactive, onMounted } from 'vue';
   import { useAuthStore } from '@/store/auth';
   import { storeToRefs } from 'pinia';

  const { errors } = storeToRefs(useAuthStore());
  const { message } = storeToRefs(useAuthStore());
  const authStore = useAuthStore();

  const formData = reactive({
    email: '',
    phone: '',
    address: '',
    password:'',
    password_confirmation:''

  });

  onMounted(
     () => (errors.value = {}),
     () => (message.value = {})
  );

  const  handleRegistration = async () => {
      await authStore.registration(formData);
 }

</script>
<template>

    <main class="main">
                <!--End header-->
            <main class="main pages">
             
                <div class="page-content pt-150 pb-150">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                                    <div class="row" >
                                        <div class="col-lg-6 col-md-8">
                                            <div class="login_wrap widget-taber-content background-white">
                                                <div class="padding_eight_all bg-white">
                                                    <div class="heading_s1">
                                                        <h1 class="mb-5">Create an Account</h1>
                                                        <p class="mb-30">Already have an account?
                                                            <router-link :to="{ name: 'login' }">
                                                                <span class="lable">Login </span>
                                                                </router-link>  
                                                        </p>
                                                    </div>
                                                    <form @submit.prevent="handleRegistration()">
                                                       
                                                        <div class="form-group">
                                                            <input type="text" required v-model="formData.name" placeholder="Full Name" />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" required v-model="formData.phone" placeholder="Phone Number" />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" required v-model="formData.email" placeholder="Email" />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" required v-model="formData.address" placeholder="Address" />
                                                        </div>
                                                        <div class="form-group">
                                                            <input required type="password" v-model="formData.password" placeholder="Password" />
                                                        </div>
                                                        <div class="form-group">
                                                            <input required type="password" v-model="formData.password_confirmation" placeholder="Confirm password" />
                                                        </div>
                                                
                                                        <div class="form-group mb-30">
                                                            <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" >Submit &amp; Register</button>
                                                        </div>
                                                        <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes</p>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
      </main>


</template>