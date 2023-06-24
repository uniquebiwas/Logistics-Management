<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('meta')
    <title>@yield('page_title')</title>


    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" type="" href="img/icon.png">
    <link rel="stylesheet" href="{{ asset('front/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/line-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/flaticon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/metisMenu.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/lightslider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/lightgallery.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/owl.carousel.min.css') }}">
    <link href="{{ asset('front/css/aos.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/toastr.min.css') }}">
    @stack('styles')
</head>

<body>

    <div class="awbs-cover">
        <div class="awbs-part1" style="height: 94px;">
            <div class="row m-0">
                <div class="col-md-6 p-0" style="border-right:1px solid #785e9b;">
                    <div class="row m-0">
                        <div class="col-md-6 p-0">
                            <label for="" style="padding:3px;">Shipper's Name and Address</label>
                        </div>
                        <div class="col-md-6 p-0" style="border:1px solid #785e9b;border-top:none;
                        border-right:none;height:35px;">
                            <label for="" style="padding:3px 3px 0;text-align:center;display: block;">Shipper's Account
                                Number</label>
                            <input type="text" class="form-control" style="height: 12px;
                            text-align: center;">
                        </div>
                        <div class="col-md-12 p-0">
                            <textarea name="" class="form-control" style="height: 56px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-0">
                    <div style="padding:5px;">
                        <p style="margin-bottom:0;">Not Negotiable</p>
                        <b style="margin-bottom:0;font-size:17px;">Air Waybill</b>
                        <p style="margin-bottom:0;">Issued by</p>
                        <input type="text" class="form-control" style="height: 16px;padding:5px 0;">
                    </div>
                    <div class="imp-text">
                        <p style="margin-bottom:0;padding:3px;">Copies 1, 2 and 3 of this Air Waybill are orginals and
                            have the same
                            validity</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="awbs-part1" style="height: 101px;border-top:1px solid #785e9b;">
            <div class="row m-0">
                <div class="col-md-6 p-0" style="border-right:1px solid #785e9b;">
                    <div class="row m-0">
                        <div class="col-md-6 p-0">
                            <label for="" style="padding:3px;">Consignee's Name and Address</label>
                        </div>
                        <div class="col-md-6 p-0" style="border:1px solid #785e9b;border-top:none;
                        border-right:none;height:35px;">
                            <label for="" style="padding:3px 3px 0;text-align:center;display: block;">Consignee's
                                Account Number</label>
                            <input type="text" class="form-control" style="height: 12px;
                            text-align: center;
                        }">
                        </div>
                        <div class="col-md-12 p-0">
                            <textarea name="" class="form-control" style="height: 56px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-0">
                    <p style="line-height: 11px;margin-bottom:0;font-size:10px;padding:3px;">
                        It is agreed that the goods described herein are accepted in apparent good order and condition
                        (except as noted) for carriage <b style="font-size: 8px;
                        line-height: 11px;
                        ">SUBJECT TO THE CONTITIONS OF CONTRACT ON THE REVERSE HEREOF, ALL GOODS MAY BE CARRIED
                            BY ANY OTHER MEANS INCLUDING ROAD OR ANY OTHER CARRIER UNLESS SPECIFIC CONTRARY INSTRUCTIONS
                            ARE GIVEN HEREON BY THE SHIPPER,
                            AND SHIPPER AGREES THAT THE SHIPMENT MAY BE CARRIED VIA INTERMEDIATE STOPPING PLACES WHICH
                            THE CARRIER DEEMS APPROPRIATE.
                            THE SHIPPER'S ATTENTION IS DRAWN TO THE NOTICE CONCERNING CARRIER'S LIMITATION OF
                            LIABILITY.</b> Shipper may increase such limitation of liability by declearing
                        a higher value of carriage and paying a supplemental charge if required.
                    </p>
                </div>
            </div>
        </div>
        <div class="awbs-part1" style="height: 98px;border-top:1px solid #785e9b;">
            <div class="row m-0">
                <div class="col-md-6 p-0" style="border-right:1px solid #785e9b;">
                    <div class="row m-0">
                        <div class="col-md-12 p-0" style="height: 64px;">
                            <label for="" style="padding:3px 3px 0;">Issuing Carrier's Agent Name and City</label>
                            <textarea name="" class="form-control" style="height: 46px;"></textarea>
                        </div>
                        <div class="col-md-6 p-0"
                            style="border-top:1px solid #785e9b;border-right:1px solid #785e9b;height:34px;">
                            <label for="" style="padding:3px 3px 0;">Agent's IATA Code</label>
                            <input type="text" class="form-control" style="height: 14px;">
                        </div>
                        <div class="col-md-6 p-0" style="border-top:1px solid #785e9b;height:34px;">
                            <label for="" style="padding:3px 3px 0;">Account No.</label>
                            <input type="text" class="form-control" style="height: 14px;">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-0" style="">
                    <label for="" style="padding:3px 3px 0;">Accounting Information</label>
                    <textarea name="" class="form-control" style="height: 79px;"></textarea>
                </div>
            </div>
        </div>
        <div class="awbs-part1" style="height: 32px;border-top:1px solid #785e9b;">
            <div class="row m-0">
                <div class="col-md-6 p-0" style="border-right:1px solid #785e9b;">
                    <div class="row m-0">
                        <div class="col-md-12 p-0">
                            <label for="" style="padding:3px 3px 0;">Airport of Depature (Addr. of First Carrier) and
                                Request Routing</label>
                            <input type="text" class="form-control" style="height: 13px;">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-0" style="">
                    <div class="row m-0">
                        <div class="col-md-4 p-0">
                            <label for="" style="padding:3px 3px 0;">Reference Number</label>
                            <input type="text" class="form-control" style="height: 13px;">
                        </div>
                        <div class="col-md-5 p-0">
                            <label for="" style="padding:3px 3px 0;text-align:center;display:block;">Optional Shipping
                                Information</label>
                            <input type="text" class="form-control"
                                style="height: 13px;border:1px solid #785e9b;border-bottom:none;text-align:center;">
                        </div>
                        <div class="col-md-3 p-0"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="awbs-part1" style="border-top:1px solid #785e9b;">
            <div class="row m-0">
                <div class="col-md-6 p-0" style="border-right:1px solid #785e9b;">
                    <table width="100%" style="height: 35px;">
                        <thead>
                            <tr>
                                <th
                                    style="width: 38px;vertical-align:top;border-right:1px solid #785e9b;padding:3px;padding-bottom:0;">
                                    To</th>
                                <th
                                    style="width: 265px;vertical-align:top;border-right:1px solid #785e9b;padding-bottom:0;">
                                    <div class="row m-0">
                                        <div class="col-md-6 p-0">
                                            <label for="" style="padding:3px 3px 0 3px;">By First Carrier</label>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <label for="" style="border: 1px solid #785e9b;
                                            display: block;
                                            text-align: center;
                                            border-top: none;
                                            margin-right: 15px;
                                            font-size:9px;">Routing & Destination</label>
                                        </div>
                                    </div>
                                </th>
                                <th
                                    style="width: 38px;vertical-align:top;border-right:1px solid #785e9b;padding:3px;padding-bottom:0;">
                                    To</th>
                                <th
                                    style="width: 30px;vertical-align:top;border-right:1px solid #785e9b;padding:3px;padding-bottom:0;">
                                    By</th>
                                <th
                                    style="width: 38px;vertical-align:top;border-right:1px solid #785e9b;padding:3px;padding-bottom:0;">
                                    To</th>
                                <th style="width: 30px;vertical-align:top;padding:3px;">By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border-right:1px solid #785e9b;vertical-align:top;"><input type="text"
                                        class="form-control" style="height:5px;"></td>
                                <td style="border-right:1px solid #785e9b;vertical-align:top;">
                                    <div class="row m-0">
                                        <div class="col-md-6 p-0">
                                            <input type="text" class="form-control" style="height:5px;">
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <input type="text" class="form-control" style="height:5px;">
                                        </div>
                                    </div>
                                </td>
                                <td style="border-right:1px solid #785e9b;vertical-align:top;"><input type="text"
                                        class="form-control" style="height:5px;"></td>
                                <td style="border-right:1px solid #785e9b;vertical-align:top;"><input type="text"
                                        class="form-control" style="height:5px;"></td>
                                <td style="border-right:1px solid #785e9b;vertical-align:top;"><input type="text"
                                        class="form-control" style="height:5px;"></td>
                                <td style=""><input type="text" class="form-control"
                                        style="height:5px;vertical-align:top;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 p-0">
                    <table width="100%" style="height: 35px;">
                        <thead>
                            <tr>
                                <th
                                    style="width: 38px;vertical-align:top;border-right:1px solid #785e9b;padding:3px;padding-bottom:0;">
                                    Currency
                                </th>
                                <th
                                    style="width: 38px;vertical-align:top;border-right:1px solid #785e9b;padding:3px;padding-bottom:0;">
                                    CHGS Code
                                </th>
                                <th
                                    style="width: 30px;vertical-align:top;border-right:1px solid #785e9b;padding:3px;padding-bottom:0;">
                                    By
                                </th>
                                <th
                                    style="width: 38px;vertical-align:top;border-right:1px solid #785e9b;padding:3px;padding-bottom:0;">
                                    To
                                </th>
                                <th style="width: 30px;vertical-align:top;padding:3px;">By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border-right:1px solid #785e9b;vertical-align:top;"><input type="text"
                                        class="form-control" style="height:5px;"></td>
                                <td style="border-right:1px solid #785e9b;vertical-align:top;">
                                    <div class="row m-0">
                                        <div class="col-md-6 p-0">
                                            <input type="text" class="form-control" style="height:5px;">
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <input type="text" class="form-control" style="height:5px;">
                                        </div>
                                    </div>
                                </td>
                                <td style="border-right:1px solid #785e9b;vertical-align:top;"><input type="text"
                                        class="form-control" style="height:5px;"></td>
                                <td style="border-right:1px solid #785e9b;vertical-align:top;"><input type="text"
                                        class="form-control" style="height:5px;"></td>
                                <td style="border-right:1px solid #785e9b;vertical-align:top;"><input type="text"
                                        class="form-control" style="height:5px;"></td>
                                <td style=""><input type="text" class="form-control"
                                        style="height:5px;vertical-align:top;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="{{ asset('front/js/jquery.min.js') }}"></script>
        <script src="{{ asset('front/js/jquery-ui.js') }}"></script>
        <script src="{{ asset('front/js/popper.min.js') }}"></script>
        <script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('front/js/aos.js') }}"></script>
        <script src="{{ asset('front/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('front/js/lightslider.min.js') }}"></script>
        <script src="{{ asset('front/js/lightgallery-all.min.js') }}"></script>
        <script src="{{ asset('front/js/custom.js') }}"></script>
        <script src="{{ asset('plugins/toastrjs/toastr.min.js') }}"></script>
        @stack('scripts')

</body>

</html>
