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
            <div class="form-cover">
                <form action="">
                    <div class="form-part1">
                        <div class="row m-0">
                            <div class="col-md-6 p-0" style="border-right:1px solid #000;">
                                <div class="part1-left">
                                    <div class="form-group"
                                        style="height: 96px;border-bottom: 1px solid #000;padding:10px 10px;">
                                        <label for="">1. Goods consigned from (exporter's business name, address,
                                            country)</label>
                                        <textarea name="" class="form-control" style="height: 50px;"></textarea>
                                    </div>
                                    <div class="form-group" style="height: 96px;padding:10px 10px;">
                                        <label for="">2. Goods consigned to (Consignee's name, address, country)</label>
                                        <textarea name="" class="form-control" style="height: 50px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 p-0">
                                <div class="part1-right">
                                    <span>Rerference No. <b
                                            style="font-size: 15px;letter-spacing:2px;">123456</b></span>
                                    <div class="part1-right-text">
                                        <p
                                            style="text-transform: uppercase;font-size:11px;font-weight:600;margin-top:10px;line-height:1.2;">
                                            Generalized System of Preferences</p>
                                        <p style="text-transform: uppercase;font-size:11px;font-weight:600;">Certificate
                                            of Origin</p>
                                        <b style="font-size:12px;font-weight:600;">(Combined declaration and
                                            certificate)</b>
                                        <b
                                            style="display: block;text-transform:uppercase;font-weight:bold;font-size:12px;margin-top:5px;">Form
                                            A</b>
                                        <p style="display: flex;
                                        margin-top:11px;
                                        align-items: center;
                                        white-space: nowrap;
                                        justify-content: center;
                                        font-size: 13px;">issued in <input type="text" placeholder="KTM"
                                                class="form-control" style="width: 140px;
                                            text-align: center;
                                            border-bottom: 1px dotted #000;
                                            border-radius: 0;
                                            padding-bottom: 0;
                                            padding-top: 0;
                                            font-size: 13px;
                                            font-weight: bold;">/ Nepal</p>
                                        <span>(Coyntry)</span>
                                        <b style="display: block;text-align:right;font-weight:normal;margin-top:10px;">See notes
                                            overleaf</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-part2">
                        <div class="row m-0">
                            <div class="col-md-6 p-0" style="border-right:1px solid #000;height:179px;">
                                <div class="form-group" style="padding:10px 10px;">
                                    <label for="">3. Means of transport and route (as far as known)</label>
                                    <textarea name="" class="form-control" style="height: 140px;"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 p-0">
                                <div class="form-group" style="padding:10px 10px;height:179px;">
                                    <label for="">4. For official use</label>
                                    <textarea name="" class="form-control" style="height: 140px;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-part3">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th style="width:35px;">5. Item number</th>
                                    <th style="width:87px;">6. Marks and numbers of packages</th>
                                    <th style="width:302px;">7. Number and kind of packages; description of goods</th>
                                    <th style="width:87px;">8. Origin criterion (see notes overleaf)</th>
                                    <th style="width:87px;">9. Gross weight or other quantity</th>
                                    <th style="width:87px;">10. Number and date of invoices</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:35px;"><textarea name="" class="form-control"></textarea></td>
                                    <td style="width:87px;"><textarea name="" class="form-control"></textarea></td>
                                    <td style="width:302px;"><textarea name="" class="form-control"></textarea></td>
                                    <td style="width:87px;"><textarea name="" class="form-control"></textarea></td>
                                    <td style="width:87px;"><textarea name="" class="form-control"></textarea></td>
                                    <td style="width:87px;"><textarea name="" class="form-control"></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-part4">
                        <div class="row m-0">
                            <div class="col-md-6 p-0" style="border-right:1px solid #000;">
                                <div class="form-part4-left">
                                    <label for="" style="font-weight: 600;font-size:13px;">11. Certification</label>
                                    <p style="padding-left:22px;height: 153px;">
                                        It is hereby certified, on the basic of control carried out, that the
                                        declaration by the exporter is correct.
                                    </p>
                                    <p>
                                        <input type="text" class="form-control" style="border-bottom:1px dotted #000;padding-top:0;padding-bottom:0;border-radius:0;">
                                        <span style="font-size:11px;">place and date, signature and stamp of certifying authority</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 p-0">
                                <div class="form-part4-right">
                                    <label for="" style="font-weight: 600;font-size:13px;">12. Declaration by the exporter</label>
                                    <p style="padding-left:22px;">
                                        The undersigned hereby declares that the above details and statements are
                                        correct;
                                        that all the goods were
                                        <b style="display: flex;
                                        white-space: nowrap;margin-top: 10px;">procuded in <input type="text" class="form-control" style="border-bottom: 1px dotted #000;
                                            border-radius: 0;
                                            padding-top: 0;
                                            padding-bottom: 0;text-align:center;"></b>
                                        <span style="display: block;text-align:center;margin-bottom:10px;font-size:11px;">(country)</span>
                                        and that they comply with the origin requirements specified for those goods in
                                        the
                                        generalized system of preferences for goods exported to
                                        <span><input type="text" class="form-control" style="border-bottom:1px dotted #000;padding-top:0;padding-bottom:0;border-radius:0;text-align:center;"> <span style="display: block;text-align:center;font-size:11px;">(importing
                                                country)</span></span>
                                    </p>
                                    <p style="margin-bottom:0;">
                                        <input type="text" class="form-control" style="border-bottom:1px dotted #000;padding-top:0;padding-bottom:0;border-radius:0;">
                                        <span style="font-size:11px;">place and date, signature of authorized signatory</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
