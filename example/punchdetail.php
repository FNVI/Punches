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
            
            $args = [
                "username"=>FILTER_SANITIZE_STRING,
                "notes"=>FILTER_SANITIZE_STRING,
                "action"=>FILTER_SANITIZE_STRING
            ];
            
            $post_vars = filter_input_array(INPUT_POST, $args, false);
            
            if(count($post_vars) === count($args)){
                
                switch($post_vars["action"]){
                    case "accept": $punch->accept($post_vars["username"]); break;
                    case "reject": $punch->reject($post_vars["username"]); break;
                    case "close": $punch->close($post_vars["username"]); break;
                }
                $punch->store();
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
                        This displays the details of a punch. Any recorded details could be used. At the bottom are buttons to optionally accept and/or close the punch.
                    </div>
                    <fieldset class="col-md-6">
                        <legend>
                            Punch Detail
                        </legend>
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
                            <?php if($punch->accepted){ ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    Accepted by:
                                </label>
                                <p class="form-control-static">
                                    <?php echo $punch->accepted->by; ?>
                                </p>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    Timestamp:
                                </label>
                                <p class="form-control-static">
                                    <?php echo $punch->accepted->timestamp->toDateTime()->format("d/m/y h:i:s"); ?>
                                </p>
                            </div>
                            <?php } ?>
                             <?php if($punch->closed){ ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    Closed by:
                                </label>
                                <p class="form-control-static">
                                    <?php echo $punch->closed->by; ?>
                                </p>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    Timestamp:
                                </label>
                                <p class="form-control-static">
                                    <?php echo $punch->closed->timestamp->toDateTime()->format("d/m/y h:i:s"); ?>
                                </p>
                            </div>
                            <?php } ?>
                             <?php if($punch->rejected){ ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    Rejected by:
                                </label>
                                <p class="form-control-static">
                                    <?php echo $punch->rejected->by; ?>
                                </p>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    Timestamp:
                                </label>
                                <p class="form-control-static">
                                    <?php echo $punch->rejected->timestamp->toDateTime()->format("d/m/y h:i:s"); ?>
                                </p>
                            </div>
                            <?php } ?>
                        </div>
                    </fieldset>
                    <?php if($punch->status["name"] != "closed"){ ?>
                    <fieldset class="col-md-6">
                        <legend>
                            <?php echo $punch->status["name"] === "raised" ? "Accept punch" : "Close Punch"; ?>
                        </legend>
                        <form class="form-horizontal" method="post">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="username">
                                    Username:
                                </label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="username" id="username" value="Chuck Jones">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="notes">
                                    Notes:
                                </label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="notes" id="notes" value="Some Notes">
                                </div>
                            </div>
                            <?php if($punch->status["name"] === "raised"){ ?>
                            <button class="btn btn-success" name="action" value="accept">Accept Punch</button>
                            <button class="btn btn-danger" name="action" value="reject">Reject Punch</button>
                            <?php } else if($punch->status["name"] === "accepted") { ?>
                            <button class="btn btn-success" name="action" value="close">Close Punch</button>
                            <?php } ?>
                        </form>
                    </fieldset>
                    <?php } ?>
                </div>
            </div>
        </main>
    </body>
</html>
