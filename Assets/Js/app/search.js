(function($) {
	$(function() {
			var nbPage = 1;
			var firstRequete = true;
			var firstNum = 1;
			var lastNum = 5;
			
			var allPages = $('.page');
			$('#areas').change(function() {
				$('#formSearch').submit();
				//Gestion de la soumission du formulaire

			});

			$('#submitSearch').on('click', function()
			{
				$('#formSearch').submit();
			});
			$('#formSearch').submit(function(e){
			    e.preventDefault();
			    var valeurs=$(this).serialize();
			    firstRequete = true;
			    recherche(valeurs, 1);
			});

			function recherche(valeurs, numPage)
			{

				window.history.pushState(document.title,document.title, 'http://'+document.location.hostname+'/search?'+valeurs);
				$.ajax({
		            url: '/page_search.php',
		            type: 'GET',
		            data : 'EX=searchAJAX&'+valeurs+'&page='+numPage,
		            dataType: 'json',
		            success: function(json) {

						var address = 'No Address';
						var sqft = '/';
						var price = 'No Price';
						var bed = '/';
						var bathroom = '/';
						var img = '../assets/img/img-480-2.jpg';
						var id = '';
						var style = '';
						var city = '';

						var html = '';
						$.each(json.results, function(i, v)
						{
							if(v.address != null)
								address = v.address;
							if(v.price != null)
								price = '$'+v.price.replace('.00', '');
							if(v.bed != null)
								bed = v.bed;
							if(v.bathroom != null)
								bathroom = v.bathroom;
							if(v.sqft != null)
								sqft = v.sqft;

							if(v.style != null)
								style = v.style;

							if(v.city != null)
								city = v.city;

							if(v.img != null)
							{
								var img_split = v.img.split('|');
								img = img_split[0];
							}

							id = v.id;


							html += '<div class="col-lg-4 padding-2em">'+
								'<article class="search-property">'+
									'<div class="bg-header">'+
										'<img src="'+img+'" alt="">'+
									'</div>'+
									'<div class="padding-r-l-2em search-property-content txt-center">'+
										'<hgroup class="txt-center">'+
											'<h4 class="search-property-type"><span class="visuallyhidden">Property type :</span> <i class="icon-home"></i></h4>'+
											'<h3 class="search-property-title lh-100 margin-zero">'+address+'</h3>'+
											'<h4 class="lh-100">'+price+'</h4>'+
										'</hgroup>'+
										'<a href="/property/'+encodeURIComponent(id)+'" class="btn btn-primary">View details</a>'+
										'<ul class="list-inline padding-3em details">'+
											'<li class="text-left"><strong class="display-block number">'+bed+'</strong> BEDS'+
											'<li class="text-left"><strong class="display-block number">'+bathroom+'</strong> BATHS'+
											'<li class="text-left"><strong class="display-block number">'+sqft+'</strong>  SQFT'+
										'</ul>'+
									'</div>'+
								'</article>'+
							'</div>';
						});

						$('#searchResult').html(html);
						nbPage = Math.ceil(json.nbResults / 6);
						
						if(firstRequete)
						{
							

							$('#matching').text(json.nbResults);
							
							$('.liste_page').empty();
							if(nbPage > 1)
							{
								if(nbPage > 5)
								{
									$('.liste_page').append($('<li />').append($('<a />').attr('class','page first').attr('href','#').html('&laquo;')));
									$('.liste_page').append($('<li />').attr('class','active').append($('<a />').attr('class','page').attr('href','#').text(1)));

									for(i = 2; i < 6; ++i)
									{
											$('.liste_page').append($('<li />').append($('<a />').attr('class','page').attr('href','#').text(i)));
									}
								}
								else
								{
									$('.liste_page').append($('<li />').append($('<a />').attr('class','page').attr('href','#').html('&laquo;')));
									$('.liste_page').append($('<li />').attr('class','active').append($('<a />').attr('class','page').attr('href','#').text(1)));

									for(i = 2; i != nbPage + 1; ++i)
									{
											$('.liste_page').append($('<li />').append($('<a />').attr('class','page').attr('href','#').text(i)));
									}
								}
								$('.liste_page').append($('<li />').append($('<a />').attr('class','page last').attr('href','#').html('&raquo;')));
							}
							
							firstRequete = false;
						}
						else
						{

							if(nbPage > 1)
							{
								if((numPage == lastNum && numPage != nbPage) || (numPage == firstNum && numPage != 1))
								{
									$('.liste_page').empty();
									$('.liste_page').append($('<li />').append($('<a />').attr('class','page first').attr('href','#').html('&laquo;')));
	
									if(numPage + 2 > nbPage)
									{
										i = numPage - 3;
										limit = numPage + 1;
									}
									else if(numPage - 2 < 1)
									{
										i = numPage - 1;
										limit = numPage + 3;
									}
									else
									{
										i = numPage - 2;
										limit = numPage + 2;
									}
	
									for(; i <= limit; ++i)
									{
										if(i == nbPage + 1) break;
	
										if(i == numPage)
											$('.liste_page').append($('<li />').attr('class','active').append($('<a />').attr('class','page').attr('href','#').text(i)));
										else
											$('.liste_page').append($('<li />').append($('<a />').attr('class','page').attr('href','#').text(i)));
									}
									$('.liste_page').append($('<li />').append($('<a />').attr('class','page last').attr('href','#').html('&raquo;')));
									lastNum = i - 1;
									firstNum = i - 5;
	
								}
								else if(numPage == nbPage || numPage == 1)
								{
									if(numPage == nbPage)
									{
										limit = numPage;
										(numPage < 5 ? i = 1 : i = numPage - 4)
									}
									else if(numPage == 1)
									{
										i = numPage;
										limit = numPage + 4;
									}
	
									$('.liste_page').empty();
									$('.liste_page').append($('<li />').append($('<a />').attr('class','page first').attr('href','#').html('&laquo;')));
	
									for(; i <= limit; ++i)
									{
										if(i == nbPage + 1) break;
	
										if(i == numPage)
											$('.liste_page').append($('<li />').attr('class','active').append($('<a />').attr('class','page').attr('href','#').text(i)));
										else
											$('.liste_page').append($('<li />').append($('<a />').attr('class','page').attr('href','#').text(i)));
									}
									$('.liste_page').append($('<li />').append($('<a />').attr('class','page last').attr('href','#').html('&raquo;')));
									lastNum = i - 1;
									firstNum = i - 5;
	
								}
							}
						}
						
						
						
					},
					error: function(resultat, statut, erreur){
		            }
		        });
			}

			$('.pagination').on('click', '.page', function(e)
			{
				e.preventDefault();
				$.each(allPages, function()
				{
					$(this).parent().removeClass('active');
				});

				$(this).parent().addClass('active');

				if($(this).hasClass('last'))
					numPage = nbPage;
				else if($(this).hasClass('first'))
					numPage = 1;
				else
					numPage = parseInt($(this).text());

				firstRequete = false;

				var valeurs=$('#formSearch').serialize();
				recherche(valeurs, numPage);

				
			});

			$('#formVisitRequest').on('submit', function(e)
			{
				e.preventDefault();

				var valeurs = $(this).serialize();
				var id_property = $('#id_property').val();
				$.ajax({
		            url: '/page_search.php?EX=ajaxSendVisitRequest',
		            type: 'GET',
		            data : valeurs+'&id_property='+id_property,
		            dataType: 'json',
		            success: function(json) {
						if(json == 'false')
							alert('Erreur : Veuillez renseigner tous les champs.');
						else
						{
							$('#buttonVisit').attr('href', '');
							$('#buttonVisit').addClass('cancel_request');
							$('#buttonVisit').text('Cancel Request')
							$('#modalVisitRequest').modal('hide');
						}

					}
				});
			});

			$('.cancel_request').on('click', function(e)
			{
				e.preventDefault();
				var id_property = $('#id_property').val();
				$.ajax({
		            url: '/page_search.php?EX=ajaxCancelVisitRequest',
		            type: 'GET',
		            data : 'id_property='+id_property,
		            dataType: 'json',
		            success: function(json) {
						if(json == 'false')
							alert('Error');
						else
						{
							$('#buttonVisit').attr('href', '#modalVisitRequest');
							$('#buttonVisit').removeClass('cancel_request');
							$('#buttonVisit').text('Visit available')
						}

					}
				});
			});

			$('#button_like').on('click', function(e)
			{
				e.preventDefault();
				var id_property = $('#id_property').val();
				$.ajax({
		            url: '/page_search.php?EX=ajaxLikeProperty',
		            type: 'GET',
		            data : 'id_property='+id_property,
		            dataType: 'json',
		            success: function(json) {
						if(json == 'false')
							alert('Error');
						else
						{
							$('#button_dislike').parent().removeClass('hide');
							$('#button_like').parent().addClass('hide');
						}

					}
				});
			});

			$('#button_dislike').on('click', function(e)
			{
				e.preventDefault();
				var id_property = $('#id_property').val();
				$.ajax({
		            url: '/page_search.php?EX=ajaxDislikeProperty',
		            type: 'GET',
		            data : 'id_property='+id_property,
		            dataType: 'json',
		            success: function(json) {
						if(json == 'false')
							alert('Error');
						else
						{
							$('#button_dislike').parent().addClass('hide');
							$('#button_like').parent().removeClass('hide');
						}

					}
				});
			});
	});


})(jQuery);

