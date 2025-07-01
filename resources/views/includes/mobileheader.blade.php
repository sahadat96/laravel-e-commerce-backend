<div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="index.html"><img src="{{ asset('frontend') }}/assets/imgs/theme/logo.jpg" alt="logo" /></a>
                </div>
                    <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                        <button class="close-style search-close">
                            <i class="icon-top"></i>
                            <i class="icon-bottom"></i>
                        </button>
                    </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" placeholder="Search for items…" />
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                     @php
                        $getCategoriesMobile = App\Models\Category::getRecordMenu();
                     @endphp

                     <div class="mobile-menu-wrap mobile-header-border">
                            <!-- mobile menu start -->
                            <nav>
                                <ul class="mobile-menu font-heading">
                                    <li class="menu-item-has-children">
                                        <a href="{{ route('homePage') }}">Home</a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- mobile menu end -->
                        </div>

                     @foreach( $getCategoriesMobile as $category )
                        <div class="mobile-menu-wrap mobile-header-border">
                            <!-- mobile menu start -->
                            <nav>
                                <ul class="mobile-menu font-heading">
                                    <li class="menu-item-has-children">
                                        <a href="shop-grid-right.html">{{ $category->cat_name }}</a>
                                        @foreach( $category->getSubCategory as $sub_cat )
                                        <ul class="dropdown">
                                            <li><a href="{{ url($category->cat_slug.'/'.$sub_cat->subcat_slug) }}">{{ $sub_cat->subcat_name }}</a></li>
                                        </ul>
                                        @endforeach
                                    </li>
                                </ul>
                            </nav>
                            <!-- mobile menu end -->
                        </div>
                     @endforeach
                     
                <div class="mobile-header-info-wrap">
                    <div class="single-mobile-header-info">
                        <a href="#"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
                    </div>
                </div>
                <div class="mobile-social-icon mb-50">
                    <h6 class="mb-15">Follow Us</h6>
                    <a href="#"><img src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-facebook-white.svg" alt="" /></a>
                    <a href="#"><img src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-instagram-white.svg" alt="" /></a>
                    <a href="#"><img src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-youtube-white.svg" alt="" /></a>
                </div>
                <div class="site-copyright">Copyright 2024 © Sasroi Mela. All rights reserved.</div>
            </div>
        </div>
    </div>