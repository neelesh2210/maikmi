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
</head>

<body>
    <div class="container-xxl p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-pink" style="width: 3rem; height: 3rem;" role="status"></div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <img src="{{ asset('website/img/logo.png') }}" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="index.html" class="nav-item nav-link active">Home</a>
                        <a href="" class="nav-item nav-link">Gallery</a>
                        <a href="" class="nav-item nav-link">About Us</a>
                        <a href="" class="nav-item nav-link">Contact Us</a>
                    </div>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container my-5 py-5">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-7 text-center text-lg-start">
                            <h1 class="display-3 text-white animated slideInLeft">
                                Unleash Your <br>
                                <span class="text-primary">Beauty</span> Potential
                            </h1>
                            <p class="text-white animated slideInLeft mb-4 pb-2">
                                Maikmi is more than just a booking app; it's a lifestyle upgrade. We've carefully
                                crafted a user-friendly platform that seamlessly connects beauty enthusiasts with
                                top-notch salons, spas, and beauty experts.
                            </p>
                            <a href=""
                                class="btn btn-pink text-white py-sm-3 px-sm-5 me-3 animated slideInLeft custom-btn">
                                Explore Gallery
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h2 class="section-title ff-secondary text-start text-primary fw-normal">About Us</h2>
                        <h1 class="mb-4">Welcome to <span class="text-pink">Maikmi</span></h1>
                        <p class="mb-4">
                            The revolutionary app designed to simplify and enhance your beauty and wellness experience.
                            We understand the importance of self-care in today's fast-paced world, and our mission is to
                            make it easier for you to book appointments with your favorite salons, spas, and beauty
                            professionals.
                        </p>
                        <p class="mb-4">
                            Maikmi is more than just a booking app; it's a lifestyle upgrade. We've carefully crafted a
                            user-friendly platform that seamlessly connects beauty enthusiasts with top-notch salons,
                            spas, and beauty experts. Whether you're looking for a haircut, a rejuvenating spa day, or
                            any beauty-related service, Maikmi is your go-to destination.
                        </p>
                        <a class="btn btn-pink text-white py-3 px-5 mt-2 custom-btn" href="">Read More</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-3 img-about">
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s"
                                    src="{{ asset('website/img/salon1.jpg') }}">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s"
                                    src="{{ asset('website/img/salon2.jpg') }}">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.5s"
                                    src="{{ asset('website/img/salon3.jpg') }}">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s"
                                    src="{{ asset('website/img/salon4.jpg') }}">
                            </div>
                            <div class="maikmi-absolute">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.8s"
                                    src="{{ asset('website/img/maikmi.png') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Service Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-title ff-secondary text-center text-primary fw-normal">Our Services</h2>
                    <h1 class="mb-5">What We <span class="text-pink">Provide</span></h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-sm-6">
                        <div class="service-item rounded w-100 wow zoomIn" data-wow-delay="0.7s">
                            <h5>Haircuts & Styling</h5>
                            <div class="bg-absolute"></div>
                            <img class="img-fluid rounded" src="{{ asset('website/img/salon1.jpg') }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="service-item rounded w-100 wow fadeInUp" data-wow-delay="0.3s">
                            <h5>Hair Coloring</h5>
                            <div class="bg-absolute"></div>
                            <img class="img-fluid rounded" src="{{ asset('website/img/salon2.jpg') }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="service-item rounded w-100 wow fadeInUp" data-wow-delay="0.5s">
                            <h5>Facials & Skin Care</h5>
                            <div class="bg-absolute"></div>
                            <img class="img-fluid rounded" src="{{ asset('website/img/salon3.jpg') }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="service-item rounded w-100 wow fadeInUp" data-wow-delay="0.7s">
                            <h5>Manicures and Pedicures</h5>
                            <div class="bg-absolute"></div>
                            <img class="img-fluid rounded" src="{{ asset('website/img/salon4.jpg') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->

        <!-- Testimonial Start -->
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-title ff-secondary text-center text-primary fw-normal">Testimonials</h2>
                    <h1 class="mb-5">What Our Customer <span class="text-pink">Say</span></h1>
                </div>
                <div class="owl-carousel testimonial-carousel">
                    <div class="testimonial-item bg-transparent border rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>
                            "Amazing service! The hairstylists here truly know how to make you feel fabulous.
                            My go-to salon for a fresh look!"
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle"
                                src="{{ asset('website/img/user.png') }}" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Aashutosh Kumar</h5>
                                <small>Clerk</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-transparent border rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>
                            "I love the relaxing ambiance and skilled professionals at this salon.
                            Always leave with a smile and a stunning hairstyle."
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle"
                                src="{{ asset('website/img/user.png') }}" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Amit Kumar</h5>
                                <small>Salesman</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-transparent border rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>
                            "Exceptional service every time! The salon has a welcoming atmosphere. Highly recommended."
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle"
                                src="{{ asset('website/img/user.png') }}" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Nitin Kumar</h5>
                                <small>Businessman</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-transparent border rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>
                            "Fantastic salon experience! The staff is friendly. My favorite place for a pampering
                            session."
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle"
                                src="{{ asset('website/img/user.png') }}" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Anubhav</h5>
                                <small>Student</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->

        <!-- Contact Area-->
        <div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-title ff-secondary text-center text-primary fw-normal">Connect With Us</h2>
                    <h1 class="mb-5">Book Your Next Salon <span class="text-pink">Experience</span></h1>
                </div>
                <div class="row p-2 g-4">
                    <div class="col-md-4">
                        <h5 class="fw-normal text-start text-pink">Mail Us On</h5>
                        <p><i class="fa fa-envelope-open text-pink me-2"></i>maikmi@textmail.com</p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="fw-normal text-start text-pink">Call Us On</h5>
                        <a href="tel:+917688828394" class="text-white"><i class="fa fa-phone-alt text-pink me-2"></i>+91-7688828394</a>
                    </div>
                    <div class="col-md-4">
                        <h5 class="fw-normal text-start text-pink">Our Address</h5>
                        <p><i class="fa fa-map-marker-alt text-pink me-2"></i>Varanasi, Uttar
                            Pradesh, 221010</p>
                    </div>
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
                        <a class="btn btn-link" href="">About Us</a>
                        <a class="btn btn-link" href="">Contact Us</a>
                        <a class="btn btn-link" href="">Privacy Policy</a>
                        <a class="btn btn-link" href="">Terms & Condition</a>
                    </div>

                    <div class="col-lg-3 col-6">
                        <h4 class="text-start text-primary fw-normal mb-4">Opens On</h4>
                        <h5 class="text-pink fw-normal">Monday - Saturday</h5>
                        <p>10AM - 09PM</p>
                        <h5 class="text-pink fw-normal">Sunday</h5>
                        <p>10AM - 05PM</p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; Maikmi, All Right Reserved. Designed By <a class="text-primary"
                                href="#">Adian Infotech</a>
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

        <!-- Back to Top -->
        <button id="backToTop" onclick="scrollToTop()"
            class="btn btn-lg btn-pink text-white btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></button>
    </div>

    <!-- JavaScript-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('website/js/wow.min.js') }}"></script>
    <script src="{{ asset('website/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- For back to top -->
    <script>
        var mybutton = document.getElementById("backToTop");

        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        function scrollToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
</body>

</html>
