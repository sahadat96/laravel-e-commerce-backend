   <!-- Quick view -->
<section class="product-tabs section-padding position-relative">
                        <div class="section-title style-2">
                            <h3>Popular Products</h3>
                        </div>
                        <!--End nav-tabs-->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                                <div class="row product-grid-4">
                                 
                                    <!--end product card-->
                                    @php  
                                        $feautured = App\Http\Controllers\Frontend\FrontendController::getfeature();
                                    @endphp
                                    <!--end product card-->
                                    @foreach( $feautured as $feauture)
                                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6" >
                                        <div class="product-cart-wrap mb-30">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="{{ url($feauture->slug ) }}">
                                                        <img class="default-img" src="{{ asset('uploads/product/product_photo/'.$feauture->product_image) }}" alt="" />
                                                        <img class="hover-img" src="{{ asset('uploads/product/product_photo/'.$feauture->product_image) }}" alt="" />
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal{{ $feauture->id }}"><i class="fi-rs-eye"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="new">New</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="shop-grid-right.html"></a>
                                                </div>
                                                <h2><a href="shop-product-right.html">{{ $feauture->product_name }}</a></h2>
                                                <div class="product-rate-cover">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 85%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                                </div>
                                                <div>
                                                    <span class="font-small text-muted">By <a href="vendor-details-1.html">{{ $feauture->vdendor_id->shop_name }}</a></span>
                                                </div>
                                                <div class="product-card-bottom">
                                                    <div class="product-price">
                                                        <span>{{ $feauture->discount_price }} TK</span>
                                                        <span class="old-price">{{ $feauture->product_price }} TK</span>
                                                    </div>
                                                    <div class="add-cart">
                                                        <a class="add" href="{{ url($feauture->slug ) }}"> View </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!--end product card-->
                                </div>
                                <!--End product-grid-4-->
                            </div>
                            <!--En tab one-->
                      
                            <!--En tab seven-->
                        </div>
                        <!--End tab-content-->
                    </section>