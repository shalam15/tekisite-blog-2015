<?php
if (is_tax('mh-portfolio-type') || is_tax('mh-portfolio-tag')) {
	get_template_part('archive-mh-portfolio');
} else {
	get_template_part('index');
}
?>