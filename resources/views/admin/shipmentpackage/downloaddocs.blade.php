<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <table style="font-family: 'Roboto', sans-serif;text-align:center;" width="100%">
        <thead>
            @isset($package->shipmentFiles)
                @foreach ($package->shipmentFiles as $docs)
                    <tr>
                        <td style="padding:7px">
                            <img src="{{ public_path($docs->filepath) }}" style="width: 100%;">
                        </td>
                       
                    </tr>
                @endforeach
            @endisset
        </thead>
    </table>
</body>

</html>
