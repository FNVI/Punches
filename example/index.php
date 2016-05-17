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
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" />

        
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
            include '../vendor/autoload.php';
            
            use FNVi\Punches\PunchList;
            
            $status = filter_input(INPUT_GET, "status", FILTER_SANITIZE_STRING);
            
            $punchlist = new PunchList();
            
            $punches = [];
            
            if($status){
                $punches = $punchlist->getPunchesWithStatus($status);
            } else {
                $punches = $punchlist->getPunches();
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
                        <span>
                            This is a basic example of the punch list engine.
                            Punches can be raised, accepted, closed and reported on. Use the buttons below to filter the punchlist
                        </span>
                        <br>
                        <form>
                            <button name="status" value="open" class="btn btn-default">Open</button>
                            <button name="status" value="raised" class="btn btn-info">Raised</button>
                            <button name="status" value="accepted" class="btn btn-warning">Accepted</button>
                            <button name="status" value="rejected" class="btn btn-danger">Rejected</button>
                            <button name="status" value="closed" class="btn btn-success">Closed</button>
                            <a href="index.php" class="btn btn-primary">All</a>
                        </form>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Raised by</th>
                                <th>Timestamp</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($punches as $punch){ ?>
                            <tr>
                                <td><?php echo $punch->item; ?></td>
                                <td><?php echo $punch->raised->by; ?></td>
                                <td><?php echo $punch->raised->timestamp->toDateTime()->format("d/m/y h:i:s"); ?></td>
                                <td><?php echo $punch->issue; ?></td>
                                <td><?php echo $punch->status["name"]; ?></td>
                                <td>
                                    <a href="punchdetail.php?id=<?php echo $punch->getId(); ?>" class="btn btn-default"><i class="fa fa-file-text-o"></i> </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </body>
</html>
