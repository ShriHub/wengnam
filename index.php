
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
</style>

<style type="text/css">
  .container{
    margin-top: 20px;
  }

  .tab-pane{
    margin-top: 15px;
  }

  .page-header{
    margin-top: 20px;
  }

  .input-group{
    margin-bottom: 20px;

  }

  input[type=text],
  textarea{
    box-shadow: none;
    -webkit-appearance:none;
    -webkit-box-shadow: none !important;
    -moz-box-shadow: none !important;
    box-shadow: none !important;
  }

  #dm .input-group{
    float: left;
    padding-left: 10px;
  }

  #dm .input-group.first{
    padding-left: 0px;
  }

  #dm .col-xs-12{
    padding-left: 0;
  }

</style>

<style>
body, html {
  height: 100%;
  margin: 0;
  font-family: 'Roboto', sans-serif;
  color: #777;
}

.footer {
  position: absolute;
  bottom: 8px;
  right: 16px;
  font-size: 16px;
  color:black;
}

.start {
  position: absolute;
  bottom: 50px;
  right: 50px;
  font-size: 16px;
  color:black;
}


span + span {
    margin-left: 10px;
}

.bgimg-1, .bgimg-2, .bgimg-3 {
  position: relative;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;

}
.bgimg-1 {
  background-image: url("images/landing.png");
  height: 100%;
}

.caption {
  position: absolute;
  left: 0;
  top: 1%;
  width: 100%;
  text-align: center;
  color: #000;
  display:none;
}

.caption span.border {
  background-color: #111;
  color: #fff;
  padding: 18px;
  font-size: 25px;
  letter-spacing: 10px;
}

h3 {
  letter-spacing: 5px;
  text-transform: uppercase;
  font: 20px "Lato", sans-serif;
  color: #111;
}

img.map, map area{
    outline: none;
}

a:link {
  text-decoration: none;
  color: inherit;
}

</style>
</head>
<body>

<div class="bgimg-1">
  <div class="caption">
    <span class="border">FULL PAGE</span><br>
    <span class="border">BACKGROUND IMAGE</span>
    
    <span class="border">*No phone? Use your mouse.</span>
    

  </div>
</div>

<div class="start">
    <img src="images/footer/start-btn.png" style="width:75%;" id="ex"  onclick="nextScreen();">
</div>

  <div class="footer">
      <span><a href="/about" style="color:black;">Weng Nam Yap | About</a>  </span> | 
      <span><a href="https://facebook.com"><img src="images/footer/fb-dark.png"></a></span>
      <span><a href="https://instagram.com"><img src="images/footer/ig-dark.png"></a></span>
      <span><img src="images/footer/fs-dark.png" id="fs"></span>
<!--style="display:none;"-->
  </div>
  

<script>

function nextScreen(){
    window.location.href="qr.html";
}

var elem = document.documentElement;
document.getElementById("fs").onclick = function() {openFullScreen()};
let is_fullscreen = () => !! document.fullscreenElement

function openFullScreen() {
    console.log('test');
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.webkitRequestFullscreen) { /* Safari */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE11 */
    elem.msRequestFullscreen();
  }
}

function closeFullScreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.webkitExitFullscreen) { /* Safari */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE11 */
    document.msExitFullscreen();
  }

}
</script>


</body>



</html>


