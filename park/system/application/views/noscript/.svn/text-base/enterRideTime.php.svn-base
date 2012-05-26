<h3 align="center">Enter Wait Time For:</h3>
<hr />
<FORM action="<?= base_url();?>index.php/enterrideTimeservices/addRideWaitTime" 
								method="post">
<table cellspacing="5" border="0" align="center">
	<tr>
		<TH>
			<select name="rideId">
				<?php foreach($rides as $ride): ?>
					<option value="<?=$ride->getId(); ?>">
						<?=$ride->getName(); ?>  
					</option>
				<?php endforeach; ?>
			</select>
		</TH>
	</tr>
	<tr>
		<td>
			<table cellspacing="5" border="0" align="center">
				<tr>
					<td align="center">
						<?=$parkClock->getMonth(); ?>-<?=$parkClock->getDayOfMonth(); ?>-<?=$parkClock->getYear(); ?>
					</td>
				</tr>
				<tr>
					<td align="center">Time of Day</td>
				</tr>
				<tr>
					<td align="center">
						
						<?php 
							$hour = $parkClock->getHour();
							
							if($hour >= 12 || $hour = 0)
							{
								$isPm = true; 
							}
							else 
							{
								$isPm = false;
							}
							
							if($hour > 12)
							{
								$hour -= 12;
							}
							else if($hour == 0 )
							{
								$hour = 12;
							}
						?>
						<select name="time_hour">
							<?php for($index = 1; $index <= 12; $index++): ?>		
								<?php if($hour == $index): ?>
									<option value="<?=$index ?>" selected ><?=$index ?></option>
								<?php else: ?>
									<option value="<?=$index ?>"><?=$index ?></option>
								<?php endif; ?>
							<?php endfor; ?>
						</select>
						 :
						<select name="time_min">
							<?php for($index = 0; $index < 60; $index += 5): ?>	
								<?php if($parkClock->getMinutes() > $index && $parkClock->getMinutes() < $index + 5): ?>
									<option value="<?=$index ?>" selected ><?=$index ?></option>
								<?php else: ?>
									<option value="<?=$index ?>"><?=$index ?></option>
								<?php endif; ?>
							<?php endfor; ?>
						</select>
						<select name="am_pm">
							<?php if($isPm): ?> 
								<option value="am">AM</option>
								<option value="pm"  selected >PM</option>
							<?php else: ?>
								<option value="am"  selected >AM</option>
								<option value="pm">PM</option>
							<?php endif; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="center">Wait Time</td>
				</tr>
				<tr>
					<td align="center">
						<select name="wait_hour">
							<option value="0" selected >0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select> 
							hour
						<select name="wait_min">
			      			<option value="0">00</option>
			      			<option value="5">05</option>
			      			<option value="10">10</option>
			      			<option value="15" selected>15</option>
			      			<option value="20">20</option>
			      			<option value="25">25</option>
			      			<option value="30">30</option>
			      			<option value="35">35</option>
			      			<option value="40">40</option>
			      			<option value="45">45</option>
			      			<option value="50">50</option>
			      			<option value="55">55</option>
						</select> min
					</td>
				</tr>
				<tr>
					<td align="center"><br>
						<input type="submit" value="Submit">
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</FORM>
<hr />