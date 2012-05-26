<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		<title>CoasterQ – Ride More, Wait Less</title>
		
		<?= $this->load->view('header');?>
		    
		<?= $this->load->view('bookmark');?>
    
		<script type="text/javascript" language="javascript" src="<?= base_url();?>client/client.nocache.js"></script>
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
		<div id='des'>
			Choose a park from the list below to create a ride itinerary. Enter ride wait times that you are experiencing to improve the times displayed.
	   	</div>
		
		<br />
		<center>
			<?= $this->load->view('advertisement');?>
		</center>

		<br />
		<br />
		<div id='selectpark' align='center'> Please Select a Park</div>
		<center><div id='parks'> Loading...
		<noscript>
			Enable JavaScript
			<div id='noscriptparks'>
			<table align='center'>
				<tr >
					<td>
						<h3><a href='http://disneyland.coasterq.com/'>Disneyland Resort</a></h3>
					</td>
				</tr>	
				<tr>
					<td>
						<h3><a href='http://california-adventure.coasterq.com/'>California Adventure</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://magic-kingdom.coasterq.com/'>Magic Kingdom</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://animal-kingdom.coasterq.com/'>Disney's Animal Kingdom</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://epcot.coasterq.com/'>Epcot</a></h3></h3>
					</td>
				</tr>
		
				<tr>
					<td>
						<h3><a href='http://hollywood-studios.coasterq.com/'>Disney's Hollywood Studios</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://universal-studios-florida.coasterq.com/'>Universal Studios Florida</a></h3>
		
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://universal-studios-hollywood.coasterq.com/'>Universal Studios Hollywood</a></h3>
					</td>
				</tr>
				<tr>
		
					<td>
						<h3><a href='http://islands-of-adventure.coasterq.com/'>Universal's Islands of Adventure</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://magic-mountain.coasterq.com/'>Six Flags Magic Mountain</a></h3>
					</td>
		
				</tr>
				<tr>
					<td>
						<h3><a href='http://knotts-berry-farm.coasterq.com/'>Knott's Berry Farm</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://over-texas.coasterq.com/'>Six Flags Over Texas</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://legoland-california.coasterq.com/'>LEGOLAND California</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://seaworld-orlando.coasterq.com/'>SeaWorld Orlando</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://tokyo-disneyland.coasterq.com/'>Tokyo Disneyland</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://tokyo-disneysea.coasterq.com/'>Tokyo DisneySea</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://disneyland-park.coasterq.com/'>Disneyland Park (Paris)</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://walt-disney-studios-park.coasterq.com/'>Walt Disney Studios Park (Paris)</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://great-adventure.coasterq.com/'>Six Flags Great Adventure</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://great-america.coasterq.com/'>Six Flags Great America</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://over-georgia.coasterq.com/'>Six Flags Over Georgia</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://discovery-kingdom.coasterq.com/'>Six Flags Discovery Kingdom</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://seaworld-san-antonio.coasterq.com/'>SeaWorld San Antonio</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://six-flags-america.coasterq.com/'>Six Flags America (Baltimore/Washington, D.C.)</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://canadas-wonderland.coasterq.com/'>Canada's Wonderland</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://cedar-point.coasterq.com/'>Cedar Point</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://hersheypark.coasterq.com/'>Hersheypark</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://new-england.coasterq.com/'>Six Flags New England</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://thorpe-park.coasterq.com/'>Thorpe Park</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						<h3><a href='http://st-louis.coasterq.com/'>Six Flags St. Louis</a></h3>
					</td>
				</tr>
				<tr>
					<td>
						More Parks Coming Soon
					</td>
				</tr>
			</table>
			</div>
		</noscript>
		</div></center>
		
		<br />
		<center>
			<?= $this->load->view('advertisement');?>
			<br /><br />
			<center>
				<div id="login"> </div>
			</center>
			<div id="main"> </div>
			<br />
				<center>
				<div>
				  <div style="width: 100%; text-align: center;">
				    <div id="bookmark">
				      <button onClick='addBookmark();'>Add Bookmark</button>
				    </div>
				  </div>
				</div>
				</center>
			<br />
				<a name="fb_share" type="button_count" share_url="www.coasterq.com" href="http://www.facebook.com/sharer.php">Share</a>
				<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
			<br></br>
			<script type="text/javascript" src="http://static.ak.connect.facebook.com/connect.php/en_US"></script>
			<script type="text/javascript">FB.init("afec23131772cced4d65e080a2f8a22b", "<?= base_url();?>xd_receiver.htm");</script>
			<div style="font-size:8px; padding-left:10px"><a href="http://www.coasterq.com/">CoasterQ</a> on Facebook</div>
		</center>
	
		<?= $this->load->view('googleAnalytics');?>
	
		<br />
		<p align = "center">
			<a href = "<?= base_url();?>index.php/main/sitemap">Site Map</a>
			|
			<a href = "<?= base_url();?>index.php/main/faqs"> FAQs</a>
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
	</body>
</html>
