<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Volos_Voyage
 */

get_header();

if (is_singular('museums')) :
// template part for museums custom post type
elseif (is_singular('destinations')) :
// template part for destinations custom post type
elseif (is_singular('post')) :
	get_template_part('template-parts/single-cpt/content-post');
elseif (is_singular('sightseeing')) :
// template part for sightseeing custom post type
else :
	get_template_part('template-parts/single-cpt/content');
endif;

get_footer();
