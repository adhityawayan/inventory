

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
				<?php echo anchor('user/create_user', '<i class="fa fa-plus"></i> '.lang('index_create_user_link'),'class="btn btn-primary"')?>
				<!--<?php echo anchor('user/create_group', '<i class="fa fa-plus"></i> '.lang('index_create_group_link'),'class="btn btn-primary"')?>-->
			</div>
			<div class="box-body no-padding">

				<table class="table table-striped">
					<tr>
						<th><?php echo lang('index_fname_th');?></th>
						<th><?php echo lang('index_lname_th');?></th>
						<th><?php echo lang('index_email_th');?></th>
						<th><?php echo lang('index_groups_th');?></th>
						<th><?php echo lang('index_status_th');?></th>
						<th><?php echo lang('index_action_th');?></th>
					</tr>
					<?php foreach ($users as $user):?>
						<tr>
				            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
				            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
				            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
							<td style="width:70px;">
								<?php foreach ($user->groups as $group):?>
									<?php echo anchor("user/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
				                <?php endforeach?>
							</td>
							<td style="width:70px;"><?php echo ($user->active) ? anchor("user/deactivate/".$user->id, lang('index_active_link')) : anchor("user/activate/". $user->id, lang('index_inactive_link'));?></td>
							<td style="width:70px;"><?php echo anchor("user/edit_user/".$user->id, 'Edit') ;?></td>
						</tr>
					<?php endforeach;?>
				</table>
			</div>
		</div>
	</div>
</div>

