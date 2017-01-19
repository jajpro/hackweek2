$(document).ready(function() {


	//$('#widthResult').html("huih");
    $("#dot_main").click(function(){
   		
   		var wid = $(this).width()+0.5;
   		var hei = $(this).height()+0.5;

   		//var marginLeft = $(this).left()-5;
   		/*
   		if( wid > 140 ) {

			//marginLeft = $(this).css("margin-left")+;
			wid = $(this).width()+0.3;
   		}
		*/
   		$(this).css("width",wid);
   		$(this).css("height",hei);

   		/*
   		if(marginLeft < 150) {
   			$(this).css("margin-left",marginLeft);
   		} else {
   			marginLeft -= 10;
   			$(this).css("margin-left",marginLeft);
   		}
   		*/
   		//$(this).css("margin-left",marginLeft);



   		$('#widthResult').html('' + $(this).width() + 'mm');
    });

    //$('#dot_main').draggable();

});