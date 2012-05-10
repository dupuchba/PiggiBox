
	$("a.confirmsuppr").click(function () {
		$("#confirmsuppr").show("slow");
	});
	$("a.hidesuppr").click(function () {
		$("#confirmsuppr").hide("slow");
	});


	$("a.hint").click(function () {
		myrel = "#"+this.rel;
		//alert(myrel);
		$(myrel).toggle();
	});


function updatecalcul() {
    var solde = $('span#thesolde').val();
    var montant = $('input#montant.input-small').val();
    var nombre = $('input#nombre.input-mini').val();
    var valticket = $('input#valeur.input-mini').val();

    var nbrmin = (montant - solde) / valticket;
    var result = Number(solde) + Number((nombre * valticket)) - Number(montant);

    $('span.hintitem').html(Math.ceil(nbrmin));    

    if (result<0) {
        $('.reste').show();
        $('.resteval span').html(Math.abs(result.toFixed(2)) + ' &euro;');
        $('.avoir').hide();
    } else {
        $('.avoir').show();
        $('.avoirval span').html(result.toFixed(2) + ' &euro;');
        $('.reste').hide();
    };
}

    $('input#montant.input-small').keyup(updatecalcul);
    $('input#nombre.input-mini').keyup(updatecalcul);
    $('input#valeur.input-mini').keyup(updatecalcul);
