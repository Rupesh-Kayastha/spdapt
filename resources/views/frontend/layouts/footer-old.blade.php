<footer class="morsh-footer-sec">

  <div class="footer-body">

      <div class="footer-left">

          <div class="footer-menu">

              <div class="footer-menu-list">

                  <h3>INFORMATION</h3>

                  <ul>

                      <li><a href="{{ route('about-us') }}">About Us</a></li>

                      <li><a href="{{ route('story') }}">Our Story</a></li>

                      <li><a href="{{ route('delivery-information') }}">Delivery information</a></li>

                      <li><a href="{{ route('privacy') }}">Privacy policy</a></li>

                      <li><a href="{{ route('terms') }}">Terms & conditions</a></li>

                  </ul>

              </div>

              <div class="footer-menu-list">

                  <h3>CUSTOMER SERVICE</h3>

                  <ul>

                      <li><a href="{{ route('contact') }}">Contact us</a></li>

                      <li><a href="#">Guarantee</a></li>

                      <li><a href="{{ route('returns') }}">Returns</a></li>

                  </ul>

              </div>

              <div class="footer-menu-list">

                  <h3>EXTRAS</h3>

                  <ul>

                      <li><a href="#">Affiliates</a></li>

                      <li><a href="#">Partners</a></li>

                      <li><a href="#">E-Newsletter</a></li>

                      <li><a href="#">Online Retailers</a></li>

                      <li><a href="#">Warranty Registration</a></li>

                      <li><a href="#">Certified Pre-owned</a></li>

                  </ul>

              </div>

          </div>

          <div class="about-footer">

              <h3>ABOUT US</h3>

              <p>Since 2015 we try very hard to fulfil every golfer’s dreams – long shots off the tee and fairway.  Not with a driver, but with a 2 wood.</p>

          </div>

      </div>

      <div class="footer-right">

          <div class="footer-news-letter">

              <h2>Stay in touch</h2>

              <p>Subscribe to our newsletter so we can spam you with offers and discounts</p>

                <form action="{{route('subscribe')}}" method="post" class="newsletter-inner">

                  @csrf

                  <input type="text" class="form-control" name="email" placeholder="Enter your e-mail here" >

                  <input type="submit" class="sub-btn" value="Yes, I love a good deal">

              </form>

          </div>

      </div>

  </div>    

  <div class="footer-copyright">

      <p>© {{ date('Y') }} SPDAPT | Development: Rupesh Kayastha</a></p>

      <div class="footer-payment">

          <a href=""><img src="{{ asset('frontend/images/payment-method.png') }}" alt=""></a>

      </div>

  </div>

</footer>



<!-- jQuery first, then Popper.js, then Bootstrap JS --> 

<script src="https://code.jquery.com/jquery-3.6.0.js"></script> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script> 

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> 

<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script> 

<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script> 

<script src="{{ asset('frontend/js/wow.min.js') }}"></script> 

<script src="{{ asset('frontend/js/script.js') }}"></script> 

<script> new WOW().init(); </script>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>-->

<!--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->



