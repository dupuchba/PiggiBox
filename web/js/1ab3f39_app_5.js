
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


//Model Backbone.js sur les Customer
window.Customer = Backbone.Model.extend();
 
window.CustomerCollection = Backbone.Collection.extend({
    model:Customer,
    url:"http://localhost:8888/PiggiBox/web/app_dev.php/customer/search.json",

    initialize:function(){
        console.log("window.CustomerCollection : initialize");
    }
});

//Views Backbone.js sur les Customer
window.CustomerListView = Backbone.View.extend({
 
    tagName:'ul',
 
    initialize:function () {
        this.model.bind("reset", this.render, this);
        var self = this;
        this.model.bind("add", function (customer) {
            $(self.el).append(new CustomerListItemView({model:customer}).render().el);
        });
    },
 
    render:function (event) {
        console.log("window.CustomerListView render");
        _.each(this.model.models, function (customer) {
            $(this.el).append(new CustomerListItemView({model:customer}).render().el);
        }, this);
        return this;
    }
 
});
 
window.CustomerListItemView = Backbone.View.extend({
    tagName:"li",
 
    render:function (event) {
        $(this.el).html(this.model.toJSON());
        return this;
    }
 
});

// AppRouter initializiation
var AppRouter = Backbone.Router.extend({
 
    routes:{
        "":"list"
    },
 
    list:function () {
        console.log("AppRouter: list:function()");
        this.customerList = new CustomerCollection();
        this.CustomerListView = new CustomerListView({model:this.customerList});
        this.customerList.fetch();
        $('#searchform').html(this.CustomerListView.render().el);
    }
});
 
var app = new AppRouter();
Backbone.history.start();