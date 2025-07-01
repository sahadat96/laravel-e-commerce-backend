<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useRoute } from 'vue-router';
import { useAuthStore } from '@/store/auth';
import { useCartStore } from '@/store/cartManagment';

import Swal from "sweetalert2";

const authStore = useAuthStore();
const cartStore = useCartStore();

const thumbsSwiper = ref(null);
const route = useRoute();
const products = ref('');
const quantity = ref(1);
const selectedColor = ref("");
const selectedSize = ref("");


const getProduct = async () => {
    try {
        const response = await axios.get(`/api/getproductdetails/${route.params.id}`);
        products.value = response.data.product;
    } catch (error) {
        console.error('Error fetching product:', error);
    }
};

const addToCart = async () => {
  if (!authStore.isAuthenticated) {
          Swal.fire("Please login first");
        window.location.href = '/login';
        return;
    };
    if (!selectedColor.value && products.value.product_color) {
        Swal.fire("Please Select Color");
        return;
    };
    if (!selectedSize.value  && products.value.product_size) {
        Swal.fire("Please Select Size");
        return;
    };
    const cartItem = {
        product_id : products.value.id,
        quantity : quantity.value,
        color : selectedColor.value,
        size : selectedSize.value,
        price: products.value.discount_price 
    };
    const success = await cartStore.addToCart(cartItem);
    if(success){
        Swal.fire({
            position: "top-end",
            icon: "success",
            text: cartStore.message,
            title: "Your work has been saved",
            showConfirmButton: false,
            timer: 1700
        });

        cartStore.fetchCartItems();
    };

};


const incrementQuantity = () => {
    if (quantity.value < 30) quantity.value++;
};

const decrementQuantity = () => {
    if (quantity.value > 1) quantity.value--;
};

const calculateDiscount = (product) => {
    if (product.product_price && product.discount_price) {
        return Math.round(
            ((product.product_price - product.discount_price) / product.product_price) * 100
        );
    }
    return 0;
};

const setThumbsSwiper = (swiper) => {
    thumbsSwiper.value = swiper;
};

// Add zoom configuration
const mainSwiperOptions = {
    modules: [FreeMode, Navigation, Thumbs, Zoom],
    zoom: {
        maxRatio: 3,
        minRatio: 1
    },
    navigation: true
};

onMounted(() => {
    getProduct();
});

import { Swiper, SwiperSlide } from "swiper/vue";
import { FreeMode, Navigation, Thumbs, Zoom } from "swiper"; // Added Zoom
import "swiper/css";
import "swiper/css/free-mode";
import "swiper/css/navigation";
import "swiper/css/thumbs";
import "swiper/css/zoom"; // Added zoom CSS
</script>

