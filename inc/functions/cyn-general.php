<?php

/**
 * get category info
 * 
 * @todo change for custom taxonomy
 *
 * @param int $post_id
 * @param string $url_all
 * @param WP_TERM | string | int $taxonomy
 * 
 * 
 * @return array
 */
function cyn_category_info( $post_id, $url_all, $taxonomy ) {
	$current_post_cat_ids = [];
	foreach ( get_the_category( $post_id ) as $cat ) {
		array_push( $current_post_cat_ids, $cat->term_id );
	}

	$categories = get_categories( [ 
		'orderby' => 'id',
		'hide_empty' => false,
		'taxonomy' => $taxonomy
	] );

	$categories_link = [];
	foreach ( $categories as $cat ) {
		array_push( $categories_link, get_category_link( $cat->term_id ) );
	}

	$info_categories = [ 
		[ 
			'name' => 'All',
			'link' => $url_all,
			'in_category_exist' => true
		]
	];

	for ( $i = 0; $i < count( $categories ); $i++ ) {
		array_push(
			$info_categories,
			[ 
				'name' => $categories[ $i ]->name,
				'link' => $categories_link[ $i ],
				'in_category_exist' => in_array( $categories[ $i ]->term_id, $current_post_cat_ids )
			]
		);
	}
	return $info_categories;
}


/**
 * CYN Reading Time
 *
 * @param int $id //post id
 * @return string //reading time + ' Min'
 */
function cyn_reading_time( $id ) {
	$content = get_post_field( 'post_content', $id );
	$word_count = str_word_count( strip_tags( $content ) );
	$reading_time = ceil( $word_count / 50 );
	return $reading_time . ' Min';
}

/**
 * Convert To Snake Case
 * @param string $inputString
 * @return string
 */
function cyn_convert_to_snake( $inputString ) {

	$snakeCaseString = preg_replace( '/[^A-Za-z0-9]+/', '_', $inputString );
	$snakeCaseString = strtolower( $snakeCaseString );
	$snakeCaseString = trim( $snakeCaseString, '_' );
	return $snakeCaseString;
}

/**
 * Summary of get_page_url_by_template
 * @param mixed string template name
 * @return string
 */
function get_page_url_by_template( $TEMPLATE_NAME ) {
	$pages = query_posts( [ 
		'post_type' => 'page',
		'meta_key' => '_wp_page_template',
		'meta_value' => $TEMPLATE_NAME
	] );
	$url = '';
	if ( isset( $pages[0] ) ) {
		$array = (array) $pages[0];
		$url = get_page_link( $array['ID'] );
	}

	return $url;
}
