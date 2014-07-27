function MenuItem( controlElement, dropdownElement ) {
	this.control = controlElement;
	this.dropdown = dropdownElement;
	this.selected = false;
	
	this.dropdown.show = function () {
		this.css("display", "block");
	};

	this.dropdown.hide = function () {
		this.css("display", "none");
	};
}

function Menu() {
	var items = { };

	this.addItem = function ( name, controlElement, dropdownElement ) {
		items[name] = new MenuItem( controlElement, dropdownElement );
	};

	this.fixControlHrefs = function() {
		for (index in items) {
			items[index].control.attr("href", "#");
		}
	}

	this.enable = function() {
		this.fixControlHrefs();
		
		$('html').click(function(event){
			var target = $(event.target);
			console.log(target);
			for (cmp in items) {
				// bug out if you clicked on a dropdown
				if ( !( target.closest(items[cmp].dropdown ).length > 0 ) &&
					  ( target ) ){
					// hide everything anyway
					items[cmp].control.removeClass('active');
					items[cmp].dropdown.hide();
					// wondering if there is a way to find the element on top of the pile our control element is in.
					// .closest should work but its probably more expensive  - not that it matters much - but this method
					// works with our markup
					if (items.hasOwnProperty(cmp) && items[cmp].control[0] == target.context.parentElement) {
						items[cmp].control.addClass('active');
						// show dropdown
						items[cmp].dropdown.show();
					}
				}
			}
		});
	};
}

$(document).ready(function() {
	var menu = new Menu();
	menu.addItem( 'search', $("a#search-button"), $("#search-dropdown") );
	menu.addItem( 'site-map', $("a#sitemap-button"), $("#site-map-dropdown") );
	menu.addItem( 'user', $("a#user-button"), $("#user-dropdown") );
	menu.enable();
});