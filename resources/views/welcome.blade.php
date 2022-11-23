<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <title>Getting RealTime Notification</title>
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


</head>

<body class="antialiased">

     <div class="container">
          <div style="display:none;" class="alert alert-success" id="notification_panel">kfdghfdkjgh</div>


          <div class="jumbotron" style="margin-top:15px;">
               <h1 class="display-4">Realtime Notification</h1>
               <p class="lead">When you fire an event from websockets dashboard, you will receive notification here on
                    the top.</p>
               </p>
          </div>


     </div>

</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>

<script src="https://js.pusher.com/6.0/pusher.min.js"></script>
<script>
     let a_tok = document.querySelector('meta[name="csrf-token"]').content;

     //suscribing to pusher channel
     Pusher.logToConsole = false;
     var pusher = new Pusher('12345', {
          cluster: 'mt1',
          broadcaster: 'pusher',
          //key: process.env.MIX_PUSHER_APP_KEY,
          //cluster: process.env.MIX_PUSHER_APP_CLUSTER,
          forceTLS: false,
          wsHost: window.location.hostname,
          wsPort: 6001,
          wssPort: 6001,
     });
     var channel = pusher.subscribe('events');
     channel.bind('App\\Events\\RealTimeMessage', (d) => {
          if (d.msg == null || d.msg == "") {
               $("#notification_panel").removeClass('alert alert-success');
               $("#notification_panel").addClass('alert alert-danger');
               $("#notification_panel").text('Notification was blank');
               $("#notification_panel").fadeIn();
               setTimeout(function() {
                    $("#notification_panel").fadeOut();
               }, 2000);
          } else {
               $("#notification_panel").removeClass('alert alert-danger');
               $("#notification_panel").addClass('alert alert-success');
               $("#notification_panel").text(d.msg);
               $("#notification_panel").fadeIn();
               setTimeout(function() {
                    $("#notification_panel").fadeOut();
               }, 2000);
          }
     });
</script>

</html>
