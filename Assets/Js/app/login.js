(function($) {
	$(function() {

		$('#sendFormRegister').on('click', function(e)
		{
			e.preventDefault();
				$('.control-label').remove();
	           	$('.has-error').removeClass('has-error');
			$('#formRegister').submit();
		});
		
		$('#formRegister').on('submit', function(e)
		{
			e.preventDefault();
			var datas = $(this).serialize();
			
			$.ajax({
	              url: '/page_login.php',
	              type: 'POST',
	              data: 'EX=doRegister&'+datas,
	              dataType: 'json',
	              success: function(json) {
		              
	              	
	              		if(json.statut == 'KO')
	              		{
		              		$.each(json.error_form, function(i,v)
		              		{
		              			$('#'+i).after('<label class="control-label" for="'+i+'">'+v+'</label>');
		              			$('#'+i).parent().addClass('has-error');
		              			
		              		});
	              		}
	              		else
	              		{
	              			window.location.reload();
	              		}
	              		
	              }
			});
	
		});
		
		$('#sendFormLogin').on('click', function(e)
		{
			e.preventDefault();
				$('.control-label').remove();
	           	$('.has-error').removeClass('has-error');
			$('#loginForm').submit();
			
		});
				
		$('#loginForm').on('submit', function(e)
		{
			console.log('test');
			e.preventDefault();
			var datas = $(this).serialize();
			console.log('test');
			$.ajax({
	              url: '/page_login.php',
	              type: 'POST',
	              data: 'EX=doLogin&'+datas,
	              dataType: 'json',
	              success: function(json) {
		              
	              	
	              		if(json.statut == 'KO')
	              		{
		              		$('.error_login').text('Login failed');
	              		}
	              		else
	              		{
	              			window.location.reload();
	              		}
	              		
	              }
			});
	
		});
	});
})(jQuery);
