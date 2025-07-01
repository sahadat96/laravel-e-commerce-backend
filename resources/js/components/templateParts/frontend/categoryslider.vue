<script setup>
  const getAssetPath = (filename) => {
  return `/frontend/assets/imgs/theme/icons/${filename}`
}
</script>

<template>
    <section class="popular-categories section-padding">
            <div class="container">
                <div class="section-title">
                    <div class="title">
                        <h3>Shop by Categories</h3>
                    </div>
                    <div class="slider-arrow slider-arrow-2 flex-right carausel-8-columns-arrow" id="carausel-8-columns-arrows"></div>
                </div>
                <div class="carausel-8-columns-cover position-relative">
                    <div class="carausel-8-columns" id="carausel-8-columns">
                        <div class="card-1">
                            <figure class="img-hover-scale overflow-hidden">
                                <a href="shop-grid-right.html"><img :src="getAssetPath('category-1.svg')"  alt="" /></a>
                            </figure>
                            <h6>
                                <a href="shop-grid-right.html">Milks and <br />Dairies</a>
                            </h6>
                        </div>
                        <div class="card-1">
                            <figure class="img-hover-scale overflow-hidden">
                                <a href="shop-grid-right.html"><img :src="getAssetPath('category-2.svg')"  alt="" /></a>
                            </figure>
                            <h6>
                                <a href="shop-grid-right.html">Wines & <br />
                                    Alcohol</a>
                            </h6>
                        </div>
                        <div class="card-1">
                            <figure class="img-hover-scale overflow-hidden">
                                <a href="shop-grid-right.html"><img :src="getAssetPath('category-3.svg')"  alt="" /></a>
                            </figure>
                            <h6>
                                <a href="shop-grid-right.html">Clothing & <br />Beauty</a>
                            </h6>
                        </div>
                        <div class="card-1">
                            <figure class="img-hover-scale overflow-hidden">
                                <a href="shop-grid-right.html"><img :src="getAssetPath('category-4.svg')"  alt="" /></a>
                            </figure>
                            <h6>
                                <a href="shop-grid-right.html">Pet Foods <br />& Toy</a>
                            </h6>
                        </div>
                        <div class="card-1">
                            <figure class="img-hover-scale overflow-hidden">
                                <a href="shop-grid-right.html"><img :src="getAssetPath('category-5.svg')"  alt="" /></a>
                            </figure>
                            <h6>
                                <a href="shop-grid-right.html">Packaged <br />fast food</a>
                            </h6>
                        </div>
                        <div class="card-1">
                            <figure class="img-hover-scale overflow-hidden">
                                <a href="shop-grid-right.html"><img :src="getAssetPath('category-6.svg')"  alt="" /></a>
                            </figure>
                            <h6>
                                <a href="shop-grid-right.html">Baking <br />material</a>
                            </h6>
                        </div>
                        <div class="card-1">
                            <figure class="img-hover-scale overflow-hidden">
                                <a href="shop-grid-right.html"><img :src="getAssetPath('category-7.svg')"  alt="" /></a>
                            </figure>
                            <h6>
                                <a href="shop-grid-right.html">Vegetables <br />& tubers</a>
                            </h6>
                        </div>
                        <div class="card-1">
                            <figure class="img-hover-scale overflow-hidden">
                                <a href="shop-grid-right.html"><img :src="getAssetPath('category-8.svg')" alt="" /></a>
                            </figure>
                            <h6>
                                <a href="shop-grid-right.html">Fresh <br />Seafood</a>
                            </h6>
                        </div>
                        <div class="card-1">
                            <figure class="img-hover-scale overflow-hidden">
                                <a href="shop-grid-right.html"><img :src="getAssetPath('category-9.svg')"  alt="" /></a>
                            </figure>
                            <h6>
                                <a href="shop-grid-right.html">Noodles <br />Rice</a>
                            </h6>
                        </div>
                        <div class="card-1">
                            <figure class="img-hover-scale overflow-hidden">
                                <a href="shop-grid-right.html"><img :src="getAssetPath('category-10.svg')"  alt="" /></a>
                            </figure>
                            <h6><a href="shop-grid-right.html">Fastfood</a></h6>
                        </div>
                        <div class="card-1">
                            <figure class="img-hover-scale overflow-hidden">
                                <a href="shop-grid-right.html"><img :src="getAssetPath('category-11.svg')"  alt="" /></a>
                            </figure>
                            <h6><a href="shop-grid-right.html">Ice cream</a></h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</template>