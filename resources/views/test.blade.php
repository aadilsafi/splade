<head>
    <!-- Scripts -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('input').on('keydown', function(){
                let channel = Echo.private('chat')

setTimeout( () => {
  channel.whisper('typing', {
    typing: true
  })
}, 300)
        })
                    
                
})


    </script>
    <script>
        // Echo.channel('trades')
        //     .listen('NewTrade', (e) => {
        //         console.log(e.trade);
        //     })

    </script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <input type="text" name="" id="">
    <div id="app">
        .
        .
        .
        .
        .
        .
    </div>
</body>