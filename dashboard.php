<?php

include "includes/header.php";
include "includes/sideNav.php";
echo "<style>
.messagePerm
{
    position: absolute;
    width: 70%;
    left: 15%;
}
.dontShow
{
    position: relative;
    bottom: 6px;
    font-size: 11px;
    opacity: 1;
    right: -35px;
    color: #000;
    margin-top: 25px;
}
     
.herelink {
    color: #a039b1;
    font-weight: 600;
}     
</style>
<div class=\"container-fluid\">    
    <div class=\"col-md-10 col-md-offset-1\">
    ";
if ($headerparentcondition == "") {
    echo "        <div class=\"row\">
          <div class=\"col-sm-2\">
          </div>
          <div class=\"col-sm-8\">
            <div class=\"alert alert-warning\" style=\"position: relative;top: 20px;\">
              <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> 
              <strong style=\"font-weight: bold;\">Notice!</strong>
    You have not set the Parental Control password. Click <a href=\"settings.php\" class=\"herelink\">here</a> to set it up!
            </div>
          </div>
          <div class=\"col-sm-2\">
          </div>
        </div> 
      ";
}
echo "    <div class=\"b-content home\">
    	<div class=\"col-md-4 col-sm-4 col-xs-12\">
          <a href=\"live.php\">
    		    <div class=\"col-md-12 liveTV rippler rippler-default\">
                <center><img src=\"img/Live_tv.png\"></center>
                <h3 class=\"text-center\">Live TV</h3>
            </div>
          </a>
    	</div>

    	<div class=\"col-md-4 col-sm-4 col-xs-12\">
        <a href=\"movies.php\">
    		  <div class=\"col-md-12 movieVOD rippler rippler-default\">
                <center><img src=\"img/on_demand.png\"></center>
                <h3 class=\"text-center\">Movies</h3>
          </div>
        </a>
    	</div>

    	<div class=\"col-md-4 col-sm-4 col-xs-12\">
          <a href=\"series.php\">
            <div class=\"col-md-12 tvSeries rippler rippler-default\">
        			<center><img src=\"img/series.png\"></center>
        			<h3 class=\"text-center\">Series</h3>
            </div>
          </a>
    	</div>

        <div class=\"col-md-8 col-sm-12 col-xs-12 Mybtns\">
            <div class=\"col-md-4 col-sm-6 col-xs-12 hide\">
                <a href=\"\" class=\"btn btn-default center-block rippler rippler-default\"><i class=\"fa fa-book\"></i> EPG</a>
            </div>
            <div class=\"col-md-4 col-sm-12 col-xs-12\">
                <a class=\"btn btn-default center-block btn-lg account rippler rippler-default\" id=\"accountModal\"><i class=\"fa fa-info\"></i> Account</a>
            </div>
            <div class=\"col-md-4 col-sm-12 col-xs-12\">
                <a class=\"btn btn-default center-block btn-lg account rippler rippler-default\" href=\"catchup.php\"><i class=\"fa fa-clock-o\" ></i> Catch UP</a>
            </div>
            <div class=\"col-md-4 col-sm-12 col-xs-12\">
                <a href=\"\" class=\"btn btn-default center-block btn-lg logoutBtn rippler rippler-default\"><i class=\"fa fa-sign-out\" style=\"padding-top: 0px;\"></i> Log Out</a>
            </div>
        </div>
        ";
$ExpiryData = "";
if ($_SESSION["webTvplayer"]["exp_date"] == "null" || $_SESSION["webTvplayer"]["exp_date"] == "") {
    $ExpiryData = "Unlimited";
} else {
    $ExpiryData = date("F d, Y", $_SESSION["webTvplayer"]["exp_date"]);
}
echo "        <h4 class=\"text-center\" style=\"color: #fff; top: 50px; float:left;width: 100%;position: relative;    text-transform: uppercase;\">Expiry: ";
echo $ExpiryData;
echo "</h4>
    </div>
</div>
</div>
";
include "includes/footer.php";

?>
