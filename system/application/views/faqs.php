<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>CoasterQ - FAQs</title>
		<?= $this->load->view('header');?>
		<script type="text/javascript" src="<?= base_url();?>js/FAQNodeTreeBuilder.js"></script>
		<script type="text/javascript" src="<?= base_url();?>js/PageHolder.js"></script>
		<script type="text/javascript" src="<?= base_url();?>js/NodeTreeView.js"></script>
		<script type="text/javascript" src="<?= base_url();?>js/Node.js"></script>
		<script type="text/javascript" src="<?= base_url();?>js/GuidGenerator.js"></script>
		<script type="text/javascript" src="<?= base_url();?>js/FAQNodeDisplayer.js"></script>
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
		<h3>FAQs</h3>
	   	<div id='text'> 
		<center>Loading....</center>
		<noscript>
			Enable Javascript..
			   	<table align='center'>
					<tr >
						<td>
							<div align='center'>
							CoasterQ’s formula for calculating ride wait times consists of a two step process. The initial step involves a prediction technique which incorporates specific attributes of the park (this includes crowd levels along with many other factors) and historical data* to provide an approximate wait time. The second step is where CoasterQ’s user community comes into play – the base times are then refined by user entered wait times. Since the wait time calculation incorporates historical data, user-entered times will improve displayed times for the remainder of the current day as well as all future dates. The more wait times that users enter into the system, the more precise the times displayed will become, so tell your friends, family, and the people next to you in line to help out. Hey, you’re in line - got something better to do?
							<br /><br />
							* Historical data consists of prior user-entered wait times; this includes wait times entered earlier for the current day as well as all entries made into the CoasterQ system on previous days/years. 
							</div>
							<br>
							<div align='center'><img src="<?= base_url();?>img/dot.png"></div>
							<br>
							<div align='center'>
							CoasterQ's wait times are automatically updated and displayed while you are connected to the internet. You do not need to refresh your browser.
							</div>
							<br>
							<div align='center'><img src="<?= base_url();?>img/dot.png"></div>
							<br>
							<div align='center'>
							A ride queue can be created for each park. If you change parks your queue will be available to you upon returning to that park’s page.
							</div>
						</td>
					</tr>
				</table>
			</noscript>
		</div>
		<br></br>
		<center>
			<?= $this->load->view('advertisement');?>
		</center>
		<script type="text/javascript">
			pageHolder = new PageHolder("text");
			window.onload = function () 
			{
				var nodeTreeBuilder = new FAQNodeTreeBuilder();
					
				pageHolder.addPage(new NodeTreeView(nodeTreeBuilder));
				
				pageHolder.showPage(NodeTreeViewName);
			}
		</script>
		<?= $this->load->view('googleAnalytics');?>
	
	</body>
	<br />
	<p align = "center">
		<a href = "<?= base_url();?>">Home</a>
		|
		<a href = "<?= base_url();?>index.php/main/sitemap">Site Map</a>
		|
		<a href = "<?= base_url();?>index.php/main/termsofuse">Terms of Use</a>
		|
		<a href = "mailto: support@coasterq.com">Contact Us</a>
		<br /><br />
		<a href = "http://twitter.com/coasterq">
			<img src="<?= base_url();?>img/twitter.gif" alt="TWitter" />
		</a>
	</p>
	<?= $this->load->view('footer');?>
</html>
