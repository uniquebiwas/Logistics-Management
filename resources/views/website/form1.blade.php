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
                                        style="height: 163px;border-bottom: 1px solid #000;padding:10px 10px;">
                                        <label for="">1. Exporter's name & address</label>
                                        <textarea name="" class="form-control" style="height: 55px;"></textarea>
                                        <ul class="lists">
                                            <li>
                                                <label for="">Tax Registeration No. & Place :</label>
                                                <input type="text" class="form-control">
                                            </li>
                                            <li>
                                                <label for="">Firm Registeration No. :</label>
                                                <input type="text" class="form-control">
                                            </li>
                                            <li>
                                                <label for="">(Place and Date) :</label>
                                                <input type="text" class="form-control">
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="form-group" style="height: 143px;padding:10px 10px;">
                                        <label for="">2. Consignee's name, address, country</label>
                                        <textarea name="" class="form-control" style="height: 105px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 p-0">
                                <div class="part1-right1">
                                    <span>NCC Rerference No. <b
                                            style="font-size: 15px;letter-spacing:2px;">123456</b></span>
                                    <div class="part1-right-text">
                                        <p style="text-transform: uppercase;font-size:17px;font-weight:600;margin-top:8px;">Certificate
                                            of Origin
                                        </p>
                                        <p style="font-size:12px;margin-top:-5px;">Issued by:</p>
                                        <img src="{{ asset('front/img/ncc.png') }}" alt="images" style="height: 75px;
                                        width: 75px;margin:3px 0;">
                                        <p
                                            style="text-transform: uppercase;font-size:17px;font-weight:600;margin-top:8px;line-height:1.2;">
                                            Nepal Chamber of Commerce
                                        </p>
                                        <p style="font-size:13px;line-height:20px;margin-top:3px;">
                                            Chamber Bhawan, Kantipath <br>
                                            P.O.Box No. 198, Kathmandu, Nepal <br>
                                            Tel.: +977-1-4230947 <br>
                                            Fax: 00977-1-4229998 <br>
                                            E-mail: info@nepalchamber.org
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-part2">
                        <div class="row m-0">
                            <div class="col-md-6 p-0" style="border-right:1px solid #000;height:64px;">
                                <div class="form-group" style="padding:10px 10px;">
                                    <label for="">3. Means of transport and route</label>
                                    <textarea name="" class="form-control" style="height: 30px;"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 p-0">
                                <div class="form-group" style="padding:10px 10px;height:64px;">
                                    <label for="">4. Export Licence No. & Date (When Needed)</label>
                                    <textarea name="" class="form-control" style="height: 30px;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-part3 form1-part3">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th style="width:91px;">5. Marks and numbers of packages</th>
                                    <th style="width:272px;">6. Description of goods</th>
                                    <th style="width:106px;">7. Value</th>
                                    <th style="width:79px;">8. Quantity</th>
                                    <th style="width:87px;">9. Place of production</th>
                                    <th style="width:91px;">10. Number and date of invoice</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:91px;"><textarea name="" class="form-control"></textarea></td>
                                    <td style="width:272px;"><textarea name="" class="form-control"></textarea></td>
                                    <td style="width:106px;"><textarea name="" class="form-control"></textarea></td>
                                    <td style="width:79px;"><textarea name="" class="form-control"></textarea></td>
                                    <td style="width:87px;"><textarea name="" class="form-control"></textarea></td>
                                    <td style="width:91px;"><textarea name="" class="form-control"></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-part7" style="border-top:1px solid #000;height:28px;padding:0 10px;">
                        <ul>
                            <li>
                                <label for="" style="margin-right:10px;">Value in Words:</label>
                                <input type="text" class="form-control">
                            </li>
                        </ul>
                    </div>
                    <div class="form-part4">
                        <div class="row m-0">
                            <div class="col-md-6 p-0" style="border-right:1px solid #000;">
                                <div class="form-part4-left form1-part4-left">
                                    <label for="" style="font-weight: 600;font-size:14px;">11. Declaration by the exporter</label>
                                    <p style="height:55px;">
                                        The Ubdersigned hereby declares that the above mentioned goods have been produced in Nepal and that the details given above are true and correct.
                                    </p>
                                    <ul class="details">
                                        <li>
                                            <label for="">Authorised Signature</label>
                                            <span>Seal</span>
                                        </li>
                                        <li>
                                            <label for="">Full Name:</label>
                                            <input type="text" class="form-control">
                                        </li>
                                        <li>
                                            <label for="">Title:</label>
                                            <input type="text" class="form-control">
                                        </li>
                                        <li>
                                            <label for="">Date:</label>
                                            <input type="text" class="form-control">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 p-0">
                                <div class="form-part4-right form1-part4-right">
                                    <label for="" style="font-weight: 600;font-size:14px;">12. Certification by issuing authority</label>
                                    <p style="height:55px;">
                                        It is hereby certified that the above mentioned goods are of Neplease Origin to the best of our knpwledge and belief.
                                    </p>
                                    <ul class="details">
                                        <li>
                                            <label for="">Authorised Signature</label>
                                            <span>Seal</span>
                                        </li>
                                        <li>
                                            <label for="">Full Name:</label>
                                            <input type="text" class="form-control">
                                        </li>
                                        <li>
                                            <label for="">Title:</label>
                                            <input type="text" class="form-control">
                                        </li>
                                        <li>
                                            <label for="">Date:</label>
                                            <input type="text" class="form-control">
                                        </li>
                                    </ul>
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
