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
                <a href="{{ route('frontend.index') }}" class="navbar-brand p-0">
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
                    <h2 class="title mb-0">Privacy <span>Policy</span></h2>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12 col-md-12">
                    <p>This Privacy Policy outlines how we collect, use, and share your personal information when you
                        use our app and website for account management and query resolution.
                    </p>
                    <h5 class="text-theme">1. Information Collection and Use</h5>
                    <p class="mb-3"> <strong>Registration and Login : </strong> When you register and log in to our
                        app, we collect your phone number for OTP-based authentication. This ensures the security of
                        your account.</p>
                    <p class="mb-3"> <strong>Profile Information : </strong>We may collect the following information
                        to create and manage your account:.</p>
                    <p>- City name</p>
                    <p>- Name</p>
                    <p>- Phone number</p>
                    <p>- Date of Birth (DOB)</p>
                    <p>- Gender</p>
                    <p class="mb-3"> <strong>Optional Profile Picture : </strong>You have the option to upload a
                        profile picture, which is not mandatory for using our services.</p>
                    <h5 class="text-theme mt-3">2. Use of Information</h5>
                    <ul class="list-unstyled mb-3 list-icon">
                        <li><i class="fa fa-angle-right"></i> <strong>Account Management : </strong>We use the collected
                            information to manage your account, provide access to our services, and assist with query
                            resolution. </li>
                        <li><i class="fa fa-angle-right"></i> <strong>Communication : </strong> We may use your contact
                            information to communicate with you regarding your account, queries, and updates related to
                            our services.</li>
                    </ul>
                    <h5 class="text-theme mt-3"> 3. Information Sharing</h5>
                    <p><strong>Third-Party Sharing :</strong> We do not share your personal information with third
                        parties unless required by law or for the purpose of resolving queries related to our services.
                    </p>
                    <h5 class="text-theme mt-3">4. Security</h5>
                    <p><strong>Data Security :</strong> We implement security measures to protect your personal
                        information from unauthorized access, alteration, disclosure, or destruction.
                    </p>
                    <h5 class="text-theme mt-3">5. Data Retention</h5>
                    <p>We retain your personal information as long as it is necessary for the purposes outlined in this
                        Privacy Policy.
                    </p>
                    <h5 class="text-theme mt-3">6. User Rights</h5>
                    <p class="mb-3"> You have the right to access, correct, or delete your personal information.
                        Please contact us if you wish to exercise any of these rights.</p>
                    <h5 class="text-theme mt-3">7. Updates to Privacy Policy</h5>
                    <p>We may update this Privacy Policy from time to time. Any changes will be effective immediately
                        upon posting.</p>
                    <p>By using our app and website, you acknowledge that you have read and understood this Privacy
                        Policy and agree to the collection and use of your personal information as described herein.</p>
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
                        <a class="btn btn-link" href="{{ route('frontend.terms') }}">Terms & Condition</a>
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
