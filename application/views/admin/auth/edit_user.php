
<div class="row">
  <div class="col-xs-12">
    
    <div class="box">
      <div class="box-header">

      </div>
      <div class="box-body">
        <?php echo form_open(uri_string());?>
          <div class="form-group">
            <label><?php echo lang('edit_user_fname_label', 'first_name');?></label>
            <?php echo form_input($first_name);?>
          </div>
          
          <div class="form-group">
            <label><?php echo lang('edit_user_lname_label', 'last_name');?></label>
            <?php echo form_input($last_name);?>
          </div>



          <div class="form-group">
                <label><?php echo lang('edit_user_company_label', 'company');?></label>
                <?php echo form_input($company);?>
          </div>

          <div class="form-group">
                <label><?php echo lang('edit_user_phone_label', 'phone');?></label>
                <?php echo form_input($phone);?>
          </div>

          <div class="form-group">
                <label><?php echo lang('edit_user_password_label', 'password');?></label>
                <?php echo form_input($password);?>
          </div>

          <div class="form-group">
                <label><?php echo lang('edit_user_password_confirm_label', 'password_confirm');?></label>
                <?php echo form_input($password_confirm);?>
          </div>

          <?php if ($this->ion_auth->is_admin() && $this->uri->segment(1) != "profile"): ?>

              <h3><?php echo lang('edit_user_groups_heading');?></h3>
              <?php foreach ($groups as $group):?>
                  <label class="checkbox">
                  <?php
                      $gID=$group['id'];
                      $checked = null;
                      $item = null;
                      foreach($currentGroups as $grp) {
                          if ($gID == $grp->id) {
                              $checked= ' checked="checked"';
                          break;
                          }
                      }
                  ?>
                  <input type="radio" name="groups[]" class="minimal" value="<?php echo $group['id'];?>" <?php echo $checked;?> >
                  <?php echo Ucfirst(htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8'));?>
                  </label>
              <?php endforeach?>
              

              <div id="hakakses">
              <h3>Hak Akses User</h3>
              <?php foreach ($menus as $menu):?>
                  <label class="checkbox">
                  <?php
                      $mid=$menu['id'];
                      $checked = null;
                      $item = null;
                      foreach($users_access as $acc) {
                          if ($mid == $acc->menu_id) {
                              $checked= ' checked="checked"';
                          break;
                          }
                      }
                  ?>
                  <input type="checkbox" name="menus[]" class="minimal" value="<?php echo $menu['id'];?>" <?php echo $checked;?> >
                  <?php echo Ucfirst(htmlspecialchars($menu['nama'],ENT_QUOTES,'UTF-8'));?>
                  </label>
              <?php endforeach?>
              </div>


          <?php endif ?>

          <?php echo form_hidden('id', $user->id);?>
          <?php echo form_hidden($csrf); ?>

          <div class="form-group">

            <?php echo form_submit('submit', lang('edit_user_submit_btn'),"class='btn btn-primary'");?></div>
          </div>
    <?php echo form_close();?>
      </div>
    </div>
  </div>

<div id="infoMessage"><?php echo $message;?></div>


