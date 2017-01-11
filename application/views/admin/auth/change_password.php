<div class="row">
      <div class="col-xs-12">
            <?php
                  if (isset($message)){
                        ?>
                              <div id="alert alert-primary"><?php echo $message;?></div>
                        <?php
                  }
            ?>
            <div class="box">
                  <div class="box-header">

                  </div>
                  <div class="box-body">
<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/change_password");?>

      <div class="form-group">
                <label>
            <?php echo lang('change_password_old_password_label', 'old_password');?> </label>
            <?php echo form_input($old_password);?>
      </div>

      <div class="form-group">
                <label>
            <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> </label>
            <?php echo form_input($new_password);?>
      </div>

      <div class="form-group">
                <label>
            <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> </label>
            <?php echo form_input($new_password_confirm);?>
      </div>

      <?php echo form_input($user_id);?>
      <div class="form-group">
                <label><?php echo form_submit('submit', lang('change_password_submit_btn'),'class="btn btn-primary"');?></div>

<?php echo form_close();?>
                  </div>
            </div>
      </div>
</div>

