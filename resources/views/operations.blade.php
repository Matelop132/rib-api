<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway';
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;

        }
        .top-left {
            position: absolute;
            left: 10px;
            top: 18px;
        }
        .content {
            text-align: center;
        }
        .title {
            font-size: 84px;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border-color: #636b6f;
        }
        .m-b-md {
            margin-bottom: 30px;
        }
        .solde{
            margin : 25px;
        }

    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
<h2 class="top-left"> Nom d'utilisateur : {{Session('user')}} </h2>


    <div class="content">
        <div class="title m-b-md">
            Vos informations de compte
        </div>


        <p class="top-left">

        </p>
        <div class="links">
            <a href="/api/operations/depenses">Vos dépenses</a>
            <a href="/api/operations/recettes">Vos recettes</a>
            <a href="/api/operations/paiements">Paiements</a>
            <a href="/api/operations/ajout_paiment">Ajout_paiment</a>
            <a href="/api/operations/releve"> Relevé d'identité bancaire</a>

            <br>
        </p>

    </div>

</div>
</div>

<a class="top-right" href="/disconnect"> disconnect</a>
</body>




</html>




