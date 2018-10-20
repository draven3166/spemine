$(document).ready(function(){
	
	$('.accordion').accordion({
		heightStyle: "content"
	});

	$( "#go-account" ).click(function() {
	 	$(location).attr('href', '/account.php');
	});

    $( "#go-withdraw" ).click(function() {
        $(location).attr('href', '/withdraw.php');
    });;

    $( "#go-withdrawAff" ).click(function() {
        $(location).attr('href', '/withdraw_affiliate.php');
    });

	$('.upgrade').fancybox({
		toolbar  : false,
		iframe : {
			preload : false,
			css : {
				height : '460px'
			}
		}
	});
	
	$('.premium').click(function() {
		$('html, body').animate({scrollTop: 0}, 1000);
	});
	
	$('#btn-upgrade').click(function() {
		$('html, body').animate({scrollTop: $("#footer").offset().top }, 1000);
	});
	
});