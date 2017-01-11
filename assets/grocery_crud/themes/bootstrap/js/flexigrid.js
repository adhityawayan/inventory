$(function(){
	$('.ajax_list').on('click','.delete-row', function(){
		var delete_url = $(this).attr('href');
		var link = $("#link").attr("href");

		if( confirm( message_alert_delete ) )
		{
			$.ajax({
				url: delete_url,
				dataType: 'json',
				success: function(data)
				{
					if(data.success)
					{

						alert(data.success_message);
						document.location.href=link;
					}
					else
					{
						alert(data.error_message);

					}
				}
			});
		}

		return false;
	});

});