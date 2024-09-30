<?php



include "includes/header.php";
if (isset($_SESSION["webTvplayer"]) && !empty($_SESSION["webTvplayer"])) {
    echo "<script>window.location.href = 'dashboard.php';</script>";
    exit;
}
$cookieusername = isset($_COOKIE["username"]) ? $_COOKIE["username"] : "";
$FinalUsername = isset($_GET["username"]) ? $_GET["username"] : $cookieusername;
$cookiepassword = isset($_COOKIE["userpassword"]) ? base64_decode($_COOKIE["userpassword"]) : "";
$FinalPassword = isset($_GET["password"]) ? $_GET["password"] : $cookiepassword;
echo "<style type=\"text/css\">
  .addborder {
      border: 1px solid red !important;
  }
  .hideOnload
  {
    display: none !important;
  }
  div#FailLOginMessage {
      position: fixed;
      top: -100%;
      text-align: center;
      left: 35%;
      width: 30%;
  }
</style>
<!-- <nav class=\"navbar navbar-inverse navbar-static-top\">
    <div class=\"container full-container navb-fixid\">
      <div class=\"navbar-header\">
        
      </div>
      <a class=\"\" href=\"#\"><img class=\"img-responsive\" src=\"img/logo.png\" alt=\"\" width=\"187px\"></a>
      
     //.nav-collapse
    </div>
  </nav> -->
  <div class=\"alert alert-danger \" id=\"FailLOginMessage\">
      <strong>Error!</strong> <span id=\"ErrorText\">Invalid Details</span>
  </div>
<div class=\"container-fluid\">
        <!-- Login Wrapper -->
        <center><a href=\"dashboard.php\"><img class=\"img-responsive\" src=\"";
echo isset($XClogoLinkval) && !empty($XClogoLinkval) ? $XClogoLinkval : "img/logo.png";
echo "\" alt=\"\" onerror=\"this.src='img/logo.png';\" width=\"200px\" style=\"margin-top: 40px;\"></a>
        </center>
          <div class=\"midbox\">
            <h3>Enter your details</h3>
            <form>
              <div class=\"form-group\">
                <label>Username</label>
                <input type=\"username\" class=\"form-control logininputs\" id=\"input-login\" placeholder=\"Username\" value=\"";
echo $FinalUsername;
echo "\">
              </div>
              <div class=\"form-group\">
                <label>Password</label>
                <input type=\"password\" class=\"form-control logininputs\" id=\"input-pass\" placeholder=\"Password\" value=\"";
echo $FinalPassword;
echo "\">
              </div>
              <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6 form_left\">
                <div class=\"checkbox checkbox_new\">
                  <label>
                    <input type=\"checkbox\" id=\"rememberMe\"> Remember me
                  </label>
                </div>
              </div>
              <div class=\"form-group\">
                <button type=\"submit\" class=\"btn btn-ghost webtvloginprocess rippler rippler-default\">LOGIN <i class=\"fa fa-spin fa-spinner hideOnload\" id=\"loginProcessIcon\"></i></button>
              </div>
            </form>
          </div>
        <!-- /Login Wrapper -->
      </div>
      ";
include "includes/footer.php";

?>
