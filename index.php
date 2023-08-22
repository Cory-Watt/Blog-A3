<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <?php
        // Start session at the beginning of the script.
        session_start();
        ?>

        <h1>Blogs Page</h1>
        <a href="search_all_blogs.php">Show all blogs</a>
        <br>

        <!-- Form for searching blogs by keyword -->
        <form class="form-horizontal" action="search_keyword.php" method="get">
            <fieldset>
                <legend>Search for a Blog</legend>
                <!-- Input group for the keyword -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="keyword">Search input</label>
                    <div class="col-md-5">
                        <input id="keyword" type="search" name="keyword" placeholder="Enter Search Term"
                            class="form-control input-md" required="">
                        <p class="help-block">Enter a keyword to search for a blog in the database</p>
                    </div>
                </div>

                <!-- Submit button for the search form -->
                <div class="form-group">
                    <label for="submit" class="col-md-4 control-label"></label>
                    <div class="col-md-4">
                        <button id="submit" name="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </fieldset>
        </form>

        <!-- Horizontal line to separate forms -->
        <hr>

        <!-- Form for adding a new blog -->
        <form class="form-horizontal" action="add_blog.php" method="post">
            <fieldset>
                <legend>Add a new Blog</legend>

                <!-- Input group for the blog title -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="newblog">New Blog</label>
                    <div class="col-md-5">
                        <input id="newblog" type="text" name="newblog" placeholder="Blog Subject"
                            class="form-control input-md" required="">
                        <p class="help-block">Enter the blog subject</p>
                    </div>
                </div>

                <!-- Input group for the blog post -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="blogbody">Blog Body</label>
                    <div class="col-md-5">
                        <textarea id="blogbody" name="blogbody" placeholder="blog body" class="form-control" rows="5"
                            required=""></textarea>
                        <p class="help-block">Enter the body of your blog</p>
                    </div>
                </div>

                <!-- Submit button for the add blog form -->
                <div class="form-group">
                    <label for="submit" class="col-md-4 control-label"></label>
                    <div class="col-md-4">
                        <button id="submit" name="submit" class="btn btn-primary">OK</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="submit" class="col-md-4 control-label"></label>
                    <div class="col-md-4">
                        <a href='logout.php'>Logout</a>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</body>

</html>