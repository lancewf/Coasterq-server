<div id="top_links">
	<table width="100%" border="0" >
		<tr>
			<td align="center">
			 <h2><?= $parkName; ?></h2>
			</td>
		</tr>
		<tr>
			<td align="center">
				
				<?php if($startPage == 'myq'): ?>
					<b >My Q</b>
				<?php else: ?>
					<A  HREF="<?= base_url();?>index.php/main/myq">My Q</A>
				<?php endif; ?>
				
				<img src="<?= base_url();?>img/dot.png" />
				
				<?php if($startPage == 'enterridetime'): ?>
					<b >Enter Wait</b>
				<?php else: ?>
					<A  HREF="<?= base_url();?>index.php/main/enterridetime">Enter Wait</A>
				<?php endif; ?>
				
				<img src="<?= base_url();?>img/dot.png" />

				<?php if($startPage == 'rides'): ?>
					<b >Ride Search</b>
				<?php else: ?>
					<A  HREF="<?= base_url();?>index.php/main/rides">Ride Search</A>
				<?php endif; ?>
				
				<img src="<?= base_url();?>img/dot.png" />
				
				<A  HREF="<?=$homeUrl; ?>" >Change Park</A>
			</td>
        </tr>
	</table>
</div>