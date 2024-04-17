@php $settings=DB::table('settings')->get(); @endphp
<footer class="morsh-footer-sec">
    <div class="footer-body">
        <div class="footer-left">
            <div class="footer-menu">
                <div class="footer-menu-list">
                    <h3>INFORMATION</h3>
                    <ul>
                        <li><a href="{{ route('about-us') }}">About Us</a></li>
                        {{-- <li><a href="{{ route('story') }}">Our Story</a></li> --}}
                        {{-- <li><a href="{{ route('delivery-information') }}">Delivery information</a></li> --}}
                        <li><a href="{{ route('privacy') }}">Privacy policy</a></li>
                        <li><a href="{{ route('terms') }}">Terms & conditions</a></li>
                    </ul>
                </div>
                <div class="footer-menu-list">
                    <h3>CUSTOMER SERVICE</h3>
                    <ul>
                        <li><a href="{{ route('contact') }}">Contact us</a></li>
                        <li><a href="{{ route('guarantee') }}">Guarantee</a></li>
                        {{-- <li><a href="{{ route('returns') }}">Returns</a></li> --}}
                    </ul>
                </div>
                {{-- <div class="footer-menu-list">
                    <h3>EXTRAS</h3>
                    <ul>
                        <li><a href="{{ route('affiliates') }}">Affiliates</a></li>
                        <li><a href="{{ route('partners') }}">Partners</a></li>
                    </ul>
                </div> --}}
            </div>
            <div class="about-footer">
                <h3>ABOUT US</h3>
                <p>{{ $settings[0]->home_page_about_us }} <a href="{{ route('about-us') }}" style="color: #fff;">Read
                        more...</a></p>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p>{{ $settings[0]->location_map }}</p>
        <div class="footer-payment"> <a href=""><img src="{{ asset('frontend/images/payment-method.png') }}" alt=""></a>
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
<script src="{{ asset('frontend/js/slick-lightbox.min.js') }}"></script>
<script src="{{ asset('frontend/js/slick.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>
<script src="{{ asset('frontend/js/script.js') }}"></script>
<script>
    new WOW().init(); 
</script>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>-->

