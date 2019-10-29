<?php require_once("../config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/jquery.Jcrop.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="css/asw.css" media="screen">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    <?php
    $id=0;
    $nama_tw = " ";
    $caption= " ";
    $update = false;

    if(isset($_GET['pesan'])){
    $id = $_GET['pesan'];
    $query  = mysqli_query($koneksi, "SELECT * FROM tb_images WHERE id = '$id' ORDER BY id DESC");
    $data = mysqli_fetch_array($query);
    $ukuran = $data['ukuran'];
    $nama_tw= $data['nama_tw'];
    $caption = $data['caption'];
    $url = "../add_tw.php?id=%20$id";
    }
    ?>
    .jcrop-holder div .jcrop-tracker {
        background: url("<?php echo $url?>") center center/cover no-repeat
    }
    </style>
    <title>Twibbon <?=$nama_tw?></title>
</head>

<body>
<header class="header">
        <div class="segitigaatas d-none d-md-block">
            <img src="./image/pojokatas.png" />
        </div>
    </header>

<div class="jumbotron">
    <h1 id="judul" class="display-2"><?php echo $nama_tw ?></h1>    
</div>
  
<div class="container-fluid bg-3 text-center">    
  <h3>~ Ofiicial Twibbon ~</h3><br>
  <div class="row justify-content-center">

  <div class="col-sm-12 justify-content-center">
                    <div class="attachment attachment-1 ">
                        <label for="attachment" class="btn btn-primary">Unggah Fotomu</label>
                        <input type="file" id="attachment" name="attachment" accept="image/*" required="">
                        <a class="btn btn-primary" href='<?php echo $url; ?>'>Download File Twibbon</a>
                    </div>
                    <div id="result" class="image-hide">
                        <canvas id="uploadimage" width="2000" height="2000" class="img-fluid"></canvas>
                    </div>
                <div class="text-content-2">
                <small class="form-text text-muted d-none d-md-block">
                Ini adalah caption untuk twibbon <?=$nama_tw?>.
                </small>
                <div class="row justify-content-md-center">
                <div class="col-md-5"><div class="wrapper-text"><span id="copyTarget2"><?=$caption?></span></div></div>
                </div>
                </div>
                <div class="new-download">
                    <a href="./index.php?pesan=<?php echo $id ?>" class="btn btn-primary">Unggah Foto Baru</a>
                    <a id="download" class="btn btn-success"style="color: white;">Unduh</a>
                    <button id="copyButton2" type="button" class="btn btn-info">Copy Caption</button>
                </div>
    </div>

  </div>
</div><br>

<br><br>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="./js/jquery.Jcrop.js"></script>
    <link href="http://jcrop-cdn.tapmodo.com/v0.9.12/css/jquery.Jcrop.min.css" rel="stylesheet" />
    <script src="./js/load-image.all.min.js" type="text/javascript"></script>
    <script src="./js/Blob.js" type="text/javascript"></script>
    <script src="./js/canvas-toBlob.js" type="text/javascript"></script>
    <script src="./js/FileSaver.js" type="text/javascript"></script>
    <img src="<?php echo $url?>" id="img3" width="<?php echo $ukuran?>" height="<?php echo $ukuran?>" hidden="true">
  <script>
        (function($) {

            var result = $('#result');
            var coordinates;
            var canvas = document.getElementById("uploadimage");
            var context = canvas.getContext("2d");

            function processImage(img) {
                $('.image-hide, .text-content-2, .new-download, .figure').show();
                $('h2, figure, .attachment-1, .text-content-1').hide();
                $('.images-caman').addClass('images-caman-active');

                canvas.width = img.width;
                canvas.height = img.height;
                context.drawImage(img, 0, 0);
                var imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                var px = imageData.data;
                var len = px.length;
                for (var i = 0; i < len; i += 4) {
                    var redPx = px[i];
                    var greenPx = px[i + 1];
                    var bluePx = px[i + 2];
                    var alphaPx = px[i + 3];
                }
                context.putImageData(imageData, 0, 0);

                $('#uploadimage').Jcrop({
                    bgOpacity: .4,
                    allowSelect: false,
                    setSelect: [0, 0, 800, 800],
                    aspectRatio: 1,
                    onSelect: function(coords) {
                        coordinates = coords
                    },
                    onRelease: function() {
                        coordinates = null
                    }
                });
                $('#statusedit').hide();
            }

            function displayImage(file, options) {
                currentFile = file
                if (!loadImage(
                        file,
                        processImage,
                        options
                    )) {
                    alert("Your browser does not support the URL or FileReader API");
                }
            }

            function dropChangeHandler(e) {
                e.preventDefault()
                e = e.originalEvent
                var target = e.dataTransfer || e.target
                var file = target && target.files && target.files[0]
                var options = {
                    maxWidth: 3000,
                    canvas: true,
                    pixelRatio: window.devicePixelRatio,
                    downsamplingRatio: 0.5
                }
                if (!file) {
                    return
                }

                loadImage.parseMetaData(file, function(data) {
                    if (data.exif) {
                        options.orientation = data.exif.get('Orientation')
                    }
                    displayImage(file, options)
                })
            }

            $('#attachment').on('change', dropChangeHandler)

            var img3 = document.getElementById('img3');
            var crop_canvas = document.createElement('canvas');
            crop_canvas.width = <?=$ukuran?>;
            crop_canvas.height = <?=$ukuran?>;
            document.getElementById('download').addEventListener('click', function() {
                var ratioY = canvas.height / result.height(),
                    ratioX = canvas.width / result.width();
                var getX = coordinates.x * ratioX,
                    getY = coordinates.y * ratioY,
                    getWidth = coordinates.h * ratioX,
                    getHeight = coordinates.w * ratioY;
                crop_canvas.getContext('2d').drawImage(canvas, getX, getY, getWidth, getHeight, 0, 0, <?=$ukuran?>, <?=$ukuran?>);
                crop_canvas.getContext('2d').drawImage(img3, 0, 0, <?=$ukuran?>, <?=$ukuran?>, 0, 0, <?=$ukuran?>, <?=$ukuran?>);
                crop_canvas.toBlobHD(function(blob) {
                    saveAs(blob, "<?=$nama_tw?>.png");
                }, "image/png");

            }, false);
        })(jQuery);

    </script>
<script>

document.getElementById("copyButton2").addEventListener("click", function() {
    copyToClipboardMsg(document.getElementById("copyTarget2"));
});


function copyToClipboardMsg(elem, msgElem) {
	  var succeed = copyToClipboard(elem);
    if (typeof msgElem === "string") {
        msgElem = document.getElementById(msgElem);
    }
}

function copyToClipboard(elem) {
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}


    </script>
</body>

</html>
