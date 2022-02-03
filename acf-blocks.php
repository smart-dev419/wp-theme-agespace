<?php

function register_acf_block_types() {

    // register a testimonial block.
acf_register_block(array(
			'name'				=> 'borderedbox',
			'title'				=> __('Box + Border'),
			'description'		=> __('A custom block.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'grid-view',
    'render_template' => 'blocks/borderedbox.php'
		));

acf_register_block(array(
			'name'				=> 'careblock',
			'title'				=> __('Care Block'),
			'description'		=> __('A custom block.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'align-left',
    'render_template' => 'blocks/careblock.php'
		));

acf_register_block(array(
			'name'				=> 'alertbox',
			'title'				=> __('Alert Box'),
			'description'		=> __('A custom block.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'align-left',
    'render_template' => 'blocks/borderedbox.php'
		));


}



// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}


function my_acf_block_render_callback( $block ) {
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);
	// var_dump($slug,get_theme_file_path("/blocks/{$slug}.php"));
	// include a template part from within the "template-parts/block" folder

	if( file_exists( get_theme_file_path("/blocks/{$slug}.php") ) ) {
		include( get_theme_file_path("/blocks/{$slug}.php") );
	}
}