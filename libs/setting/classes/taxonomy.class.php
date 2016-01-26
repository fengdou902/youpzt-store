<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * taxonomy Class
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class YOUPZTFramework_Taxonomy extends CSFramework_Abstract{

  /**
   *
   * taxonomy options
   * @access public
   * @var array
   *
   */
  public $options = array();
  /**
   *
   * instance
   * @access private
   * @var class
   *
   */
  private static $instance = null;

  // run taxonomy construct
  public function __construct( $options ){

    $this->options = apply_filters( 'cs_taxonomy_options', $options );
    
    //var_dump($this->options);
    if( ! empty( $this->options ) ) {
      foreach($this->options as $option){
        
        $this->addAction($option['taxonomy'].'_add_form_fields', 'add_taxonomy_fields', 10, 2);
        $this->addAction($option['taxonomy'].'_edit_form_fields','edit_taxonomy_metabox', 10, 2);
        $this->addAction('created_'.$option['taxonomy'],'save_taxonomy_metadata', 10, 1);
        $this->addAction('edited_'.$option['taxonomy'],'save_taxonomy_metadata', 10, 1);
        //$this->addAction('admin_menu','init_taxonomy');
        $this->addAction('delete_'.$option['taxonomy'],'delete_taxonomy_metadata', 10, 1);
      }
    }

  }

  // instance
  public static function instance( $options = array() ){

    if ( is_null( self::$instance ) && CS_ACTIVE_TAXONOMY) {
      self::$instance = new self( $options );
    }
    return self::$instance;
  }

  // add taxonomy
  public function add_taxonomy_fields( $taxonomy_name) {
  //var_dump($taxonomy_name);
    foreach($this->options as $option){
      if( $taxonomy_name == $option['taxonomy'] ) {
        if($option['only_edit_show_all']) $option['show_all']=true;
          $this->render_meta_box_content($taxonomy_name,$option);
      }
    }
  }
  function edit_taxonomy_metabox($taxonomy){
    //var_dump($taxonomy);
    foreach($this->options as $option){
      if( $taxonomy->taxonomy == $option['taxonomy'] ) {
          if($option['only_edit_show_all']) $option['show_all']=false;
          $this->render_meta_box_content($taxonomy,$option);
      }
    }
  }
  // taxonomy render content
  public function render_meta_box_content( $taxonomy, $callback ) {

    global $cs_errors;

    wp_nonce_field( 'cs-framework-taxonomy', 'cs-framework-taxonomy-nonce' );

    $unique       = $callback['id'];
    $sections     = $callback['sections'];
    $meta_value   =get_term_meta($taxonomy->term_id ,$unique,true);
    $transient    = get_transient( 'cs-taxonomy-transient' );
    $cs_errors    = $transient['errors'];
    $has_nav      = ( count( $sections ) >= 2 && $callback['context'] != 'side' ) ? true : false;
    //$show_all     = ( ! $has_nav ) ? ' cs-show-all' : '';
    $show_all     = ( $callback['show_all']) ?' cs-show-all':'';
    $section_name = ( ! empty( $sections[0]['fields'] ) ) ? $sections[0]['name'] : $sections[1]['name'];
    $section_id   = ( ! empty( $transient['ids'][$unique] ) ) ? $transient['ids'][$unique] : $section_name;
    $section_id   = ( ! empty( $_GET['cs-section'] ) ) ? esc_attr( $_GET['cs-section'] ) : $section_id;

    echo '<div class="cs-framework cs-taxonomy-framework">';

      echo '<input type="hidden" name="cs_section_id['. $unique .']" class="cs-reset" value="'. $section_id .'">';

      echo '<div class="cs-body'. $show_all .'">';

        if( $has_nav ) {

          echo '<div class="cs-nav">';

            echo '<ul>';
            foreach( $sections as $value ) {

              $tab_icon = ( ! empty( $value['icon'] ) ) ? '<i class="cs-icon '. $value['icon'] .'"></i>' : '';

              if( isset( $value['fields'] ) ) {
                $active_section = ( $section_id == $value['name'] ) ? ' class="cs-section-active"' : '';
                echo '<li><a href="#"'. $active_section .' data-section="'. $value['name'] .'">'. $tab_icon . $value['title'] .'</a></li>';
              } else {
                echo '<li><div class="cs-seperator">'. $tab_icon . $value['title'] .'</div></li>';
              }

            }
            echo '</ul>';

          echo '</div>';

        }

        echo '<div class="cs-content">';

          echo '<div class="cs-sections">';
          foreach( $sections as $val ) {

            if( isset( $val['fields'] ) ) {

              $active_content = ( $section_id == $val['name'] ) ? ' style="display: block;"' : '';

              echo '<div id="cs-tab-'. $val['name'] .'" class="cs-section"'. $active_content .'>';
              echo ( isset( $val['title'] ) ) ? '<div class="cs-section-title"><h3>'. $val['title'] .'</h3></div>' : '';

              foreach ( $val['fields'] as $field_key => $field ) {

                $default    = ( isset( $field['default'] ) ) ? $field['default'] : '';
                $elem_id    = ( isset( $field['id'] ) ) ? $field['id'] : '';
                $elem_value = ( is_array( $meta_value ) && isset( $meta_value[$elem_id] ) ) ? $meta_value[$elem_id] : $default;
                echo cs_add_element( $field, $elem_value, $unique );

              }
              echo '</div>';

            }
          }
          echo '</div>';

          echo '<div class="clear"></div>';

        echo '</div>';

        echo ( $has_nav ) ? '<div class="cs-nav-background"></div>' : '';

        echo '<div class="clear"></div>';

      echo '</div>';

    echo '</div>';

  }

  // save taxonomy options
  public function save_taxonomy_metadata( $term_id) {

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $term_id; }

    $nonce = ( isset( $_POST['cs-framework-taxonomy-nonce'] ) ) ? $_POST['cs-framework-taxonomy-nonce'] : '';

    if ( ! wp_verify_nonce( $nonce, 'cs-framework-taxonomy' ) ) { return $term_id; }
        if(!current_user_can('manage_categories')){
          return $term_id ;
        }
    $errors = array();
    $taxonomy = ( isset( $_REQUEST['taxonomy'] ) ) ? $_REQUEST['taxonomy'] : '';

    foreach ( $this->options as $request_value ) {

      if( $taxonomy == $request_value['taxonomy'] ) {

        $request_key = $request_value['id'];
        $meta_value  = get_term_meta( $term_id, $request_key, true );
        $request     = ( isset( $_POST[$request_key] ) ) ? $_POST[$request_key] : array();

        // ignore _nonce
        if( isset( $request['_nonce'] ) ) {
          unset( $request['_nonce'] );
        }

        foreach( $request_value['sections'] as $key => $section ) {

          if( isset( $section['fields'] ) ) {

            foreach( $section['fields'] as $field ) {

              if( isset( $field['type'] ) && isset( $field['id'] ) ) {

                $field_value = ( isset( $_POST[$request_key][$field['id']] ) ) ? $_POST[$request_key][$field['id']] : '';

                // sanitize options
                if( isset( $field['sanitize'] ) && $field['sanitize'] !== false ) {
                  $sanitize_type = $field['sanitize'];
                } else if ( ! isset( $field['sanitize'] ) ) {
                  $sanitize_type = $field['type'];
                }

                if( has_filter( 'cs_sanitize_'. $sanitize_type ) ) {
                  $request[$field['id']] = apply_filters( 'cs_sanitize_' . $sanitize_type, $field_value, $field, $section['fields'] );
                }

                // validate options
                if ( isset( $field['validate'] ) && has_filter( 'cs_validate_'. $field['validate'] ) ) {

                  $validate = apply_filters( 'cs_validate_' . $field['validate'], $field_value, $field, $section['fields'] );

                  if( ! empty( $validate ) ) {

                    $errors[$field['id']] = array( 'code' => $field['id'], 'message' => $validate, 'type' => 'error' );
                    $default_value = isset( $field['default'] ) ? $field['default'] : '';
                    $request[$field['id']] = ( isset( $meta_value[$field['id']] ) ) ? $meta_value[$field['id']] : $default_value;

                  }

                }

              }

            }

          }

        }

        $request = apply_filters( 'cs_save_taxonomy', $request, $request_key, $meta_value, $this );

        if( empty( $request ) ) {

          delete_term_meta( $term_id, $request_key );

        } else {

          if( get_term_meta( $term_id, $request_key,true) ) {

            update_term_meta( $term_id, $request_key, $request );

          } else {

            add_term_meta( $term_id, $request_key, $request );

          }

        }

        $transient['ids'][$request_key] = $_POST['cs_section_id'][$request_key];
        $transient['errors'] = $errors;

      }

    }

    set_transient( 'cs-taxonomy-transient', $transient, 10 );

  }

    function delete_taxonomy_metadata($term_id){
        foreach($this->options as $option){
          delete_term_meta($term_id,$option['taxonomy']);
        }
      }

}
