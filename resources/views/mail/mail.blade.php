<!DOCTYPE html>
<html>

<head>
    <title>@yield('mail_title')</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
</head>
<style>

</style>

<body>
    <div style="
    padding: 15px;
    border-radius: 10px;
    max-width: 100%;
    font-family: 'Open Sans', sans-serif;
    margin: 0 auto;
    box-shadow: 0px 2px 20px #f4ecec;">
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 20%; ">
                        <img src="{{ @$appsettings_logo ?? 'https://www.nectardigit.com/uploads/pictures/2289964f3f3e56bc2f88f43821fb7529site_logo.png' }}" alt="Logo" style="width: 70px; height: auto;"></th>
                    <th style="font-size: 20px; color: darkblue; font-weight: 600; text-shadow: 0px 1px 2px darkblue; border-bottom: 1px solid darkblue; width: 80%;"> {{@$sharedinfo->name}}
                    </th>
                </tr>
            </thead>
        </table>
        @yield('mail-body')
        <p> Thank You & Regards</p>
        <p>{{@$appsettings_name}} Admin</p>
    </div>

</body>

</html>
