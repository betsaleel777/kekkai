<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>404</title>
    <link rel="stylesheet" href="{{asset('css/error.css')}}">
</head>

<body>
    <div class="mars"></div>
    <img src="https://mars-404.templateku.co/img/404.svg" class="logo-404" />
    <img src="https://mars-404.templateku.co/img/meteor.svg" class="meteor" />
    <p class="title">Oh no!!</p>
    <p class="subtitle">
        Pas d'issue possible<br /> Une erreur s'est produite dans l'URL
    </p>
    <div align="center">
        <a class="btn-back" href="{{url()->previous()}}">Acceuil</a>
    </div>
    <img src="https://mars-404.templateku.co/img/astronaut.svg" class="astronaut" />
    <img src="https://mars-404.templateku.co/img/spaceship.svg" class="spaceship" />
</body>


</html>
