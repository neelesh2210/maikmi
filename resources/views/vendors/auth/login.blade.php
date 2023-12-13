<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{isset($page_title) ? $page_title : ""}} :: {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />

    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{asset('vendors_css/assets/css/main.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin_css/assets/vendors/sweetalert2/sweetalert2.min.css')}}">
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100">
                <div class="h-100 no-gutters row">
                    <div class="d-none d-lg-block col-lg-4">
                        <div class="slider-light">
                            <div class="slick-slider">
                                <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate"
                                        tabindex="-1">
                                        <div class="slide-img-bg"
                                            style="background-image: url('{{asset('vendors_css/assets/images/originals/city.jpg')}}');"></div>
                                        <div class="slider-content">
                                            <h3>Perfect Balance</h3>
                                            <p>ArchitectUI is like a dream. Some think it's too good to be true!
                                                Extensive
                                                collection of unified React Boostrap Components and Elements.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark"
                                        tabindex="-1">
                                        <div class="slide-img-bg"
                                            style="background-image: url('{{asset('vendors_css/assets/images/originals/citynights.jpg')}}');">
                                        </div>
                                        <div class="slider-content">
                                            <h3>Scalable, Modular, Consistent</h3>
                                            <p>Easily exclude the components you don't require. Lightweight, consistent
                                                Bootstrap based styles across all elements and components
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-sunny-morning"
                                        tabindex="-1">
                                        <div class="slide-img-bg"
                                            style="background-image: url('{{asset('vendors_css/assets/images/originals/citydark.jpg')}}');">
                                        </div>
                                        <div class="slider-content">
                                            <h3>Complex, but lightweight</h3>
                                            <p>We've included a lot of components that cover almost all use cases for
                                                any type of application.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
                        <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                            <a href="#" class="d-block mb-2 text-center">
                                @if(websiteSetupValue('logo'))
                                    <img src="{{asset('admin_css/admin/website_setup/'.websiteSetupValue('logo'))}}" class="img-fluid"  style="height: 40px">
                                @else
                                    <h4> {{config('app.name')}} </h4>
                                @endif
                            </a>
                            <h4 class="mb-0">
                                <span class="d-block">Welcome back,</span>
                                <span>Please sign in to your account.</span>
                            </h4>
                            <h6 class="mt-3">No account? <a href="javascript:void(0);" class="text-primary">Sign up now</a></h6>
                            <div class="divider row"></div>
                            <div>
                                <form action="{{route('vendors.login')}}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="phone" class>Phone Number</label>
                                                <input name="phone" id="phone" placeholder="Phone number here..."
                                                    type="number" class="form-control"  value="{{old('phone')}}">
                                            </div>
                                            @error('password')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="examplePassword" class>Password</label>
                                                <input name="password" id="examplePassword"
                                                    placeholder="Password here..." type="password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative form-check">
                                        <input name="remember" id="exampleCheck" type="checkbox"
                                            class="form-check-input" value="1" {{old('remember')==1?'checked':''}}>
                                        <label for="exampleCheck" class="form-check-label">Remember me</label>
                                    </div>
                                    <div class="divider row"></div>
                                    <div class="d-flex align-items-center">
                                        <div class="ml-auto">
                                            <a href="javascript:void(0);" class="btn-lg btn btn-link">Recover
                                                Password</a>
                                            <button class="btn btn-primary btn-lg">Login to Dashboard</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('vendors_css/assets/scripts/main.js')}}"></script>
    <script src="{{asset('admin_css/assets/vendors/core/core.js')}}"></script>
    <script src="{{asset('admin_css/assets/vendors/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>
        $(function () {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });

            $( document ).ready(function() {
                var success_message = "{{Session::get('success')}}";
                var error_message = "{{Session::get('error')}}";

                if(success_message != ""){
                    success_sweet_alert(success_message);
                }
                if(error_message !=""){
                    error_sweet_alert(error_message)
                }

            });

            function success_sweet_alert(success_message){
                Toast.fire({
                    icon: 'success',
                    title: success_message
                });
            }

            function error_sweet_alert(error_message){
                Toast.fire({
                    icon: 'error',
                    title: error_message
                });
            }
        });
    </script>
</body>

</html>
