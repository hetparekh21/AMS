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
                        <p>Scan this QR code to join the class {{$code}}</p>
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
    // setTimeout(function() {
    //     // wait till the function is called
    //     clear_mapper_data();
    // }, Timer);

    setInterval(function() {
        get_qr();
    }, 5000);

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

    // You can use this is cron job
    function clear_mapper_data() {
        $.ajax({
            url: '{{ route('clear.mapper', $code) }}',
            type: 'get',
            success: function(data) {
                console.log('data cleared');
                window.close();
            }
        });
    }
</script>

</html>
