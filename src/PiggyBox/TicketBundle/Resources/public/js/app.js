
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
    var solde = $('#payer input#thesolde').val();
    var montant = $('#payer input#montant').val();
    var nombre = $('#payer input#nombre').val();
    var valticket = $('#payer input#valeur').val();

    var nbrmin = (montant - solde) / valticket;
    var result = Number(solde) + Number((nombre * valticket)) - Number(montant);

    $('.nbrminval span').html(Math.ceil(nbrmin));

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

    $('#payer input#montant').keyup(updatecalcul);
    $('#payer input#nombre').keyup(updatecalcul);
    $('#payer input#valticket').keyup(updatecalcul);

