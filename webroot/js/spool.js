
/*
	by: Marco Antônio Queiroz
	IFG - Campus Cidade de Goias
*/


/**
 * Navigation
 *
 * @return void
 */

navigationSpool = function(){

	// Botão mostrar All
	var allSpool = $("#allSpool");

	var activeSpools = function(e){
		
		var v = $("tbody td[data-th='Status']");

		if (e == "Ativos") {
			allSpool.html("Ativos");
			v.each(function(e){
				$(this).parent().show();
			})
			
		} else {
			allSpool.html("All");
			v.each(function(e){
				var valor = $(this).attr("value");
				if (valor == 0) {
					$(this).parent().hide();
				};		
			})
		};
	}
	

	allSpool.click(function(){
		if (allSpool.html() == "All") {
			activeSpools("Ativos");
		} else {
			activeSpools("All");
		};
	})
	activeSpools("All");

}

spoolsActive = function(){
	var obj = $("#spoolsActive");
	var url = $("#UrlSpools")[0];
	//alert(url);

	$.ajax({
	    url: url,
	    type: "GET",
	    contentType:false,
	    processData: false,
	    cache: false,
	    success: function(data){
	        // alert(data);
	        obj.html(data);
	    }
	});
}


$(document).ready(function(){
	navigationSpool();

	spoolsActive();
	setInterval(spoolsActive, 10000);
});
