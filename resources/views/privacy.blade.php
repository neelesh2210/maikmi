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
                    <p>This Privacy Policy explains how We collects, uses, and
                        shares your personal information when you use our app and website. It also details your rights
                        regarding your data and how you can contact us for inquiries.</p>

                    <h4>1. Information We Collect</h4>
                    <h5>1.1 Registration & Login</h5>
                    <p>When you register or log in to our app, we collect your phone number for OTP-based authentication
                        to ensure account security.</p>

                    <h5>1.2 Profile Information</h5>
                    <p>To create and manage your account, we may collect the following details:</p>
                    <ul>
                        <li>Name</li>
                        <li>Phone number</li>
                        <li>City Name</li>
                        <li>Date of Birth (DOB)</li>
                        <li>Gender</li>
                        <li>Optional Profile Picture (You may choose to upload an image, but it is not mandatory).</li>
                    </ul>

                    <h4>2. How We Use Your Information</h4>
                    <p>We use the collected data to:</p>
                    <ul>
                        <li>Manage your account and provide access to our services.</li>
                        <li>Verify identity and ensure account security.</li>
                        <li>Communicate with you regarding service updates, inquiries, or support requests.</li>
                        <li>Improve our app and services based on user interactions.</li>
                    </ul>

                    <h4>3. Information Sharing & Disclosure</h4>
                    <p>We do not sell, rent, or trade your personal data. However, we may share your information in the
                        following situations:</p>
                    <ul>
                        <li><strong>Legal Requirements:</strong> If required by law, government authorities, or to
                            protect our legal rights.</li>
                        <li><strong>Service Providers:</strong> If necessary, we may share data with trusted third-party
                            providers for essential services (e.g., cloud hosting, analytics) while ensuring compliance
                            with data protection laws.</li>
                    </ul>

                    <h4>4. Data Security</h4>
                    <p>We implement industry-standard security measures to protect your personal information against
                        unauthorized access, loss, misuse, or disclosure. However, no method of transmission over the
                        internet is 100% secure.</p>

                    <h4>5. Data Retention & Deletion</h4>
                    <p>We retain your personal data only as long as necessary for the purposes outlined in this policy.
                    </p>
                    <p>If you wish to delete your account and associated data, you may contact us via the provided
                        support channels.</p>

                    <h4>6. Your Rights & Control Over Data</h4>
                    <p>You have the right to:</p>
                    <ul>
                        <li>Access, update, or delete your personal information.</li>
                        <li>Withdraw consent for data collection (this may limit certain functionalities).</li>
                        <li>Contact us for inquiries about how we handle your data.</li>
                    </ul>

                    <h4>7. Privacy Policy Updates</h4>
                    <p>We may update this Privacy Policy periodically. Any changes will be posted in the app and on our
                        website. Continued use of our services constitutes your acceptance of the updated policy.</p>

                    <h4>8. Contact Information</h4>
                    <p>If you have any questions about this Privacy Policy or data protection, you can contact us:</p>
                    <ul>
                        <li><strong>Email:</strong> support@maikmi.com</li>
                        <li><strong>Phone:</strong> +91-80091 64221</li>
                        <li><strong>Website:</strong> https://maikmi.in/</li>
                    </ul>
                    <p>By using our app, you acknowledge that you have read and understood this Privacy Policy and agree
                        to its terms.</p>
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
                                &copy; Maikmi, All Right Reserved. Designed By <a class="text-primary"
                                    href="#">Adian
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
