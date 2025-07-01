<header class="header-area header-style-1 header-height-2">
        <div class="mobile-promotion">
            <span>Wellcome To Sasroi Mela </span>
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
                                    <a class="language-dropdown-active" href="#">English <i class="fi-rs-angle-small-down"></i></a>
                                    <ul class="language-dropdown">
                                      
                                    </ul>
                                </li>
                                <li>
                                    <a class="language-dropdown-active" href="#">BDT <i class="fi-rs-angle-small-down"></i></a>
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
                        <a href="index.html"><img src="{{ asset('frontend') }}/assets/imgs/theme/logo.jpg" alt="logo" /></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form action="#">
                                <select class="select-active">
                                    <option>All Categories</option>
                                    
                                </select>
                                <input type="text" placeholder="Search for items..." />
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                            @if(!empty(Auth::user()->id))
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="shop-cart.html">
                                        <img alt="" src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-cart.svg">
                                        <span class="pro-count blue totalCount"></span>
                                    </a>
                                    <a href=""><span class="lable">Cart</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                        <ul class="cartinfo">
                                            <!-- all code get from ajax -->
                                        </ul>
                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4>Total <span class="totalAmount"></span> ৳ </h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <a href="{{ route('viewcart') }}" class="outline">View cart</a>
                                                <a href="shop-checkout.html">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                
                                  @if(empty(Auth::user()->id))
                                    <div class="header-action-icon-2">
                                        <a href="{{ route('login') }}"><span class="lable">Login / </span></a>
                                        <a href="{{ route('register')}}"><span class="lable">  Registration  </span></a>
                                    </div>
                                  @endif
                                  @if(!empty(Auth::user()->id))
                                  <div class="header-action-icon-2">
                                        <a href="page-account.html">
                                            <img class="svgInject" alt="Nest" src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-user.svg" />
                                        </a>
                                        <a href="page-account.html"><span class="lable ml-0">Account</span></a>
                                        <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                            <ul>
                                                <li><a href="{{ route('my.account') }}"><i class="fi fi-rs-user mr-10"></i>My Account</a></li>
                                                <li><a href="{{ route('order.show') }}"><i class="fi fi-rs-location-alt mr-10"></i>My Order</a></li>
                                                <li><a href=""><i class="fi fi-rs-label mr-10"></i>My Voucher</a></li>
                                                <li><a href=""><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a></li>
                                                <li><a href=""><i class="fi fi-rs-settings-sliders mr-10"></i>Setting</a></li>
                                               <form action="{{ route('logout') }}" method="post"> 
                                                @csrf
                                                 <button><a ><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a></button>
                                               </form>
                                            </ul>
                                        </div>
                                    </div>
                                  @endif
                            
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
                        <a href="#"><img src="{{ asset('frontend') }}/assets/imgs/theme/logo.jpg" alt="logo" /></a>
                    </div>
                                       
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categories-button-active" href="#">
                                <span class="fi-rs-apps"></span> <span class="et">Browse</span> All Categories
                                <i class="fi-rs-angle-down"></i>
                            </a>
                             @php  
                                 $cats = App\Http\Controllers\Frontend\FrontendController::showCat();
                             @endphp
                            <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                                <div class="d-flex categori-dropdown-inner">
                                    <ul>
                                  @foreach($cats as $cat)
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="{{ asset('uploads/category/'.$cat->cat_image) }}" alt="" />{{ $cat->cat_name }}</a>
                                        </li>
                                   @endforeach
                                    </ul>
                                    <ul class="end">
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="assets/imgs/theme/icons/category-6.svg" alt="" />Wines & Drinks</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="more_slide_open" style="display: none">
                                    <div class="d-flex categori-dropdown-inner">
                                        <ul>
                                            <li>
                                                <a href="shop-grid-right.html"> <img src="assets/imgs/theme/icons/icon-1.svg" alt="" />Milks and Dairies</a>
                                            </li>
                                            
                                        </ul>
                                        <ul class="end">
                                            <li>
                                                <a href="shop-grid-right.html"> <img src="assets/imgs/theme/icons/icon-3.svg" alt="" />Wines & Drinks</a>
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
                                        <a class="active" href="index.html">Home <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="index.html">Home 1</a></li>
                                            
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="page-about.html">About</a>
                                    </li>
                                    <li>
                                        <a href="shop-grid-right.html">Shop <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="shop-grid-right.html">Shop Grid – Right Sidebar</a></li>
                                            
                                            <li>
                                                <a href="#">Single Product <i class="fi-rs-angle-right"></i></a>
                                                <ul class="level-menu">
                                                    <li><a href="shop-product-right.html">Product – Right Sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="shop-filter.html">Shop – Filter</a>
                                            </li>
                                           
                                            <li>
                                                <a href="#">Shop Invoice<i class="fi-rs-angle-right"></i></a>
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
                    
                    <div class="hotline d-none d-lg-flex">
                        <img src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-headphone.svg" alt="hotline" />
                        <p>1900 - 888<span>24/7 Support Center</span></p>
                    </div>
                    <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>
                    <div class="header-action-right d-block d-lg-none">
                    @if(empty(Auth::user()->id))
                                    <div class="header-action-icon-2">
                                        <a href="{{ route('login') }}"><span class="lable">Login / </span></a>
                                        <a href="{{ route('register')}}"><span class="lable">  Registration  </span></a>
                                    </div>
                                  @endif
                    @if(!empty(Auth::user()->id))
                        <div class="header-action-2">
                            
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon">
                                    <img alt="" src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-cart.svg" />
                                    <span class="pro-count white totalCount"></span>
                                </a>


                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul class="cartinfo">
                                        
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span class="totalAmount"></span>৳</h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href=" {{ route('viewcart') }}">View cart</a>
                                            <a href="">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="header-action-icon-2">
                                        <a href="#">
                                            <img class="svgInject" alt="" src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-user.svg" />
                                        </a>
                                        <a href="#"><span class="lable ml-0">Account</span></a>
                                        <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                            <ul>
                                                <li><a href=""><i class="fi fi-rs-user mr-10"></i>My Account</a></li>
                                                <li><a href=""><i class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a></li>
                                                <li><a href=""><i class="fi fi-rs-label mr-10"></i>My Voucher</a></li>
                                                <li><a href=""><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a></li>
                                                <li><a href=""><i class="fi fi-rs-settings-sliders mr-10"></i>Setting</a></li>
                                               <form action="{{ route('logout') }}" method="post"> 
                                                @csrf
                                                 <button><a ><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a></button>
                                               </form>
                                            </ul>
                                        </div>
                                    </div>
                        </div>
                     @endif
                    </div>
                </div>
            </div>
        </div>
    </header>