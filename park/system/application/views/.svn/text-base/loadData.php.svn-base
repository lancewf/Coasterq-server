<br>
<script type="text/javascript">

	pageHolder = new PageHolder("mainbody");
	window.onload = function () 
	{	
		var rideManager = new RideManager();

		<?php foreach($rides as $ride): ?>
			rideManager.addRideObject(
				new Ride(
					"<?=$ride->getName(); ?>",
					<?=$ride->getId(); ?>,
					"<?=$ride->getLand()->getName(); ?>",
					<?=$ride->getHeight(); ?>,
					<?=$ride->getFastpass() ? "true" : "false"; ?>, 
					<?=$ride->getCurrentwaittime(); ?>,
					<?=$ride->getAverageWaitTime(); ?>,
						null
					, <?= $ride->getNextshortestwaittime(); ?>
					)
				);
	   <?php endforeach; ?>
		
	    var itineraryRideManager = new ItineraryRideManager(rideManager);
			
	   <?php foreach($itineraryRides as $itineraryRide): ?>
		    var ride = rideManager.getRideFromId(
				<?=$itineraryRide->getRideId(); ?>);
			
			if(ride != null)
			{
				itineraryRideManager.addItineraryRideObject(
					new ItineraryRide(ride, 
					<?=$itineraryRide->getPriority(); ?>));
			}
	   <?php endforeach; ?>
	   
   		var parkClock = new ParkClock(<?=$parkClock->getMinutes(); ?>, 
									  <?=$parkClock->getHour(); ?>, 
									  <?=$parkClock->getDayOfMonth(); ?>, 
									  <?=$parkClock->getMonth(); ?>, 
									  <?=$parkClock->getYear(); ?>);
	   
	   <?php foreach($parkClock->getParkOpenRanges() as $parkOpenRange): ?>
	   		parkClock.addParkOpenRange(
				<?=$parkOpenRange->getOpenHour(); ?>, 
				<?=$parkOpenRange->getOpenMin(); ?>,
				<?=$parkOpenRange->getCloseHour(); ?>,
				<?=$parkOpenRange->getCloseMin(); ?>,
				<?=$parkOpenRange->getDay(); ?>,
				<?=$parkOpenRange->getMonth(); ?>,
				<?=$parkOpenRange->getYear(); ?>
				);
	   <?php endforeach; ?>
		
		var htmlRideDisplayer = new HTMLRideDisplayer(<?=$isFasspassAvailable ? "false" : "true"; ?>, parkClock);
	    var rideWaitEntryManager = new RideWaitEntryManager();
		var pageLinkView = 
			new PageLinkView("<?= $parkName; ?>");
		var rideDisplayView = new RideDisplayView(
			itineraryRideManager, htmlRideDisplayer);

	    pageHolder.addPage(new EnterTimeView(rideManager, 
	    	rideWaitEntryManager, htmlRideDisplayer, parkClock));
	    	
	    pageHolder.addPage(new ItineraryRideView(itineraryRideManager,
		 htmlRideDisplayer));
		 
	    pageHolder.addPage(new RideSearchView(
	    	rideManager, rideDisplayView, <?=$isFasspassAvailable ? "false" : "true"; ?>));
	    
	    pageHolder.addPage(rideDisplayView);
		
		var pageLinkView = null;
		
		<?php if($startPage == 'myq'): ?>
			pageHolder.showPage(ItineraryRideViewName);
			pageLinkView = new PageLinkView("<?= $parkName; ?>", ItineraryRideViewName);
		<?php elseif ($startPage == 'enterridetime'): ?>
			pageHolder.showPage(EnterTimeViewName);
			pageLinkView = new PageLinkView("<?= $parkName; ?>", EnterTimeViewName);
		<?php else: ?><!--$startPage == rides -->
			pageHolder.showPage(RideSearchViewName);
			pageLinkView = new PageLinkView("<?= $parkName; ?>", RideSearchViewName);
		<?php endif; ?>
		
		pageHolder.addPage(pageLinkView);
		pageLinkView.showPage('top_links');
	}
	
</script>