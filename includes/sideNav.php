<?php

if ($activePage !== "dashboard" && $activePage !== "settings") {
    echo " 
<nav class=\"cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left\" id=\"cbp-spmenu-s1\">
    <h3>Categories</h3>
    <ul>
      ";
    if (!empty($FinalCategoriesArray) && $FinalCategoriesArray["result"] == "success") {
        $TotalCountCategories = count($FinalCategoriesArray["data"]);
        $TotalCountForAll = 0;
        $ConditionCounter = 1;
        foreach ($FinalCategoriesArray["data"] as $catkey) {
            $OnloadActiveclass = "";
            if ($ConditionCounter == 1) {
                $OnloadActiveclass = "active onloadCallCategory";
            }
            $ConditionCounter += 1;
            echo "      <li>
          <a onclick=\"";
            if (webtvpanel_parentcondition($catkey->category_name) == 1) {
                echo "confirmparent('";
                echo $catkey->category_id;
                echo "')";
            } else {
                echo "getData('";
                echo $catkey->category_id;
                echo "')";
            }
            echo "\" data-CategoryID=\"";
            echo $catkey->category_id;
            echo "\"  data-pcon=\"";
            echo webtvpanel_parentcondition($catkey->category_name);
            echo "\" class=\"";
            echo $OnloadActiveclass;
            echo "\">
            ";
            echo $catkey->category_name != "other channels" ? $catkey->category_name : "Uncategorized";
            echo "          </a>
      </li>
    ";
        }
    }
    echo "    </ul>
    <!-- <form class=\"sort\">
      <label>Sort By:</label>
      <div class=\"s-list\">
        <select>
          <option>Title</option>
          <option>Year</option>
          <option>Date added</option>
          <option>Popularity</option>
        </select>
      </div>
    </form> -->
  </nav>
  ";
}
echo "  <nav class=\"navbar navbar-inverse navbar-static-top\">
    <div class=\"container full-container navb-fixid\">
      ";
if ($activePage !== "dashboard" && $activePage !== "settings") {
    echo " 
      <div class=\"navbar-header\">
        <div id=\"showLeft\" class=\"cat-toggle\"> <span></span> <span></span> <span></span> <span></span> </div>
        <button type=\"button\" class=\"navbar-toggle collapsed pull-right\" data-toggle=\"offcanvas\"> <span class=\"sr-only\">Toggle navigation</span> <span class=\"icon-bar\"></span> <span class=\"icon-bar\"></span> <span class=\"icon-bar\"></span> </button>
      </div>
      ";
}
echo "      <a class=\"brand\" href=\"dashboard.php\"><img class=\"img-responsive\" src=\"";
echo isset($XClogoLinkval) && !empty($XClogoLinkval) ? $XClogoLinkval : "img/logo.png";
echo "\" alt=\"\" onerror=\"this.src='img/logo.png';\"></a>
      <div id=\"navbar\" class=\"collapse navbar-collapse sidebar-offcanvas\">
        ";
if ($activePage !== "index" && $activePage !== "dashboard") {
    echo "        <ul class=\"nav navbar-nav navbar-left main-icon\">
        	<li class=\"";
    if ($activePage == "index") {
        echo "active";
    }
    echo "\"><a href=\"dashboard.php\"><span class=\"da home\"></span><span>Home</span></a></li>

          <li class=\"";
    if ($activePage == "live") {
        echo "active";
    }
    echo "\"><a href=\"live.php\"><span class=\"da live\"></span><span>Live Tv</span></a></li>          
          <li class=\"";
    if ($activePage == "movies") {
        echo "active";
    }
    echo "\"><a href=\"movies.php\"><span class=\"da movie\"></span><span>Movies</span></a></li>
          <li class=\"";
    if ($activePage == "series") {
        echo "active";
    }
    echo "\" ><a href=\"series.php\"><span class=\"da tv\"></span><span>Tv series</span></a></li>
          <li class=\"";
    if ($activePage == "radio") {
        echo "active";
    }
    echo "\" ><a href=\"radio.php\"><span class=\"da radio\"></span><span>Radio</span></a></li>
          <li class=\"";
    if ($activePage == "catchup") {
        echo "active";
    }
    echo "\"><a href=\"catchup.php\"><span class=\"da catchup\"></span><span>Catch Up</span></a></li>
          <!-- <li class=\"";
    if ($activePage == "radio") {
        echo "active";
    }
    echo "\"><a href=\"radio.php\"><span class=\"da radio\"></span><span>Radio</span></a></li> -->
          
        </ul>
        <ul class=\"nav navbar-nav navbar-right r-icon\">
         ";
    if ($activePage !== "dashboard" && $activePage !== "settings") {
        echo " 
              <li class=\"r-li\"><a href=\"#search\"><i class=\"fa fa-search\"></i><span class=\"r-show\"></span></a></li>
              <li class=\"r-li\"><a href=\"#sort\" data-toggle=\"modal\" data-target=\"#sortingpopup\"><i class=\"fa fa-sort\"></i><span class=\"r-show\"></span></a></li>

             ";
    }
    echo "          <li class=\"r-li ";
    if ($activePage == "settings") {
        echo "active";
    }
    echo "\"><a href=\"settings.php\"><i class=\"fa fa-gear\"></i><span class=\"r-show\"></span></a></li>
          ";
    if ($activePage !== "dashboard" && $activePage !== "settings") {
        echo " 

          <li class=\"r-li\"><a href=\"#\"\" class=\"logoutBtn\"><i class=\"fa fa-sign-out\"></i><span class=\"r-show\">Logout</span></a></li>
        ";
    }
    echo "        </ul>
      ";
} else {
    echo "          <ul class=\"nav navbar-nav navbar-right r-icon\">
            <li><a href=\"settings.php\"><i class=\"fa fa-gear\"></i><span class=\"r-show\"></span></a></li>
          </ul>
          <p class=\"datetime\" style=\"margin-right: 20px;\"><span class=\"time\"></span>  <span class=\"date\"> ";
    echo date("d-M-Y");
    echo "</span></p>


        ";
}
echo "      </div>
      <!--/.nav-collapse --> 
    </div>
  </nav>
  <!-- Sorting Model -->
  <style type=\"text/css\">
    .sorting-container span {
        font-size: 16px;
        font-weight: 200;
        cursor: pointer;
    }
  </style>
