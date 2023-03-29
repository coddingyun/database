<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>Leaflet Quick Start Guide</title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

  <!-- Leaf css/js 를 추가해준다. -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>
  <!-- Make sure you put this AFTER Leaflet's CSS -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
          integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
          crossorigin=""></script>

  <style type="text/css">
    html,body { width:100%; height:100%; margin:0; padding:0; }
    #mapid { width:100%; height:100%; }
  </style>

</head>
<body>
<?php
function debug_to_console($data) {
  $output = $data;
  if (is_array($output))
      $output = implode(',', $output);

  echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
function getClientIP(){
  $ip = file_get_contents('https://api.ipify.org');
  return $ip;
}

$ipaddress = getClientIP();
//$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
debug_to_console($ipaddress);

function ip_details($ip) {
  $json = file_get_contents("http://ipinfo.io/{$ip}/geo");
  $details = json_decode($json, true);
  return $details;
}

$details = ip_details($ipaddress);
$loc = $details['loc'];
$ip = $details['ip'];
debug_to_console($details);
?>

<div id="mapid"></div>


<script>
    <?php
    echo "var jsloc = '$loc';";
    echo "var jsip = '$ip';";
    ?>
    console.log(jsloc);
    console.log(jsip);

    var mymap = L.map('mapid').setView([jsloc.split(',')[0],jsloc.split(',')[1]], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(mymap);
    var marker = L.marker([jsloc.split(',')[0],jsloc.split(',')[1]]).addTo(mymap);
    marker.bindPopup(jsip).openPopup();
</script>

</body>
</html>