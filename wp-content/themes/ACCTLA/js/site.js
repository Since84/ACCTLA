	(function($){
		function searchTypeSelect(){
			$('select[name="filter_type"]').on("change click", function(){
				var field = $(this).val();
				$('.search-filter').find('.on').removeClass('on');
				$('[name="' + field + '"]').addClass('on');
				console.log('[name="' + field + '"]');
			});
		}
		
		function submitFilterForm(){
			
			$('select[name="area_of_practice"]').on("change click", function(){
				$(this).closest('form').trigger('submit');
			});
			
			$('select[name="membership_level"]').on("change click", function(){
				$(this).closest('form').trigger('submit');
			});
			
			$('select[name="member_location"]').on("change click", function(){
				$(this).closest('form').trigger('submit');
			});
		}
		
		jQuery(document).ready(function($) {
			searchTypeSelect();
			submitFilterForm();
		});
		
	})(jQuery);

