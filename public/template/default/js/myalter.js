$(function(){
	$('.inventory').show();
	$('.secondary-menu > ul > li > a').on('click',function(){
		var $this = $(this),
		submenuData = $this.attr('data-myalter'),
		submenuDiv = $('.my-alter-container > div');
		submenuDiv.hide();
		$('.'+submenuData).show();

	})
})