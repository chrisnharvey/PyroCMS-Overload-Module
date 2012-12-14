<section class="title">
	<h4>Overload</h4>
</section>

<section class="item">
<?php if ( ! empty($records)): ?>

	<?php echo form_open('admin/overload/delete'); ?>
		<table border="0" class="table-list">
			<thead>
			<tr>
				<th width="30"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
				<th>Title</th>
				<th>Route</th>
				<th>Module</th>
				<th>Class</th>
				<th>Method</th>
				<th width="140"></th>
			</tr>
			</thead>
			<tbody>
				<?php foreach ($records as $record): ?>
				<tr>
					<td><?php echo form_checkbox('action_to[]', $record['id']); ?></td>
					<td><?php echo $record['title']; ?></td>
					<td><?php echo $record['route'] ? $record['route'] : 'N/A'; ?></td>
					<td><?php echo $record['module'] ? $record['module'] : 'N/A'; ?></td>
					<td><?php echo $record['class'] ? $record['class'] : 'N/A'; ?></td>
					<td><?php echo $record['method'] ? $record['method'] : 'N/A'; ?></td>
					<td class="actions">
						<?php echo anchor('admin/overload/edit/' . $record['id'], lang('buttons.edit'), 'class="button edit"'); ?>
						<?php echo anchor('admin/overload/delete/' . $record['id'], lang('buttons.delete'), array('class'=>'confirm button delete')); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<div class="table_action_buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
		</div>
	<?php echo form_close(); ?>

<?php else: ?>
		<div class="no_data">You have not added any custom overloads yet</div>
<?php endif; ?>
</section>