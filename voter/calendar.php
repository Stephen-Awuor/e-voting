<?php require_once("template/header.php");?>
<link rel="stylesheet" href="../css/calendarCSS/eventCalendar.css" media="screen">
<link rel="stylesheet" href="../css/calendarCSS/eventCalendar_theme_responsive.css" media="screen">
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/calendarJS/jquery.eventCalendar.js"></script>
<script type="text/javascript" src="../js/calendarJS/jquery.eventCalendar.min.js"></script>
<script type="text/javascript" src="../js/calendarJS/jquery.timeago.js"></script>

<fieldset><legend><h3>Event Calendar</h3></legend>
<div id="eventCalendar"></div>
</fieldset>
<script type="text/javascript">
	$(document).ready(function() {
		$("#eventCalendar").eventCalendar({
			eventsjson: 'json/events.json.php' // link to events json
		});
	});
</script>
<?php require_once("template/footer.php");?>