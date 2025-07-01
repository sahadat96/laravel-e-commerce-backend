                             @php  
                                 $feautured = App\Http\Controllers\Frontend\FrontendController::getfeature();
                             @endphp

@foreach( $feautured as $feauture)

<div class="modal fade custom-modal" id="quickViewModal{{ $feauture->id }}" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                 @php
                                     $images = App\Http\Controllers\Frontend\FrontendController::gallery($feauture->id); 
                                 @endphp
                                 @foreach( $images as $image)
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('uploads/product/productgallery/'.$image->images) }}" alt="product image" />
                                    </figure>
                                    @endforeach
                                
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                 @php
                                     $images = App\Http\Controllers\Frontend\FrontendController::gallery($feauture->id); 
                                 @endphp
                                 @foreach( $images as $image)
                                    <div><img src="{{ asset('uploads/product/productgallery/'.$image->images) }}" alt="product image" /></div>
                                 @endforeach
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                @if($feauture->quantity > 0)
                                <span class="stock-status in-stock"> In Stock </span>
                                @else
                                <span class="stock-status out-stock"> Sale Off </span>
                                @endif
                                <h3 class="title-detail"><a href="#" class="text-heading">{{ $feauture->product_name }}</a></h3>
                                <br>
                                @php
                                     $product_color = App\Http\Controllers\Frontend\FrontendController::productAttribute($feauture->id); 
                                     $product_size = App\Http\COntrollers\frontend\FrontendCOntroller::product_size($feauture->id);
                                @endphp
                                      
                                     
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">৳{{ $feauture->discount_price }} </span>
                                        <span>
                                            <span class="save-price font-md color3 ml-15"></span>
                                            <span class="old-price font-md ml-15">৳{{ $feauture->product_price }} </span>
                                        </span>
                                    </div>
                                </div>
                                
                                 @if($feauture->product_color == NULL)
                                 @else
                                 
                                    <div class="attr-detail attr-size mb-30">
                                        <strong class="mr-10" style="width:50px;" >Color  : </strong>
                                        <select  id="color-{{ $feauture->id }}" class="form-control unicase-form-control" style="width:150px;" >
                                        <option selected="" disabled="" >Choose Color</option>
                                            @foreach($product_color as $product_colors)
                                            <option value="{{ $product_colors }}"  >{{ ucwords($product_colors) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                 @endif
                                 
                                <div class="attr-detail attr-size mb-30">
                                        <strong class="mr-10" style="width:50px;" >Size  : </strong>
                                        <select  class="form-control unicase-form-control" style="width:150px;"  id="size-{{ $feauture->id }}">
                                            <option selected="" disabled="" >Choose Size</option>
                                            @foreach($product_size as $product_sizes)
                                                <option  value="{{ $product_sizes }}" >{{ ucwords($product_sizes) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                            
                                <div class="detail-extralink mb-30">
                                    <div class="detail-qty border radius">
                                      <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                         <input type="text" name="quantity" class="qty-val" id="p_qnt-{{ $feauture->id }}" value="1" min="1" max="30">
                                      <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>

                                    <div class="product-extra-link2">
                                        <button value="{{ $feauture->id }}" type="submit" class="qview_btn button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                                <div class="font-xs">
                                    <ul>
                                        <li class="mb-5">Vendor: <span class="text-brand">{{ $feauture->vdendor_id->shop_name }}</span></li>
                                        
                                    </ul>
                                </div>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endforeach
