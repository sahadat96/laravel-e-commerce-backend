<script setup>
   


const getAssetPath = (filename) => {
  return `/frontend/assets/imgs/theme/icons/${filename}`
}

</script>

<template>
   <footer class="main">
        <section class="featured section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                        <div class="banner-left-icon d-flex align-items-center wow fadeIn animated bg-15">
                            <div class="banner-icon">
                                <img :src="getAssetPath('icon-1.svg')"  alt="" />
                            </div>
                            <div class="banner-text ">
                                <h3 class="icon-box-title">Best prices & offers</h3>
                                <p>Orders $50 or more</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow fadeIn animated bg-15">
                            <div class="banner-icon">
                                <img :src="getAssetPath('icon-2.svg')" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Free delivery</h3>
                                <p>24/7 amazing services</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow fadeIn animated bg-15">
                            <div class="banner-icon">
                                <img :src="getAssetPath('icon-3.svg')" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Great daily deal</h3>
                                <p>When you sign up</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow fadeIn animated bg-15">
                            <div class="banner-icon">
                                <img :src="getAssetPath('icon-4.svg')" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Wide assortment</h3>
                                <p>Mega Discounts</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow fadeIn animated bg-15">
                            <div class="banner-icon">
                                <img :src="getAssetPath('icon-5.svg')"  alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Easy returns</h3>
                                <p>Within 30 days</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-xl-none">
                        <div class="banner-left-icon d-flex align-items-center wow fadeIn animated bg-15">
                            <div class="banner-icon">
                                <img :src="getAssetPath('icon-6.svg')"  alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Safe delivery</h3>
                                <p>Within 07 days</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-padding footer-mid">
        </section>
        <div class="container pb-30">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <p class="font-sm mb-0">&copy; 2025, Developed By <strong class="text-brand">Sahadat Hossain</strong> <br />All rights reserved</p>
                </div>
                <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">
                    <div class="hotline d-lg-inline-flex mr-30">
                        <img :src="getAssetPath('phone-call.svg')"  alt="hotline" />
                        <p>1900 - 6666<span>Working 8:00 - 22:00</span></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                    <div class="mobile-social-icon">
                        <h6>Follow Us</h6>
                        <a href="#"><img :src="getAssetPath('icon-facebook-white.svg')" alt="" /></a>
                        <a href="#"><img :src="getAssetPath('icon-twitter-white.svg')"  alt="" /></a>
                        <a href="#"><img :src="getAssetPath('icon-instagram-white.svg')"  alt="" /></a>
                        <a href="#"><img :src="getAssetPath('icon-pinterest-white.svg')"  alt="" /></a>
                        <a href="#"><img :src="getAssetPath('icon-youtube-white.svg')"   alt="" /></a>
                    </div>
                    
                </div>
            </div>
        </div>
    </footer>
</template>