<?php
/* Delete specified record of string */
function youpzt_delete_string_specific_value($separator,$string,$value){
    $arr = explode($separator,$string);
    $key =array_search($value,$arr);
    array_splice($arr,$key,1);
    $str_new = implode($separator,$arr);
    return $str_new;
}
/* Load create template */
function youpzt_store_load_template($template_path){
    if (is_page('my-account')) {
        return $template_path = UPSTORE_PLUGIN_DIR.'/templates/my-account.php';
    }elseif (is_page('shop')) {
        return $template_path = UPSTORE_PLUGIN_DIR.'/templates/shop.php';
    }elseif (is_single()&&get_post_type()=='product') {
        return $template_path = UPSTORE_PLUGIN_DIR.'/templates/single-product.php';
    }else{
        return $template_path;  
    }
}
add_filter( 'template_include', 'youpzt_store_load_template', 1 );

/**
 * 获取模板的一部分 (如：商品循环)
 *
 * @access public
 * @param mixed $slug
 * @param string $name (default: '')
 */
function youpztStore_get_template_part( $slug, $name = '' ) {
    $template = '';
    // 先检索主题中是否有这个文件
    if ( $name) {
        //检索模板
        $template = locate_template( array( "{$slug}-{$name}.php",UPSTORE_TEMPLATE_DIR. "/{$slug}-{$name}.php" ) );
    }

    // Get default slug-name.php
    if ( ! $template && $name && file_exists( UPSTORE_PLUGIN_DIR. "/templates/{$slug}-{$name}.php" ) ) {
        $template =UPSTORE_PLUGIN_DIR."/templates/{$slug}-{$name}.php";
    }
    //如果模板文件仍然不存在，检索你的主题中的slug.php文件
    if ( ! $template) {
        $template = locate_template( array( "{$slug}.php", UPSTORE_TEMPLATE_DIR. "/{$slug}.php" ) );
    }

    // Allow 3rd party plugins to filter template file from their plugin.
    //$template = apply_filters( 'youpzt_store_get_template_part', $template, $slug, $name );

    if ( $template ) {
        load_template( $template, false );
    }
}

/**
 * Get other templates (e.g. product attributes) passing attributes and including the file.
 *
 * @access public
 * @param string $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 */
function youpztStore_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
    if ( $args && is_array( $args ) ) {
        extract( $args );
    }

    $located = youpztStore_locate_template( $template_name, $template_path, $default_path );

    if ( ! file_exists( $located ) ) {
        //_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '2.1' );
        return;
    }

    // Allow 3rd party plugin filter template file from their plugin.
    $located = apply_filters('youpztStore_get_template', $located, $template_name, $args, $template_path, $default_path );

    include( $located );

}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *      yourtheme       /   $template_path  /   $template_name
 *      yourtheme       /   $template_name
 *      $default_path   /   $template_name
 *
 * @access public
 * @param string $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */
function youpztStore_locate_template( $template_name, $template_path = '', $default_path = '' ) {
    if ( ! $template_path ) {
        $template_path =UPSTORE_TEMPLATE_DIR;
    }

    if ( ! $default_path ) {
        $default_path =UPSTORE_PLUGIN_DIR.'/templates/';
    }

    // Look within passed path within the theme - this is priority.
    $template = locate_template(
        array(
            trailingslashit( $template_path ) . $template_name,
            $template_name
        )
    );

    // Get default template/
    if ( ! $template) {
        $template = $default_path . $template_name;
    }

    // Return what we found.
    return $template;
}
?>