<template>
  <main class="main">

      <div class="container mb-30">
          <div class="row">
              <div class="col-xl-11 col-lg-12 m-auto">
                  <div class="row">
                      <div class="col-xl-9">
                          <div class="product-detail accordion-detail">
                              <div class="row mb-50 mt-30">
                                  <div class="col-md-6">
                                    <div class="detail-gallery">
                                        <!-- Main Swiper with Zoom -->
                                        <swiper
                                            v-bind="mainSwiperOptions"
                                            :thumbs="{ swiper: thumbsSwiper }"
                                            class="product-image-slider"
                                        >
                                            <swiper-slide v-for="image in products.get_image" :key="image.id">
                                                <div class="swiper-zoom-container">
                                                    <img 
                                                        :src="`/uploads/product/productgallery/${image.images}`" 
                                                        :alt="products.product_name"
                                                    />
                                                </div>
                                            </swiper-slide>
                                        </swiper>

                                        <!-- Thumbs Swiper (remains the same) -->
                                        <swiper
                                            :modules="[FreeMode, Navigation, Thumbs]"
                                            :slides-per-view="4"
                                            :space-between="10"
                                            :free-mode="true"
                                            :watch-slides-progress="true"
                                            @swiper="setThumbsSwiper"
                                            class="product-image-slider-thumbs"
                                        >
                                            <swiper-slide v-for="image in products.get_image" :key="image.id">
                                                <img 
                                                    :src="`/uploads/product/productgallery/${image.images}`" 
                                                    :alt="products.product_name"
                                                />
                                            </swiper-slide>
                                        </swiper>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="detail-info">
                                          <h2 class="title-detail">{{ products.product_name }}</h2>
                                          
                                          <div class="product-price-cover">
                                              <div class="product-price">
                                                  <span class="current-price">৳{{ products.discount_price }}</span>
                                                  <span class="old-price">৳{{ products.product_price }}</span>
                                                  <span class="save-price">
                                                      {{ calculateDiscount(products) }}% Off
                                                  </span>
                                              </div>
                                          </div>

                                          <!-- Color Selection -->
                                          <div v-if="products.product_color" class="attr-detail mb-30">
                                              <label class="mr-10">Color:</label>
                                              <select v-model="selectedColor" class="form-select form-select-custom">
                                                  <option value="" disabled>Choose Color</option>
                                                  <option v-for="color in products.product_color?.split(',')"
                                                          :key="color"
                                                          :value="color.trim()">
                                                      {{ color.trim() }}
                                                  </option>
                                              </select>
                                          </div>

                                          <!-- Size Selection -->
                                          <div v-if="products.product_size" class="attr-detail mb-30">
                                              <label class="mr-10">Size:</label>
                                              <select v-model="selectedSize" class="form-select form-select-custom">
                                                  <option value="" disabled>Choose Size</option>
                                                  <option v-for="size in products.product_size?.split(',')"
                                                          :key="size"
                                                          :value="size.trim()">
                                                      {{ size.trim() }}
                                                  </option>
                                              </select>
                                          </div>

                                          <!-- Quantity Controls -->
                                          <div class="detail-extralink mb-30 ">
                                              <div class="detail-qty border radius qty-custom">
                                                  <a href="#" class="qty-down" @click.prevent="decrementQuantity"><i class="bi bi-chevron-down"></i></a>
                                                  <input type="text" v-model="quantity" class="qty-val" min="1" max="30" />
                                                  <a href="#" class="qty-up" @click.prevent="incrementQuantity" ><i class="bi bi-chevron-up"></i ></a>
                                              </div>
                                              
                                              <button  @click="addToCart()"  
                                                      class="button button-add-to-cart addtocart-custom ">
                                                  Add to Cart
                                              </button>
                                          </div>

                                          

                                          <!-- Vendor Info -->
                                          <div class="vendor-info">
                                              <span>Vendor: {{ products.vendor_id?.shop_name }}</span>
                                          </div>
                                      </div>
                                  </div>
                              </div>


                          </div>
                      </div>

                      <div class="product-info">
                                    <div class="tab-style3">
                                        <ul class="nav nav-tabs text-uppercase">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews(***)</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content shop_info_tab entry-main-content">
                                            <div class="tab-pane fade show active" id="Description">
                                                <div class="">
                                                    <h5>Short Description :</h5> <p>{{ products.short_desc }}</p>
                                                         
                                                    <br>
                                                    <h5>Long Description : </h5>
                                                    <p>
                                                        {{ products.long_desc }}
                                                     </p>
                                                </div>
                                            </div>
                                            
                                            <div class="tab-pane fade" id="Vendor-info">
                                            
                                                <ul class="contact-infor mb-50">
                                                    <li><img src="" alt="" /><strong>Address: </strong> <span>5171 W Campbell Ave undefined Kent, Utah 53127 United States</span></li>
                                                    <li><img src="" alt="" /><strong>Contact Seller:</strong><span>(+91) - 540-025-553</span></li>
                                                </ul>
                                                <div class="d-flex mb-55">
                                                    <div class="mr-30">
                                                        <p class="text-brand font-xs">Rating</p>
                                                        <h4 class="mb-0">92%</h4>
                                                    </div>
                                                    <div class="mr-30">
                                                        <p class="text-brand font-xs">Ship on time</p>
                                                        <h4 class="mb-0">100%</h4>
                                                    </div>
                                                    <div>
                                                        <p class="text-brand font-xs">Chat response</p>
                                                        <h4 class="mb-0">89%</h4>
                                                    </div>
                                                </div>
                                                <p>
                                                    Noodles & Company is an American fast-casual restaurant that offers international and American noodle dishes and pasta in addition to soups and salads. Noodles & Company was founded in 1995 by Aaron Kennedy and is headquartered in Broomfield, Colorado. The company went public in 2013 and recorded a $457 million revenue in 2017.In late 2018, there were 460 Noodles & Company locations across 29 states and Washington, D.C.
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="Reviews">
                                                <!--Comments-->
                                                <div class="comments-area">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <h4 class="mb-30">Customer questions & answers</h4>
                                                            <div class="comment-list">
                                                    <!-- fore get letest comment-->         
                                         
                                                       
                                                        <!-- for admin approve -->
                                                         
                                                                <div class="single-comment justify-content-between d-flex mb-30">
                                                                    <div class="user justify-content-between d-flex">
                                                                        <div class="thumb text-center">
                                                                            <img src="" alt="" />
                                                                            <a href="#" class="font-heading text-brand"></a>
                                                                        </div>
                                                                        <div class="desc">
                                                                            <div class="d-flex justify-content-between mb-10">
                                                                                <div class="d-flex align-items-center">
                                                                                    <span class="font-xs text-muted"></span>
                                                                                </div>
                                                                                <div class="product-rate d-inline-block">
                                                                                

                                                                                
                                                                                    <div class="product-rating" style="width: 20%"></div>
                                                                                
                                                                                    <div class="product-rating" style="width: 40%"></div>
                                                                                
                                                                                    <div class="product-rating" style="width: 60%"></div>
                                                                                
                                                                                    <div class="product-rating" style="width: 80%"></div>
                                                                                 
                                                                                    <div class="product-rating" style="width: 100%"></div>
                                                                                 
                                                                                </div>
                                                                            </div>
                                                                            <p class="mb-10">  <a href="#" class="reply">Reply</a></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                        
                                                               
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                                <!--comment form-->
                                                <div class="comment-form">
                                                    <h4 class="mb-15">Add a review</h4>
                                                  
                                                    <div class="product-rate d-inline-block mb-30"></div>
                                                        <div class="row">
                                                            <div class="col-lg-8 col-md-12">

                                                                <form class="form-contact comment_form" >
                                                                   
                                                                    <div class="row">
                                                                       <div class="col-12"> 
                                                                         <div class="form-group">
                                                                          <input type="hidden" name="" value=""></input>
                                                                             <table class="table" style=" width: 10%;">
                                                                                <thead> 
                                                                                    <tr>
                                                                                        <th class="cell-level">&nbsp;</th>
                                                                                        <th>1 star</th>
                                                                                        <th>2 star</th>
                                                                                        <th>3 star</th>
                                                                                        <th>4 star</th>
                                                                                        <th>5 star</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="cell-level">Quality</td>
                                                                                        <td><input type="radio" name="quality" class="radio-sm" value="1"></td>
                                                                                        <td><input type="radio" name="quality" class="radio-sm" value="2"></td>
                                                                                        <td><input type="radio" name="quality" class="radio-sm" value="3"></td>
                                                                                        <td><input type="radio" name="quality" class="radio-sm" value="4"></td>
                                                                                        <td><input type="radio" name="quality" class="radio-sm" value="5"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                         </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="button button-contactForm">Submit Review</button>
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
              </div>
          </div>


      </div>
  </main>
