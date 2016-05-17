<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Basic Punch Engine</title>
        <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
        
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
            include '../vendor/autoload.php';
            
            use FNVi\Punches\Schemas\Punch;
            use FNVi\Punches\Collections\Punches;
            
            $punches = new Punches();
            
            $args = [
                "item"=>FILTER_SANITIZE_STRING,
                "issue"=>FILTER_SANITIZE_STRING,
                "user"=>FILTER_SANITIZE_STRING
            ];
                
            $post_vars = filter_input_array(INPUT_POST, $args, false);
            
            if(count($post_vars) === count($args)){
                $punches->insertOne(new Punch($post_vars["item"], $post_vars["user"], $post_vars["issue"]));
                header("Location: index.php");
            }
            
        ?>
        <nav class="navbar navbar-default">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php">Punch list</a>
                    </li>
                    <li>
                        <a href="raisepunch.php">Raise Punch</a>
                    </li>
                    <li>
                        <a href="aggregate.php">Accordion List</a>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="jumbotron">
                        Enter a punch item below
                    </div>
                    <form method="post">
                        <div class="form-group">
                            <label for="user">
                                Username:
                            </label>
                            <input class="form-control" type="text" id="user" name="user" value="Wile E Coyote">
                        </div>
                        <div class="form-group">
                            <label for="item">
                                Item:
                            </label>
                            <input class="form-control" type="text" id="item" name="item" value="Jet propelled running shoes">
                        </div>
                        <div class="form-group">
                            <label for="issue">
                                Issue:
                            </label>
                            <textarea class="form-control" id="issue" name="issue" rows="4">Rockets are delayed too long. When they do fire they are too powerful</textarea>
                        </div>
                        <button class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>
