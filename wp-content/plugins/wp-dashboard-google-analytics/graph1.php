<?php
define('ga_email',$_GET['user']);
define('ga_password',$_GET['pass']);
define('ga_profile_id',$_GET['gaprofileid']);

require 'gapi-1.3/gapi.class.php';

$ga = new gapi(ga_email,ga_password);

$filter='';

$ga->requestReportData(ga_profile_id,array('year', 'month', 'day'),array('pageviews','visits'),array('year', 'month', 'day'),$filter);

function dayGraphCSV($ga){
	$csv = '"Date,Visits,Views';
	foreach($ga->getResults() as $result){
		$csv.="\\n".$result->getYear().'-'.$result->getMonth().'-'.$result->getDay().','.$result->getVisits().','.$result->getPageviews();
	}
	echo $csv.'"';
}
?>


<!--[if IE]>
<script type="text/javascript" src="../wp-content/plugins/wp-dashboard-google-analytics/dygraph/excanvas.js"></script>>
<![endif]-->
<script type="text/javascript" src="../wp-content/plugins/wp-dashboard-google-analytics/dygraph/dygraph-combined.js">
</script>
<script type="text/javascript" src="../wp-content/plugins/wp-dashboard-google-analytics/dygraph/dygraph-canvas.js"></script>
<script type="text/javascript" src="../wp-content/plugins/wp-dashboard-google-analytics/dygraph/dygraph.js"></script>


<div id="div_g30" style="width: 700px; height: 180px;">
<script type="text/javascript">
   	var g30 = new Dygraph(
        document.getElementById("div_g30"),
        <?php dayGraphCSV($ga); ?>, 
              {
                rollPeriod: 1,
                showRoller: true,
                fillGraph: true
              }
            );
</script>
</div>

<table>
<tr>
<td>
<div style="padding:5px; width: 300px; overflow: hidden; clear: both">
<h3>Top 10 keywords</h3>
<ul style="font-size:10px">
  <?php
$ga->max_results = 10;
$ga->requestReportData(ga_profile_id,array('keyword'),array('pageviews'),array('-pageviews'),$filter);
	foreach($ga->getResults() as $result){
		echo('<li>'.$result->getKeyword().' - '.$result->getPageViews()).'</li>';
	}
?>
</ul>
</div>
</td>
<td>
<div style="padding:5px; width: 500px; overflow: hidden; float: left">
<h3>Top 10 accessed pages</h3>
<ul style="font-size:10px">
<?php
$ga->max_results = 10;
$ga->requestReportData(ga_profile_id,array('pageTitle','pagePath'),array('pageviews'),array('-pageviews'),$filter);
	foreach($ga->getResults() as $result){
		echo('<li><strong>'.$result->getPageTitle().'</strong> - '.$result->getPageViews()).'</li>';
	}

?>
</ul>
</div>
</td>
</tr>
</table>