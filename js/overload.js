$(function()
{
	$('.kv_button').click(function()
	{
		var elem = $(this).parent().parent().find('fieldset ul li:first-child').clone();

		$(this).parent().parent().find('fieldset ul').append(elem);
	});
});