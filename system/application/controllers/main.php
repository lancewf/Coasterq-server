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
}
?>
