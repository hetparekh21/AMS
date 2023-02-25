<html>

<head>
    <title>QR</title>
    <script src="../assets/js/config.js"></script>
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
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
                        <div id="qr"></div>
                        {{-- {{  QrCode::size(300)->generate(session('message')); }} --}}
                    </div>
                    {{-- </div>
                        </div> --}}
                </div>
            </div>
            {{-- </div> --}}
        </div>
    </div>
</body>

<script>
    Timer = 120000;

    get_qr();

    // write a function to close the window after a minute
    setTimeout(function() {
        window.close();
    }, Timer);

    // write a function to print "Hello" every 30 seconds
    setInterval(function() {
        get_qr();
    }, 30000);

    function get_qr() {
        // use ajax to call the controller
        $.ajax({
            url: '{{ route('dynamic_qr', $code) }}',
            type: 'POST',
            success: function(data) {
                console.log(data);
                $("#qr").html(data);
            }
        });
    }
</script>

</html>
