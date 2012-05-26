<br>
<script type="text/javascript">

	pageHolder = new PageHolder("mainbody");
	window.onload = function () 
	{	
		var rideManager = new RideManager();

		<?php foreach($rides as $ride): ?>
			var ride = new Ride(
					"<?=$ride->getName(); ?>",
					<?=$ride->getId(); ?>,
					"<?=$ride->getLand()->getName(); ?>",
					<?=$ride->getHeight(); ?>,
					<?=$ride->getFastpass() ? "true" : "false"; ?>, 
					<?=$ride->getCurrentwaittime(); ?>,
					<?=$ride->getAverageWaitTime(); ?>,
						null
					, <?= $ride->getNextshortestwaittime(); ?>
					);
			ride.setPopularity(<?=$ride->getPopularitylevel(); ?>);
			ride.setClosedPermanently(<?=$ride->getIsRidePermentlyClosed() ? "true" : "false"; ?>);
			rideManager.addRideObject(ride);
	   <?php endforeach; ?>
		
		var parkClock = new ParkClock(<?=$parkClock->getMinutes(); ?>, 
									  <?=$parkClock->getHour(); ?>, 
									  <?=$parkClock->getDayOfMonth(); ?>, 
									  <?=$parkClock->getMonth(); ?>, 
									  <?=$parkClock->getYear(); ?>);
		
		var rideClosureManager = new RideClosureManager(rideManager);
		
		<?php foreach($rideClosures as $rideClosure): ?>
		
			var startDate = new Date(<?=$rideClosure->getStartDateYear(); ?>, 
				<?=$rideClosure->getStartDateMonth(); ?>  - 1, 
				<?=$rideClosure->getStartDateDay(); ?>, 0, 0, 0);

			var endDate = new Date(<?=$rideClosure->getEndDateYear(); ?>, 
				<?=$rideClosure->getEndDateMonth(); ?> - 1, 
				<?=$rideClosure->getEndDateDay(); ?>, 0, 0, 0);
		
			var ride = rideManager.getRideFromId(<?=$rideClosure->getRideId(); ?>);
			
			var id = <?=$rideClosure->getId(); ?>;
			
			if(ride != null)
			{
				var rideClosure = new RideClosure(id, startDate, endDate, ride);
		
				rideClosureManager.addRideClosure(rideClosure);
			}
		
		<?php endforeach; ?>
			
		var parkDayManager = new ParkDayManager();
		
	    pageHolder.addPage(new CalendarView(parkDayManager, 
			rideClosureManager, rideManager));

		pageHolder.showPage(CalendarView.NAME);
	}
	
</script>