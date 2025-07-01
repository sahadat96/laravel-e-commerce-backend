<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useRouter } from 'vue-router';
import Swal from "sweetalert2";
import { useAuthStore } from '@/stores/auth';
import { useCartStore } from '@/stores/cartManagment';

const products = ref([]);
const links = ref([]);
const error = ref({});
const selectedProduct = ref(null);
const quantity = ref(1);
const selectedColor = ref("");
const selectedSize = ref("");
const router = useRouter();
const authStore = useAuthStore();
const cartStore = useCartStore();

// Get product
const getProducts = async () => {
    try {
        const response = await axios.get("/api/getallproducts");
        products.value = response.data.getProduct.data;
        links.value = response.data.getProduct.links;
    } catch (err) {
        error.value = err.message;
    }
};

// change pagination
const changePage = async (link) => {
    if (!link.url || link.active) {
        return;
    }

    try {
        const response = await axios.get(link.url);
        products.value = response.data.getProduct.data;
        links.value = response.data.getProduct.links;
    } catch (err) {
        error.value = err.message;
    }
};

//Quick view  modal
const openQuickView = (product) => {
    selectedProduct.value = product;
    quantity.value = 1;
    selectedColor.value = "";
    selectedSize.value = "";
};

//Add to cart
const addToCart = async () => {
  if (!authStore.isAuthenticated) {
          Swal.fire("Please login first");
        window.location.href = '/login';
        return;
    };
    if (!selectedColor.value && selectedProduct.value.product_color) {
        Swal.fire("Please Select Color");
        return;
    };
    if (!selectedSize.value) {
        Swal.fire("Please Select Size");
        return;
    };
    const cartItem = {
        product_id : selectedProduct.value.id,
        quantity : quantity.value,
        color : selectedColor.value,
        size : selectedSize.value,
        price: selectedProduct.value.discount_price 
    };
    const success = await cartStore.addToCart(cartItem);
    if(success){
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: cartStore.message,
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
            ((product.product_price - product.discount_price) /
                product.product_price) *
                100
        );
    }
    return 0;
};

// Go product details page
const productDetails = (id) => {
  router.push({ name: 'productdetailspage', params: { id: id } });
}

onMounted(() => {
    getProducts();
});

import { Swiper, SwiperSlide } from "swiper/vue";
import { FreeMode, Navigation, Thumbs } from "swiper";
import "swiper/css";
import "swiper/css/free-mode";
import "swiper/css/navigation";
import "swiper/css/thumbs";
</script>

