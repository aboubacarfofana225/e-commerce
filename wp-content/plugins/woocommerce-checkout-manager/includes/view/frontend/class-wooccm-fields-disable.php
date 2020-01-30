<?php

class WOOCCM_Fields_Display {

  protected static $_instance;

  public function __construct() {
    $this->init();
  }

  public static function instance() {
    if (is_null(self::$_instance)) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  function disable_by_role($field) {

    global $current_user;

    $user_roles = (array) $current_user->roles;

    if (!empty($field['hide_role'])) {

      if (array_intersect($user_roles, $field['hide_role'])) {
        $field['disabled'] = true;
      } else {
        $field['disabled'] = false;
      }
    }

    if (!empty($field['show_role'])) {

      if (!array_intersect($user_roles, $field['show_role'])) {
        $field['disabled'] = true;
      } else {
        $field['disabled'] = false;
      }
    }

    return $field;
  }

  function disable_by_category($field) {

    if (empty($field['disabled']) && (!empty($field['hide_product_cat']) || !empty($field['show_product_cat']))) {

      if (count($cart_contents = WC()->cart->get_cart_contents())) {

        $hide_cats_array = (array) $field['hide_product_cat'];

        $show_cats_array = (array) $field['show_product_cat'];

        $product_cats = array();

        foreach ($cart_contents as $key => $values) {
          if ($cats = wp_get_post_terms($values['product_id'], 'product_cat', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'slugs'))) {
            $product_cats += $cats;
          }
        }

        // field without more
        // -------------------------------------------------------------------
        if (empty($field['more_product']) && count($cart_contents) < 2) {
          // hide field
          // -----------------------------------------------------------------
          if (!empty($field['hide_product_cat'])) {
            if (array_intersect($product_cats, $hide_cats_array)) {
              $field['disabled'] = true;
            }
          }

          // show field
          // -----------------------------------------------------------------
          if (!empty($field['show_product_cat'])) {
            if (!array_intersect($product_cats, $show_cats_array)) {
              $field['disabled'] = true;
            } else {
              $field['disabled'] = false;
            }
          }
        }

        // field with more
        // -------------------------------------------------------------------
        if (!empty($field['more_product'])) {

          // hide field
          // -------------------------------------------------------------
          if (!empty($field['hide_product_cat'])) {
            if (array_intersect($product_cats, $hide_cats_array)) {
              $field['disabled'] = true;
            }
          }

          // show field
          // ---------------------------------------------------------------
          if (!empty($field['show_product_cat'])) {
            if (!array_intersect($product_cats, $show_cats_array)) {
              $field['disabled'] = true;
            } else {
              $field['disabled'] = false;
            }
          }
        }
      }
    }

    return $field;
  }

  function disable_by_product($field) {

    if (empty($field['disabled']) && (!empty($field['hide_product']) || !empty($field['show_product']))) {

      if (count($cart_contents = WC()->cart->get_cart_contents())) {

        $hide_ids_array = (array) $field['hide_product'];

        $show_ids_array = (array) $field['show_product'];

        $product_ids = array_column($cart_contents, 'product_id');

        // field without more
        // -------------------------------------------------------------------
        if (empty($field['more_product']) && count($cart_contents) < 2) {
          // hide field
          // -----------------------------------------------------------------
          if (!empty($field['hide_product'])) {
            if (array_intersect($product_ids, $hide_ids_array)) {
               $field['disabled'] = true;
            }
          }

          // show field
          // -----------------------------------------------------------------
          if (!empty($field['show_product'])) {
            if (!array_intersect($product_ids, $show_ids_array)) {
                  $field['disabled'] = true;
            } else {
              $field['disabled'] = false;
            }
          }
        }

        // field with more
        // -------------------------------------------------------------------
        if (!empty($field['more_product'])) {

          // hide field
          // -------------------------------------------------------------
          if (!empty($field['hide_product'])) {
            
            if (array_intersect($product_ids, $hide_ids_array)) {
              $field['disabled'] = true;
            }
          }

          // show field
          // ---------------------------------------------------------------
          if (!empty($field['show_product'])) {
            if (!array_intersect($product_ids, $show_ids_array)) {
              $field['disabled'] = true;
            } else {
              $field['disabled'] = false;
            }
          }
        }
      }
    }

    return $field;
  }

  function init() {

    // Remove by product
    add_filter('wooccm_checkout_field_filter', array($this, 'disable_by_product'));
    // Remove by category
    add_filter('wooccm_checkout_field_filter', array($this, 'disable_by_category'));
    // Remove by role
    add_filter('wooccm_checkout_field_filter', array($this, 'disable_by_role'));
  }

}

WOOCCM_Fields_Display::instance();