<div class=\"modal fade\" id=\"sortingpopup\" role=\"dialog\" data-backdrop=\"static\" data-keyboard=\"false\" style=\"background: rgba(0, 0, 0, 0.9)\">
    <div class=\"modal-dialog\">
    
      <!-- Modal content-->
      ";
$sortCondition = isset($_COOKIE[$SessioStoredUsername . "_" . $activePage]) && !empty($_COOKIE[$SessioStoredUsername . "_" . $activePage]) ? $_COOKIE[$SessioStoredUsername . "_" . $activePage] : "default";
echo "      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
          <h4 class=\"modal-title\">
            <span>
                <i class=\"fa fa-sort\" id=\"fappass\" aria-hidden=\"true\"></i>&nbsp;
                Sort According to: 
              </span>
          </h4>
        </div>
        <div class=\"modal-body\">
          <div class=\"sorting-container\">
            <label>
              <input type=\"radio\" name=\"sorttype\" class=\"sorttype\" value=\"default\" ";
echo $sortCondition == "default" ? "checked" : "";
echo " > &nbsp;<span>Default</span>
            </label>
            <br>
            <label>
              <input type=\"radio\" name=\"sorttype\" class=\"sorttype\" value=\"topadded\" ";
echo $sortCondition == "topadded" ? "checked" : "";
echo " > &nbsp;<span>Top Added</span>
            </label>
            <br>
            <label>
              <input type=\"radio\" name=\"sorttype\" class=\"sorttype\" value=\"asc\" ";
echo $sortCondition == "asc" ? "checked" : "";
echo " > &nbsp;<span>A-Z</span>
            </label>
            <br>
            <label>
              <input type=\"radio\" name=\"sorttype\" class=\"sorttype\" value=\"desc\" ";
echo $sortCondition == "desc" ? "checked" : "";
echo " > &nbsp;<span>Z-A</span>
            </label>
          </div>            
        </div>
        <div class=\"modal-footer\">
          <button type=\"button\" id=\"savesorting\" data-sortin=\"";
echo $activePage;
echo "\" class=\"btn btn-primary\">
            Save 
            <i class=\"fa fa-spin fa-spinner hideOnLoad\" id=\"sortingloader\"></i>
          </button>
          <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <script type=\"text/javascript\">
    \$(document).ready(function(){
      \$(\"#savesorting\").click(function(e){
        e.preventDefault();
        var SortIN = \$(this).data('sortin');
        var selectedVal = \$(\"input:radio.sorttype:checked\").val();
         \$('#sortingloader').removeClass('hideOnload');
         jQuery.ajax({
            type:\"POST\",
            url:\"includes/ajax-control.php\",
            dataType:\"text\",
            data:{
            action:'SaveSortSettings',
            SortIN:SortIN,
            selectedVal:selectedVal,
            hostURL: \"";
echo $XCStreamHostUrl . $bar;
echo "\"
            },
            success:function(response2){ 
              \$('#sortingloader').addClass('hideOnload');
                location.reload();
            }
         });
      });
    });
  </script>";

?>