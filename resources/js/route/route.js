import { createRouter, createWebHistory } from "vue-router";
import categoryProducts from  '../components/templateParts/frontend/CategoryProducts.vue';
import productDetailsPage from "../components/page/frontend/ProductDetailsPage.vue";
import login from '../components/users/login.vue';
import registration from '../components/users/register.vue'
import viewcart from "../components/page/frontend/viewcart.vue";
import checkout from "../components/page/frontend/checkOut.vue";
import account from "../components/users/user_account.vue";
import orderDetails from "../components/page/frontend/orderDetails.vue";

const routes = [

        {
            path:'/category/:slug', 
            name: 'category',
            component: categoryProducts
        },
        {
            path:'/subcategory/:slug', 
            name: 'subcategory',
            component: categoryProducts

        },
        {
            path:'/productdetails/:id',
            name: 'productdetailspage',
            component: productDetailsPage
        },
        {
            path: '/login', 
            name: 'login',
            component: login 
        },
        {
            path:'/registration',
            name:'registration',
            component: registration
        },
        {
            path:'/viewcart',
            name:'viewcart',
            component: viewcart
        },
        {
            path:'/checkout',
            name:'checkout',
            component: checkout
        },
        {
            path:'/user_account',
            name:'user_account',
            component: account,
        },
        {
            path: '/order/details/:orderId',
            name:'order_details',
            component:orderDetails,
        }



    
]


const router = createRouter({
    history: createWebHistory(),
    routes,
     scrollBehavior(to, from, savedPosition) {
    return savedPosition || { top: 0 }
  }
})

export default router;

