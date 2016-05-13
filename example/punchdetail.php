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
            use FNVi\Punches\Collections\Punches;
            $punches = new Punches();
            
            $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
            
            $punch = $punches->getPunch($id);
            
        ?>
        <nav class="navbar navbar-default">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="raisepunch.php">Raise Punch</a>
                    </li>
                    <li>
                        <a href="punchlist.php">Punch list</a>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                Item:
                            </label>
                            <p class="form-control-static">
                                <?php echo $punch->item; ?>
                            </p>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                Raised by:
                            </label>
                            <p class="form-control-static">
                                <?php echo $punch->raised->by; ?>
                            </p>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                Timestamp:
                            </label>
                            <p class="form-control-static">
                                <?php echo $punch->raised->timestamp->toDateTime()->format("d/m/y h:i:s"); ?>
                            </p>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                Issue:
                            </label>
                            <p class="form-control-static">
                                <?php echo $punch->issue; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
