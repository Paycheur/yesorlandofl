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
			
			$('.checkbox_style').click(function() {
				$('#formSearch').submit();
				//Gestion de la soumission du formulaire

			});
			
			$('.qtyplus').click(function() {
				$('#formSearch').submit();
				//Gestion de la soumission du formulaire

			});
			
			$('.qtyminus').click(function() {
				$('#formSearch').submit();
				//Gestion de la soumission du formulaire

			});
			
			$('.slider-handle').mouseup(function() {
				$('#formSearch').submit();
				//Gestion de la soumission du formulaire

			});
			
			$('.slider-handle').mouseup(function() {
				$('#formSearch').submit();
				//Gestion de la soumission du formulaire

			});
			
			$('#option1').change(function() { //SALE
				$('#formSearch').submit();
				//Gestion de la soumission du formulaire

			});
			
			$('#option2').change(function() { //LEASE
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
				window.history.pushState(document.title,document.title, 'http://'+document.location.hostname+'/search?'+valeurs+'&page='+numPage);
				$.ajax({
		            url: '/page_search.php',
		            type: 'GET',
		            data : 'EX=searchAJAX&'+valeurs+'&page='+numPage,
		            dataType: 'json',
		            success: function(json) {

						var address = 'No Address';
						var sqft = '';
						var price = 'No Price';
						var bed = '';
						var bathroom = '';
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
								price = '$ '+v.price.replace('.00', '');
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
								'<article class="bg-cover" style="background-image:url('+img+');"   >'+
									'<div class="search-property"  >'+
										'<div class="padding-r-l-2em search-property-content txt-center">'+
											'<hgroup class="txt-center">'+
												'<h3 class="search-property-title h4 lh-100 margin-zero">'+address+'</h3>'+
												'<h4 class="lh-100 h3 white">'+price+'</h4>'+
											'</hgroup>'+
											'<a href="/property/'+v.url+'/'+encodeURIComponent(id)+'" class="btn btn-warning">View details</a>'+
											'<ul class="list-inline padding-3em details">';
												if(bed != '')
													html += '<li class="text-left"><strong class="display-block number">'+bed+'</strong> BEDS';
												if(bathroom != '')
													html += '<li class="text-left"><strong class="display-block number">'+bathroom+'</strong> BATHS';
												if(sqft != '' && sqft != '0')
													html+='<li class="text-left"><strong class="display-block number">'+sqft+'</strong>  SQFT';
											html+='</ul>'+
										'</div>'+
									'</div>'+
								'</article>'+
							'</div>';
						});

						$('#searchResult').html(html);
						nbPage = Math.ceil(json.nbResults / 6);
						
						if(numPage == 1)
						{
							
							
							$('#matching').text(json.nbResults);
							
							$('.liste_page').empty();
							if(nbPage > 1)
							{
								
								if(nbPage > 5)
								{
									$('.liste_page').append($('<li />').append($('<a />').attr('class','page first').attr('href','/search?'+valeurs+'&page=1').html('&laquo;')));
									$('.liste_page').append($('<li />').attr('class','active').append($('<a />').attr('class','page').attr('href','/search?'+valeurs+'&page=1').text(1)));

									for(i = 2; i < 6; ++i)
									{
											$('.liste_page').append($('<li />').append($('<a />').attr('class','page').attr('href','/search?'+valeurs+'&page='+i).text(i)));
									}
								}
								else
								{
									$('.liste_page').append($('<li />').append($('<a />').attr('class','page').attr('href','/search?'+valeurs+'&page=1').html('&laquo;')));
									$('.liste_page').append($('<li />').attr('class','active').append($('<a />').attr('class','page').attr('href','/search?'+valeurs+'&page=1').text(1)));

									for(i = 2; i != nbPage + 1; ++i)
									{
											$('.liste_page').append($('<li />').append($('<a />').attr('class','page').attr('href','/search?'+valeurs+'&page='+i).text(i)));
									}
								}
								$('.liste_page').append($('<li />').append($('<a />').attr('class','page last').attr('href','/search?'+valeurs+'&page='+nbPage).html('&raquo;')));
							}
							
							firstRequete = false;
						}
						else
						{

							if(nbPage > 1)
							{
								if(numPage == nbPage || numPage == 1)
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
									$('.liste_page').append($('<li />').append($('<a />').attr('class','page first').attr('href','/search?'+valeurs+'&page=1').html('&laquo;')));
	
									for(; i <= limit; ++i)
									{
										if(i == nbPage + 1) break;
	
										if(i == numPage)
											$('.liste_page').append($('<li />').attr('class','active').append($('<a />').attr('class','page').attr('href','/search?'+valeurs+'&page='+i).text(i)));
										else
											$('.liste_page').append($('<li />').append($('<a />').attr('class','page').attr('href','/search?'+valeurs+'&page='+i).text(i)));
									}
									$('.liste_page').append($('<li />').append($('<a />').attr('class','page last').attr('href','/search?'+valeurs+'&page='+nbPage).html('&raquo;')));
									lastNum = i - 1;
									firstNum = i - 5;
								}
								else
								{
									$('.liste_page').empty();
									$('.liste_page').append($('<li />').append($('<a />').attr('class','page first').attr('href','/search?'+valeurs+'&page=1').html('&laquo;')));
	
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
											$('.liste_page').append($('<li />').attr('class','active').append($('<a />').attr('class','page').attr('href','/search?'+valeurs+'&page='+i).text(i)));
										else
											$('.liste_page').append($('<li />').append($('<a />').attr('class','page').attr('href','/search?'+valeurs+'&page='+i).text(i)));
									}
									$('.liste_page').append($('<li />').append($('<a />').attr('class','page last').attr('href','/search?'+valeurs+'&page='+nbPage).html('&raquo;')));
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

				//mettre a jours lastNum et firstNum en fonction des num affichés en bas
				
				var valeurs=$('#formSearch').serialize();
				recherche(valeurs, numPage);
				
				 $(window).scrollTop(0);
				
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
			function initializeMap() 
			{
					
				if($('#coord_gps').length > 0)
				{
					var coord_property = $('#coord_gps').val();
					var address_property = $('#address_property').val();
					var img_property = $('.img_property').attr('src');
					
					var split_coord = coord_property.split(';');
					var point_center = new google.maps.LatLng(split_coord[0], split_coord[1]);
					var myOptions = {
						zoom: 15,
						center: point_center,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};
					var map = new google.maps.Map(document.getElementById("googleMap"), myOptions);
					
					var marker = new google.maps.Marker({
				        position: point_center,
				        map: map
				    });
					
					var infowindow = new google.maps.InfoWindow({
						content: '<img src="'+img_property+'" alt="" style="float:left;height:40px;margin:5px;border:1px solid #999999" /><b>'+address_property+'</b>',
						maxWidth: 200

					});
					
					google.maps.event.addListener(marker, 'load', function() {
					    infowindow.open(map,marker);
					  });

					infowindow.open(map,marker);
					$('.list-area').on('click', function(e)
					{
						e.preventDefault();
						var latlong = $(this).find('input').val();
						var nom_area = $(this).find('span').text();
						var split_latlong = latlong.split(';');
						var point_center_2 = new google.maps.LatLng(split_latlong[0], split_latlong[1]);
						 myOptions = {
							zoom: 14,
							center: point_center_2,
							mapTypeId: google.maps.MapTypeId.ROADMAP,
							
						};
						map = new google.maps.Map(document.getElementById("googleMap"), myOptions);
						
						var marker = new google.maps.Marker({
					        position: point_center,
					        map: map
					    });
						
						var marker_2 = new google.maps.Marker({
					        position: point_center_2,
					        map: map
					    });
						
						var infowindow_2 = new google.maps.InfoWindow({
							content: '<b>'+nom_area+'</b>',
							maxWidth: 200

						});
						
						var infowindow = new google.maps.InfoWindow({
							content: '<img src="'+img_property+'" alt="" style="float:left;height:40px;margin:5px;border:1px solid #999999" /><b>'+address_property+'</b>',
							maxWidth: 200
							

						});
						
						google.maps.event.addListener(marker, 'click', function() {
						    infowindow.open(map,marker);
						  });
						
						google.maps.event.addListener(marker_2, 'click', function() {
						    infowindow_2.open(map,marker_2);
						  });
						
						infowindow.open(map,marker);
						window.location.hash = '#googleMap';
					});
				}
			}
			if($('#coord_gps').length > 0)
				google.maps.event.addDomListener(window, 'load', initializeMap);
			
	});


})(jQuery);

