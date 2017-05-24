var device_width = 0;
var device_height = 0;

function reinit()
{
    $.Metro.initDropdowns('header');
    $.Metro.initPulls('header');
}

$(function(){
    $("[data-load]").each(function(){
        $(this).load($(this).data("load"), function(){
            reinit();
        });
    });

    window.prettyPrint && prettyPrint();

    $(".history-back").on("click", function(e){
        e.preventDefault();
        history.back();
        return false;
    })
})


function headerPosition(){
    if ($(window).scrollTop() > $('header').height()) {
        $("header .navigation-bar")
            .addClass("fixed-top")
            .addClass(" shadow")
        ;
    } else {
        $("header .navigation-bar")
            .removeClass("fixed-top")
            .removeClass(" shadow")
        ;
    }
}

$(function() {
    if ($('nav > .side-menu').length > 0) {
        var side_menu = $('nav > .side-menu');
        var fixblock_pos = side_menu.position().top;
        $(window).scroll(function(){
            if ($(window).scrollTop() > fixblock_pos){
                side_menu.css({'position': 'fixed', 'top':'65px', 'z-index':'1000'});
            } else {
                side_menu.css({'position': 'static'});
            }
        })
    }
});

$(function(){
    setTimeout(function(){headerPosition();}, 100);
})

$(window).scroll(function(){
    headerPosition();
});

$(document).ready(function(){    
	var TriggerClick = 0;
	$('#fluid-button').click(function(){ 
		if(TriggerClick==0){
			TriggerClick=1;
			$( ".fluid-sides" ).animate({width: "+=16%"}, 200);
			$( "#fluid-button" ).animate({left: "+=16%"}, 200);
		}
		else{
			TriggerClick=0;
			$( ".fluid-sides" ).animate({width: "0px"}, 200);
			$( "#fluid-button" ).animate({left: "0"}, 200);
		}
	}); 
}); //window

function getDetail(mode){
	if(mode=='hide'){$( "#detail" ).animate({width: "0%"}, 200);}
	else{$( "#detail" ).animate({width: "78.5%"}, 200);}
}

function loadAsetMenu(){
	$( "#pencarian" ).animate({width: "0px"}, 200);
	$( "#tematik" ).css("margin", "0px");
	$( "#tematik" ).animate({width: "22%",margin: "0px"}, 200);
}

function loadSearchMenu(){
	$( "#tematik" ).animate({width: "0px",margin:"0 -10px 0 0"}, 200);
	$( "#pencarian" ).animate({width: "22%"}, 200);
}

/*
function getDeviceSize(){
    device_width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    //device_height = (window.innerHeight > 0) ? window.innerHeight : screen.height;
    $("#device_width").html(device_width);
    //$("#device_height").html(device_height);
}

$(function(){
    $("<div/>").addClass("padding20 bg-dark fg-white border bd-white no-display").css({
        position: "fixed",
        top: 0,
        right: 0
    }).html('<span id="device_width">0</span>').appendTo("body");
    getDeviceSize();
})

$(window).resize(function(){
    getDeviceSize();
})
*/
