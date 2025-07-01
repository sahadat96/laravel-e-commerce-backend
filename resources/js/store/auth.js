import { defineStore } from "pinia";
import axios from 'axios';

export const useAuthStore = defineStore('auth', {
    state: () => {
        return {
            user: null,
            errors: {},
            isAuthenticated: !! localStorage.getItem('token'),
            message:{},
            tokenExpirationTimer: null
        };
    },

    actions: { 
        setAuthenticated(status) {
            this.isAuthenticated = status
          },

          setTokenExpirationTimer(expires_in) {
            // Clear any existing timer
            if (this.tokenExpirationTimer) {
                clearTimeout(this.tokenExpirationTimer);
            }
            
            // Set new timer
            this.tokenExpirationTimer = setTimeout(() => {
                this.handleTokenExpiration();
            }, expires_in * 1000); // Convert to milliseconds
          },

          handleTokenExpiration() {
            localStorage.removeItem('token');
            this.isAuthenticated = false;
            this.user = null;
            this.errors = {};
            this.router.push('/login');
         },


        async login(formData) {
            try {
                const response  = await axios.post('/api/userlogin', formData, {
                    headers: {
                        'Content-Type' : 'application/json',
                        'Accept': 'application/json',
                    },
                });

                const data = response.data.info
                if (!data.errors) {
                   this.errors = {}
                   localStorage.setItem('token', data.token);
                   this.user = data.user;
                   this.setAuthenticated(true);
                    // Set expiration timer
                   this.setTokenExpirationTimer(data.expires_in);
                   this.router.push('/');
                } else {
                   this.errors = data.errors;
                }

            } catch (error) {
                if (error.response) {
                    this.errors = error.response.data.errors;
                } else if (error.request) {
                    this.errors = { message: "network error occurred" };
                } else {
                    this.errors = { message: error.message };
                }
                throw error;
            }
            
        },

        async registration(formData){
            try {
                const response  = await axios.post('/api/userregistration', formData, {
                    headers: {
                        'Content-Type' : 'application/json',
                        'Accept': 'application/json',
                    },
                });

                const data = response.data
                if (!data.errors) {
                   this.errors = {}
                   this.router.push({name: 'login'});
                   this.message = data.message;
                } else {
                   this.errors = data.errors;
                }

            } catch (error) {
                if (error.response) {
                    this.errors = error.response.data.errors;
                } else if (error.request) {
                    this.errors = { message: "network error occurred" };
                } else {
                    this.errors = { message: error.message };
                }
                throw error;
            }
        },
        
        async logout(){
            try {
                const response = await axios.post('/api/logout', {}, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    }
                });

                const data = response.data
                  
                if (data.status === true) {
                    localStorage.removeItem('token');
                    this.isAuthenticated = false;
                    this.user = null
                    this.errors = {}
                    this.router.push('/');
                    this.message = data.message;
                 } else {
                    this.errors = data.errors;
                 }
            } catch (error) {
                if (error.response) {
                    this.errors = error.response.data.errors;
                } else if (error.request) {
                    this.errors = { message: "network error occurred" };
                } else {
                    this.errors = { message: error.message };
                }
                throw error;
            }
         },

         async getUser(){
            try {
                const response = await axios.get('/api/getauthuser', {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`,
                        'Accept': 'application/json',
                    }
                });
                const data = response.data
                if (data.status === true) {
                    this.user = data.get_user;
                 } else {
                    this.errors = data.errors;
                 }
            } catch (error) {
                if (error.response) {
                    this.errors = error.response.data.errors;
                } else if (error.request) {
                    this.errors = { message: "network error occurred" };
                } else {
                    this.errors = { message: error.message };
                }
                throw error;
            }
         },

    },

});