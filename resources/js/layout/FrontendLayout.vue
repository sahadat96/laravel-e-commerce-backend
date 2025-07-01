<script setup>
 import { computed } from 'vue';
 import { RouterView, useRoute } from 'vue-router'
 import CategorySidebar from '../components/templateParts/frontend/category_sidebar.vue';
 import Header from '../components/templateParts/frontend/header.vue';
 import Slider from '../components/templateParts/frontend/slider.vue';
 import FeatureProduct from '../components/templateParts/frontend/featureProduct.vue';
 import Footer from '../components/templateParts/frontend/footer.vue';


const route = useRoute()

// Pages that should not show slider and featured products
const EXCLUDED_ROUTES = ['category', 'subcategory', 'productdetailspage', 'login', 'registration', 'viewcart', 'checkout', 'user_account', 'order_details']

const isHomePage = computed(() => !EXCLUDED_ROUTES.includes(route.name))

// Layout type based on route
const layoutType = computed(() => {
  switch (route.name) {
    case 'login':
    case 'registration':
      return 'auth-layout'
    default:
      return 'default-layout'
  }
})


//  // Create a computed property to check if we're on the home route
// const showFeatureProduct = computed(() => {
//     return !['category', 'subcategory', 'productdetailspage'].includes(route.name);
// });


</script>
<template>

 <div :class="layoutType">
    <!-- Auth Layout -->
    <template v-if="layoutType === 'auth-layout'">
     <Header></Header>
      <main class="auth-main">
        <RouterView />
      </main>
      <Footer></Footer>
    </template>

    <!-- Default E-commerce Layout -->
    <template v-else>
        <Header></Header>
      <main class="main">
        <div class="container mb-30">
          <div class="row flex-row-reverse">
            <!-- Main Content Area -->
            <div class="col-lg-4-5">
              <!-- Home Page Components -->
              <template v-if="isHomePage">
                <Slider />
                <FeatureProduct />
              </template>
              
              <!-- Dynamic Route Content -->
              <RouterView v-slot="{ Component }">
                <component :is="Component" />
              </RouterView>
            </div>

            <!-- Sidebar -->
            <CategorySidebar />
          </div>
        </div>
      </main>
      <Footer></Footer>
    </template>
  </div>
 
 <!-- <Header></Header>
      <main class="main">
          <div class="container mb-30">
              <div class="row flex-row-reverse">
                  <div class="col-lg-4-5">

                    <Slider v-if="showFeatureProduct" />
                    <FeatureProduct v-if="showFeatureProduct" />
                    <RouterView v-slot="{ Component }">
                        <component :is="Component" />
                    </RouterView>

                    </div>
               <CategorySidebar />
            </div>
          </div>
        
      </main>

      <Footer></Footer>
      -->
</template> 

<style >
/* Import CDN CSS using @import */
    @import url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css');
    @import url('https://fonts.bunny.net/css?family=lato:400,700,900|quicksand:400,500,600,700');
    @import url('https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css');
    
</style>