</template>


<style scoped>
.qty-custom {
  width: 25%;
  height: 50px;
}

.form-select-custom {
  width: 36%;
  height: 40px;
}
.product-image-slider {
    width: 100%;
    height: 400px;
}

.product-image-slider img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
}

.product-image-slider-thumbs {
    width: 100%;
    height: 100px;
    margin-top: 10px;
}

.product-image-slider-thumbs img {
    width: 100%;
    height: 80px;
    object-fit: cover;
    border-radius: 5px;
    cursor: pointer;
}

.swiper-slide-thumb-active img {
    border: 2px solid #3bb77e;
}

.detail-qty {
    display: flex;
    align-items: center;
    border: 1px solid #ddd;
    border-radius: 4px;
    max-width: 120px;
}

.detail-qty input {
    width: 40px;
    text-align: left;
    border: none;
    padding: 5px;
}

.detail-qty a {
    padding: 5px 10px;
    text-decoration: none;
    color: #333;
}

.product-price-cover {
    margin: 15px 0;
}

.current-price {
    font-size: 24px;
    font-weight: bold;
    color: #3bb77e;
}

.old-price {
    text-decoration: line-through;
    color: #999;
    margin-left: 10px;
}

.save-price {
    background: #ff7272;
    color: white;
    padding: 2px 6px;
    border-radius: 3px;
}
.swiper-zoom-container {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.swiper-zoom-container img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.product-image-slider {
    width: 100%;
    height: 400px;
    background-color: #fff;
}

.product-image-slider .swiper-slide {
    overflow: hidden;
    cursor: zoom-in;
}

/* Zoom instructions tooltip */
.detail-gallery::after {
    content: "Double click or pinch to zoom";
    position: absolute;
    bottom: 120px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 12px;
    pointer-events: none;
    opacity: 0.8;
}
</style>
