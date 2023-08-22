<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!-- Google Identity Service -->
    <script src="https://accounts.google.com/gsi/client"></script>

    <!-- Google Sign-in Handler -->
    <script>
        // This function will be called when the user successfully signs in using Google
        function onSignIn(credential) {
            // If the credential object exists
            if (credential) {
                // Logging to console for debugging purposes
                console.log("Google Sign-In successful");

                // Extracting the id_token from the credential
                var id_token = credential.credential;

                // Redirecting the user to the PHP script to process the Google login 
                // with the id_token as a parameter
                window.location.href = 'process_google_login.php?idtoken=' + id_token;
            }
        }
    </script>
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

    <!-- Google Sign-In button setup, with client ID and callback function provided -->
    <div id="g_id_onload" data-client_id="978762936400-13rs762kpapkc7f884r04rtfat8oiqar.apps.googleusercontent.com"
        data-login_uri="https://activity-3-blog.azurewebsites.net/process_google_login.php" data-callback="onSignIn">
    </div>

</body>

</html>