<script>
  $(document).ready(function() {
    $('#image_loader').hide();
    $('.show_state_name').hide();

    $('#image_loader_shipping').hide();
    $('.show_state_name_shipping').hide();

    //shipping calculation
    $('.shipping select[name=shipping]').change(function(){
			let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
			let subtotal = parseFloat( $('.order_subtotal').data('price') );
			let coupon = parseFloat( $('.coupon_price').data('price') ) || 0;
			// alert(coupon);
			$('#order_total_price span').text('$'+(subtotal + cost-coupon).toFixed(2));

		});

	// show state in cart page
  $('.nice-select-country').on('change', function() {
    var cat_id=$(this).val();
    if(cat_id !=null){
      //console.log(cat_id);
      // Ajax call
      $.ajax({
        url:"https://www.polosoftech.com/staging/morshgolf/country/"+cat_id+"/child",
        data:{
          _token:"{{csrf_token()}}",
          id:cat_id
        },
        type:"POST",
        beforeSend: function() {
        	$('#image_loader').show();
        },

        success:function(response){
          if(typeof(response) !='object'){
            response=$.parseJSON(response)
          }
          //console.log(response);
          var html_option="<option value=''>---select state---</option>"

          if(response.status===true){
              $('#image_loader').hide();
            var data=response.data;
              //alert(data);
            if(response.data){
                //console.log(response);
              $('.child_cat_hide').removeClass('d-none');
              $('.show_state_name').hide();
              $('#child_cat_id').removeClass('d-none');
              $.each(data,function(id,title){
                html_option +="<option value='"+id+"'>"+title+"</option>"
              });
            }
            else{
            }
          }
          else{
            $('#child_cat_id').addClass('d-none');
            $('#image_loader').hide();
            $('.show_state_name').show();
          }
          $('#child_cat_id').html(html_option);
        }
      });
    }
    else{
    }
  })	


  $('.nice-select-country_shipping').on('change', function() {
    var cat_id=$(this).val();
    if(cat_id !=null){
      //console.log(cat_id);
      // Ajax call
      $.ajax({
        url:"https://www.polosoftech.com/staging/morshgolf/country/"+cat_id+"/child",
        data:{
          _token:"{{csrf_token()}}",
          id:cat_id
        },
        type:"POST",
        beforeSend: function() {
        	$('#image_loader').show();
        },

        success:function(response){
          if(typeof(response) !='object'){
            response=$.parseJSON(response)
          }
          //console.log(response);
          var html_option="<option value=''>---select state---</option>"

          if(response.status===true){
              $('#image_loader_shipping').hide();
            var data=response.data;
              //alert(data);
            if(response.data){
                //console.log(response);
              $('.child_cat_hide_shipping').removeClass('d-none');
              $('.show_state_name_shipping').hide();
              $('#child_cat_id_shipping').removeClass('d-none');
              $.each(data,function(id,title){
                html_option +="<option value='"+id+"'>"+title+"</option>"
              });
            }
            else{
            }
          }
          else{
            $('#child_cat_id_shipping').addClass('d-none');
            $('#image_loader_shipping').hide();
            $('.show_state_name_shipping').show();
          }
          $('#child_cat_id_shipping').html(html_option);
        }
      });
    }
    else{
    }
  })
  $("#defferent_add").on('click',function(){
    if($(this).is(":checked")) {
      $(".shipping_address").removeClass('d-none');
      $(".shipping_address").show();
    } else {
      $(".shipping_address").addClass('d-none');
      $(".shipping_address").show();
    }
  });
});
  $(".shipping_btns").click(function(){

    $(".shippings_details").slideToggle("slow");

  });
    var accountClass = true;
    $(".account-login .account-login-link").click(function () {
        $(".account-popup").addClass('account-popup-open');
        $('.account-popup').toggleClass('account-popup-open');
        accountClass = false;
    });
  $(".account-popup").click(function () {
    accountClass = false;
  });
  $("html").click(function () {
    if (accountClass) {
      $(".account-popup").removeClass('account-popup-open');
    }
    accountClass = true;
  });    
  //check attribute has value or not
  $(".add-to-cart").click(function(){
      var selected_value = $('.attributes').val();
      if($('.attributes').val()===""){
          $("#showerror").html("Please select options before adding this product to your cart.").addClass("showerror");
          $(".attributes").addClass("highlightattribute");
          return false;
      }
  });
</script>


<script src="https://www.paypalobjects.com/api/checkout.js"></script>
   <script type="text/javascript">
        $(document).ready(function() {

          
            
            $('#credit_card').on('click',function(){
                $('#stripeDtls').show();
                $('.showPaypal').hide();
            });
            $('#byPaypal').on('click',function(){
                $('#stripeDtls').hide();
                $('.showPaypal').show();
            });


            
        });

        var totalAmountRaw = '200';
        var totalAmount = parseInt(totalAmountRaw);
        var clientId = 'AYhAPOna-4opZJS8xPEjLVYf-UrWNyVnzCPLkw_VAGRN2MKRQqQK_e4t6NvtTQcT7PbkFdq8uIN36Wf7';
       

        paypal.Button.render({
	        style: {
	             size: 'responsive'
	        },
	        env: 'sandbox', // sandbox | production

	        // PayPal Client IDs - replace with your own
	        // Create a PayPal app: https://developer.paypal.com/developer/applications/create
	        client: {
	            // sandbox: clientId,
	            sandbox: clientId
	        },

	        // Show the buyer a 'Pay Now' button in the checkout flow
	        commit: true,

	        // payment() is called when the button is clicked
	        payment: function(data, actions) {

	            // Make a call to the REST api to create the payment
	            return actions.payment.create({
	                payment: {
	                    transactions: [
	                        {
	                            amount: { total: totalAmount, currency: 'USD' }
	                        }
	                    ]
	                }
	            });
	        },

	        // onAuthorize() is called when the buyer approves the payment
	        onAuthorize: function(data, actions) {
	            // Make a call to the REST api to execute the payment
	            return actions.payment.execute().then(function() {
                    // Ajax Call To Save Data
                    var token = '{{ csrf_token() }}';
                    $.ajax({
                        url:'savepaypalpaymentdata-byajax',
                        method:'POST',
                        data:{'_token':token,'paypalData':data,'paymentTypeId':'1','amount':totalAmount},
                        success:function(data)
                        {
                            location.href = "{{url('/')}}/invoice-generation?info="+data;
                        }
                    });	                
	            });
	        }

        }, '#paypal-button-container');
   </script>
</body>
</html>