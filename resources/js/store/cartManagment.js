import { defineStore } from "pinia";
import axios from "axios";

export const  useCartStore = defineStore('cart', {
        state: () => ({
            cartItems: [],
            loading: false,
            error: null,
            message: null,
            totalPrice: 0,
            grand_total:0,
            total_deliveryCharge:0
        }),

        getters: {
            cartCount: (state) => state.cartItems.length,
            calculatedTotalPrice: (state) => {
              return state.cartItems.reduce((total, item) => {
                return total + (item.price * item.qnt)
              }, 0)
            }
        },

        actions: {
            async addToCart(cartItem) {
              try {
                this.loading = true
                const token = localStorage.getItem('token')
                
                const response = await axios.post('/api/addtocart', cartItem, {
                  headers: { 
                    'Authorization': `Bearer ${token}`
                  }
                })
                this.message = response.data.message;
                return true;
              } catch (err) {
                this.error = err.response?.data?.message || 'Error adding to cart'
                return false
              } finally {
                this.loading = false
              }
            },
        
            async fetchCartItems() {
              this.loading = true
              
              try {
                const token = localStorage.getItem('token')
                
                const response = await axios.get('/api/getcart', {
                  headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                  }
                })
            
                this.cartItems = response.data.carts
                this.totalPrice = response.data.totalPrice
                this.total_deliveryCharge = response.data.totalDeliveryCharge
                this.grand_total = response.data.grandTotal
            
                return true
            
              } catch (error) {
                this.error = error.response?.data?.message || 'Failed to fetch cart items'
                return false
                
              } finally {
                this.loading = false
              }
            },
            

            async removeCartItem(cartId) {
              try {
                this.loading = true
                const token = localStorage.getItem('token')
        
                await axios.delete(`/api/cartdelete/${cartId}`, {
                  headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                  }
                })
        
                this.cartItems = this.cartItems.filter(item => item.id !== cartId);
                this.totalPrice = this.calculatedTotalPrice;
                return true
              } catch (error) {
                this.error = error.response?.data?.message || 'Failed to remove item'
                return false
              } finally {
                this.loading = false
              }
            },
        
        
        }
       
});