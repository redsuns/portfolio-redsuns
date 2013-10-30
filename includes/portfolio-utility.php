<?php

function get_portfolio_taxonomies()
{
    return get_option('portfolio_conf');
}


function set_portfolio_taxonomies( $data = array() )
{
    global $wpdb, $table_prefix;
    $taxonomies_arr = array();
    $setted = false;
    
    $taxonomies = get_portfolio_taxonomies();
    
    if ( !empty($taxonomies) ) {
        
        $total = count($taxonomies);
        for($cont = 0; $cont < $total; $cont++) {
            if ( sanitize_title($taxonomies[$cont]['singular_label']) == sanitize_title($data['singular_title'])) {
                unset($taxonomies[$cont]);
            }
        }
        
        array_values($taxonomies);
        $taxonomies_arr = $taxonomies;
        array_push($taxonomies_arr, $data);
        
    } else {
        $taxonomies_arr[] = $data;
    }
    
    if ( update_option('portfolio_conf', $taxonomies_arr) ) {
        $setted =  true;
    }
    
    return $setted;
}


/**
 * 
 * @param string $taxonomy
 * @return boolean
 */
function remove_portfolio_taxonomy( $taxonomy )
{
    $tax = get_portfolio_taxonomies();
    foreach($tax as $t) {
        $taxonomies[] = $t;
    }
    
    if ( !empty($taxonomies) ) {
        
        $total = count($taxonomies);
        for($cont = 0; $cont < $total; $cont++) {

            if ( sanitize_title($taxonomies[$cont]['singular_label']) == sanitize_title($taxonomy)) {
                unset($taxonomies[$cont]);
            }
            
        }
        
        array_values($taxonomies);
    }
    
    return update_option('portfolio_conf', $taxonomies);
}