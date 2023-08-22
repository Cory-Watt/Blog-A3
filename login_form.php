<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body>

    <h1>Login for Jokes</h1>

    <!-- Including the database connection script -->
    <?php include "db_connect.php"; ?>

    <!-- Login form -->
    <form class="form-horizontal" action="process_login.php" method="post">
        <fieldset>
            <legend>Please login</legend>

            <!-- Username input field -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="username">Username</label>
                <div class="col-md-5">
                    <input id="username" type="text" name="user_name" placeholder="your name"
                        class="form-control input-md" required="">
                    <p class="help-block">Enter your username</p>
                </div>
            </div>

            <!-- Password input field -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="password">Password</label>
                <div class="col-md-5">
                    <input id="password" type="password" name="password" placeholder="password"
                        class="form-control input-md" required="">
                    <p class="help-block">Enter your password</p>
                </div>
            </div>

            <!-- Login button -->
            <div class="form-group">
                <label for="submit" class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <button id="submit" name="submit" class="btn btn-primary">Login</button>
                </div>
            </div>


            <div class="form-group">
                <label for="submit" class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <a href='register_new_user.php'>Create Account</a>
                </div>
            </div>

        </fieldset>
    </form>

    <!-- Close the database connection -->
    <?php $conn = null; ?>

</body>

</html>