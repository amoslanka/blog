jQuery(document).ready(function() {
	jQuery("#term-list-inner a").click(function(event) {
		event.preventDefault();
		
		addTag(this.innerHTML, "renametag_old");
		addTag(this.innerHTML, "deletetag_name");
		addTag(this.innerHTML, "addtag_match");
		addTag(this.innerHTML, "tagname_match");
		
		return false;
	});
});

// Add tag into input
function addTag( tag, name_element ) {
	var input_element = document.getElementById( name_element );

	if ( input_element.value.length > 0 && !input_element.value.match(/,\s*$/) )
		input_element.value += ", ";

	var comma = new RegExp(tag + ",");
	if ( !input_element.value.match(comma) )
		input_element.value += tag + ", ";

	return true;
}