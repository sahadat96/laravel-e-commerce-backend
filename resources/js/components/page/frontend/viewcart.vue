<script setup>
    import { useRoute, useRouter } from 'vue-router';
    import { computed, onMounted } from 'vue';
    import { useCartStore } from '../../../store/cartManagment';
    import { storeToRefs } from 'pinia';

    const route = useRoute();
    const router = useRouter()
  
    const carstore = useCartStore();
    const { cartItems, calculatedTotalPrice, total_deliveryCharge, grand_total  } = storeToRefs(carstore);

    onMounted( async () => {
       await carstore.fetchCartItems();
    });

    const removeCart = async (cartId) => {
       await carstore.removeCartItem(cartId);
       await carstore.fetchCartItems();
    }

   const count = computed(() => carstore.cartCount);

  const processCheckout = () => {
    router.push({name:'checkout'});
  }

</script>
<template>
    
    <main class="main">
     
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">Your Cart</h1>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">There are <span class="text-brand">{{ count }}</span> products in your cart</h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="table-responsive shopping-summery">
                        <table class="table table-wishlist">
                            <thead>
                                <tr class="main-heading">
                                    <th class="custome-checkbox start pl-30">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                        <label class="form-check-label" for="exampleCheckbox11"></label>
                                    </th>
                                    <th scope="col" colspan="2">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col" class="end">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="pt-30" v-for="cartItem in cartItems" :key="cartItem.id" >
                                    <td class="custome-checkbox pl-30">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                        <label class="form-check-label" for="exampleCheckbox1"></label>
                                    </td>
                                    <td class="image product-thumbnail pt-40"><img :src="`/uploads/product/product_photo/${cartItem.image}`" alt="#"></td>
                                    <td class="product-des product-name">
                                        <h6 class="mb-5"><a class="product-name mb-10 text-heading" >{{ cartItem.product_name}}</a></h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-body">৳ {{ cartItem.price}} </h4>
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        <div class="detail-extralink mr-15">
                                            <div class="detail-qty border radius">
                                                <span class="qty-val">{{ cartItem.qnt}}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-brand">৳ {{ cartItem.price * cartItem.qnt }} </h4>
                                    </td>
                                    <td class="action text-center" data-title="Remove"><a @click="removeCart(cartItem.id)"  class="text-body"><i class="bi bi-trash"></i></a></td>
                                </tr>
                            
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="border p-md-4 cart-totals ml-30">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <tbody>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">৳ {{ calculatedTotalPrice }}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Delivery charge</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-heading text-end"> ৳ {{ total_deliveryCharge }} </h5>
                                        </td>
                                    </tr>
                                     <tr>
                                        
                                    </tr>
                                     <tr>
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">৳ {{ grand_total }}</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="#" @click="processCheckout()" class="btn mb-20 w-100">Proceed To CheckOut<i class=""></i></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<style scoped>
</style>