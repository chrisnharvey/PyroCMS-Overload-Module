<section class="title">
<h4>Add/Edit Overload</h4>
</section>

<section class="item">
	
<?php echo form_open(); ?>

<div class="tabs">

	<ul class="tab-menu">
		<li><a href="#general-tab"><span>General</span></a></li>
		<li><a href="#options-tab"><span>Options</span></a></li>
		<li><a href="#css-tab"><span>CSS</span></a></li>
		<li><a href="#js-tab"><span>Javascript</span></a></li>
		<li><a href="#meta-tab"><span>Metadata</span></a></li>
		<li><a href="#data-tab"><span>Data</span></a></li>
	</ul>
	
	<!-- General tab -->
	<div class="form_inputs" id="general-tab">
		<fieldset>
			<ul>
				<li>
					<label for="title">Title <span>*</span></label>
					<div class="input"><?php echo form_input('title', isset($title) ? $title : NULL, 'maxlength="100" id="title"'); ?></div>				
				</li>
				
				<li>
					<label for="slug">Route<small>Which routes would you like this overload to apply to?</small></label>
					<div class="input"><?php echo form_input('route', isset($route) ? $route : NULL, 'maxlength="100" class="width-20"'); ?></div>
				</li>
				
				<li>
					<label for="status">Module</label>
					<div class="input"><?php echo form_dropdown('module', $modules_list, isset($module) ? $module : NULL) ?></div>
				</li>
				
				<li>
					<label for="slug">Class</label>
					<div class="input"><?php echo form_input('class', isset($class) ? $class : NULL, 'maxlength="100" class="width-20"'); ?></div>
				</li>

				<li>
					<label for="slug">Method</label>
					<div class="input"><?php echo form_input('method', isset($method) ? $method : NULL, 'maxlength="100" class="width-20"'); ?></div>
				</li>
			</ul>
		</fieldset>
	</div>

	<!-- Options tab -->
	<div class="form_inputs" id="options-tab">
		<fieldset>
			<ul>
				<li>
					<label for="title">Enable Parser <span>*</span></label>
					<div class="input"><?php echo form_dropdown('enable_parser', array('' => 'Default', '1' => 'Yes', '0' => 'No'), isset($enable_parser) ? $enable_parser : NULL) ?></div>
				</li>
				
				<li>
					<label for="slug">Enable Parser Body</label>
					<div class="input"><?php echo form_dropdown('enable_parser_body', array('' => 'Default', '1' => 'Yes', '0' => 'No'), isset($enable_parser_body) ? $enable_parser_body : NULL) ?></div>
				</li>
				
				<li>
					<label for="status">Enable Minify<small>Setting this to "Yes" will minify your HTML</small></label>
					<div class="input"><?php echo form_dropdown('enable_minify', array('' => 'Default', '1' => 'Yes', '0' => 'No'), isset($enable_minify) ? $enable_minify : NULL) ?></div>
				</li>
				
				<li>
					<label for="slug">Theme</label>
					<div class="input"><?php echo form_input('theme', isset($theme) ? $theme : NULL, 'maxlength="50" class="width-20"'); ?></div>
				</li>

				<li>
					<label for="slug">Layout</label>
					<div class="input"><?php echo form_input('layout', isset($layout) ? $layout : NULL, 'maxlength="50" class="width-20"'); ?></div>
				</li>
			</ul>
		</fieldset>
	</div>

	<!-- CSS tab -->
	<div class="form_inputs" id="css-tab">
		<fieldset>
			<ul>
				<li>
					<textarea name="css" height="500" id="css" class="css_editor" width="100%"><?php echo isset($css) ? $css : NULL; ?></textarea>				
				</li>
			</ul>
		</fieldset>
	</div>

	<!-- JS tab -->
	<div class="form_inputs" id="js-tab">
		<fieldset>
			<ul>
				<li>
					<textarea name="js" height="500" id="css" class="js_editor" width="100%"><?php echo isset($js) ? $js : NULL; ?></textarea>				
				</li>
			</ul>
		</fieldset>
	</div>

	<!-- Metadata tab -->
	<div class="form_inputs" id="meta-tab">
		<fieldset>
			<ul>
				<?php if (isset($meta) AND ! empty($meta)): ?>
					<?php foreach ($meta as $key => $value): ?>
						<li>
							<label style="width: 65px !important;">Key-Value <span>*</span></label>
							<div class="input key">
								<input type="text" name="meta_key[]" value="<?php echo set_value('meta_key[]', $key); ?>">
							</div>
							<div class="input value">
								<textarea name="meta_value[]"><?php echo set_value('meta_value[]', $value); ?></textarea>
							</div>
						</li>
					<?php endforeach; ?>
				<?php else: ?>
					<li>
						<label style="width: 65px !important;">Key-Value <span>*</span></label>
						<div class="input key">
							<input type="text" name="meta_key[]" value="<?php echo set_value('meta_key[]'); ?>">
						</div>
						<div class="input value">
							<textarea name="meta_value[]"><?php echo set_value('meta_value[]'); ?></textarea>
						</div>
					</li>
				<?php endif; ?>
			</ul>

			<button type="button" class="btn blue kv_button">
				<span>Add</span>
			</button>
		</fieldset>
	</div>

	<!-- Data tab -->
	<div class="form_inputs" id="data-tab">
		<fieldset>
			<ul>
				<?php if (isset($data) AND ! empty($data)): ?>
					<?php foreach ($data as $key => $value): ?>
						<li>
							<label style="width: 65px !important;">Key-Value <span>*</span></label>
							<div class="input key">
								<input type="text" name="data_key[]" value="<?php echo set_value('data_key[]', $key); ?>">
							</div>
							<div class="input value">
								<textarea name="data_value[]"><?php echo set_value('data_value[]', $value); ?></textarea>
							</div>
						</li>
					<?php endforeach; ?>
				<?php else: ?>
					<li>
						<label style="width: 65px !important;">Key-Value <span>*</span></label>
						<div class="input key">
							<input type="text" name="data_key[]" value="<?php echo set_value('data_key[]'); ?>">
						</div>
						<div class="input value">
							<textarea name="data_value[]"><?php echo set_value('data_value[]'); ?></textarea>
						</div>
					</li>
				<?php endif; ?>
			</ul>

			<button type="button" class="btn blue kv_button">
				<span>Add</span>
			</button>
		</fieldset>
	</div>

</div>

<div class="buttons">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))); ?>
</div>

<?php echo form_close(); ?>

</section>