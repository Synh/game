
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <script>

        $(".audioDemo").trigger('play');


    </script>

</head>
<body >

<div class="container">
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Envoyer un fichier</span>
            </div>
            <div class="custom-file">

                <label class="custom-file-label" for="audio">audio</label>
                <input class="custom-file-input" id="audio" type="file" name="audio">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>

<audio class="audioDemo" controls preload="none">
    <source src="{{ $toto }}" type="audio/mpeg">
</audio>


</body>
</html>




