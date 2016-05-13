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
                    <div class="list-group">
                        <?php foreach($punches->find() as $punch){ ?>
                        <a class="list-group-item" href="punchdetail.php?id=<?php echo $punch->getId(); ?>">
                            <?php echo $punch->item; ?>
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
