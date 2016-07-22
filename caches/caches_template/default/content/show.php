<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<style>
.col-left{};
</style>
<div class="main">
	<div>
    	
        <div id="Article" style="border: 0px solid #C3D4E7;">
        	<h1><?php echo $title;?><br />
<span><?php echo $inputtime;?>&nbsp;&nbsp;&nbsp;</h1>
			<?php if($description) { ?><div class="summary" ><?php echo $description;?></div><?php } ?>
			<div class="content">
            &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $content;?>
			
			</div>

		
     
      
     
</div>
   
</div>


<?php include template("content","footer"); ?>