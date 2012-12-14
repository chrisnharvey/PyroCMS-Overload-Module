$(function()
{
	$('.kv_button').click(function()
	{
		$('#data-tab fieldset ul').append('' + 
			'<li>' +
			'	<label style="width: 65px !important;">Key-Value</label>' +
			'	<div class="input key">' +
			'		<input type="text" name="data_key[]">' +
			'	</div>' +
			'	<div class="input value">' +
			'		<textarea name="data_value[]"></textarea>' +
			'	</div>' +
			'</li>');
		
	});
});