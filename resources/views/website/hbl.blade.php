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

    <div class="form-input-page">
        <div class="container-fluid">
            <div class="form-cover form-cover1">
                <form action="">
                    <div class="form-part1">
                        <div class="row m-0">
                            <div class="col-md-6 p-0" style="border-right:1px solid #000;">
                                <div class="part1-left">
                                    <div class="form-group"
                                        style="height: 94px;border-bottom: 1px solid #000;padding:5px">
                                        <label for="">Shipper's Name and Address:</label>
                                        <textarea name="" class="form-control" style="height: 60px;"></textarea>
                                    </div>
                                    <div class="form-group" style="height: 94px;border-bottom: 1px solid #000;padding:5px">
                                        <label for="">Consignee Name and Address:</label>
                                        <textarea name="" class="form-control" style="height: 60px;"></textarea>
                                    </div>
                                    <div class="form-group" style="height: 94px;border-bottom: 1px solid #000;padding:5px">
                                        <label for="">Notify:</label>
                                        <textarea name="" class="form-control" style="height: 60px;"></textarea>
                                    </div>
                                    <div class="row m-0" style="border-bottom: 1px solid #000;">
                                        <div class="col-md-6 p-0" style="border-right: 1px solid #000;">
                                            <div class="form-group" style="height: 42px;padding:5px">
                                                <label for="">Pre Carriage by:</label>
                                                <input type="text" class="form-control" style="height: 18px;">
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <div class="form-group" style="height: 42px;padding:5px">
                                                <label for="">Mode Means of Transport:</label>
                                                <input type="text" class="form-control" style="height: 18px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-0" style="border-bottom: 1px solid #000;">
                                        <div class="col-md-6 p-0" style="border-right: 1px solid #000;">
                                            <div class="form-group" style="height: 42px;padding:5px">
                                                <label for="">Place of Receipt:</label>
                                                <input type="text" class="form-control" style="height: 18px;">
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <div class="form-group" style="height: 42px;padding:5px">
                                                <label for="">Port of Loading:</label>
                                                <input type="text" class="form-control" style="height: 18px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-0" style="border-bottom: 1px solid #000;">
                                        <div class="col-md-6 p-0" style="border-right: 1px solid #000;">
                                            <div class="form-group" style="height: 42px;padding:5px">
                                                <label for="">Port of Discharge:</label>
                                                <input type="text" class="form-control" style="height: 18px;">
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <div class="form-group" style="height: 42px;padding:5px">
                                                <label for="">Port of Delivery:</label>
                                                <input type="text" class="form-control" style="height: 18px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-0">
                                        <div class="col-md-12 p-0">
                                            <div class="form-group" style="height: 42px;padding:5px">
                                                <label for="">Vessel Voy. No:</label>
                                                <input type="text" class="form-control" style="height: 18px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 p-0">
                                <div class="part1-right1">
                                    <div class="row m-0">
                                        <div class="col-md-6 p-0">
                                            <label>HBL No.:</label>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <input type="text" class="form-control" style="border: 1px solid #000;border-radius:0;border-bottom:none;padding:5px 5px;">
                                        </div>
                                    </div>
                                    <div class="row m-0">
                                        <div class="col-md-6 p-0">
                                            <label>Shipment Reference No.:</label>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <input type="text" class="form-control" style="border: 1px solid #000;border-radius:0;padding:5px 5px;">
                                        </div>
                                    </div>
                                    <div class="hbl-logo">
                                        <a href="#"><img src="{{ asset('front/img/logo.png') }}" alt="images"></a>
                                    </div>
                                    <p style="font-size:11px;line-height: 15px;color:#000;margin-top:20px;">
                                        The shipment is taken in apparent good order and condition, herein at the place of receipt, 
                                        and assumes the responsibility for transport and delivery by ocean vessel to the port of 
                                        discharge or place of delivery, as mentioned. The contents, weight, value and measurement 
                                        included are according to Shipper’s declaration. This House Bill of Lading shall have effect 
                                        subject to our shipping/trading conditions. The goods to be delivered at the mentioned port 
                                        of discharge or place of delivery, whichever is applicable, subject always to the exceptions, 
                                        limitations, conditions and liberties set out by the Terms and Conditions of Carriage of the 
                                        corresponding Master Bill of Lading, to which the Shipper and/or Consignee agree to accepting 
                                        this Bill of Lading.
                                    </p>
                                    <p style="font-size:11px;line-height: 15px;color:#000;">
                                        In witness whereof original House Bill of Lading have been duly endorsed not otherwise stated 
                                        above, one copy of which being accomplished the others shall be void.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-part3 form3-part3">
                        <table width="100%" style="border-top:none;">
                            <thead>
                                <tr>
                                    <th style="width:94px;">Container No.(s)</th>
                                    <th style="width:132px;">Marks and Numbers</th>
                                    <th style="width:223px;">Number of packages, kind of packages, general description of goods</th>
                                    <th style="width:113px;">Gross Weight</th>
                                    <th style="width:113px;">Measurement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:94px;"><textarea name="" class="form-control"></textarea></td>
                                    <td style="width:132px;"><textarea name="" class="form-control"></textarea></td>
                                    <td style="width:223px;"><textarea name="" class="form-control"></textarea></td>
                                    <td style="width:113px;"><textarea name="" class="form-control"></textarea></td>
                                    <td style="width:113px;"><textarea name="" class="form-control"></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="hbl-part1">
                        <div class="row m-0" style="border-top: 1px solid #000;">
                            <div class="col-md-3 p-0" style="border-right: 1px solid #000;">
                                <div class="form-group" style="height: 42px;padding:5px">
                                    <label for="">Freight Amount</label>
                                    <input type="text" class="form-control" style="height: 18px;">
                                </div>
                            </div>
                            <div class="col-md-3 p-0" style="border-right: 1px solid #000;">
                                <div class="form-group" style="height: 42px;padding:5px">
                                    <label for="">Freight Payable at</label>
                                    <input type="text" class="form-control" style="height: 18px;">
                                </div>
                            </div>
                            <div class="col-md-3 p-0" style="border-right: 1px solid #000;">
                                <div class="form-group" style="height: 42px;padding:5px">
                                    <label for="">Number of Original HBL</label>
                                    <input type="text" class="form-control" style="height: 18px;">
                                </div>
                            </div>
                            <div class="col-md-3 p-0">
                                <div class="form-group" style="height: 42px;padding:5px">
                                    <label for="">Place and Date of Issue</label>
                                    <input type="text" class="form-control" style="height: 18px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hbl-part1">
                        <div class="row m-0" style="border-top: 1px solid #000;">
                            <div class="col-md-6 p-0" style="border-right: 1px solid #000;">
                                <div class="form-group" style="height: 94px;padding:5px">
                                    <label for="">Other Particulars: (If any)</label>
                                    <textarea class="form-control" style="height: 50px;"></textarea>
                                    <p style="font-size:13px;color:#000;">Weight and measurement of container not to be included</p>
                                </div>
                            </div>
                            <div class="col-md-6 p-0">
                                <div class="form-group" style="height: 94px;padding:5px">
                                    <label for="">&nbsp;</label>
                                    <textarea class="form-control" style="height: 65px;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <p style="color:#000;background: #f5f8ff;
            max-width: 850px;
            font-size: 11px;
            margin:auto;
            text-align:center;
            height: auto;">Air Logistics Group Pvt. Ltd. GPO Box No.: 24884, Kathmandu, Nepal Phone: +977-1-4004795, Email:cs@sirlogisticsgroup.com.np</p>
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
