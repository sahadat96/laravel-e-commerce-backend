<script setup>

 import { useRoute, useRouter } from 'vue-router';
 import { computed, onMounted, ref } from 'vue';
 import { useAuthStore } from '@/store/auth';
 import { useCartStore } from '../../../store/cartManagment';
 import { storeToRefs } from 'pinia';
 import axios from 'axios';

 const route = useRoute();
 const router = useRouter()
 const authStore = useAuthStore();
 const isLoginRoute = computed(() => route.name ==='login');
 const isRegisterRoute = computed(() => route.name ==='registration');
 const isAuthenticated = computed(() => authStore.isAuthenticated);
 const categories = ref([]);    

 const carstore = useCartStore();
 const { cartItems, calculatedTotalPrice  } = storeToRefs(useCartStore());

 const processCheckout = () => {
    router.push({name:'checkout'});
  }

 const getAssetPath = (filename) => {
  return `/frontend/assets/imgs/theme/icons/${filename}`
}

const logOut = async () => {
    authStore.logout();
    authStore.setTokenExpirationTimer();
}

onMounted( async () => {
  await carstore.fetchCartItems();
  fetchCategories()

});

//fetch category 
const fetchCategories = async () => {
    try {
        const response = await axios.get('/api/categories')
        categories.value = response.data
    } catch (error) {
        console.error('Error fetching categories:', error)
    }
};


const navigateToSubCategory = (subCatSlug) => {
    router.push({name: 'subcategory', params: { slug: subCatSlug }}); // Changed 'subCategory' to 'subcategory'
};


// remove cart items
const removeCart = async (cartId) => {
  await  carstore.removeCartItem(cartId);
}

const count = computed(() => carstore.cartCount);

const viewCart = () => {
    router.push({ name: 'viewcart' });
}

const myAccount = () => {
    router.push({name:'user_account'});
}


//for mobile header

const logo = ref('/frontend/assets/imgs/theme/logo.jpg')


const isOpen = ref(false)
const openMenus = ref([])

const toggleHeader = () => {
  isOpen.value = !isOpen.value
}

const toggleSubMenu = (categoryId) => {
  if (openMenus.value.includes(categoryId)) {
    openMenus.value = openMenus.value.filter(id => id !== categoryId)
  } else {
    openMenus.value.push(categoryId)
  }
}

const Home = () => {
    router.push('/');
}

</script>

