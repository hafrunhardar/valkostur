<?php

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

<?php
if (is_user_logged_in()) { ?>
	<h3>Leiðbeiningar</h3>
	<p>Til þess að bæta við réttum á matseðil er fyllt út í gluggana hér að neðan og ýtt að "Bæta við".<p>
	<p>Til þess að eyða rétti úr matseðli þarf að velja matseðil hér að neðan og ýta á "Eyða" hjá viðkomandi rétti. 
	<form action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>" method="POST" id="add_data_form" class="col-12">
		<table id="add-data-table"> 
			<tr>
				<td> Veldu flokk:
				<td> Veldu undirflokk (ef við á):
			<tr>
				<td>	
				<select name="type" required>
					<option></option>
					<option value="grill">Grillpartí</option>
					<option value="home">Heimaboð</option>
					<option value="buffet">Veisluhlaðborð</option>
					<option value="sushi">Sushi-veisla</option>
				</select> 
				<td>
				<select name="subtype">
					<option></option>
					<option value="starter">Forréttur</option>
					<option value="main">Aðalréttur</option>
					<option value="dessert">Eftirréttur</option>
				</select>
			<tr>
				<td> Nafn:
				<td> Verð:
			<tr>
				<td> <input type="text" name="course_name" class="col-3" required>
				<td> <input type="number" name="price" class="col-3" required>
			<tr>
				<td> Lýsing:
			<tr> 
				<td colspan="2"><textarea name="description"></textarea> 
			<tr>
				<td> <input type="submit" name="submit" value="Bæta við!">
		</table>
	</form>

<?php	
	//if submit button is pressed, add data
	$submit = $_POST;
	if($submit) {
		add_data($_POST['type'], $_POST['subtype'], $_POST['course_name'], $_POST['description'], $_POST['price']);
	}
} 

// Display menus in a table
$args = array(
	'post_type' => 'page',
	'post_parent' => $post->ID,
	'posts_per_page' => -1
	);

$menus = new WP_Query($args); ?>
<?php if ($menus->have_posts()){ ?>
	<table id="menu-table"> 
		<?php
		while($menus->have_posts()) : $menus->the_post(); ?>
			<tr class="menu-page matsedlar-container">
				<td class="menu-img-container">
					<?php
					echo "<a href=" . get_permalink() . "><img class='matsedlar-img' src=" . get_the_post_thumbnail() . "</a>"; ?>
					<div class="middle-menu-img">
						<div class="menu-img-hovertext"><?php the_title(); ?></div>
					</div>
				</td>
				<td class="entry-wrap">
					<h1 class="entry-title">
					<?php echo "<a href=" . get_permalink() . ">" ?>
							<?php the_title(); ?></h1> 
		            <div class="entry-content">
		                <?php the_excerpt(); ?> 
		        	</div>
	            </td>
		     </tr> <!-- Page-row-->
		<?php endwhile; // End of loop ?>
	</table>
<?php
} 

get_footer();
?>