<!--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
<script>
    function setCurrency(currency) {
        $.ajax({
            url:"{{ route('set-currency') }}",
            data:{
                _token:"{{csrf_token()}}",
                currency:currency
            },
            type:"POST",
            success:function(response){
                location.reload(true);
            }
        });     
    }

    const dropdowns = document.querySelectorAll(".dropdown");
    dropdowns.forEach((dropdown) => {
        const select = document.querySelector(".select");
        const caret = document.querySelector(".caret");
        const menu = document.querySelector(".menu");
        const options = document.querySelectorAll(".menu li");
        const selected = document.querySelector(".selected");
        select.addEventListener("click", () => {
            caret.classList.toggle("caret-rotate");
            menu.classList.toggle("menu-open");
        });

        options.forEach((option) => {
            option.addEventListener("click", () => {
                selected.classList.remove("placeholder");
                selected.innerText = option.innerText;
                caret.classList.remove("caret-rotate");
                menu.classList.remove("menu-open");
                options.forEach((option) => option.classList.remove("active"));
                option.classList.add("active");
            });
        });
    });

    const header = document.querySelector(".pages-header");
    const toggleClass = "is-sticky";

    window.addEventListener("scroll", () => {
        const currentScroll = window.pageYOffset;
        if (currentScroll > 100) {
            header.classList.add(toggleClass);
        } else {
            header.classList.remove(toggleClass);
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('.header-part:contains("Powered by")').html('');
        $('#image_loader').hide();
        $('#image_loader_shipping').hide();

        $('.show_state_name').hide();
        $('.show_state_name_shipping').hide();

        $('.shipping select[name=shipping]').change(function(){

			let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
			let subtotal = parseFloat( $('.order_subtotal').data('price') );
			let coupon = parseFloat( $('.coupon_price').data('price') ) || 0;
			$('#order_total_price span').text('$'+(subtotal + cost - coupon).toFixed(2));

		});

        // show state in cart page
        $('.nice-select-country').on('change', function() {
            var cat_id=$(this).val();
            if(cat_id !=null){
                $.ajax({
                    url:"{{ route('show-state-country-wise') }}",
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

                        var html_option="<option value=''>---select state---</option>"
                        if(response.status===true){
                            $('#image_loader').hide();
                            var data=response.data;
                            if(response.data){
                                $('.child_cat_hide').removeClass('d-none');
                                $('.show_state_name').hide();
                                $('#child_cat_id').removeClass('d-none');
                                $.each(data,function(id,title){
                                    html_option +="<option value='"+id+"'>"+title+"</option>"
                                });
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

            $.ajax({
                url: "{{ route('shipping-stor') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    shipping_country: cat_id,
                }
            })
            .done(function(response) {
                var total_amount_data  = $('#total_amount_data').val();
                var shipping_product  = $('#shipping_product').val();
                if(shipping_product == 11) {
                    var resultData = parseFloat(total_amount_data);
                } else {
                    var resultData = parseFloat(response[0].shipping_charge) + parseFloat(total_amount_data);
                }
                
                resultData = resultData.toFixed(2);

                var shipping_charge_data = parseFloat(response[0].shipping_charge);
                result_shipping_charge_data = shipping_charge_data.toFixed(2);

                if(result_shipping_charge_data > 0){
                    $("#shipping_method").show();
                    $("#shipping_method_1").hide();
                    $("#shipping_country_name").html(response[0].shipping_country_name);
                    if(shipping_product == 11) {
                        $("#shipping_charge").html('00.00');
                    } else {
                        $("#shipping_charge").html(result_shipping_charge_data);
                    }
                    
                    $(".shipping_charge_data").html(resultData);
                } else {
                    $("#shipping_method").hide();
                    $("#shipping_method_1").show();
                    $("#shipping_log").html("There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.");
                }
                
            })
            .fail(function(response) {
                $("#shipping_method").hide();
                $("#shipping_method_1").show();
            });
        })	


        // show state in cart page
        $('.nice-select-country_shipping').on('change', function() {
            var cat_id=$(this).val();
            if(cat_id !=null){
                $.ajax({
                    url:"{{ route('show-state-country-wise') }}",
                    data:{
                        _token:"{{csrf_token()}}",
                        id:cat_id
                    },
                    type:"POST",
                    beforeSend: function() {
                        $('#image_loader_shipping').show();
                    },
                    success:function(response){
                    if(typeof(response) !='object'){
                        response=$.parseJSON(response)
                    }
                    var html_option="<option value=''>---select state---</option>"
                    if(response.status===true){
                        $('#image_loader_shipping').hide();
                        var data=response.data;
                        if(response.data){
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
            
        })	
    });

    $(document).ready(function() {
        $('.shipping_address').hide();
        $('#ship_to_different').click(function() {
            if ($(this).is(':checked')) {
                $('#ship_to_different').val('1');
            $('.shipping_address').show();
            } else {
                $('#ship_to_different').val('');
            $('.shipping_address').hide();
            }
        });
    });

    $(".shipping_btns").click(function(){
        $(".shippings_details").slideToggle("slow");
    });
    
    $(".shipping_btns_checkout").click(function(){
        $(".shippings_details_checkout").slideToggle("slow");
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

    var Cookie = {
        set: function (name, value, days) {
            var domain, domainParts, date, expires, host;

            if (days) {
                date = new Date();
                date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
                expires = "; expires=" + date.toGMTString();
            } else {
                expires = "";
            }

            host = location.host;
            if (host.split(".").length === 1) {
                document.cookie = name + "=" + value + expires + "; path=/";
            } else {
                domainParts = host.split(".");
                domainParts.shift();
                domain = "." + domainParts.join(".");

                document.cookie =
                    name + "=" + value + expires + "; path=/; domain=" + domain;
                if (Cookie.get(name) == null || Cookie.get(name) != value) {
                    domain = "." + host;
                    document.cookie =
                        name + "=" + value + expires + "; path=/; domain=" + domain;
                }
            }
        },

        get: function (name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(";");
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == " ") {
                    c = c.substring(1, c.length);
                }

                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        },

        erase: function (name) {
            Cookie.set(name, "", -1);
        }
    };


    function googleTranslateElementInit() {
        let url = new URL(window.location);
        let lang = url.searchParams.get("lang");
        
        if (lang) {
            console.log(lang);
            Cookies.set("googtrans", `/en/${lang}`, {
                path: "",
                domain: location.host
            });
        } else {
            Cookie.erase("googtrans");
        }

        // Wait for Google Translate API to load before initializing
        function initializeTranslate() {
            new google.translate.TranslateElement({
                pageLanguage: 'auto', // or set it to a specific default language code
            }, 'translate');

            // Add event listener to change URL param on language selection change
            let langSelector = document.querySelector(".goog-te-combo");
            langSelector.addEventListener("change", function () {
                let lang = langSelector.value;
                var newurl =
                    window.location.protocol +
                    "//" +
                    window.location.host +
                    window.location.pathname +
                    "?lang=" +
                    lang;
                window.history.pushState({
                    path: newurl
                }, "", newurl);
            });
        }

        // Check if the Google Translate API is already loaded
        if (typeof google !== 'undefined' && google.translate) {
            initializeTranslate();
        } else {
            // If not loaded, wait for the API to load
            window.onGoogleTranslateApiLoad = initializeTranslate;

            // Load the Google Translate API script
            var googleTranslateScript = document.createElement("script");
            googleTranslateScript.type = "text/javascript";
            googleTranslateScript.src =
                "//translate.google.com/translate_a/element.js?cb=onGoogleTranslateApiLoad";
            (
                document.getElementsByTagName("head")[0] ||
                document.getElementsByTagName("body")[0]
            ).appendChild(googleTranslateScript);
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        (function () {
            googleTranslateElementInit();
        })();
    });

    $(document).ready(function() {
        var offerClass = true;    
        $(window).on('load', function() {
            $('.offer-popup-sec').addClass('offer-popup-sec-open');
            offerClass = false;
        });

        $(".offer-popup-body").click(function () {
            offerClass = false;
        });

        $("html").click(function () {
            if (offerClass) {
                $(".offer-popup-sec").removeClass('offer-popup-sec-open');
            }
            offerClass = true;
        });    
        
        $(".popup-close-btn").click(function () {
            $(".offer-popup-sec").removeClass('offer-popup-sec-open');
            offerClass = true;
        });   
	});
    

</script>
<style>
    body {
        top: 0px !important;
        position: unset !important;
    }

    body>.skiptranslate {
        display: none;
    }

    #translate .goog-te-gadget {
        font-size: 0;
    }

    #translate .goog-te-gadget span {
        display: none;
    }

    .offer-popup-sec {
        margin: 0;
        padding: 0;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #0000007a;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        transition: all 0.3s ease-in-out;
        visibility: hidden;
        opacity: 0;
    }

    .offer-popup-sec.offer-popup-sec-open {
        visibility: visible;
        opacity: 1;
    }

    .offer-popup-sec .offer-popup-body {
        margin: 0;
        padding: 30px;
        background: #FFF;
        max-width: 800px;
        width: 100%;
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0 10px;
        position: relative;
        transform: scale(0.8);
        visibility: hidden;
        opacity: 0;
    }

    .offer-popup-sec.offer-popup-sec-open .offer-popup-body {
        transform: scale(1);
        visibility: visible;
        opacity: 1;
        transition: all 0.3s ease-in-out;
    }

    .offer-popup-sec .offer-popup-body a.popup-close-btn {
        margin: 0;
        padding: 0;
        position: absolute;
        top: 30px;
        right: 30px;
        font-size: 26px;
        line-height: 16px;
        color: #000;
        height: fit-content;
        width: fit-content;
    }

    .offer-popup-body .popup-content {
        margin: 0;
        padding: 0;
        position: relative;
        max-width: 460px;
    }

    .offer-popup-body .popup-content h3 {
        margin: 0 0 20px 0;
        padding: 0;
        position: relative;
        font-size: 18px;
        font-weight: 700;
        color: #ff8401;
        letter-spacing: 2px;
    }

    .offer-popup-body .popup-content h2 {
        margin: 0 0 20px 0;
        padding: 0 0 20px 0;
        position: relative;
        font-size: 22px;
        font-weight: 700;
        line-height: 32px;
        color: #000;
    }

    .offer-popup-body .popup-content h2:before {
        position: absolute;
        content: '';
        left: 0;
        bottom: 0;
        width: 202px;
        height: 3px;
        background: #ff8401;
    }

    .offer-popup-body .popup-content p {
        margin: 40px 0;
        padding: 0;
        position: relative;
        font-size: 15px;
        font-weight: 500;
        color: #000;
    }

    .offer-popup-body .popup-content p span {
        position: relative;
        display: block;
        font-size: 58px;
        font-weight: 700;
        color: #00895e;
        line-height: 66px;
    }

    .offer-popup-body .popup-content a.book-now-btn {
        position: relative;
        background: #ffd800;
        height: 60px;
        width: 210px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #000;
        font-weight: bold;
        border-radius: 100px;
        font-size: 16px;
        gap: 0 13px;
    }
</style>
</body>

</html>