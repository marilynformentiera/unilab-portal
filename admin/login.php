<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="./assetsForSideBar/css/styles.css">
    <title>Login</title>
    <link rel="icon" href="/unilab-portal/img/logo.png" type="image/x-icon">

    <style>
        main#main {
            width: 100%;
            height: calc(100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            flex-direction: column;
            background: transparent !important;
        }

        #login-right {
            width: 40%;
            height: calc(100%);
            background: white;
            margin-top: 40px;
        }

        #login-right .card {
            margin: auto
        }
    </style>
</head>

<body style="background-image:url('../img/unilabManda.jpg'); background-size: cover;    background-repeat: no-repeat; ">
    <main id="main" class="bg-dark">
        <div class="mt-5">
            <img src="../img/UnilabLogo.png" class="rounded mx-auto d-block" style="max-width:60%" alt="Unilab-Logo">
        </div>

        <div id="login-right" class="card" style="color: #092e6e;">

            <div class="card-body">
                <form action="partials/_handleLogin.php" method="post">
                    <div class="p-2">
                        <label for="username" class="form-check-label"><b>Username</b></label>
                        <input type="text" id="username" name="username" class="form-control">
                    </div>
                    <div class="mb-2 p-2">
                        <label for="password" class="form-check-label"><b>Password</b></label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <center><button type="submit" class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
                </form>


            </div>

        </div>


    </main>


    <?php
    if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false") {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> Invalid Credentials
                <button type="button" class="btn-close" data-bs-dismiss="alert"><span aria-label="Close"></span></button>
                </div>';
    }
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>