<template>

   <header class="header-area header-style-1 header-height-2">


                                <div class="mobile-header-active" :class="{ 'header-show': isOpen }">

                                <div class="mobile-header-wrapper-inner">
                                <!-- Header Logo Section -->
                                <div class="mobile-header-top">
                                    <div class="mobile-header-logo">
                                    <router-link to="/" @click="toggleHeader()">
                                        <img :src="logo" alt="logo" />
                                    </router-link>
                                    </div>
                                  
                                </div>

                                <!-- Mobile Content Area -->
                                <div class="mobile-header-content">
                                    <button  :class="['header-toggle', 'd-xl-none', isOpen ? 'bi-x' : 'bi-list']"  @click="toggleHeader()">
                                    </button>
                                    <nav class="mobile-nav">
                                        <ul class="mobile-menu">
                                            <li>
                                              <router-link to="/" @click="toggleHeader()" >Home</router-link>
                                            </li>
                                            
                                            <li v-for="category in categories" :key="category.id">
                                            <div class="menu-item" @click="toggleSubMenu(category.id)">
                                                <span>{{ category.cat_name }}</span>
                                                <i :class="['bi', openMenus.includes(category.id) ? 'bi-chevron-down' : 'bi-chevron-right']"></i>
                                            </div>
                                             
                                            <transition name="slide">
                                                <ul v-if="openMenus.includes(category.id)" class="submenu">
                                                <li v-for="subCat in category.get_sub_category" :key="subCat.id">
                                                    <a @click="() => { navigateToSubCategory(subCat.subcat_slug); toggleHeader(); }">
                                                      {{ subCat.subcat_name }}
                                                    </a>
                                                </li>
                                                </ul>
                                            </transition>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                </div>
                            </div>


        <div class="mobile-promotion" >
            <span @click="Home()">Wellcome To Paikari Mela </span>
        </div>
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">    
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                            <ul>
                                <li><a href="">About Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                                <li>Need help? Call Us: <strong class="text-brand"> + 1800 900</strong></li>
                                <li>
                                    <a class="language-dropdown-active" href="#">English </a>
                                    <ul class="language-dropdown">
                                      
                                    </ul>
                                </li>
                                <li>
                                    <a class="language-dropdown-active" href="#">BDT </a>
                                    <ul class="language-dropdown">
                                     
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href=""><img :src="logo" alt="logo" /></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form action="#">
                                <select class="select-active">
                                    <option>All Categories</option>
                                    
                                </select>
                                <input type="text" placeholder="Search for items..." />
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                           
                                <div v-if="isAuthenticated" class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="">
                                        <img alt="" :src="getAssetPath('icon-cart.svg')" />
                                        <span class="pro-count blue totalCount"> {{ count }}</span>
                                    </a>
                                    <a href=""><span class="lable">Cart</span></a>
                                    <div  class="cart-dropdown-wrap cart-dropdown-hm2"  >
                                        <ul >
                                            <li v-for="cartItem in cartItems" :key="cartItem.id">
                                                <div class="shopping-cart-img">
                                                    <a href="shop-product-right.html"><img alt="Nest" :src="`/uploads/product/product_photo/${cartItem.image}`" /></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="shop-product-right.html">{{cartItem.product_name}}</a></h4>
                                                    <h4><span>{{  cartItem.qnt  }} × </span>৳{{cartItem.price * cartItem.qnt}}</h4>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a @click="removeCart(cartItem.id)" href="#">
                                                        <button type="button" class="btn-close btn-close-sm" aria-label="Close"></button>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul> <br>
                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4>Total <span class="totalAmount"> ৳ {{ calculatedTotalPrice }}</span>  </h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <a @click="viewCart()" class="outline">View cart</a>
                                                <a @click="processCheckout()">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div v-if="!isAuthenticated"  class="header-action-icon-2" >      
                                       <router-link v-if="!isLoginRoute" :to="{ name: 'login' }">
                                          <span class="lable">Login  </span>
                                        </router-link>  
                                         
                                        <router-link v-if="!isRegisterRoute" :to="{ name: 'registration' }">
                                          <span class="lable">  Registration  </span>
                                       </router-link>  
                                    </div>
                             
                                  <div class="header-action-icon-2" v-if="isAuthenticated">
                                        <a href="#">
                                            <img class="svgInject" alt="Nest" :src="getAssetPath('icon-user.svg')"  />
                                        </a>
                                        <a href="#"><span class="lable ml-0">Account</span></a>
                                        <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                            <ul>
                                                <li><a @click="myAccount()"><i class="bi bi-person me-2"></i>My Account</a></li>
                                                <li><a @click="myAccount()" ><i class="bi bi-bag me-2"></i>My Order</a></li>
                                               <form @submit.prevent="logOut()"> 
                                                 <button><a  ><i class="bi bi-box-arrow-right me-2"></i>Sign out</a></button>
                                               </form>
                                            </ul>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="#"><img :src="getAssetPath('logo.jpg')"  alt="logo" /></a>
                    </div>
                                       
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categories-button-active" >
                                <span class="fi-rs-apps"></span> Paikarii Mela
                            </a>
                            
                            <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                                <div class="d-flex categori-dropdown-inner">
                                    <ul>
                                  
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="" alt="" /></a>
                                        </li>
                                 
                                    </ul>
                                    <ul class="end">
                                        <li>
                                            <a href="shop-grid-right.html"> <img :src="getAssetPath('category-6.svg')" alt="" />Wines & Drinks</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="more_slide_open" style="display: none">
                                    <div class="d-flex categori-dropdown-inner">
                                        <ul>
                                            <li>
                                                <a href="shop-grid-right.html"> <img :src="getAssetPath('icon-1.svg')" alt="" />Milks and Dairies</a>
                                            </li>
                                            
                                        </ul>
                                        <ul class="end">
                                            <li>
                                                <a href="shop-grid-right.html"> <img :src="getAssetPath('icon-3.svg')"  alt="" />Wines & Drinks</a>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </div>
                                <div class="more_categories"><span class="icon"></span> <span class="heading-sm-1">Show more...</span></div>
                            </div>
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                            <nav>
                                <ul>
                                    <li>
                                        <router-link to="/" rel="nofollow">Home</router-link>
                                    </li>
                                    <li>
                                        <a href="page-about.html">About</a>
                                    </li>
                                    <li>
                                        <a href="shop-grid-right.html">Shop <i class="bi bi-chevron-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="shop-grid-right.html">Shop Grid – Right Sidebar</a></li>
                                            
                                            <li>
                                                <a href="#">Single Product <i class="bi bi-chevron-right"></i></a>
                                                <ul class="level-menu">
                                                    <li><a href="shop-product-right.html">Product – Right Sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="shop-filter.html">Shop – Filter</a>
                                            </li>
                                           
                                            <li>
                                                <a href="#">Shop Invoice<i class="bi bi-chevron-right"></i></a>
                                                <ul class="level-menu">
                                                    <li><a href="shop-invoice-1.html">Shop Invoice 1</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    
                     <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white"  @click="toggleHeader">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                     </div>

                        <div class="mobile-search search-style-3 mobile-header-border d-block d-lg-none ">
                            <form action="#">
                                <input type="text" placeholder="Search for items…" />
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div>


                         <div class="header-action-right d-block d-lg-none" >
                            
                                <div v-if="!isAuthenticated"  class="header-action-icon-2" >      
                                       <router-link v-if="!isLoginRoute" :to="{ name: 'login' }">
                                          <span class="lable">Login  </span>
                                        </router-link>  
                                         
                                        <router-link v-if="!isRegisterRoute" :to="{ name: 'registration' }">
                                          <span class="lable">  Registration  </span>
                                       </router-link>  
                               </div>
                             
                                <div class="header-action-2" v-if="isAuthenticated">
                                    
                                    <div class="header-action-icon-2">
                                        <a class="mini-cart-icon">
                                            <img :src="getAssetPath('icon-cart.svg')"  />
                                            <span class="pro-count white totalCount"> {{ count }}</span>
                                        </a>


                                        <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                            <ul >
                                            <li v-for="cartItem in cartItems" :key="cartItem.id">
                                                <div class="shopping-cart-img">
                                                    <a href="shop-product-right.html"><img alt="Nest" :src="`/uploads/product/product_photo/${cartItem.image}`" /></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="shop-product-right.html">{{cartItem.product_name}}</a></h4>
                                                    <h4><span>{{  cartItem.qnt  }} × </span>৳{{cartItem.price * cartItem.qnt}}</h4>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a @click="removeCart(cartItem.id)" href="#">
                                                        <button type="button" class="btn-close btn-close-sm" aria-label="Close"></button>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul> <br>
                                            <div class="shopping-cart-footer">
                                                <div class="shopping-cart-total">
                                                    <h4>Total <span class="totalAmount"> ৳ {{ calculatedTotalPrice }}</span>  </h4>
                                                </div>
                                                <div class="shopping-cart-button">
                                                    <a @click="viewCart()" class="outline">View cart</a>
                                                    <a @click="processCheckout()">Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="header-action-icon-2">
                                                <a href="#">
                                                    <img class="svgInject" alt="" :src="getAssetPath('icon-user.svg')"  />
                                                </a>
                                                <a href="#"><span class="lable ml-0">Account</span></a>
                                                <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                                    <ul>
                                                        <li><a @click="myAccount()"><i class="bi bi-person me-2"></i>My Account</a></li>
                                                            <li><a @click="myAccount()" ><i class="bi bi-bag me-2"></i>My Order</a></li>
                                                        <form @submit.prevent="logOut()"> 
                                                            <button><a  ><i class="bi bi-box-arrow-right me-2"></i>Sign out</a></button>
                                                        </form>
                                                    </ul>
                                                </div>
                                    </div>
                          </div>
                     
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<style scoped>
.mobile-menu {
  list-style: none;
  padding: 0;
  margin: 0;
}

