jQuery(function($) {
	$('.gd-dashboard .gd-collapse').on('click',function(e){
		var $parent = $(this).closest('.panel');
		if ($('.panel-body.gd-collapsable', $parent).is(':visible')) {
			$('.panel-body.gd-collapsable', $parent).slideUp(200, function(){
				$('.panel-footer.gd-collapsable', $parent).hide();
			});
			$(this).find('.fa-caret-up').addClass('fa-caret-down').removeClass('fa-caret-up');
		} else {
			$('.panel-body.gd-collapsable', $parent).slideDown(200, function(){
				$('.panel-footer.gd-collapsable', $parent).show();
			});
			$(this).find('.fa-caret-down', $parent).addClass('fa-caret-up').removeClass('fa-caret-down');
		}
	});
});