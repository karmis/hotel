$(document).ready(function(){
	"use strict";
	/* Responsive menu*/
	if($("#mp-menu").length > 0)
	new mlPushMenu(document.getElementById( 'mp-menu' ), document.getElementById( 'sys_btn_toogle_menu' ),{dockSide: "right"} ); 

	// Heading large	
	var doMargintop = -$(".decription-override").outerHeight()/2;
	$(".decription-override").css("margin-top",doMargintop);
	
	//=============== IF IE 8 ===================
	var rex = new RegExp("MSIE 8.0");
	var trueIE = rex.test(navigator.userAgent);
	
	if(trueIE) {
		jQuery('#mp-menu').hide();
		// jQuery('.md-slide').find('LI').children('IMG').css({
		// 	top: '0px',
		// 	left: '0px'
		// });
		jQuery('.content-slide .home-content').css({
			left: '24%',
			top: '25%'
		});
	}

});