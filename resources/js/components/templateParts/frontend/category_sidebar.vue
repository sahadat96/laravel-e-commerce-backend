<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';


const router = useRouter();
const categories = ref([]);

const fetchCategories = async () => {
    try {
        const response = await axios.get('/api/categories')
        categories.value = response.data
    } catch (error) {
        console.error('Error fetching categories:', error)
    }
};

onMounted(() => {
    fetchCategories()
});

const navigateToCategory = (categorySlug) => {
    router.push({ name: 'category', params: { slug: categorySlug }});
};

const navigateToSubCategory = (subCatSlug) => {
    router.push({name: 'subcategory', params: { slug: subCatSlug }}); // Changed 'subCategory' to 'subcategory'
};


</script>

<template>
    <div class="col-lg-1-5 primary-sidebar sticky-sidebar pt-30 d-none d-md-block">
        <!-- <div class="col-lg-1-5 primary-sidebar sticky-sidebar pt-30 d-md-none"> -->
        <h5 class="section-title style-1 mb-30">Category</h5>
        <div class="sidebar-widget widget-category-2 mb-30">
            <div class="custom-sidebar-menu menu-padding main-menull-h">
                <nav>
                    <ul>
                        <li v-for="category in categories" :key="category.id">
                            <a @click="navigateToCategory(category.cat_slug)" style="color: #253D4E;">
                                {{ category.cat_name }}
                                <i class="bi-chevron-right"></i>
                            </a>
                            <br>
                            <ul class="sub-menu">
                                <li v-for="subCat in category.get_sub_category" 
                                    :key="subCat.id">
                                    <a @click="navigateToSubCategory(subCat.subcat_slug)">
                                        {{ subCat.subcat_name }}
                                        <i class="bi-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <br>
                </nav>
            </div>
        </div>
    </div>
</template>

<style scoped>
 .custom-sidebar-menu.menu-padding > nav > ul > li {
    margin-left: -18px;
}

</style>