$(document).ready(function(){
    "use strict";

    $.preload( '#contact-sheet img', {		
        placeholder: root_url+'/images/placeholderM.png',		
		threshold: 2
        //notFound:
	});
});