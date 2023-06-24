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

    <table width="100%" style="background: #f5f8ff;
    border:1px solid #000;
    max-width: 850px;
    font-size: 13px;
    height: auto;
    font-family: 'Roboto', sans-serif;
    margin: auto;
    border-bottom:none;
    ">
        <tbody>
            <tr>
                <td width="50%" style="border-right:1px solid #000;vertical-align:top;">
                    <table width="100%">
                        <tbody>
                            <tr style="border-bottom:1px solid #000;">
                                <td style="height:163px;vertical-align:top;padding:10px;">
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="" style="font-weight:500;">&nbsp;</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height:51px;vertical-align:top;padding-top:3px;">
                                                    Air Logistic Group<br>
                                                    Kathmandu, Nepal
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align:top;padding-top:3px;font-size:12px;">
                                                    <table width="100%" style="line-height: 23px;">
                                                        <tbody>
                                                            <tr>
                                                                <td width="50%">&nbsp;</td>
                                                                <td width="50%">123 456 789</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="50%">&nbsp;</td>
                                                                <td width="50%">123 456 789</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="50%">&nbsp;</td>
                                                                <td width="50%">Kathmandu, 12/12/2021</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="height: 143px;vertical-align:top;padding:10px;">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="" style="font-weight:500;">&nbsp;</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height:51px;vertical-align:top;padding-top:3px;">
                                                    Air Logistic Group<br>
                                                    Patan, Kathmandu <br>
                                                    Nepal
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="50%" style="height:306px;vertical-align:top;">
                    &nbsp;
                </td>
            </tr>
        </tbody>
    </table>

    <table width="100%" style="background: #f5f8ff;
    border:1px solid #000;
    max-width: 850px;
    font-size: 13px;
    height: auto;
    font-family: 'Roboto', sans-serif;
    margin: auto;
    border-bottom:none;
    ">
        <tbody>
            <tr>
                <td width="50%" style="border-right:1px solid #000;padding:10px;height:64px;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td><label for="" style="font-weight:500;">&nbsp;</label></td>
                            </tr>
                            <tr>
                                <td style="padding-top:3px;">Transport by Air</td>
                            </tr>
                        </tbody>   
                    </table>
                </td>
                <td width="50%" style="padding:10px;height:64px;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <label for="" style="font-weight:500;">&nbsp;</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:3px;">Transport by Air</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    

    <table width="100%" style="background: #f5f8ff;
    border:1px solid #000;
    max-width: 850px;
    font-size: 12px;
    height: auto;
    font-family: 'Roboto', sans-serif;
    margin: auto;
    height:314px;
    border-bottom:none;
    ">
        <thead>
            <tr>
                <th style="width:91px;text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;font-weight:normal;line-height:14px;padding:5px;height:53px;">&nbsp;</th>
                <th style="width:272px;text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;font-weight:normal;line-height:14px;padding:5px;height:53px;">&nbsp;</th>
                <th style="width:106px;text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;font-weight:normal;line-height:14px;padding:5px;height:53px;">&nbsp;</th>
                <th style="width:79px;text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;font-weight:normal;line-height:14px;padding:5px;height:53px;">&nbsp;</th>
                <th style="width:87px;text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;font-weight:normal;line-height:14px;padding:5px;height:53px;">&nbsp;</th>
                <th style="width:91px;text-align:center;border-bottom:1px solid #000;font-weight:normal;line-height:14px;padding:5px;height:53px;">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width:91px;text-align:center;border-right:1px solid #000;vertical-align:top;padding:5px;">5</td>
                <td style="width:272px;text-align:center;border-right:1px solid #000;vertical-align:top;padding:5px;">100% Cutton and woolen T-shirt</td>
                <td style="width:106px;text-align:center;border-right:1px solid #000;vertical-align:top;padding:5px;">&nbsp;</td>
                <td style="width:79px;text-align:center;border-right:1px solid #000;vertical-align:top;padding:5px;">4</td>
                <td style="width:87px;text-align:center;border-right:1px solid #000;vertical-align:top;padding:5px;">Kathmandu</td>
                <td style="width:91px;text-align:center;vertical-align:top;padding:5px;">25- 12/12/2021</td>
            </tr>
        </tbody>
    </table>

    <table width="100%" style="background: #f5f8ff;
    border:1px solid #000;
    max-width: 850px;
    font-size: 12px;
    height: auto;
    font-family: 'Roboto', sans-serif;
    margin: auto;
    height:28px;
    border-bottom:none;
    ">
        <tbody>
            <tr>
                <td style="padding:4px 10px;">
                    <table>
                        <tbody>
                            <tr>
                                <td><label for="" style="font-weight:500;width: 85px;">&nbsp;</label></td>
                                <td style="padding-left:10px;">One lakh fifity thousand only.</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table width="100%" style="background: #f5f8ff;
    border:1px solid #000;
    max-width: 850px;
    font-size: 12px;
    height: auto;
    font-family: 'Roboto', sans-serif;
    margin: auto;
    ">
        <tbody>
            <tr>
                <td width="50%" style="height:257px;vertical-align:top;border-right:1px solid #000;padding:10px;">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="padding-bottom:5px;"><label for="" style="font-weight:500;">&nbsp;</label></td>
                                            </tr>
                                            <tr>
                                                <td style="height:55px;vertical-align:top;">
                                                    &nbsp;
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:65px;">
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="padding-top:5px;width:112px;">&nbsp;</td>
                                                <td style="padding-top:5px;text-align:center;">Seal</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:5px;">&nbsp;</td>
                                                <td style="padding-top:5px;">Air Logistic Group</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:5px;">&nbsp;</td>
                                                <td style="padding-top:5px;">Design</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:5px;">&nbsp;</td>
                                                <td style="padding-top:5px;">12/12/2021</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="50%" style="height:257px;vertical-align:top;padding:10px;">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="padding-bottom:5px;"><label for="" style="font-weight:500;">&nbsp;</label></td>
                                            </tr>
                                            <tr>
                                                <td style="height:55px;vertical-align:top;">
                                                    &nbsp;
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:65px;">
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="padding-top:5px;width:112px;">&nbsp;</td>
                                                <td style="padding-top:5px;text-align:center;">Seal</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:5px;">&nbsp;</td>
                                                <td style="padding-top:5px;">Air Logistic Group</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:5px;">&nbsp;</td>
                                                <td style="padding-top:5px;">Design</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:5px;">&nbsp;</td>
                                                <td style="padding-top:5px;">12/12/2021</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

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
