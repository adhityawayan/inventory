<?php if(!empty($list)){ ?>
<div class="bDiv" >
	<table  class="table table-bordered table-striped table-hover" id="dtables">
		<thead>
			<tr class=''>
				<th>No.</th>
				<?php foreach($columns as $column){?>
				<th><?php echo $column->display_as?></th>
				<?php }?>
				<?php if(!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)){?>
				<th abbr="tools" axis="col1"><?php echo $this->l('list_actions'); ?></th>
				<?php }?>
			</tr>
		</thead>
		<tbody>
		<?php $i = 1; foreach($list as $num_row => $row){ ?>        
		<tr>
			<td><?= $i ?></td>
			<?php foreach($columns as $column){?>
				<td><?php echo $row->{$column->field_name} != '' ? $row->{$column->field_name} : '&nbsp;' ; ?></td>
			<?php }?>

			<?php if(!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)){?>
			<td class="td-action" width="200">

                    <?php if(!empty($row->action_urls)){ foreach($row->action_urls as $action_unique_id => $action_url){ $action = $actions[$action_unique_id]; ?>
					
						<a href="<?php echo $action_url; ?>" class="<?php echo $action->css_class; ?> crud-action btn btn-primary btn-sm" title="<?php echo $action->label?>"><i class="<?php echo $action->image_url ?>"></i> <?php echo $action->label; ?></a>	
					
					<?php }	} ?>					

                    <?php if(!$unset_read){?>
                    
						<a href='<?php echo $row->read_url?>' title='<?php echo $this->l('list_view')?> <?php echo $subject?>' class="edit_button btn btn-primary btn-sm"><i class='fa fa-list'></i> Detail</a>   
					
					<?php }?>
                                        
                    <?php if(!$unset_edit){?>
					
						<a href='<?php echo $row->edit_url?>' title='<?php echo $this->l('list_edit')?> <?php echo $subject?>' class="edit_button btn btn-warning btn-sm"><i class='fa fa-pencil'></i> Edit</a> 
					
					<?php }?>

                    <?php if(!$unset_delete){?>
                    
                    	<a href='<?php echo $row->delete_url?>' onclick="cek()" title='<?php echo $this->l('list_delete')?> <?php echo $subject?>' class="delete-row btn btn-danger btn-sm" ><i class='fa fa-trash-o'></i> Delete</a>
                    	
                    <?php }?>
				
			</td>
			<?php }?>
		</tr>
		<?php $i = $i+1; } ?>     
		</tbody>  
	</table>
</div>
<?php }else{?>
	<br/>
	&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $this->l('list_no_items'); ?>
	<br/>
	<br/>
<?php }?>

