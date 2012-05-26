<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>CoasterQ - Terms of Use</title>
		<?= $this->load->view('header');?>
	</head>
	<body>
	    <div align="center" class="coasterqImage">
			<a href="<?=base_url(); ?>"> 
				<img src="<?= base_url();?>img/cqlogo.png" alt="CoasterQ"  />
			</a>
		</div>
	   	<hr />
	   	<div id='head'>
		<hr />
		</div>
	   	<hr />
		<center>
			<?= $this->load->view('advertisement');?>
		</center>
	   	<div id='text'>
		<h3>Terms of Use</h3>
		<table align='center'>
			<tr >
				<td>
	CoasterQ (and its associated domains from here on to be known as Site) maintains this Site in an effort to provide you with information for wait times in specific theme parks. This Site is not affiliated with any companies for which information is provided, including wait times, advertisements, or links to external sites.
	<br /><br />
	CoasterQ requires that all the visitors to our Site(s) adhere to the following rules and regulations.  CoasterQ reserves the right to change the terms and conditions of the Terms of Use without notice to you.  Your right to use the Site is for personal purposes only. By accessing this Site, you agree not to exploit for any public or commercial purposes (whether profitable, marketable, or neither) the Site or any information or technology obtained from the Site (this includes but is not limited to the duplication, replication, copying, or selling of said content).
	<br /><br />
	The contents of the Site including its software, data, interface layout/”feel”, and other components or technology belong to CoasterQ (aside from Trademarked names). The information and technology (including software applications) contained in the Site may not be distributed, re-posted in any format, reproduced, reused, or used to create an imitative work or otherwise used for public or commercial purposes without the written permission of CoasterQ. 
	<br /><br />
	You agree that you will not use any technological processes to monitor or copy the content contained in our Site without the prior written permission of CoasterQ. You agree that you will not use any device (physical or non-physical, malicious or not) to interfere or attempt to interfere with the proper working of the Site or any processes being carried out on our Site.
	<br /><br />
	<h3>Disclaimer</h3>
	You agree that all access and use of the Site and its contents is at your own risk. By using the Site, you acknowledge that we specifically disclaim any liability arising out of or in any way connected with your access to or use of the Site or its contents. 
	<br /><br />
	CoasterQ is only an application to display ride wait times. No information on this Site is guaranteed. This Site provide you with estimated times which may be different than actual times.  Although the information on the Site is updated continuously, it is always best to note the time posted at the park for each ride to insure the information displayed on the Site is accurate. 
				</td>
			</tr>
		</table>
		</div>
		<br />
		<center>
			<?= $this->load->view('advertisement');?>
		</center>
		<?= $this->load->view('googleAnalytics');?>
	</body>
	<br>
	<p align = "center">
		<a href = "<?= base_url();?>">Home</a>
		|
		<a href = "<?= base_url();?>index.php/main/sitemap">Site Map</a>
		|
		<a href = "<?= base_url();?>index.php/main/faqs"> FAQs</a>
		|
		<a href = "mailto: support@coasterq.com">Contact Us</a>
		<br /><br />
		<a href = "http://twitter.com/coasterq">
			<img src="<?= base_url();?>img/twitter.gif" alt="TWitter" />
		</a>
	</p>
	<?= $this->load->view('footer');?>
</html>
