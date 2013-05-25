<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" > 

    <?= $this->load->view('header');?>
   
    <body>
    	<div align="center" class="coasterqImage">
			<a href="<?=$homeUrl; ?>"> 
				<img src="<?= base_url();?>img/cqlogo.png" alt="CoasterQ"  />
			</a>
		</div>
		
		<center>
			<?= $this->load->view('advertisement');?>
		</center>
		
		<br />
		
		<center>
	    	<div id='main' > 
	    		Loading...
				<?= $this->load->view('noscript/index');?>
			</div>
		</center>
		
		<!-- OPTIONAL: include this if you want history support -->
    	<iframe src="javascript:''" id="__gwt_historyFrame" tabIndex='-1' style="position:absolute;width:0;height:0;border:0"></iframe>
    	<br /><br />
		<center>
			<?= $this->load->view('advertisement');?>
		</center>
		
        <?= $this->load->view('footer');?>
		<?= $this->load->view('googleAnalytics');?>
		
    </body>
</html>
