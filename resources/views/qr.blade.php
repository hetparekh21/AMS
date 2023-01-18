<html>

<head>
    <title>QR</title>
<script src="../assets/js/config.js" ></script>
<link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />

</head>

{{-- vertically centered div  --}}
<body class="h-100">
    <div class="container h-100">
        <div class="row h-100">
            {{-- <div class="col-md-12"> --}}
                <div class="card h-100 d-flex align-items-center">
                    <div class="card-body">
                        {{-- <div class="row">
                            <div class="col-md-5"> --}}
                                <div class="text-center">
                                    <h1>QR</h1>
                                    <p>Scan this QR code to join the class</p>
                                    {{  QrCode::size(300)->generate(session('message')); }}
                                </div>
                            {{-- </div>
                        </div> --}}
                    </div>
                </div>
            {{-- </div> --}}
        </div>
    </div>

</html>