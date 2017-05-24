<?php

get_header();

/* Sýna lista yfir matseðla */

$args = array(
	'post_type' => 'page',
	'post_parent' => $post->ID,
	'posts_per_page' => -1
	);

$menus = new WP_Query($args);

if ($menus->have_posts()){
	while($menus->have_posts()) : $menus->the_post();
		echo "<a href=" . get_permalink() . "><img src=" . get_the_post_thumbnail_url() . "/></a>";
	endwhile;
}

//$matsedlar = get_pages($args);

//wp_list_pages($args);

/*foreach ($menu => $value) {
	# code...
}*/

/*foreach ($matsedlar as $tegund) {
	echo wp_list_pages($matsedlar);
}*/


/*$links = array(
    'localhost/valkostur1/wordpress/matsedlar/heimabod/' => 'http://localhost/valkostur1/wordpress/wp-content/uploads/2017/01/c700x420-1.jpg',
    'localhost/valkostur1/wordpress/matsedlar/sushi-veisla/' => 'http://localhost/valkostur1/wordpress/wp-content/uploads/2017/01/sushi-prufa-2.jpg'
);

foreach($links as $link => $image) {
    echo "<a href='http://{$link}'><img src='{$image}' class='matsedlarImages'></img></a><br />";   
} */


?>

<?php
get_footer();
?>