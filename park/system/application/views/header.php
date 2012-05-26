<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=400;height=525;initial-scale=1.0;">
    <!--                                                               -->
    <!-- Consider inlining CSS to reduce the number of requested files -->
    <!--                                                               -->
    <link type="text/css" rel="stylesheet" href="<?= base_url();?>css/Coasterqclient.css">
	
	<title>CoasterQ - <?= $parkName; ?> Ride Wait Times</title>
	<link rel="shortcut icon" href="<?= base_url();?>/img/favicon.gif" />
	<link rel="home" href="http://www.coasterq.com/" title="Home" />
	
	<meta name="description" content="CoasterQ provides a continuous live feed of the line wait times for your favorite <?= $parkName; ?> rides. Create a ride itinerary and enter ride wait times that you are experiencing to improve the times displayed." />
	<meta name='robots' content='all' />
	<meta http-equiv='expires' content='-1' />
	<meta http-equiv='pragma' content='no-cache' />
	<meta name="verify-v1" content="QXzkUyAPYZu/KK8gFOwBSeK77ISepu9nim/ME8c4ICY=" >
    <!--                                           -->
    <!-- This script loads your compiled module.   -->
    <!-- If you add any GWT meta tags, they must   -->
    <!-- be added before this line.                -->
    <!--                                           -->
	<script type="text/javascript">
		//<![CDATA[
			base_url = '<?= base_url();?>';
			base_services_url = base_url + 'index.php/services/';
			home_url = '<?=$homeUrl; ?>';
			start_tab ='<?=$startPage; ?>';
		//]]>
	</script>
    <script type="text/javascript" language="javascript" src="<?= base_url();?>client/client.nocache.js"></script>
</head>

