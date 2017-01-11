<div class="row">
  <div class="col-xs-12">
    
    <div class="box">
      <div class="box-header">

      </div>
      <div class="box-body">
        <?php
          if (isset($message)){
            ?>
              <div class="alert alert-warning">
                <?php echo $message;?>
              </div>
            <?php
          }
        ?>


<?php echo form_open(current_url());?>

		<div class="form-group">
	        <label><?php echo lang('edit_group_name_label', 'group_name');?></label>
	            <?php echo form_input($group_name);?>
	      </div>

	      <div class="form-group">
	        <label><?php echo lang('edit_group_desc_label', 'description');?></label>
	            <?php echo form_input($group_description);?>
	      </div>


      	<div class="form-group">
                <?php echo form_submit('submit', lang('edit_group_submit_btn'),"class='btn btn-primary'");?>
              </div>


<?php echo form_close();?>

      </div>
    </div>
  </div>
</div>
