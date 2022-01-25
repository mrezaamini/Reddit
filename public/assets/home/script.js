$(document).ready(function()
{
	$("select[name='orderBy']").on('change',function()
	{
		$(this).closest('form').submit()
	})
})