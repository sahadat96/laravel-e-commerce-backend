jQuery(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 //ajax for add to cart from product details page
   jQuery(document).on("click", '#cartFromDetal', function(){
        let id = jQuery(this).val();
        let color = jQuery('#color').val();
        let size = jQuery('#size').val();
        let qnt = jQuery('#qnt-'+ id).val();

         // Validation checks
         if (!color) {
            Swal.fire({
                icon: 'warning',
                title: 'Please select a color.',
            });
            jQuery('#color').focus();
            return false;
        }
        if (!size) {
            Swal.fire({
                icon: 'warning',
                title:'Please select a size.',
            });
            jQuery('#size').focus();
            return false;
        }
        if (!qnt || qnt <= 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Please enter a valid quantity.',
            });
            jQuery('#p_qnt-' + id).focus();
            return false;
        }
       
       jQuery.ajax({
          url:'/addtocart/'+id,
          type:'POST',
          data:{
            product_size:size,
            product_color:color,
            product_quantity:qnt,
          },
          success:function(res){
            Swal.fire({
                width: 400,
                position: "top-end",
                icon: "success",
                title: res.msg,
                showConfirmButton: false,
                timer: 1600
            });
            show();
          }

        });
    });

 //ajax for sent data to route
    jQuery(document).on("click", '.qview_btn', function(){
 
        let id = jQuery(this).val();
        let color = jQuery('#color-'+ id).val();
        let size = jQuery('#size-'+ id).val();
        let qnt = jQuery('#p_qnt-'+ id).val();
        
         // Validation checks
         if (!color) {
            Swal.fire({
                icon: 'warning',
                title: 'Please select a color.',
            });
            jQuery('#color-' + id).focus();
            return false;
        }
        if (!size) {
            Swal.fire({
                icon: 'warning',
                title:'Please select a size.',
            });
            jQuery('#size-' + id).focus();
            return false;
        }
        if (!qnt || qnt <= 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Please enter a valid quantity.',
            });
            jQuery('#p_qnt-' + id).focus();
            return false;
        }
      
        jQuery.ajax({
            url: '/addtocart/'+ id,
            type: 'POST',
            data:{
                    product_size:size,
                    product_color:color,
                    product_quantity:qnt
            },
            success: function(res){
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: res.msg,
                    showConfirmButton: false,
                    timer: 1500
                  });
                show();
            }
        });
    });

    show()
    function show(){

         jQuery.ajax({
            url:'/addtocartshow',
            type:'GET',
            success:function(res){  
                let  alldata='';
                let sum=0;
                let count=0;

                $.each(res.data, function(key, val){
                   let total_ammount = val.qnt * val.price; 
                   sum += total_ammount;
                   count++;
                    alldata +='<li>\
                    <div class="shopping-cart-img">\
                        <a href="#"><img alt="" src="http://127.0.0.1:8000/uploads/product/product_photo/'+val.image+'"></a>\
                    </div>\
                    <div class="shopping-cart-title">\
                        <h4><a href="#">'+val.product_name+'</a></h4>\
                        <h4><span>'+val.qnt+' × </span>৳'+val.price+'</h4>\
                    </div>\
                    <div class="shopping-cart-delete">\
                        <button value="'+val.id+'" type="button" class="btn-close  removeItem" aria-label="Close"></button>\
                    </div>\
                    </li>';
                });
                jQuery('.cartinfo').html(alldata);
                jQuery('.totalAmount').html(sum);
                jQuery('.totalCount').html(count);
            }
         });

         jQuery.ajax({
           url:'/cartviewpage',
           type:'GET',
           success:function(res){
             let productdata ='';
             let count = 0;
             let total_ammount = 0;
             let delivery_charge = 0;
             
             $.each(res.data, function(key, val){
                let ammount = val.qnt * val.price;
                total_ammount += ammount + val.delivery_charge;
                count ++;
                delivery_charge +=val.delivery_charge;

                let delivery_charge_limit = 100;
                if (delivery_charge >= delivery_charge_limit) {
                    delivery_charge = 100;
                }
                
                productdata +='<tr ><td class="custome-checkbox pl-30">\
                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value=""\
                <label class="form-check-label" for="exampleCheckbox3"></label>\
            </td>\
            <td class="image product-thumbnail"><img src="http://127.0.0.1:8000/uploads/product/product_photo/'+val.image+'"></td>\
            <td class="product-des ">\
                <h6 class="mb-5"><a class="product-name mb-10 text-heading" >'+val.product_name+'</a></h6>\
            </td>\
            <td class="price" data-title="Price">\
                <h4 class="text-body">৳ '+val.price+' </h4>\
            </td>\
            <td class="text-center detail-info" data-title="Stock">\
                <div class="detail-extralink mr-15">\
                    <div class="detail-qty border radius">\
                <h4 class="text-body"> × '+val.qnt+' </h4>\
                    </div>\
                </div>\
            </td>\
            <td class="price" data-title="Price">\
                <h4 class="text-brand"> '+ammount+'</h4>\
            </td>\
            <td class="action text-center" data-title="Remove">\
                <button value="'+val.id+'" type="button" class="btn btn-outline-danger removeItem " aria-label="Close">\
                  <i class="bi bi-trash"></i>\
                </button>\
                </tr></td>';
                
                
             });
             jQuery('.product_name').html(productdata);
             jQuery('.ammount_delivery').html(total_ammount);
             jQuery('.delivery_charge').html(delivery_charge);
             

           }

         });
     }

        jQuery(document).on("click", '.removeItem', function(){
            var id = jQuery(this).val();
            
            jQuery.ajax({
                url: " /removeitem/"+ id,
                type: "GET",
                success: function(res){
                
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: res.msg,
                    showConfirmButton: false,
                    timer: 1500
                });
                show();
                }
         });
        
      });



});






