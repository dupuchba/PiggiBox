// Models
window.Customer = Backbone.Model.extend();
 
window.CustomerCollection = Backbone.Collection.extend({
    model:Customer,
    url:"/index"
});
 
// Views
window.CustomerListView = Backbone.View.extend({
 
    tagName:'ul',
 
    initialize:function () {
        this.model.bind("reset", this.render, this);
    },
 
    render:function (eventName) {
        _.each(this.model.models, function (Customer) {
            $(this.el).append(new CustomerListItemView({model:Customer}).render().el);
        }, this);
        return this;
    }
 
});
 
window.CustomerListItemView = Backbone.View.extend({
 
    tagName:"li",
 
    template:_.template($('#tpl-Customer-list-item').html()),
 
    render:function (eventName) {
        $(this.el).html(this.template(this.model.toJSON()));
        return this;
    }
 
});
 
window.CustomerView = Backbone.View.extend({
 
    template:_.template($('#tpl-Customer-details').html()),
 
    render:function (eventName) {
        $(this.el).html(this.template(this.model.toJSON()));
        return this;
    }
 
});
 
// Router
var AppRouter = Backbone.Router.extend({
 
    routes:{
        "":"list",
        "Customers/:id":"CustomerDetails"
    },
 
    list:function () {
        this.CustomerList = new CustomerCollection();
        this.CustomerListView = new CustomerListView({model:this.CustomerList});
        this.CustomerList.fetch();
        $('#sidebar').html(this.CustomerListView.render().el);
    },
 
    CustomerDetails:function (id) {
        this.Customer = this.CustomerList.get(id);
        this.CustomerView = new CustomerView({model:this.Customer});
        $('#content').html(this.CustomerView.render().el);
    }
});
 
var app = new AppRouter();
Backbone.history.start();