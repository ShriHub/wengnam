
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/fulltilt/dist/fulltilt.min.js"></script>
<script src="lib/gyronorm.js"></script>
<link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">


<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
</style>
<style>
body, html {
  height: 100%;
  margin: 0;
  /*font: 400 15px/1.8 "Lato", sans-serif;*/
  color: #777;
  background-color:black;
  font-family: 'Roboto', sans-serif;

}

.bgimg-1, .bgimg-2, .bgimg-3 {
  position: relative;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;

}

.bgimg-1 {
  background-image: url("img_parallax.jpg");
  height: 100%;
}

.caption {
  position: absolute;
  left: 0;
  top: 25%;
  width: 100%;
  text-align: center;
  color: #000;
}

.caption span.border {
  /*background-color: #111;*/
  color: #5f5c5c;
  padding: 15px;
  font-size: 20px;
  /*letter-spacing: 10px;*/
}

h3 {
  letter-spacing: 5px;
  text-transform: uppercase;
  font: 20px "Lato", sans-serif;
  color: #111;
}



</style>
</head>
<body onload="init_gn()">

<!-- <div class="bgimg-1" id="showmsg">
  <div class="caption">
<p>
        <img src="images/tilt.png" style="opacity:0.8;padding:35px;" >
    </p>

    <span class="border">Slowly tilt & pan your phone to search the sound of Kuala Lumpur.</span>
    <p><span class="border" style="color:#607690">Guess the location by listening to it.</span></p>
    
  </div>
