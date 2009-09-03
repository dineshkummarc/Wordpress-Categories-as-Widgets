<?php
/*
Plugin Name: Categories as Widgets
Plugin URI: http://no.whe.re/
Description: Display each top-level category as a widget with its sub categories
Author: Florian Cargoët
Version: 0.1
Author URI: http://fcargoet.evolix.net/
*/

function cat_as_widget($args){
    extract($args);

    echo $before_widget;
    echo $before_title . $category->name . $after_title;

    $cat_args = array('child_of'=>$category->cat_ID,'hierarchical' => false,'title_li'=>'');

    echo '<ul>';
    wp_list_categories(apply_filters('widget_categories_args', $cat_args));
    echo '</ul>';

    echo $after_widget;
}



function widget_CategoriesAsWidgets($args) {

    $categories = get_categories();
    
    foreach($categories as $category){
        if($category->parent==0){ //only toplevel cats
            $args['category']=$category;
            cat_as_widget($args);
        }
    }
}

function categoriesAsWidgets_init()
{
    register_sidebar_widget(__('Categories As Widgets'), 'widget_CategoriesAsWidgets');
}

add_action("plugins_loaded", "categoriesAsWidgets_init");
?>
