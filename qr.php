
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/qrcode.min.js"></script>

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
  top: 35%;
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
<body>

<div class="bgimg-1" id="showmsg">
  <div class="caption">
    <span class="border">Connect your smartphone or tablet.</span>
    <p><span class="border">Scan the QR code, or visit <a style="text-decoration:none;color: #f90002;" href="#">www</a> on your mobile.</span></p>
    <p>
        <!-- <img src="images/qr.jpg" style="opacity:0.8;padding:35px;" > -->
<div id="qrcode" style="width:100px; height:100px; margin:0 auto;"></div>
    </p>
    <p> <span class="border">*No phone? <a href="art.html" style="color: #abcdf4;">Use your mouse.</a></span> </p>
  </div>
</div>


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
    qrcode.makeCode(msg.connection_key);
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

// function sendMessage(msg) {
//     conn.send(JSON.stringify({command: "message", message: msg}));
// }

var qrcode = new QRCode(document.getElementById("qrcode"), {
  width : 100,
  height : 100
});

// function makeCode (elText){
//   if (!elText.value) {
//     alert("Input a text");
//     elText.focus();
//     return;
//   }
//   qrcode.makeCode(elText.value);
// }

// makeCode();

// $("#text").
//   on("blur", function () {
//     makeCode();
//   }).
//   on("keydown", function (e) {
//     if (e.keyCode == 13) {
//       makeCode();
//     }
//   });
</script>

</body>
</html>