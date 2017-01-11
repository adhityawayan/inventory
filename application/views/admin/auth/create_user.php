
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

        <?php echo form_open("user/create_user");?>

              <div class="form-group">
                <label><?php echo lang('create_user_fname_label', 'first_name');?></label>
                    <?php echo form_input($first_name);?>
              </div>

              <div class="form-group">
                <label>
                    <?php echo lang('create_user_lname_label', 'last_name');?></label>
                    <?php echo form_input($last_name);?>
              </div>
              
              <?php
              if($identity_column!=='email') {
                  echo '<div class="form-group">
                <label>';
                  echo lang('create_user_identity_label', 'identity');
                  echo '<br />';
                  echo form_error('identity');
                  echo form_input($identity);
                  echo '</div>';
              }
              ?>

              <div class="form-group">
                <label>
                    <?php echo lang('create_user_company_label', 'company');?></label>
                    <?php echo form_input($company);?>
              </div>

              <div class="form-group">
                <label>
                    <?php echo lang('create_user_email_label', 'email');?></label>
                    <?php echo form_input($email);?>
              </div>

              <div class="form-group">
                <label>
                    <?php echo lang('create_user_phone_label', 'phone');?></label>
                    <?php echo form_input($phone);?>
              </div>

              <div class="form-group">
                <label>
                    <?php echo lang('create_user_password_label', 'password');?></label>
                    <?php echo form_input($password);?>
              </div>

              <div class="form-group">
                <label>
                    <?php echo lang('create_user_password_confirm_label', 'password_confirm');?></label>
                    <?php echo form_input($password_confirm);?>
              </div>


              <div class="form-group">
                <?php echo form_submit('submit', lang('create_user_submit_btn'),"class='btn btn-primary'");?>
              </div>

        <?php echo form_close();?>
      </div>
    </div>
  </div>
</div>