<template>
    <section class="product-tabs section-padding position-relative">
        <div class="section-title style-2">
            <h3>Popular Products</h3>
        </div>

        <div class="products-grid">
            <div class="product-item" v-for="product in products" :key="product.id">
                <div class="product-cart-wrap mb-30">
                    <div class="product-img-action-wrap">
                        <div class="product-img product-img-zoom">
                            <a @click="productDetails(product.id)" >
                                <img class="default-img" :src="`/uploads/product/product_photo/${product.product_image}`" alt=""/>
                                <img class="hover-img" :src="`/uploads/product/product_photo/${product.product_image}`" alt="" />
                            </a>
                        </div>
                        <div class="product-action-1">
                            <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"> <i class="bi bi-heart"></i></a>
                            <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="bi bi-shuffle"></i></a>
                            <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" :data-bs-target="`#quickViewModal${product.id}`" @click="openQuickView(product)">
                                <i class="bi bi-eye"></i>
                            </a>
                        </div>
                        <div class="product-badges product-badges-position product-badges-mrg">
                            <span class="new">New</span>
                        </div>
                    </div>
                    <div class="product-content-wrap">
                        <div class="product-category"><a href="#"></a></div>
                        <h2><a href="shop-product-right.html">{{ product.product_name }}</a></h2>
                        <div class="product-rate-cover">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 85%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted">(4.0)</span>
                        </div>
                        <div>
                            <span class="font-small text-muted">By <a href="#">{{ product.vendor_id?.shop_name }}</a></span>
                        </div>
                        <div class="product-card-bottom">
                            <div class="product-price">
                                <span>{{ product.discount_price }} TK</span>
                                <span class="old-price">{{ product.product_price }} TK</span>
                            </div>
                            <div class="add-cart">
                                <a class="add" @click="productDetails(product.id)" >View</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!--for pagination-->
         <div class="pagination-container">
                        <div class="pagination-list">
                            <a
                                class="pagination-link"
                                v-for="(link, index) in links"
                                :key="index"
                                v-html="link.label"
                                :class="{
                                    active: link.active,
                                    disabled: !link.url,
                                }"
                                @click="changePage(link)"
                                :aria-current="link.active ? 'page' : null"
                            ></a>
                        </div>
                    </div>

        <!-- Rest of your code remains same until the Quick View Modal -->
        <div
            v-for="product in products"
            :key="product.id"
            class="modal fade custom-modal"
            :id="'quickViewModal' + product.id"
            tabindex="-1"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                    <div class="modal-body">
                        <div class="row">
                            <div
                                class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5"
                            >
                                <div class="detail-gallery">
                                    <!-- Main Swiper -->
                                    <swiper
                                        :modules="[
                                            FreeMode,
                                            Navigation,
                                            Thumbs,
                                        ]"
                                        :thumbs="{ swiper: thumbsSwiper }"
                                        :navigation="true"
                                        class="product-image-slider"
                                    >
                                        <swiper-slide
                                            v-for="(
                                                image, index
                                            ) in selectedProduct?.gallery_images"
                                            :key="index"
                                        >
                                            <img
                                                :src="`/uploads/product/productgallery/${image}`"
                                                :alt="
                                                    selectedProduct?.product_name
                                                "
                                                class="w-100"
                                            />
                                        </swiper-slide>
                                    </swiper>

                                    <!-- Thumbs Swiper -->
                                    <swiper
                                        :modules="[
                                            FreeMode,
                                            Navigation,
                                            Thumbs,
                                        ]"
                                        :slides-per-view="4"
                                        :space-between="10"
                                        :free-mode="true"
                                        :watch-slides-progress="true"
                                        @swiper="setThumbsSwiper"
                                        class="product-image-slider-thumbs mt-2"
                                    >
                                        <swiper-slide
                                            v-for="(
                                                image, index
                                            ) in selectedProduct?.gallery_images"
                                            :key="index"
                                        >
                                            <img
                                                :src="`/uploads/product/productgallery/${image}`"
                                                :alt="
                                                    selectedProduct?.product_name
                                                "
                                                class="w-100 cursor-pointer"
                                            />
                                        </swiper-slide>
                                    </swiper>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info pr-30 pl-30">
                                    <span class="stock-status in-stock"
                                        >In Stock</span
                                    >

                                    <h3 class="title-detail">
                                        <a href="#" class="text-heading">{{
                                            product.product_name
                                        }}</a>
                                    </h3>

                                    <div class="clearfix product-price-cover">
                                        <div
                                            class="product-price primary-color float-left"
                                        >
                                            <span
                                                class="current-price text-brand"
                                                >৳
                                                {{
                                                    product.discount_price
                                                }}</span
                                            >
                                            <span>
                                                <span
                                                    class="save-price font-md color3 ml-15"
                                                    >{{
                                                        calculateDiscount(
                                                            product
                                                        )
                                                    }}% Off</span
                                                >
                                                <span
                                                    class="old-price font-md ml-15"
                                                    >৳
                                                    {{
                                                        product.product_price
                                                    }}</span
                                                >
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Color Selector -->
                                    <div
                                        v-if="selectedProduct?.product_color"
                                        class="attr-detail attr-size mb-30"
                                    >
                                        <strong
                                            class="mr-10"
                                            style="width: 50px"
                                            >Color :
                                        </strong>
                                        <select
                                            v-model="selectedColor"
                                            class="form-control unicase-form-control"
                                            style="width: 150px"
                                        >
                                            <option value="" disabled>
                                                Choose Color
                                            </option>
                                            <option
                                                v-for="color in selectedProduct.product_color.split(
                                                    ','
                                                )"
                                                :key="color"
                                                :value="color.trim()"
                                            >
                                                {{
                                                    color
                                                        .trim()
                                                        .charAt(0)
                                                        .toUpperCase() +
                                                    color.trim().slice(1)
                                                }}
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Size Selector -->
                                    <div class="attr-detail attr-size mb-30">
                                        <strong
                                            class="mr-10"
                                            style="width: 50px"
                                            >Size :
                                        </strong>
                                        <select
                                            v-model="selectedSize"
                                            class="form-control unicase-form-control"
                                            style="width: 150px"
                                        >
                                            <option value="" disabled>
                                                Choose Size
                                            </option>
                                            <option
                                                v-for="size in selectedProduct?.product_size.split(
                                                    ','
                                                )"
                                                :key="size"
                                                :value="size.trim()"
                                            >
                                                {{
                                                    size
                                                        .trim()
                                                        .charAt(0)
                                                        .toUpperCase() +
                                                    size.trim().slice(1)
                                                }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="detail-extralink mb-30">
                                        <div class="detail-qty border radius">
                                            <a
                                                href="#"
                                                class="qty-down"
                                                @click.prevent="
                                                    decrementQuantity
                                                "
                                                ><i
                                                    class="bi bi-chevron-down"
                                                ></i
                                            ></a>
                                            <input
                                                type="text"
                                                v-model="quantity"
                                                class="qty-val"
                                                min="1"
                                                max="30"
                                            />
                                            <a
                                                href="#"
                                                class="qty-up"
                                                @click.prevent="
                                                    incrementQuantity
                                                "
                                                ><i
                                                    class="bi bi-chevron-up"
                                                ></i
                                            ></a>
                                        </div>

                                        <div class="product-extra-link2">
                                            <button
                                                @click="addToCart()" class="button button-add-to-cart" >
                                                <i class="fi-rs-shopping-cart" ></i >Add to cart
                                            </button>
                                        </div>
                                    </div>

                                    <div class="font-xs">
                                        <ul>
                                            <li class="mb-5">
                                                Vendor:
                                                <span class="text-brand">{{
                                                    product.vendor_id?.shop_name
                                                }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Rest of your modal content remains same -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
}

.product-item {
    width: 100%;
    display: flex;
    flex-direction: column;
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
    padding: 10px 0;
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

.pagination-container {
    display: flex;
    justify-content: right;
    margin-top: 1rem;
}

.pagination-list {
    display: flex;
    list-style: none;
    padding: 0;
}

.pagination-link {
    display: inline-block;
    padding: 0.5rem 1rem;
    margin: 0 0.25rem;
    border: 1px solid #ddd;
    color: #000000;
    text-decoration: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
}

.pagination-link:hover {
    background-color: #5ed5bf;
    color: #fff;
}

.pagination-link.active {
    background-color: #5ed5bf;
    color: #fff;
    font-weight: bold;
}

.pagination-link.disabled {
    color: #ccc;
    cursor: not-allowed;
}


@media (max-width: 767px) {
  .products-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
  }

  .product-cart-wrap {
    margin-bottom: 10px;
  }

  .product-img-action-wrap {
    height: auto;
  }

  .product-img img {
    width: 100%;
    height: auto;
    object-fit: cover;
  }

  .product-content-wrap {
    padding: 8px;
  }

  .product-content-wrap h2 {
    font-size: 14px;
    line-height: 1.2;
  }

  .product-price {
    font-size: 13px;
  }

  .old-price {
    font-size: 11px;
  }

  .product-action-1 {
    display: none;
  }

  .product-badges {
    padding: 3px 8px;
    font-size: 10px;
  }

  .add-cart .add {
    padding: 6px 12px;
    font-size: 12px;
  }
}
</style>
