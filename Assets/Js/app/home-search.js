(function($) {
	$(function() {
			var nbPage = 1;

			$('#areas').change(function() {
				var valeurs=$('#formSearch').serialize();
			    recherche(valeurs, 1);
			});
			
			$('.checkbox_style').click(function() {

				var valeurs=$('#formSearch').serialize();
			    recherche(valeurs, 1);
			});
			
			$('.qtyplus').click(function() {

				var valeurs=$('#formSearch').serialize();
			    recherche(valeurs, 1);
			});
			
			$('.qtyminus').click(function() {

				var valeurs=$('#formSearch').serialize();
			    recherche(valeurs, 1);
			});
			
			$('.slider-handle').mouseup(function() {
				
				var valeurs=$('#formSearch').serialize();
			    recherche(valeurs, 1);
			});
			
			$('.slider-handle').mouseup(function() {
				var valeurs=$('#formSearch').serialize();
			    recherche(valeurs, 1);
			});
			
			$('#option1').change(function() { //SALE

				var valeurs=$('#formSearch').serialize();
			    recherche(valeurs, 1);
			});
			
			$('#option2').change(function() { //LEASE

				var valeurs=$('#formSearch').serialize();
			    recherche(valeurs, 1);
			});

			function recherche(valeurs, numPage)
			{
				$.ajax({
		            url: '/page_search.php',
		            type: 'GET',
		            data : 'EX=searchAJAX&'+valeurs+'&page='+numPage+'&action=count',
		            dataType: 'json',
		            success: function(json) {

							$('#matching').text(json.nbResults);

					},
					error: function(resultat, statut, erreur){
		            }
		        });
			}


	});
})(jQuery);

