<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Biz Navigator - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/login.css">
</head>

<body>
    <div class="container-background">
        <div class="signin-container">
            <div class="container px-5 py-5 mt-3">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-light">Sign in</h2>
                    </div>
                </div>

                <form action="./proses-user.php" method="POST">
                    <div class="row">
                        <div class="col-12">
                            <input type="email" name="email" class="form-control mt-3 py-3" placeholder="Email Address">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <input type="password" name="password" class="form-control mt-3 py-3" placeholder="Password">
                        </div>
                    </div>

                    <div class="row mt-3 no-gutters">
                        <div class="col-3">
                            <button type="submit" name="aksi" value="login" class="btn btn-light px-3 py-2">Sign in</button>
                        </div>
                        <div class="col-4">
                            <button type="submit" name="aksi" value="signup" class="btn btn-light px-3 py-2"><a href="./signup.php"
                                    style="text-decoration: none; color: black;">Sign up</a></button>
                        </div>
                    </div>
                </form>

                <div class="row mt-3">
                    <div class="col-12">
                        <a href="#" class="text-light" style="text-decoration: none;">Forgot your Password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>