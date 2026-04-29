<link href="{{asset('FrontEnd')}}/assets/css/styles.css" rel="stylesheet">
<!-- Bootstrap CSS -->
{{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"--}}
{{--integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">--}}


<!-- Google Font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,900;1,700&display=swap"
rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMz1Q1bO6EN4r6KFc2U4eVg0L3qLwY2Zbm2DOV" crossorigin="anonymous">
<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/686e4da3bd.js" crossorigin="anonymous"></script>

<!-- owl Carousel -->
<link rel="stylesheet" href="{{ asset('FrontEnd') }}/assect/css/owl.carousel.min.css">
<link rel="stylesheet" href="{{ asset('FrontEnd') }}/assect/css/owl.theme.default.min.css">
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    .header-fixed .headd-sty-wrap {
        padding: 5px 0px !important;
    }
    .user-account-desktop {
        display: flex !important;
    }
    .user-account-mobile, .mobile-search {
        display: none !important;
    }
    @media (max-width: 768px) {
        .header {
            background-color: #fff !important;
            position: fixed;
            z-index: 99999;
            margin: 0;
            padding: 0;
            width: 100%;
        }
        
        .call-us-link, .call-us-text, .cart-text, .header-search-wrapper, .top-header, .user-account-desktop {
            display: none !important;
        }
        
        .user-account-mobile, .mobile-search {
            display: block !important;
        }
        .nav-toggle {
            margin-top: 98px;
            display: block;
            z-index: 999999;
            position: fixed !important;
            top: -7% !important;
            left: 15px !important;
            
        }
        
        .nav-brand img {
            max-width: 85px;
            position: absolute;
            top: 20%;
            margin-left: 10px;
        }

        .nav-menus-wrapper {
            z-index: 999999 !important;
        }
        .dn-counter {
            margin-left: -10px;
            top: -14;
        }
        .page-content {
            margin-top: 86px;
        }
        .w3-ch-sideBar {
            z-index: 999999;
        }
        
        .marquee {
            padding-bottom: 0px !important;
        }
    }
    
    @media (max-width: 380px) { 
        .nav-toggle {
            top: -7% !important;

        }
    }
    


/* Third level column layout */
.third-level-columns {
    display: none;
    position: absolute;
}

/* Show on hover */
.nav-menu li:hover > .third-level-columns {
    display: flex;
    gap: 40px;
    padding: 20px;
}

/* Remove bullets */
.third-inner {
    list-style: none;
    padding: 0;
    margin: 0;
}

.third-inner li {
    margin-bottom: 6px;
}
</style>





<!-- Custom Style Sheet -->
{{--<link rel="stylesheet" href="{{ asset('FrontEnd') }}/assect/css/style.css">--}}
{{--<link rel="stylesheet" href="{{ asset('FrontEnd') }}/assect/css/sweetalert2.css">--}}

{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />--}}





















  

