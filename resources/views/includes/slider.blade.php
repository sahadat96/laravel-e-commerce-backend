<section class="home-slider position-relative mb-30">
    @php
       $slider_showing = App\Http\Controllers\Backend\SliderController::show();
    @endphp
                        <div class="home-slide-cover mt-30">
                            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                                @foreach($slider_showing as $slider_show)
                                <div class="single-hero-slider single-animation-wrap" style="background-image: url({{ asset('uploads/slider/'.$slider_show->pic) }}">
                                    <div class="slider-content">
                                        <h1 class="display-2 mb-40">
                                           {{ $slider_show->title }}
                                        </h1>
                                        <p class="mb-65">{{ $slider_show->description }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="slider-arrow hero-slider-1-arrow"></div>
                        </div>
                    </section>