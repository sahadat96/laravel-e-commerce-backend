<script setup>
  
  import { reactive, onMounted } from 'vue';
  import { useAuthStore } from '@/store/auth';
  import { storeToRefs } from 'pinia';

  const { errors } = storeToRefs(useAuthStore());
  const authStore = useAuthStore();

  const formData = reactive({
    email: '',
    password:'',
  });

  onMounted(
     () => (errors.value = {})
  );

  const  handleLogin = async () => {
      await authStore.login(formData);
 }

    const getAssetPath = (filename) => {
  return `/frontend/assets/imgs/page/${filename}`
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
                                <div class="row">
                                    <div class="col-lg-6 pr-30 d-none d-lg-block">
                                        <img class="border-radius-15" :src="getAssetPath('login-1.png')" alt="" />
                                    </div>
                                    <div class="col-lg-6 col-md-8">
                                        <div class="login_wrap widget-taber-content background-white">
                                            <div class="padding_eight_all bg-white">
                                                <div class="heading_s1">
                                                    <h1 class="mb-5">Login</h1>
                                                    <p class="mb-30">Don't have an account? 
                                                        <router-link :to="{ name: 'registration' }">
                                                            <span class="lable">  Registration  </span>
                                                        </router-link>  
                                                    </p>
                                                </div>
                                                <form @submit.prevent="handleLogin()">
                                                    
                                                    <div class="form-group">
                                                        <input type="text" v-model="formData.email" placeholder=" Email *" required />
                                                          <p v-if=" errors.email ">{{ errors.email[0] }} </p>
                                                        <span class="text-danger"></span>
                                                        
                                                    </div>
                                                    <div class="form-group">
                                                        <input  type="password" v-model="formData.password" placeholder="Your password *" required />
                                                        <p v-if=" errors.password ">{{ errors.password[0] }} </p>                        
                                                        <span class="text-danger"></span>
                                                        
                                                    </div>
                                                    
                                                    <div class="login_footer form-group mb-50">
                                                        <div class="chek-form">
                                                        </div>
                                                        <a class="text-muted" href="#">Forgot password?</a>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-heading btn-block hover-up" name="login">Log in</button>
                                                    </div>
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