<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	
	<title>CoasterQ - <?= $parkName; ?> Ride Wait Times</title>
	
	<meta name="description" content="CoasterQ provides a continuous live feed of the line wait times for your favorite <?= $parkName; ?> rides. Create a ride itinerary and enter ride wait times that you are experiencing to improve the times displayed." />
	<meta name='robots' content='all' />
	<meta http-equiv='expires' content='-1' />
	<meta http-equiv='pragma' content='no-cache' />
	<meta name="viewport" content="width=368;height=483;initial-scale=1.0;">
	
	<link rel="shortcut icon" href="<?= base_url();?>/img/favicon.ico" type="image/x-icon" />
	<link rel="home" href="http://www.coasterq.com/" title="Home" />

	<link href="<?= base_url();?>css/admin.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url();?>css/CalendarControl.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript">
		//<![CDATA[
			base_url = '<?= base_url();?>';
			base_admin_url = base_url + 'index.php/admin/';
			base_services_url = base_url + 'index.php/services/';
			home_url = '<?=$homeUrl; ?>';
		//]]>
	</script>
	<script type="text/javascript" src="<?= base_url();?>js/view/PageHolder.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/data/Ride.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/data/RideManager.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/data/ParkClock.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/helper/AjaxTransport.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/admin/prototype.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/admin/Page.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/admin/CalendarView.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/admin/EditDayView.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/helper/HTMLRideDisplayer.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/admin/CalendarControl.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/admin/ParkDayManager.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/admin/ParkDay.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/admin/RideClosureManager.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/admin/RideClosure.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/admin/EditRideDataView.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/admin/RideAdminManager.js"></script>
	<script type="text/javascript" src="<?= base_url();?>js/admin/PermanentlyDeletedRidesView.js"></script>
</head>

