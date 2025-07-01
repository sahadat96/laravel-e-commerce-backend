import axios from 'axios';
import { useAuthStore } from '@/stores/auth';

// Response interceptor with enhanced error handling
axios.interceptors.response.use(
    response => response,
    error => {
        // Check if error response exists and status is 401
        if (error?.response?.status === 401) {
            const authStore = useAuthStore();
            authStore.handleTokenExpiration();
        }
        
        // Handle network errors
        if (!error.response) {
            console.error('Network Error:', error);
        }
        
        return Promise.reject(error);
    }
);

export default axios;



