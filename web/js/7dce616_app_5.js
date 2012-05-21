/**
 * @fileoverview Compiled template for file
 *
 * 
 */

goog.provide('app.js');

/**
 * @constructor
 * @param {twig.Environment} env
 * @extends {twig.Template}
 */
app.js = function(env) {
    twig.Template.call(this, env);
};
twig.inherits(app.js, twig.Template);

/**
 * @inheritDoc
 */
app.js.prototype.getParent_ = function(context) {
    return false;
};

/**
 * @inheritDoc
 */
app.js.prototype.render_ = function(sb, context, blocks) {
    // line 1
    sb.append("\n\t$(\"a.confirmsuppr\").click(function () {\n\t\t$(\"#confirmsuppr\").show(\"slow\");\n\t});\n\t$(\"a.hidesuppr\").click(function () {\n\t\t$(\"#confirmsuppr\").hide(\"slow\");\n\t});\n\n\n\t$(\"a.hint\").click(function () {\n\t\tmyrel = \"#\"+this.rel;\n\t\t\/\/alert(myrel);\n\t\t$(myrel).toggle();\n\t});\n\n\nfunction updatecalcul() {\n    var solde = $('span#thesolde').val();\n    var montant = $('input#montant.input-small').val();\n    var nombre = $('input#nombre.input-mini').val();\n    var valticket = $('input#valeur.input-mini').val();\n\n    var nbrmin = (montant - solde) \/ valticket;\n    var result = Number(solde) + Number((nombre * valticket)) - Number(montant);\n\n    $('span.hintitem').html(Math.ceil(nbrmin));    \n\n    if (result<0) {\n        $('.reste').show();\n        $('.resteval span').html(Math.abs(result.toFixed(2)) + ' &euro;');\n        $('.avoir').hide();\n    } else {\n        $('.avoir').show();\n        $('.avoirval span').html(result.toFixed(2) + ' &euro;');\n        $('.reste').hide();\n    };\n}\n\n    $('input#montant.input-small').keyup(updatecalcul);\n    $('input#nombre.input-mini').keyup(updatecalcul);\n    $('input#valeur.input-mini').keyup(updatecalcul);\n\n\n\/\/Model Backbone.js sur les Customer\nwindow.Customer = Backbone.Model.extend();\n \nwindow.CustomerCollection = Backbone.Collection.extend({\n    model:Customer,\n    url:\"http:\/\/localhost:8888\/PiggiBox\/web\/app_dev.php\/customer\/search.json\",\n\n    initialize:function(){\n        console.log(\"window.CustomerCollection : initialize\");\n    },\n\n    search : function(letters){\n        console.log(\"window.Collection : search \"+letters);\n        if(letters == \"\") return this;\n \n        var pattern = new RegExp(letters,\"gi\");\n        return _(this.filter(function(data) {\n            return pattern.test(data.get(\"firstname\"));\n        }));\n    }\n});\n\n\/\/Views Backbone.js sur les Customer\nwindow.CustomerListView = Backbone.View.extend({\n    tagName: 'ul',\n\n    events: {\n        \"keyup input\" : \"search\"\n    },\n \n    initialize:function () {\n        console.log(\"window.CustomerListView : initialize\");\n        this.model.bind(\"reset\", this.render, this);\n        var self = this;\n        this.model.bind(\"add\", function (customer) {\n            $(self.el).append(new CustomerListItemView({model:customer}).render().el);\n        });\n    },\n \n    render:function (event) {\n        console.log(\"window.CustomerListView : render\");\n        _.each(this.model.models, function (customer) {\n            $(this.el).append(new CustomerListItemView({model:customer}).render().el);\n        }, this);\n        return this;\n    },\n\n    search: function(e){\n        console.log(\"window.CustomerListView : search\");\n        var letters = $(\"#searchbyname\").val();\n        this.render(this.model.search(letters));\n    },\n\n    renderList : function(customers){\n        console.log(\"window.CustomerListView : renderList\");\n        $(\"#taskList\").html(\"\");\n \n        _.each(customers, function (customer) {\n            $(this.el).append(new CustomerListItemView({model:customer}).render().el);\n        }, this);\n        return this;\n    }\n \n});\n \nwindow.CustomerListItemView = Backbone.View.extend({\n    tagName:\"li\",\n \n    render:function (event) {\n        console.log(\"window.CustomerListItemView : render\");\n        $(this.el).html(this.model.get('firstname'));\n        return this;\n    }\n \n});\n\n\/\/ AppRouter initializiation\nvar AppRouter = Backbone.Router.extend({\n \n    routes:{\n        \"\":\"list\"\n    },\n \n    list:function () {\n        console.log(\"AppRouter: list:function()\");\n        this.customerList = new CustomerCollection();\n        this.CustomerListView = new CustomerListView({model:this.customerList,el:'#searchcontainer'});\n        this.customerList.fetch();\n        $('#searchcontainer').prepend(this.CustomerListView.render().el);\n    }\n});\n \nvar app = new AppRouter();\nBackbone.history.start();");
};

/**
 * @inheritDoc
 */
app.js.prototype.getTemplateName = function() {
    return "app.js";
};

/**
 * Returns whether this template can be used as trait.
 *
 * @return {boolean}
 */
app.js.prototype.isTraitable = function() {
    return true;
};
