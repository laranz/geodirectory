<?php
/**
 * Core functions.
 *
 * @since 2.0.0
 * @package GeoDirectory
 */
 
 /*
 * A function to log GD errors no matter the type given.
 *
 * This function will log GD errors if the WP_DEBUG constant is true, it can be filtered.
 *
 * @since 1.5.7
 * @param mixed $log The thing that should be logged.
 * @package GeoDirectory
 */
function geodir_error_log( $log, $title = '', $file = '', $line = '', $exit = false ) {
    /*
     * A filter to override the WP_DEBUG setting for function geodir_error_log().
     *
     * @since 1.5.7
     */
    $should_log = apply_filters( 'geodir_log_errors', WP_DEBUG );

    if ( $should_log ) {
        $label = '';
        if ( $file && $file !== '' ) {
            $label .= basename( $file ) . ( $line ? '(' . $line . ')' : '' );
        }
        
        if ( $title && $title !== '' ) {
            $label = $label !== '' ? $label . ' ' : '';
            $label .= $title . ' ';
        }
        
        $label = $label !== '' ? trim( $label ) . ' : ' : '';
        
        if ( is_array( $log ) || is_object( $log ) ) {
            error_log( $label . print_r( $log, true ) );
        } else {
            error_log( $label . $log );
        }
        
        if ( $exit ) {
            exit;
        }
    }
}

function geodir_doing_it_wrong( $function, $message, $version ) {
    $message .= ' Backtrace: ' . wp_debug_backtrace_summary();

    if ( defined( 'DOING_AJAX' ) ) {
        do_action( 'doing_it_wrong_run', $function, $message, $version );
        geodir_error_log( $function . ' was called incorrectly. ' . $message . '. This message was added in version ' . $version . '.' );
    } else {
        _doing_it_wrong( $function, $message, $version );
    }
}

function geodir_is_singular( $post_types = array() ) {
    if ( empty( $post_types ) ) {
        $post_types = geodir_get_posttypes();
    }

    return is_singular( $post_types ) || geodir_is_page( 'preview' );
}

function geodir_is_taxonomy( $taxonomies = array() ) {
    if ( empty( $taxonomis ) ) {
        $taxonomis = geodir_get_taxonomies( '', true );
    }

    return is_tax( $taxonomis );
}

function geodir_is_post_type_archive( $post_types = array() ) {
    if ( empty( $post_types ) ) {
        $post_types = geodir_get_posttypes();
    }

    return is_post_type_archive( $post_types );
}


/**
 * Display a GeoDirectory help tip.
 *
 * @since  2.0.0
 *
 * @param  string $tip        Help tip text
 * @param  bool   $allow_html Allow sanitized HTML if true or escape
 * @return string
 */
function gd_help_tip( $tip, $allow_html = false ) {
    if ( $allow_html ) {
        $tip = geodir_sanitize_tooltip( $tip );
    } else {
        $tip = esc_attr( $tip );
    }

    return '<span class="gd-help-tip dashicons dashicons-editor-help" title="' . $tip . '"></span>';
}

/**
 * Get permalink settings for GeoDirectory
 *
 * @since  2.0.0
 * @return string
 */
function geodir_get_permalink_structure() {
    return geodir_get_option( 'permalink_structure', '');
}


/**
 * GeoDirectory Core Supported Themes.
 *
 * @since 2.0.0
 * @return string[]
 */
function geodir_get_core_supported_themes() {
    return array( 'twentyseventeen', 'twentysixteen', 'twentyfifteen', 'twentyfourteen', 'twentythirteen', 'twentyeleven', 'twentytwelve', 'twentyten' );
}

/**
 * Get the search form default text.
 * 
 * @since 2.0.0
 * @return string|void
 */
function get_search_default_text(){
    return __('Search for','geodirectory');
}

/**
 * Get the search near form default text.
 *
 * @since 2.0.0
 * @return string|void
 */
function get_search_default_near_text(){
    return __('Near','geodirectory');
}

/**
 * Get the search form default text.
 *
 * @since 2.0.0
 * @return string|void
 */
function get_search_default_button_text(){
    return __('#xf002;','geodirectory');
}