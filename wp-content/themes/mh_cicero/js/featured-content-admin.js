/* MH Cicero Featured Content Tag Suggestion - Based on the original code of Twenty Fourteen - licensed GPLv2 - http://wordpress.org/themes/twentyfourteen */

jQuery(document).ready(function($) {
	$('#customize-control-featured-content-tag-name input').suggest(ajaxurl + '?action=ajax-tag-search&tax=post_tag', { delay: 500, minchars: 2 });
});