<?php
require_once("../../init.php");
$get = mysql_query("SELECT * FROM event")or die("Could not get events<br/>".mysql_error());
header('Content-type: text/json');
echo '[';
while($events = mysql_fetch_assoc($get)){
extract($events);
echo '{ "date": "'.(strtotime($eventDate*1000)).'", "type": "'.$eventType.'", "title": "'.$eventTitle.'", "description": "'.$eventDesc.'", "url": "viewEvent.php?event_id='.$eventID.'" },';
}
echo '{ "date": "1337677200000", "type": "meeting", "title": "Project A meeting", "description": "Lorem Ipsum dolor set", "url": "http://www.event1.com/" }';
echo ']';
//$myDate = date("Y m d", 1337677200000);
//echo $myDate;
?>