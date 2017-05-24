<?php
	global $wpdb;
	$data = $wpdb->get_results( "SELECT * FROM veislur" );

// Create different templates for menus
if(is_page('heimabod')) { ?>
	<table id="submenu-table">
		<tr>
			<th class="courses"> Forréttir </th>
			<td class="table-price-head"> Verð </td>
		</tr>
		
		<?php
		create_menu_table('home', 'starter', $data);
		?>
		<tr>
			<th class="courses"> Aðalréttir </th>
			<td class="table-price-head"> Verð </td>
		</tr>

		<?php
		create_menu_table('home', 'main', $data);
		?>

		<tr>
			<th class="courses"> Eftirréttir </th>
			<td class="table-price-head"> Verð </td>
		</tr>

		<?php
		create_menu_table('home', 'dessert', $data);
		?>
	</table>
<?php 
}

if(is_page('sushi-veisla')) { ?>
	<table>
		<tr>
			<th class="courses"> Sushi-bitar </th>
			<td class="table-price-head"> Verð </td>
		</tr>

		<?php
		create_menu_table('sushi', null, $data);
		?>
		
	</table>
<?php	
} 

if(is_page('veisluhladbord')) { ?>
	<table>
		<tr>
			<th class="courses"> Dæmi um veisluhlaðborð </th>
			<td class="table-price-head"> Verð </td>
		</tr>

		<?php
		create_menu_table('buffet', null, $data);
		?>	
	</table>
<?php	
} 

if(is_page('grillparti-i-gardinum')) { ?>
	<table>
		<tr>
			<th class="courses"> Dæmi um grillpartí </th>
			<td class="table-price-head"> Verð </td>
		</tr>

		<?php
		create_menu_table('grill', null, $data);
		?>	
	</table>
<?php	
} 