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
        <style>
            .panel-heading .accordion-toggle:after {
                /* symbol for "opening" panels */
                font-family: 'Glyphicons Halflings';  /* essential for enabling glyphicon */
                content: "\e113";    /* adjust as needed, taken from bootstrap.css */
                float: right;        /* adjust as needed */
                color: grey;         /* adjust as needed */
            }
            .panel-heading .accordion-toggle.collapsed:after {
                /* symbol for "collapsed" panels */
                content: "\e114";    /* adjust as needed, taken from bootstrap.css */
            }
        </style>
    </head>
    <body>
        <?php
            include '../vendor/autoload.php';
            
            use FNVi\Punches\PunchList;
            
            $status = filter_input(INPUT_GET, "status", FILTER_SANITIZE_STRING);
            
            $punchlist = new PunchList();
            
            $statuses = $punchlist->groupPunchesByStatus();
            
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
                            This example shows usage of the groupPunchesByStatus function in the punchlist class, and creating accordions with it.
                        </span>
                    </div>
                    <div class="panel-group" id="accordion">
                        <?php foreach($statuses as $status){ ?>
                        <?php 
                            $context = "default";
                            
                            switch($status->_id["name"]){
                                case "rejected": $context = "danger"; break;
                                case "accepted": $context = "warning"; break;
                                case "raised": $context = "info"; break;
                                case "closed": $context = "success"; break;
                                default: $context = "default";
                            }
                            $class = "panel-$context";
                        ?>
                        <div class="panel <?php echo $class; ?>">
                            <header class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#<?php echo $status->_id["name"];?>" data-toggle="collapse" data-parent="#accordion" role="accordion" class="accordion-toggle collapsed">
                                        <?php echo $status->count . " ". $status->_id["name"]; ?>
                                    </a>
                                </h4>
                            </header>
                            <section class="panel-collapse collapse" role="tabpanel" id="<?php echo $status->_id["name"];?>">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="col-sm-3">Item</th>
                                            <th class="col-sm-3"><?php echo ucfirst($status->_id["name"]);?> by</th>
                                            <th class="col-sm-2">Timestamp</th>
                                            <th class="col-sm-3">Comment</th>
                                            <th class="col-sm-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($status["documents"] as $punch){ ?>
                                        <tr>
                                            <td><?php echo $punch->item; ?></td>
                                            <td><?php echo $punch->{$status->_id["name"]}->by; ?></td>
                                            <td><?php echo $punch->{$status->_id["name"]}->timestamp->toDateTime()->format("d/m/y h:i:s"); ?></td>
                                            <td><?php echo $punch->issue; ?></td>
                                            <td>
                                                <a href="punchdetail.php?id=<?php echo $punch->getId(); ?>" class="btn btn-default"><i class="fa fa-file-text-o"></i> </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </section>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
