<h3 align="center">Ride Wait Times</h3>
<hr />
	<table align="center">
		<thead>
			<tr>
				<th width="1%">
					*
				</th>
		        <th width="39%">
		        	Name
		        </th>
		        <th width="40%">
		            Location
		        </th>
		        <th width="17%">
		        	Current Wait 
		        </th>
		        <th width="3%">
	        	Q 
		        </th>
	        </tr>
		</thead>
		<tbody>
			<?php foreach($rides as $ride): ?>
				<?php
					$isInItinerary = false;
					foreach($itineraryRides as $itineraryRide)
					{
						if($itineraryRide->getRide()->getId() == $ride->getId())
						{
							$isInItinerary = true;
							break;
						}
					}
				?>
				<tr>
					<td>
						<?php if($ride->getFastpass()): ?>
						    <img src="<?= base_url();?>img/fastpass.png" alt="f">
						<?php endif; ?>
						<?php if($ride->getHeight() > 0): ?>
	    					<img src="<?= base_url();?>img/height.png" alt="h">
						<?php endif; ?>
					</td>
					<td>
						<?=$ride->getName(); ?>
					</td>
					<td>
						<?=$ride->getLand()->getName(); ?>
					</td>
					<td>
						<?php if($ride->getCurrentwaittime() == -1): ?>
							Closed
						<?php else: ?>
							<?=$ride->getCurrentwaittime(); ?> mins
						<?php endif; ?>
						
					</td>
					<td align="center">
						<?php if($isInItinerary): ?>
							<b>Q</b>
						<?php else: ?>
							<FORM action="<?= base_url();?>index.php/ridelistservices/addItineraryRide" 
								method="post">
								<input type="submit" value="Q">
                				<input name="rideid" type="hidden" 
									value="<?=$ride->getId(); ?>" />
							</FORM>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

<hr />
<div align="left">
	<font color='#47C3A6'> * </font> <br />
	
	<?php if($isFasspassAvailable): ?>
    	<img src="<?= base_url();?>img/fastpass.png" alt="f">  Fastpass Available<br \>
	<?php endif; ?>
	<img src="<?= base_url();?>img/height.png" alt="h">  Height Requirement <br \>
</div>