<?php
/*
Plugin Name: Portfolio Redsuns
Plugin URI: 
Description: Facilite a manutenção de seu portfolio.
Version: 1.0.0
Author: Redsuns Design e Tecnologia Web
Author URI: http://www.redsuns.com.br
License: GPLv2
*/

require_once 'includes/portfolio-utility.php';

/** REGISTRANDO O TIPO DE POST **/
add_action( 'init', 'type_post_portfolio' );

function type_post_portfolio() {
        $labels = array(
                'name' => _x( 'Portfolio', 'post type general name' ),
                'singular_name' => _x( 'Portfolio', 'post type singular name' ),
                'add_new' => _x( 'Adicionar Novo', 'Novo item' ),
                'add_new_item' => __( 'Novo Item' ),
                'edit_item' => __( 'Editar Item' ),
                'new_item' => __( 'Novo Item' ),
                'view_item' => __( 'Ver Item' ),
                'search_items' => __( 'Procurar Itens' ),
                'not_found' => __( 'Nenhum registro encontrado' ),
                'not_found_in_trash' => __( 'Nenhum registro encontrado na lixeira' ),
                'parent_item_colon' => '',
                'menu_name' => 'Portfolio'
        );
        $args = array(
                'labels' => $labels,
                'public' => true,
                'public_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => true,
                'capability_type' => 'post',
                'has_archive' => true,
                'hierarchical' => false,
                'menu_position' => 5,
                'menu_icon' => plugin_dir_url(__FILE__) . '/assets/img/portfolio.png',
                'register_meta_box_cb' => '',
                'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail' )
        );
        register_post_type( 'portfolios', $args );
        flush_rewrite_rules();
}
/** REGISTRANDO O TIPO DE POST **/


/** CONFIGURAÇÕES **/
function manage_portfolio()
{
    require_once 'templates/admin/options.php';
}


add_action('admin_menu', 'my_plugin_menu');
function my_plugin_menu() {
        add_options_page( 'Porftolio', 'Portfolio', 7, __FILE__, 'manage_portfolio');
}
/** CONFIGURAÇÕES **/


/** OBTENDO E REGISTRANDO TAXONOMIAS **/

add_action('init', 'register_taxonomies_portfolio');
/**
 * 
 * @param array $portfolio_taxonomies
 */
function register_taxonomies_portfolio()
{
 
    $taxonomies = get_portfolio_taxonomies();
    if (!empty($taxonomies)) {
        foreach ($taxonomies as $t) {
            register_taxonomy(
                sanitize_title($t['singular_label']), 
                "portfolios", 
                array(
                    "label" => $t['label'],
                    "singular_label" => $t['singular_label'],
                    "rewrite" => $t['rewrite'],
                    "hierarchical" => $t['hierarchical']
                )
            );
        }
    }
    
}
/** OBTENDO E REGISTRANDO TAXONOMIAS **/