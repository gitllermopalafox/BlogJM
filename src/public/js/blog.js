$(document).on('ready', function(){
	$('.action-panel').on('click', function(){
		if ($(this).find('span').hasClass('to-show'))
		{
			$(this).find('span').removeClass('to-show').addClass('to-hide')
		}else{
			$(this).find('span').removeClass('to-hide').addClass('to-show')
		}
	})
})
