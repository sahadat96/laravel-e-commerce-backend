
<script setup>

import axios from 'axios';
import { ref, onMounted, onBeforeUnmount } from 'vue';

let error = ref({});
let slider = ref([]);
let currentSlide = ref(0);
let autoSlideInterval = null;

const getSlider = async () => {
  try {
    const response = await axios.get('/api/slider');
    slider.value = response.data; 
  } catch (err) {
    error.value = err.message;
  }
};

const nextSlide = () => {
  currentSlide.value = (currentSlide.value + 1) % slider.value.length; 
};

const prevSlide = () => {
  currentSlide.value = (currentSlide.value - 1 + slider.value.length) % slider.value.length; 
};

// Start auto sliding
const startAutoSlide = () => {
  autoSlideInterval = setInterval(nextSlide, 4000); 
};

// Stop auto sliding
const stopAutoSlide = () => {
  clearInterval(autoSlideInterval);
};

onMounted(() => {
  getSlider();
  startAutoSlide();
});

onBeforeUnmount(() => {
  stopAutoSlide();
});
</script>

<template>
  <section class="home-slider position-relative mb-30" >
    <div class="home-slide-cover mt-30 slider-width "  style="margin-bottom:-30px;">
      <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1"  >
        <div
          v-for="(slide, index) in slider"
          :key="slide.id"
          class="single-hero-slider single-animation-wrap"
          :style="{ backgroundImage: `url(/uploads/slider/${slide.pic})` }"
          v-show="currentSlide === index"
        >
          <div class="slider-content">
            <h1 class="display-2 mb-40 title">{{ slide.title }}</h1>
            <p class="mb-65 description">{{ slide.description }}</p>
          </div>
        </div>
      </div>
      <div class="slider-arrow hero-slider-1-arrow">
        <button @click="prevSlide" class="arrow-button">Previous</button>
        <button @click="nextSlide" class="arrow-button">Next</button>
      </div>
    </div>
  </section>
</template>

<style scoped>
.slider-width {
  width: 100%;
  max-width: 1077px;
  margin: 0 auto;
}

.home-slider {
  position: relative;
 
}

.single-hero-slider {
  height: 400px;
  background-size: cover;
  background-position: center;
}

.slider-arrow {
  position: absolute;
  top: 50%;
  width: 100%;
  display: flex;
  justify-content: space-between;
  transform: translateY(-50%);
}

.arrow-button {
  background-color: rgba(255, 255, 255, 0.7);
  border: none;
  padding: 10px 20px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.arrow-button:hover {
  background-color: rgba(255, 255, 255, 1);
}

.title {
  color: #95e9c6;
}

.description {
  color: white;
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .slider-width {
    width: 90%;
  }
}

@media (max-width: 768px) {
  .single-hero-slider {
    height: 300px;
  }
  
  .title {
    font-size: 2rem;
  }
  
  .description {
    font-size: 1rem;
  }
}

@media (max-width: 480px) {
  .single-hero-slider {
    height: 250px;
  }
  
  .title {
    font-size: 1.5rem;
  }
  
  .arrow-button {
    padding: 8px 15px;
  }
}
</style>
