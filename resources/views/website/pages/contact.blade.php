@extends('layouts.front')
@section('page_title', @$pagedata->title['en'] ?? @$pagedata->title['np'])
@section('meta')
    @include('website.pages.meta')
@endsection
@section('content')

    <!-- Banner -->
    <section class="banner pt pb" style="background-image: url({{@$pagedata->parallex_img_url}});background-size:cover;">
        <div class="container">
            <h1>{{ @$pagedata->title['en'] ?? @$pagedata->title['np'] }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ @$pagedata->title['en'] ?? @$pagedata->title['np'] }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Contact Us Page -->
    <section class="contact-us mt mb">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="contact-left">
                        <form id="contact_form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Full Name"
                                            id="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email Address"
                                            id="email" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="phone" class="form-control" placeholder="Phone Number"
                                            id="phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="subject" class="form-control" placeholder="Subject"
                                            id="subject">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" placeholder="Your message here...."
                                            id="message"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Submit Now</button>
                                    <button type="reset" class="d-none" id="reset">reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="contact-right">
                        <ul>
                            <li>
                                <i class="flaticon-signs"></i>
                                <div class="contact-content">
                                    <span>Location</span>
                                    <p>{{ @$setting->address }}</p>
                                </div>
                            </li>
                            <li>
                                <i class="flaticon-phone-call"></i>
                                <div class="contact-content">
                                    <span>Call Us</span>
                                    <p>{{ @$setting->phone[0]['phone_number'] }}</p>
                                </div>
                            </li>
                            <li>
                                <i class="flaticon-message"></i>
                                <div class="contact-content">
                                    <span>Email Us</span>
                                    <p>{{ @$setting->email }}</p>
                                </div>
                            </li>
                            <li>
                                <i class="flaticon-alarm-clock"></i>
                                <div class="contact-content">
                                    <span>Opening Time</span>
                                    <p>Sun - Fri - 10:AM - 5:00PM</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="map mt">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3531.9982362846463!2d85.32277111458335!3d27.71734073166052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19c7d02e5427%3A0x6f2c9b7b7da70c15!2sAtlas%20Aviation%20Holding!5e0!3m2!1sen!2snp!4v1631273111526!5m2!1sen!2snp"
                 width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>
    <!-- Contact Us Page End -->


@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/front/css/toastr.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('plugins/toastrjs/toastr.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#contact_form").submit(function(e) {
                console.log('here');
                e.preventDefault();
                $(this).prop("disabled", true);
                var data = {
                    _token: "{{ csrf_token() }}",
                    name: $('#name').val(),
                    email: $('#email').val(),
                    service: $('#subject').val(),
                    message: $('#message').val(),
                    phone: $('#phone').val()
                };
                $.ajax({
                    method: "POST",
                    url: "{{ route('contact_form.store') }}",
                    data: JSON.stringify(data),
                    processData: false,
                    contentType: "application/json; charset=utf-8",
                    success: function(res) {
                        toastr.success(res.message[0], "Success !");
                        $('#reset').click()
                    },
                    error: function(result, status, err) {
                        console.log(err);
                        toastr.options.closeButton = true;
                        if (err == 'Conflict') {
                            toastr.error('Email already exists', "Error !");
                        } else {
                            toastr.error('Error while Form Submission', "Error !");
                        }
                    },

                });
            });
        });
    </script>
@endpush
