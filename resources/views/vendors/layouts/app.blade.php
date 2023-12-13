<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{isset($page_title) ? $page_title : ""}} :: {{config('app.name')}}</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">

    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{asset('vendors_css/assets/css/main.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin_css/assets/vendors/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_css/assets/vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_css/assets/vendors/easymde/easymde.min.css')}}">

    <link rel="stylesheet" href="{{asset('admin_css/assets/vendors/flatpickr/flatpickr.min.css')}}">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css" rel="stylesheet">
    <!-- End Icons -->

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}

</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

        @include('vendors.layouts.top_nav')

        {{-- @include('vendors.layouts.theme_setting') --}}

        <div class="app-main">

            @include('vendors.layouts.sidebar')

            <div class="app-main__outer">
                {{-- Start Main Section --}}
                <div class="app-main__inner">
                    @yield('content')
                </div>
                {{-- End Main Section --}}
                @include('vendors.layouts.footer')

            </div>
        </div>
    </div>
    {{-- @include('vendors.layouts.drawer') --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('vendors_css/assets/scripts/main.js')}}"></script>

    <script src="{{asset('admin_css/assets/js/select2.js')}}"></script>
    <script src="{{asset('admin_css/assets/vendors/select2/select2.min.js')}}"></script>
    <script src="{{asset('admin_css/assets/vendors/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('admin_css/assets/vendors/easymde/easymde.min.js')}}"></script>
    <script src="{{asset('admin_css/assets/js/easymde.js')}}"></script>
    <script src="{{asset('admin_css/assets/vendors/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('admin_css/assets/js/flatpickr.js')}}"></script>

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
                    title: success_message,
                    showCloseButton: true,
                });
            }

            function error_sweet_alert(error_message){
                Toast.fire({
                    icon: 'error',
                    title: error_message,
                    showCloseButton: true,
                });
            }
        });

        $('.deleteBtn').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger me-2'
                },
                buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    form.submit();
                    // swalWithBootstrapButtons.fire(
                    //     'Deleted!',
                    //     'Your file has been deleted.',
                    //     'success'
                    // )
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        });
    </script>

    @yield('scripts')
</body>

</html>
