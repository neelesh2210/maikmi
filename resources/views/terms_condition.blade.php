<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MAIKMI - Unleash Your Beauty Potential</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/icon.png" rel="icon">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!--Stylesheet -->
    <link href="{{ asset('website/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('website/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('website/css/style.css') }}" rel="stylesheet">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <style>
        .footer-link-content {
            padding-top: 130px;
        }
    </style>
</head>

<body>
    <div class="container-xxl p-0">
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="{{route('frontend.index')}}" class="navbar-brand p-0">
                    <img src="{{ asset('website/img/logo.png') }}" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="" class="nav-item nav-link active">Home</a>
                        <a href="#about" class="nav-item nav-link">About Us</a>
                        <a href="#services" class="nav-item nav-link">Services</a>
                        <a href="#gallery" class="nav-item nav-link">Gallery</a>
                        <a href="#contact-us" class="nav-item nav-link">Contact Us</a>
                    </div>
                </div>
            </nav>
        </div>

        <div class="container footer-link-content">
            <div class="row">
              <div class="col-lg-12 col-md-12">
                <h2 class="title mb-0">Terms and <span>Conditions of Use</span></h2>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-lg-12 col-md-12">
                <h5 class="text-theme">1. Introduction</h5>
                <p class="mb-3"> Welcome to our app and website providing information about near by shops in various cities. By using our services, you agree to comply with and be bound by the following terms and conditions. Please read them carefully.</p>
                <h5 class="text-theme mt-3">2. Accuracy of Information</h5>
                <ul class="list-unstyled mb-3 list-icon">
                  <li><i class="fa fa-angle-right"></i> The information provided in this app and website is for general informational purposes only.</li>
                  <li><i class="fa fa-angle-right"></i> While we strive to provide accurate and up-to-date information, we cannot guarantee the accuracy, completeness, or reliability of the content. Information may be subject to change without notice.</li>
                  <li><i class="fa fa-angle-right"></i> Users are advised to verify the information with the respective near by shops or authorities for accuracy and any updates.</li>
              </ul>
                <h5 class="text-theme mt-3"> 3. Manual Verification</h5>
                <ul class="list-unstyled mb-3 list-icon">
                  <li><i class="fa fa-angle-right"></i> The data presented in this app and website is subject to manual verification.</li>
                  <li><i class="fa fa-angle-right"></i> We rely on various sources to collect and update information, but we cannot guarantee its authenticity or accuracy.</li>
                </ul>
                <h5 class="text-theme mt-3">5. Liability</h5>
                <ul class="list-unstyled mb-3 list-icon">
                  <li> <i class="fa fa-angle-right"></i>We shall not be held responsible for any loss, damage, or inconvenience arising from the use of information provided on this platform.
                  </li>
                  <li> <i class="fa fa-angle-right"></i> Users are encouraged to use their discretion and consult professionals for specific medical advice or services.</li>
                </ul>
                <h5 class="text-theme mt-3">6. Changes to Terms and Conditions</h5>
                <p class="mb-3">  We reserve the right to modify or replace these terms and conditions at any time. Any changes will be effective immediately upon posting.</p>
              <p>By using this app and website, you acknowledge that you have read and understood these terms and conditions and agree to be bound by them.</p>
              <p>Please note that this is a sample and may need to be adjusted based on the specific services and functionalities of your app and website.</p>
              </div>
            </div>
          </div>

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5" style="border-top: 1px solid rgba(256, 256, 256, 0.1);">
                <div class="row g-5">
                    <div class="col-lg-6 col-md-6">
                        <a href="" class="footer-brand p-0">
                            <img src="{{ asset('website/img/logo.png') }}" alt="Logo">
                        </a>
                        <p>
                            Step into Maikmi and experience a haven of relaxation and transformation.
                            Our app is designed to create a comfortable and friendly space where you
                            can unwind while we work our magic on your beauty needs.
                        </p>
                    </div>
                    <div class="col-lg-3 col-6">
                        <h4 class="text-start text-primary fw-normal mb-4">Quick Links</h4>
                        <a class="btn btn-link" href="#about">About Us</a>
                        <a class="btn btn-link" href="#contact-us">Contact Us</a>
                        <a class="btn btn-link" href="{{ route('frontend.privacy') }}">Privacy Policy</a>
                        <a class="btn btn-link" href=""{{ route('frontend.terms') }}>Terms & Condition</a>
                    </div>

                    <div class="col-lg-3 col-6">
                        <h4 class="text-start text-primary fw-normal mb-4">Support Time</h4>
                        <h5 class="text-pink fw-normal">Monday - Saturday</h5>
                        <p>10AM : 06.00PM</p>
                        <h5 class="text-pink fw-normal">Sunday</h5>
                        <p>- Closed</p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; Maikmi, All Right Reserved. Designed By <a class="text-primary" href="#">Adian
                                Infotech</a>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-outline-light btn-social" href="">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="btn btn-outline-light btn-social" href="">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="btn btn-outline-light btn-social" href="">
                                    <i class="fab fa-youtube"></i>
                                </a>
                                <a class="btn btn-outline-light btn-social" href="">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
    </div>
</body>
