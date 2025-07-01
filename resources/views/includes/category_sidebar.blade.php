<div class="col-lg-1-5 primary-sidebar sticky-sidebar pt-30">
                
                        <h5 class="section-title style-1 mb-30">Category</h5>
                   
                   <div class="sidebar-widget widget-category-2 mb-30">
                     @php
                        $getCategories = App\Models\Category::getRecordMenu();
                     @endphp

                   @foreach( $getCategories as $category )
                        
                        <div class="custom-sidebar-menu menu-padding main-menull-h  ">
                            <!-- main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading -->
                            <nav>
                                <ul >
                                    <li>
                                    <!-- {{ url($category->cat_slug) }} -->
                                        <a style="color: #253D4E">{{ $category->cat_name }}<i class="fi-rs-angle-right"></i></a><br>
                                        <ul class="sub-menu">
                                            @foreach( $category->getSubCategory as $sub_cat )
                                            <li href="#">
                                                <a href="{{ url($category->cat_slug.'/'.$sub_cat->subcat_slug) }}">{{ $sub_cat->subcat_name }}<i class="fi-rs-angle-right"></i></a>
                                                    <!--<ul class="level-menu">
                                                        <li><a href=""> </a></li>
                                                    </ul> -->
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul><br>
                            </nav>
                        </div>
                     @endforeach
                   </div> 
                </div>