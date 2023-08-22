<html>
    <head> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    <body>
    <!-- Begin the form for new user registration, which will post to process_new_user.php -->
    <form class="form-horizontal" action="process_new_user.php" method="post">
        <!-- Create a fieldset to group related form elements -->
        <fieldset>

        <!-- Provide a title for the form -->
        <legend>Register new account</legend>

        <!-- Form group for entering a new username -->
        <div class="form-group">
            <!-- Label for the username input field -->
            <label class="col-md-4 control-label" for="keyword">New username</label>
            <div class="col-md-5">
                <!-- Input field for entering the new username -->
                <input id="username" type="text" name="username" placeholder="your name" class="form-control input-md" required="">
                <!-- Helpful hint to the user -->
                <p class="help-block">Create a new login name</p>
            </div> 
        </div>

        <!-- Form group for entering a new password -->
        <div class="form-group">
            <!-- Label for the password input field -->
            <label class="col-md-4 control-label" for="keyword">New password</label>
            <div class="col-md-5">
                <!-- Input field for entering the password -->
                <input id="password" type="password" name="password" placeholder="" class="form-control input-md" required="">
                <!-- hint for the user -->
                <p class="help-block">Create a new password</p>
            </div>
        </div> 

        <!-- Form group for confirming the password -->
        <div class="form-group">
            <!-- Label for the password confirmation input field -->
            <label class="col-md-4 control-label" for="keyword">Confirm password</label>
            <div class="col-md-5">
                <!-- Input field for re-entering the new password -->
                <input id="password-confirm" type="password" name="password-confirm" placeholder="" class="form-control input-md" required="">
                <!-- Helpful hint to the user -->
                <p class="help-block">Retype the password</p>
            </div>
        </div>

        <!-- Form group for the submission button -->
        <div class="form-group">
            <label for="submit" class="col-md-4 control-label"></label>
            <div class-"col-md-4">
                <!-- Submit button to confirm and send form data -->
                <button id="submit" name="submit" class="btn btn-primary">OK</button>
            </div>
        </div>
    </form>
</body>
</html>
