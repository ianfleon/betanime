<?php

// redirect ke index.php
header("Refresh:3; url=index.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404!</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            flex-direction: column;
/*            width: 100%;
            height: 100%;*/
        }

        * {
            margin: auto;
        }

        .error-img {
            /*width: 320px;*/
            height: 260px;
            object-fit: cover;  
        }

        .not-found {
            margin-top: 3rem;
            text-align: center;
        }

    </style>
</head>
<body>
    <div class="not-found">
        <img src="static/img/404.png" class="error-img">
        <p>Data tidak ditemukan..</p>
    </div>
</body>
</html>