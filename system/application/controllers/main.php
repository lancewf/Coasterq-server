<?php

/*
 * The main controller page of the park. 
 * 
 * This page allows the user to come in with 
 * 
 * www.[park name].coasterq.com/index.php/myq
 * www.[park name].coasterq.com/index.php/enterridetime
 * www.[park name].coasterq.com/index.php/rides
 * 
 * for the www.[park name].coasterq.com/index.php/myq URL the user's opening page
 * starts with the user's que of rides. 
 * 
 * for the www.[park name].coasterq.com/index.php/enterridetime URL the user's
 * opening page starts with the enter ride wait times view. 
 * 
 * for the www.[park name].coasterq.com/index.php/rides URL the opening page
 * starts with the ride search page. 
 * 
 */
class Main extends Controller
{
	// -------------------------------------------------------------------------
	// Constructor
	// -------------------------------------------------------------------------
	
	function Main()
	{
		parent::Controller();
	}

	// -------------------------------------------------------------------------
	// Public Members
	// -------------------------------------------------------------------------
	
	public function index()
	{
		$this->load->view('index');

		if($this->isInFacebookCanvasAndNotAdded() )
		{
			//echo "in";
			$this->facebook_connect->fb->require_login();
		}
		else
		{
			//echo "out";
		}
	}
	
	public function welcomeFacebook()
	{
		$this->load->view('index');
	}
	
	private function isInFacebookCanvasAndNotAdded()
	{
		parse_str($_SERVER['QUERY_STRING'], $_GET);

		$this->_obj =& get_instance();

		if(array_key_exists('fb_sig_in_iframe', $_GET))
		{
			if((strcmp($this->_obj->config->item('facebook_api_key'), $_GET['fb_sig_api_key']) == 0) && 
			   (strcmp("0", $_GET['fb_sig_added']) == 0))
			{
				return true;
			}
		}
		
		return false;
	}

	public function sitemap()
	{
		$this->load->view('sitemap');
	}
	
	public function faqs()
	{
		$this->load->view('faqs');
	}
		
	public function termsofuse()
	{
		$this->load->view('termsofuse');
	}
	
	// -------------------------------------------------------------------------
	// Private Members
	// -------------------------------------------------------------------------

}
?>