.menu-item {
  display: flex;
  justify-content: space-between;
  padding: 15px;
  cursor: pointer;
  border-bottom: 1px solid #eee;
}

.submenu {
  background: #f8f8f8;
  padding-left: 20px;
}

.arrow {
  border: solid #333;
  border-width: 0 2px 2px 0;
  display: inline-block;
  padding: 3px;
  transform: rotate(45deg);
  transition: transform 0.3s;
}

.arrow.active {
  transform: rotate(-135deg);
}

.slide-enter-active, .slide-leave-active {
  transition: all 0.3s ease;
}

.slide-enter-from, .slide-leave-to {
  transform: translateY(-20px);
  opacity: 0;
}

.mobile-social {
  padding: 20px;
  border-top: 1px solid #eee;
}

.social-icons {
  display: flex;
  gap: 15px;
  margin-top: 10px;
}

.social-icons img {
  width: 24px;
  height: 24px;
}


/* mobile header */

.mobile-header-active {
  display: none;
  transition: all 0.3s ease;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: white;
  z-index: 1000;
  transform: translateX(-100%);
  transition: transform 0.3s ease;
}

.header-show {
  display: block;
}

.slide-enter-active,
.slide-leave-active {
  transition: all 0.3s ease;
}

.slide-enter-from,
.slide-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}


.header-show {
  transform: translateX(0);
}

@media (max-width: 1199px) {
  .mobile-header-active {
    display: block;
  }
}


.header-toggle {
  position: absolute;
  top: 20px;
  right: 20px;
  width: 35px;
  height: 35px;
  border: none;
  background: transparent;
  cursor: pointer;
  font-size: 24px;
  color: #333;
  transition: all 0.3s ease;
}

.header-toggle:hover {
  transform: scale(1.1);
}

.bi-x {
  font-size: 28px;
}

.bi-list {
  font-size: 26px;
}
</style>