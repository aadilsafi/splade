<head>
  <!-- Scripts -->
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  <script src="{{ asset('js/app.js') }}"></script>
  <script>
    $(document).ready(function(){
      Echo.private('chat')
  .listenForWhisper('typing', (e) => {
    e.typing ? $('.typing').show() : $('.typing').hide()
    setTimeout( () => {
  console.log('timeout hiding');
  $('.typing').hide()
}, 3000)
  })


        })
  </script>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <label for="" class="typing">Typer</label>
  <div id="app">
    .
    .
    .
    .
    .
    .
  </div>
</body>