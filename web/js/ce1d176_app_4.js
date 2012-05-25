$(function() {

//NOTE: Customer:edit.html.twig permet de montrer le message de suppression        
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

//NOTE: fichier operation.html.twig fonction de calcul instantané pour le prix ficher
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

//NOTE: operation.html.twig => fonction ajax qui ecoute le formulaire pour faire une requete post pour la valeur
//TODO: faire un append sur lhistorique
$('#resetbalanceform').submit(function(){
    $.ajax({    
        url: Routing.generate('customer_setbalance', { id: $('input#reset-id').val(), "balance": 0 }),
        type:"POST",
        success: function() {
            alert("It has been a fucking success");
        }
    });
    return false;
});

//NOTE: operation.html.twig => fonction permettant de setter la valeur de balance lors du paiement
//TODO: trouver un moyen pour savoir si c'est un avoir ou un credit (aller chercher du coté nom)
$('#setbalanceform').submit(function(){
    $.ajax({    
        url: Routing.generate('customer_setbalance', { id: $('input#set-id').val(), "balance": 0 }),
        type:"POST",
        success: function() {
            alert("It has been a fucking success");
        }
    });
    return false;
});

$('#modifybalanceform').submit(function(){
    $.ajax({    
        url: Routing.generate('customer_setbalance', { id: $('input#modify-id').val(), "balance": $('input#newsolde.input-small').val() }),
        type:"POST",
        success: function() {
			$('span#thesolde').html($('input#newsolde.input-small').val());
        }
    });
    return false;
});

$('#addbalanceform').submit(function(){
var ticketValue = $('input#add-ticket-value').val();
var ticketNumber = $('input#add-ticket-number').val();

console.log("ticket value" + ticketValue + " ticket number " + ticketNumver);

var newbalance = addcredit + Number($('span#thesolde').val());
console.log("balance " + newbalance);
    $.ajax({    
        url: Routing.generate('customer_setbalance', { id: $('input#add-id').val(), "balance": Math.ceil(newbalance) }),
        type:"POST",
        success: function() {
			$('span#thesolde').html(newbalance);
        }
    });
    return false;
});

$('#customersearch_keyword').typeahead({
    property: "firstname",
    source: function(typehead, query){
        $.ajax({
            url: Routing.generate('customer_search' , { "_format": "json"}),
            type:"POST",
            data: 'keyword='+query,
            async: false,
            success: function(data){
                typehead.process(data);
            }   
        });
    },
    onselect: function(obj) { console.log(obj) }
});

//NOTE: index.html.twig permet de faire un focus sur le champ de recherche
$('#customersearch_keyword').focus();

//NOTE: new.html.twig permet de faire un focus sur le champ de nom
$('input#accounts_customer_lastname').focus();

});


