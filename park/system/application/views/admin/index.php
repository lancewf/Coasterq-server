<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

    <?= $this->load->view('admin/header');?>
   
    <body>
    	<center><h2><A href="<?=base_url(); ?>" > <?=$parkName; ?> </A></h2></center>
    	<div id='mainbody' > </div>
		
    	<br>
		
        <?= $this->load->view('admin/loadData');?>
		
    </body>
</html>