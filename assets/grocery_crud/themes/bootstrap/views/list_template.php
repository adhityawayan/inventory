<script type="text/javascript">
		var unset_add = <?php echo $unset_add; ?>
</script>
<?php

	//$this->set_css('assets/adminlte/plugins/datatables/dataTables.bootstrap.css');
	//$this->set_css('assets/adminlte/plugins/datatables/extensions/Buttons/css/buttons.bootstrap.min.css');
	//$this->set_css('assets/adminlte/plugins/datatables/jquery.dataTables.css');
	//$this->set_css($this->default_theme_path.'/bootstrap/css/flexigrid.css');
	//$this->set_js_lib($this->default_javascript_path.'/'.grocery_CRUD::JQUERY);

	//$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.noty.js');
	//$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/config/jquery.noty.config.js');
	//$this->set_js_lib($this->default_javascript_path.'/common/lazyload-min.js');

	

	//$this->set_js('assets/adminlte/plugins/datatables/jquery.dataTables.min.js');
	//$this->set_js('assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js');
	//$this->set_js('assets/adminlte/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js');
	//$this->set_js('assets/adminlte/plugins/datatables/extensions/Buttons/js/buttons.bootstrap.min.js');
	//$this->set_js('assets/adminlte/plugins/datatables/extensions/Buttons/js/buttons.print.min.js');

	//$this->set_js($this->default_theme_path.'/bootstrap/js/custom.js');


	//$this->set_js($this->default_theme_path.'/flexigrid/js/cookies.js');
	$this->set_js($this->default_theme_path.'/bootstrap/js/flexigrid.js');

    //$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.form.min.js');

	//$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.numeric.min.js');
	//$this->set_js($this->default_theme_path.'/flexigrid/js/jquery.printElement.min.js');

	/** Fancybox */
	//$this->set_css($this->default_css_path.'/jquery_plugins/fancybox/jquery.fancybox.css');
	//$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.fancybox-1.3.4.js');
	//$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.easing-1.3.pack.js');

	/** Jquery UI */
	//$this->load_js_jqueryui();

?>
<script type='text/javascript'>
	var base_url = '<?php echo base_url();?>';

	var subject = '<?php echo addslashes($subject); ?>';
	var ajax_list_info_url = '<?php echo $ajax_list_info_url; ?>';
	var unique_hash = '<?php echo $unique_hash; ?>';

	var message_alert_delete = "<?php echo $this->l('alert_delete'); ?>";


</script>
<!--ga faham-->
<div id='list-report-error' class='report-div error ' ></div>

<!--alert-->
<div id='list-report-success' class='report-div success report-list' ></div>


<!--panel-->
<div class="box">
	<div class="box-header with-border">
		<!--<h3 class="box-title"><i class="fa fa-table"></i> <?php echo $subject ?></h3>-->
		<?php if(!$unset_add){?>
		<!-- Button ADD  -->
        	<a href='<?php echo $add_url?>' title='<?php echo $this->l('list_add'); ?> <?php echo $subject?>' class='add-anchor add_button btn btn-primary'>
                <i class="fa fa-plus-circle"></i> 
				<span class="add"><?php echo $this->l('list_add'); ?> <?php echo $subject?></span>
            </a>
        <!-- Akhir Button ADD  -->
        <?php }?>
		<!--<div class="flexigrid" data-unique-hash="<?php echo $unique_hash; ?>">
			<div id="hidden-operations" class="hidden-operations"></div>

			<div class="tDiv row">
				<div class="tDiv2 col-xs-12">
			<!-- iki pencariane --
			<?php echo form_open( $ajax_list_url, 'method="post" id="filtering_form" class="filtering_form" autocomplete = "off" data-ajax-list-info-url="'.$ajax_list_info_url.'"'); ?>

		    <!--iki tampil table'e--
			<div id='ajax_list' class="ajax_list">
				
			</div>
			<div class="pReload pButton ajax_refresh_and_loading" id='ajax_refresh_and_loading'>
				<span id="btn-refresh"></span>
			</div>
			<?php echo form_close(); ?>		
			</div>
			</div>
		</div>-->
		<!-- search<div class="box-tools">
			<?php echo form_open( $ajax_list_url, 'method="post" id="filtering_form" class="filtering_form" autocomplete = "off" data-ajax-list-info-url="'.$ajax_list_info_url.'"'); ?>

	        <div class="input-group" style="width: 150px;">
	          <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

	          <div class="input-group-btn">
	            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
	          </div>
	        </div>
	        <?php echo form_close(); ?>	
	    </div>-->
	</div>
    <div class="box-body">
    	
		<div id='ajax_list' class="ajax_list">
			<?php echo $list_view?>	
		</div>
	</div>
	<div class="box-footer with-border clear-fix">
		
		<!--<ul class="pagination no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>-->
	</div>
	<div class="overlay" id="overlayTable" style="display:none;">
		<i class="fa fa-refresh fa-spin"></i>
	</div>
	<a href="<?php echo current_url(); ?>" id="link" style="display: none"></a>
</div>
<!-- /.panel-body -->
<script>
	var successMesage = "<?php echo $success_message; ?>";
</script> 	