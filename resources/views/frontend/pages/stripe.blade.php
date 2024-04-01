@extends('frontend.layouts.master')
@section('title','Stripe Payment Gateway - Morsh Golf')
@section('main-content')

<section class="all-bedcrumbs-sec">
    <div class="bedcrumb-body">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a>Stripe</a></li>
        </ul>
    </div>
</section>


<section class="checkout-sec">
    <div class="checkout-body">
    <h2>Stripe Payment</h2>


    @if (Session::has('success'))
    <div class="alert alert-success text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <p>{{ Session::get('success') }}</p>
    </div>
    @endif

    <div class="">

        <div class="">

         {{--   <form  action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form"> --}}

            <form  action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" id="register_form"> 

            @csrf
            <div class="returns-form">
                        <!-- <div class="form-group">
                            <label for="">Name on Card *</label>
                            <input class='form-control' size='4' type='text'>
                        </div>
  
                        <div class="form-group">
                                <label >Card Number</label> 
                                <input autocomplete='off' class='form-control card-number' size='20' type='text' >
                            </div>
                            <div class="form-group">
                                <label>CVC</label> <input autocomplete='off'
                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                    type='text'>
                            </div>
                            <div class="form-group">
                                <label >Expiration Month/Year</label> 
                                <input class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>&nbsp;  <input class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type="text">
                            </div>
                            <div class="col-md-12 error form-group d-none">
                                <div class="alert-danger alert">Please correct the errors and try
                                    again.</div>
                            </div> -->

                            <div class="form-group">
                                <div id="card-element" style="">
                                                    <!-- Used to display form errors. -->
                                                    <div id="card-errors" role="alert"></div>
                                                
                                </div>
                            </div>

                           
                            <input type="hidden" value="{{$order_id}}" name="order_id" id="order_id">
                           

                            <div class="form-group">
                                <button class="place-order-btn" type="submit" id="submit_btn">Pay Now </button>
                            </div>


                           
                </div> 
            </form>
        </div>
    </div>
</div>
</section>


<script src="https://js.stripe.com/v3/"></script>
   <script>
       
       // Custom styling can be passed to options when creating an Element.
       // (Note that this demo uses a wider set of styles than the guide below.)

       var style = {
           base: {
               color: '#32325d',
               lineHeight: '18px',
               fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
               fontSmoothing: 'antialiased',
               fontSize: '22px',
               width: '500px',
               '::placeholder': {
                   color: '#aab7c4'
               }
           },
           invalid: {
               color: '#fa755a',
               iconColor: '#fa755a'
           }
       };
       
       const stripe = Stripe('{{ env('STRIPE_KEY') }}', { locale: 'en' }); // Create a Stripe client.
       const elements = stripe.elements(); // Create an instance of Elements.
       const cardElement = elements.create('card', { style: style }); // Create an instance of the card Element.

       const cardButton = document.getElementById('submit_btn');
       const clientSecret = cardButton.dataset.secret;
   
       cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

       // Handle real-time validation errors from the card Element.
       cardElement.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

       // Handle form submission.
       var form = document.getElementById('register_form');
   
       form.addEventListener('submit', function(event) {
           event.preventDefault();
            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                // Inform the customer that there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
                }
            });
        });
          
   </script>
   <script>
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            //var form = document.getElementById('register_form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            //form.submit();
            
            var myForm = $("#register_form");
            if (myForm) {   
               // $('#submit_btn').prop('disabled', true);   
                $(myForm).submit();   
            } 

            }
    </script>
@endsection

