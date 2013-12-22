(function($) {
	$(function() {

		var $id_request = ''; //correspond à l'élement qui contient l'id de la visit_request dans val()
		$('.switchStatusVisitRequest').on('click', function(e)
		{
			$id_request = $(this).parent().parent().find('.id_visit_request');
		});
		
		$('.deleteVisitRequest').on('click', function(e)
		{
			$id_request = $(this).parent().find('.id_visit_request');
			if(confirm('Are you sure to delete this request ?'))
			{
				$.ajax({
		              url: '/page_dashboard.php',
		              type: 'POST',
		              data: 'EX=deleteVisitRequest&id_request='+$id_request.val(),
		              dataType: 'json',
		              success: function(json) {
							$id_request.parents('tr').remove();
					}
				});
			}
		});
		
		
		$('#formSwitchStatusVisitRequest').on('click', '.label', function(e)
		{
			if($id_request != '')
			{
				var status = $(this).find('input').val();
	
				$.ajax({
		              url: '/page_dashboard.php',
		              type: 'POST',
		              data: 'EX=switchStatusVisitRequest&id_request='+$id_request.val()+'&status='+status,
		              dataType: 'json',
		              success: function(json) {
							var classe = '';
							var lib = '';
							if(status == 0)
							{
								classe = 'label-info';
								lib = 'On confirmation';
							}
							else if(status == 1)
							{
								classe = 'label-success';
								lib = 'Approved';
							}
							else if(status == 2)
							{
								classe = 'label-warning';
								lib = 'Suspended';
							}
							$id_request.parent().parent().find('.col_status').html('<span class="switchStatusVisitRequest label '+classe+' label-mini" data-toggle="modal" href="#modalSwitchStatusVisitRequest" >'+lib+'</span>');
							$('#modalSwitchStatusVisitRequest').modal('hide');
		              		$id_request = '';
		              }
				});
			}
		});

		$( ".search_member" ).autocomplete({
				source: function( request, response ) {
				$.ajax({
					url: "/page_dashboard.php",
					type: 'POST',
					dataType: "json",
					data: {
					maxRows: 15,
					name_startsWith: request.term,
					EX: 'listMemberAutocomplete'
				},
				success: function( data ) {
	
					if(data.length > 0)
					{
						response( $.map( data, function( item ) {
							
							return {
								label: item.name+' ('+item.email+')',
								value: item.email,
								id: item.id
							}
						}));
					}
					
				}
				});
			},
			minLength: 2,
			select: function( event, ui ) {
				if($('#select_marque_definitive'))
				{
					$('#select_marque_definitive option[value='+ui.item.id+']').attr('selected', 'selected');
				}
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});
			
		$('#compose_message').submit(function(e)
		{
			e.preventDefault();
			var data_serialize = $('#compose_message').serialize();
			
			$.ajax({
	              url: '/page_dashboard.php',
	              type: 'POST',
	              data: 'EX=newConversation&'+data_serialize,
	              dataType: 'html',
	              success: function(html) {
					if(html == '')
						$('#modalComposeMail').modal('hide');
					else
						alert(html);
				}
			});
		});
		
		$('.send-mail').on('click', function(e)
		{
			e.preventDefault();
			var email = $(this).attr('id');
			$('#modalComposeMail').modal();
			$('#modalComposeMail').find('input[name="email"]').val(email);
		});
		
	    //http://www.eyecon.ro/bootstrap-datepicker/
	    var $dataPickerInput = $( "#dataPickerInput" );
	
	    if ( $dataPickerInput.length ) {
	    	
	        $dataPickerInput.datepicker(
	        		{
	        			format : 'yyyy-mm-dd'
	        		});
	
	        $dataPickerInput.focusin(function(e)
	        {
	        	$dataPickerInput.datepicker('show');
	        });
	    }
	    
	    $('.edit-request').on('click', function(e)
	    {
	    	var tr = $(this).parents('tr');
	    	var id_request = $(tr).attr('id').split('-')[1];
	    	
	    	var date = $(tr).find('.request-date').text();
	    	var hour = $(tr).find('.request-hour').text();
	    	
	    	$('#dataPickerInput').val(date);
	    	$('input[name="visit_hour"]').val(hour);
	    	
	    	$('#formVisitRequest').submit(function(e)
	    	{
	    		e.preventDefault();
	    		var data_serialize = $(this).serialize();
	    		$.ajax({
		              url: '/page_dashboard.php',
		              type: 'POST',
		              data: 'EX=editRequestVisit&id='+id_request+'&'+data_serialize,
		              dataType: 'json',
		              success: function(json) {
						if(json == 'ok')
							window.location.reload()
						else
							alert('An error has occurred');
					}
				});
	    	});
	    });
	});
	
	
})(jQuery);
