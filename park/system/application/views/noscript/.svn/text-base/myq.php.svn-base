<h3 align="center">My Q</h3>
<hr />
<FORM action="<?= base_url();?>index.php/myqservices/updateItinerary" 
 method="post">
<table align="center">
	<thead>
		<tr>
			<th width="5%">
				Priority
			</th>
			<th width="1%">
				*
			</th>
	        <th width="35%">
	        	Ride
	        </th>
	        <th width="36%">
	            Location
	        </th>
	        <th width="18%">
	        	Current Wait 
	        </th>
	        <th width="5%">
	            Remove
	        </th>
        </tr>
	</thead>
	<tbody>
		<?php foreach($itineraryRides as $itineraryRide): ?>
			<tr>
                <td>
					<input name="Priority<?=$itineraryRide->getPriority(); ?>" 
						type="text" 
                        value="<?=$itineraryRide->getPriority(); ?>"
						size="2" maxlength="2" />
				</td>
				<td>
					<?php if($itineraryRide->getRide()->getFastpass()): ?>
					    <img src="<?= base_url();?>img/fastpass.png" alt="f">
					<?php endif; ?>
					<?php if($itineraryRide->getRide()->getHeight() > 0): ?>
    					<img src="<?= base_url();?>img/height.png" alt="h">
					<?php endif; ?>
				</td>
				<td>
					<?=$itineraryRide->getRide()->getName(); ?>
				</td>
				<td>
					<?=$itineraryRide->getRide()->getLand()->getName(); ?>
				</td>
				<td>
					<?php if($itineraryRide->getRide()->getCurrentwaittime() == -1): ?>
						Closed
					<?php else: ?>
						<?=$itineraryRide->getRide()->getCurrentwaittime(); ?> mins
					<?php endif; ?>
				</td>
            	<td align="center" >
                	<input type="checkbox" 
						name="remove<?=$itineraryRide->getPriority(); ?>" />
            	</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<hr />
<div align="right">
<input type="submit" value="Update">
</div>
</FORM>
<div align="left">
	<font color='#47C3A6'> * </font> <br />
	
	<?php if($isFasspassAvailable): ?>
    	<img src="<?= base_url();?>img/fastpass.png" alt="f">  Fastpass Available<br \>
	<?php endif; ?>
	<img src="<?= base_url();?>img/height.png" alt="h">  Height Requirement <br \>
</div>