</div> -->

  <div class="container">

    <div role="tabpanel">
      <!-- Nav tabs -->
      <ul class="nav nav-pills" role="tablist">
        <li role="presentation" class="active"><a href="#do" aria-controls="do" role="tab" data-toggle="tab">Orientation</a></li>
        <li role="presentation"><a href="#dm" aria-controls="dm" role="tab" data-toggle="tab">Motion</a></li>
        <li role="presentation"><a href="#logs" aria-controls="logs" role="tab" data-toggle="tab">Logs</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">

        <div role="tabpanel" class="tab-pane active" id="do">

          <div class="input-group col-xs-12">
            <span class="input-group-addon">alpha</span>
            <input type="text" class="form-control" id="do_alpha" disabled>
          </div>

          <div class="input-group col-xs-12">
            <span class="input-group-addon">beta</span>
            <input type="text" class="form-control" id="do_beta" disabled>
          </div>

          <div class="input-group col-xs-12">
            <span class="input-group-addon">gamma</span>
            <input type="text" class="form-control" id="do_gamma" disabled>
          </div>

          <input type="button" onclick="set_head_gn()" value="Set Head Direction" class="col-xs-12 btn-warning btn"/>

        </div>
        <div role="tabpanel" class="tab-pane" id="dm">

          <div class="col-xs-12">
            Acceleration
          </div>
          <div class="input-group col-xs-4 first">
            <span class="input-group-addon">x</span>
            <input type="text" class="form-control" id="dm_x" disabled>
          </div>

          <div class="input-group col-xs-4">
            <span class="input-group-addon">y</span>
            <input type="text" class="form-control" id="dm_y" disabled>
          </div>

          <div class="input-group col-xs-4">
            <span class="input-group-addon">z</span>
            <input type="text" class="form-control" id="dm_z" disabled>
          </div>

          <div class="col-xs-12">
            Acceleration including gravity
          </div>

          <div class="input-group col-xs-4 first">
            <span class="input-group-addon">x</span>
            <input type="text" class="form-control" id="dm_gx" disabled>
          </div>

          <div class="input-group col-xs-4">
            <span class="input-group-addon">y</span>
            <input type="text" class="form-control" id="dm_gy" disabled>
          </div>

          <div class="input-group col-xs-4">
            <span class="input-group-addon">z</span>
            <input type="text" class="form-control" id="dm_gz" disabled>
          </div>

          <input type="button" onclick="norm_gn()" value="Normalize" class="col-xs-6 btn-warning btn"/>
          <input type="button" onclick="org_gn()" value="Original" class="col-xs-6 btn-warning btn"/>

          <p>&nbsp;</p>
          <div class="col-xs-12">
            Rotation rate
          </div>
          <div class="input-group col-xs-12">
            <span class="input-group-addon">alpha</span>
            <input type="text" class="form-control" id="dm_alpha" disabled>
          </div>

          <div class="input-group col-xs-12">
            <span class="input-group-addon">beta</span>
            <input type="text" class="form-control" id="dm_beta" disabled>
          </div>

          <div class="input-group col-xs-12">
            <span class="input-group-addon">gamma</span>
            <input type="text" class="form-control" id="dm_gamma" disabled>
          </div>

        </div>
        <div role="tabpanel" class="tab-pane" id="logs">
          <textarea class="col-xs-12 form-control" id="error-message" style="height:100px" placeholder="Log area..." disabled></textarea>
        </div>
      </div>

    </div>

  </div>

  <div style="display:none;">
    <input type="button" onclick="start_gn()" value="START" class="col-xs-6 btn-info btn"/>
    <input type="button" onclick="stop_gn()" value="STOP" class="col-xs-6 btn-info btn"/>

  </div>

  <script type="text/javascript">
    var gn;

    function init_gn() {
      var args = {
        logger: logger
      };

      gn = new GyroNorm();

      gn.init(args).then(function() {
        var isAvailable = gn.isAvailable();
        if(!isAvailable.deviceOrientationAvailable) {
          logger({message:'Device orientation is not available.'});
        }

        if(!isAvailable.accelerationAvailable) {
          logger({message:'Device acceleration is not available.'});
        }

        if(!isAvailable.accelerationIncludingGravityAvailable) {
          logger({message:'Device acceleration incl. gravity is not available.'});
        } 

        if(!isAvailable.rotationRateAvailable) {
          logger({message:'Device rotation rate is not available.'});
        }

        start_gn();
      }).catch(function(e){

        console.log(e);
        
      });
    }

    function logger(data) {
      $('#error-message').append(data.message + "\n");
    }

    function stop_gn() {
      gn.stop();
    }

    function start_gn() {
      gn.start(gnCallBack);
    }

    function gnCallBack(data) {
      $('#do_alpha').val(data.do.alpha);
      $('#do_beta').val(data.do.beta);
      $('#do_gamma').val(data.do.gamma);

      $('#dm_x').val(data.dm.x);
      $('#dm_y').val(data.dm.y);
      $('#dm_z').val(data.dm.z);

      $('#dm_gx').val(data.dm.gx);
      $('#dm_gy').val(data.dm.gy);
      $('#dm_gz').val(data.dm.gz);

      $('#dm_alpha').val(data.dm.alpha);
      $('#dm_beta').val(data.dm.beta);
      $('#dm_gamma').val(data.dm.gamma);
    }

    function norm_gn() {
      gn.normalizeGravity(true);
    }

    function org_gn() {
      gn.normalizeGravity(false);
    }

    function set_head_gn() {
      gn.setHeadDirection();
    }

    function showDO() {
      $('#do').show();
      $('#dm').hide();
      $('#btn-dm').removeClass('selected');
      $('#btn-do').addClass('selected');
    }

    function showDM() {
      $('#dm').show();
      $('#do').hide();
      $('#btn-do').removeClass('selected');
      $('#btn-dm').addClass('selected');
    }
  </script>


<script type="text/javascript">
var ip = "<?php echo $_SERVER['SERVER_ADDR']; ?>";  
var conn = new WebSocket('ws://'+ip+':8080');
  
// var conn = new WebSocket('ws://localhost:8080');

conn.onopen = function(e) {
  console.log("Connection established!!");
};

var i = 0;
conn.onmessage = function(e){
  console.log(e.data);
  var msg = JSON.parse(e.data);
  if(msg.connection_key != null){
    console.log(msg.connection_key);
    // qrcode.makeCode(msg.connection_key)
  }else{
    if(i>0){
     console.log('updating mouse pointer now..');
    }else{
      document.getElementById('showmsg').remove();
      i = i +1;
    }
  }

  // if(msg.mobile_connected != null && msg.mobile_connected == true){
  //   console.log('removing message & showing art..');
  //   document.getElementById('showmsg').remove();
  // }
};

function subscribe(channel) {
    conn.send(JSON.stringify({command: "subscribe", channel: channel}));
}

</script>

</body>
</html>