<?php

/***** MH Cicero Featured Content - This module is based on the original code of Twenty Fourteen (licensed GPLv2 - http://wordpress.org/themes/twentyfourteen) and allows you to define a subset of posts to be displayed in the theme's Featured Content area *****/

class MH_Cicero_Featured_Content {

	/***** The maximum number of posts a Featured Content area can contain *****/

	public static $max_posts = 20;

	/***** Instantiate - All custom functionality will be hooked into the "init" action *****/

	public static function setup() {
		add_action( 'init', array( __CLASS__ , 'init' ), 30 );
	}

	/***** Conditionally hook into WordPress *****/

	public static function init() {
		$theme_support = get_theme_support( 'featured-content' );

		if ( ! $theme_support ) {
			return;
		}

		if ( ! isset( $theme_support[0] ) ) {
			return;
		}

		if ( ! isset( $theme_support[0]['featured_content_filter'] ) ) {
			return;
		}

		$filter = $theme_support[0]['featured_content_filter'];

		if ( isset( $theme_support[0]['max_posts'] ) ) {
			self::$max_posts = absint( $theme_support[0]['max_posts'] );
		}

		add_filter( $filter,                              array( __CLASS__, 'get_featured_posts' )    );
		add_action( 'customize_register',                 array( __CLASS__, 'customize_register' ), 9 );
		add_action( 'admin_init',                         array( __CLASS__, 'register_setting'   )    );
		add_action( 'switch_theme',                       array( __CLASS__, 'delete_transient'   )    );
		add_action( 'save_post',                          array( __CLASS__, 'delete_transient'   )    );
		add_action( 'delete_post_tag',                    array( __CLASS__, 'delete_post_tag'    )    );
		add_action( 'customize_controls_enqueue_scripts', array( __CLASS__, 'enqueue_scripts'    )    );
		add_action( 'pre_get_posts',                      array( __CLASS__, 'pre_get_posts'      )    );
		add_action( 'wp_loaded',                          array( __CLASS__, 'wp_loaded'          )    );
	}

	/***** Hide "featured" tag from the front-end *****/

	public static function wp_loaded() {
		if ( self::get_setting( 'hide-tag' ) ) {
			add_filter( 'get_terms',     array( __CLASS__, 'hide_featured_term'     ), 10, 3 );
			add_filter( 'get_the_terms', array( __CLASS__, 'hide_the_featured_term' ), 10, 3 );
		}
	}

	/***** Get featured posts *****/

	public static function get_featured_posts() {
		$post_ids = self::get_featured_post_ids();

		if ( empty( $post_ids ) ) {
			return array();
		}

		$featured_posts = get_posts( array(
			'include'        => $post_ids,
			'posts_per_page' => count( $post_ids ),
		) );

		return $featured_posts;
	}

	/***** Get featured post IDs *****/

	public static function get_featured_post_ids() {
		$featured_ids = get_transient( 'featured_content_ids' );

		if ( false === $featured_ids ) {
			$settings = self::get_setting();
			$term     = get_term_by( 'name', $settings['tag-name'], 'post_tag' );

			if ( $term ) {
				$featured_ids = get_posts( array(
					'fields'           => 'ids',
					'numberposts'      => self::$max_posts,
					'suppress_filters' => false,
					'tax_query'        => array(
						array(
							'field'    => 'term_id',
							'taxonomy' => 'post_tag',
							'terms'    => $term->term_id,
						),
					),
				) );
			}

			if ( ! $featured_ids ) {
				$featured_ids = self::get_sticky_posts();
			}

			set_transient( 'featured_content_ids', $featured_ids );
		}

		return array_map( 'absint', $featured_ids );
	}

	/***** Return an array with IDs of posts maked as sticky *****/

	public static function get_sticky_posts() {
		return array_slice( get_option( 'sticky_posts', array() ), 0, self::$max_posts );
	}

	/***** Delete featured content ids transient *****/

	public static function delete_transient() {
		delete_transient( 'featured_content_ids' );
	}

	/***** Exclude featured posts from the home page blog query *****/

	public static function pre_get_posts( $query ) {

		if ( ! $query->is_home() || ! $query->is_main_query() ) {
			return;
		}

		if ( 'posts' !== get_option( 'show_on_front' ) ) {
			return;
		}

		$featured = self::get_featured_post_ids();

		if ( ! $featured ) {
			return;
		}

		$post__not_in = $query->get( 'post__not_in' );

		if ( ! empty( $post__not_in ) ) {
			$featured = array_merge( (array) $post__not_in, $featured );
			$featured = array_unique( $featured );
		}

		$query->set( 'post__not_in', $featured );
	}

	/***** Reset tag option when the saved tag is deleted *****/

	public static function delete_post_tag( $tag_id ) {
		$settings = self::get_setting();

		if ( empty( $settings['tag-id'] ) || $tag_id != $settings['tag-id'] ) {
			return;
		}

		$settings['tag-id'] = 0;
		$settings = self::validate_settings( $settings );
		update_option( 'featured-content', $settings );
	}

	/***** Hide featured tag from displaying when global terms are queried from the front-end *****/

	public static function hide_featured_term( $terms, $taxonomies, $args ) {

		if ( is_admin() ) {
			return $terms;
		}

		if ( ! in_array( 'post_tag', $taxonomies ) ) {
			return $terms;
		}

		if ( empty( $terms ) ) {
			return $terms;
		}

		if ( 'all' != $args['fields'] ) {
			return $terms;
		}

		$settings = self::get_setting();
		foreach( $terms as $order => $term ) {
			if ( ( $settings['tag-id'] === $term->term_id || $settings['tag-name'] === $term->name ) && 'post_tag' === $term->taxonomy ) {
				unset( $terms[ $order ] );
			}
		}

		return $terms;
	}

	/*****  Hide featured tag from display when terms associated with a post object are queried from the front-end *****/

	public static function hide_the_featured_term( $terms, $id, $taxonomy ) {

		if ( is_admin() ) {
			return $terms;
		}

		if ( 'post_tag' != $taxonomy ) {
			return $terms;
		}

		if ( empty( $terms ) ) {
			return $terms;
		}

		$settings = self::get_setting();
		foreach( $terms as $order => $term ) {
			if ( ( $settings['tag-id'] === $term->term_id || $settings['tag-name'] === $term->name ) && 'post_tag' === $term->taxonomy ) {
				unset( $terms[ $term->term_id ] );
			}
		}

		return $terms;
	}

	/***** Register custom setting on the Settings -> Reading screen *****/

	public static function register_setting() {
		register_setting( 'featured-content', 'featured-content', array( __CLASS__, 'validate_settings' ) );
	}

	/***** Add settings to the Customizer *****/

	public static function customize_register( $wp_customize ) {
		$wp_customize->add_section( 'featured_content', array(
			'title'          => __( 'Featured Content', 'mh-cicero' ),
			'description'    => sprintf( __( 'Use a <a href="%1$s">tag</a> to feature your posts. If no posts match the tag, <a href="%2$s">sticky posts</a> will be displayed instead.', 'mh-cicero' ),
				esc_url( add_query_arg( 'tag', _x( 'featured', 'featured content default tag slug', 'mh-cicero' ), admin_url( 'edit.php' ) ) ),
				admin_url( 'edit.php?show_sticky=1' )
			),
			'priority'       => 130,
			'theme_supports' => 'featured-content',
		) );

		/***** Add Featured Content settings *****/

		$wp_customize->add_setting( 'featured-content[tag-name]', array(
			'default'              => _x( 'featured', 'featured content default tag slug', 'mh-cicero' ),
			'type'                 => 'option',
			'sanitize_js_callback' => array( __CLASS__, 'delete_transient' ),
		) );
		$wp_customize->add_setting( 'featured-content[hide-tag]', array(
			'default'              => true,
			'type'                 => 'option',
			'sanitize_js_callback' => array( __CLASS__, 'delete_transient' ),
		) );

		/***** Add Featured Content controls *****/

		$wp_customize->add_control( 'featured-content[tag-name]', array(
			'label'    => __( 'Tag Name', 'mh-cicero' ),
			'section'  => 'featured_content',
			'priority' => 20,
		) );
		$wp_customize->add_control( 'featured-content[hide-tag]', array(
			'label'    => __( 'Don&rsquo;t display tag on front end.', 'mh-cicero' ),
			'section'  => 'featured_content',
			'type'     => 'checkbox',
			'priority' => 30,
		) );
	}

	/***** Enqueue the tag suggestion script *****/

	public static function enqueue_scripts() {
		wp_enqueue_script( 'featured-content-suggest', get_template_directory_uri() . '/js/featured-content-admin.js', array( 'jquery', 'suggest' ), '20131022', true );
	}

	/***** Get featured content settings *****/

	public static function get_setting( $key = 'all' ) {
		$saved = (array) get_option( 'featured-content' );

		$defaults = array(
			'hide-tag' => 1,
			'tag-id'   => 0,
			'tag-name' => _x( 'featured', 'featured content default tag slug', 'mh-cicero' ),
		);

		$options = wp_parse_args( $saved, $defaults );
		$options = array_intersect_key( $options, $defaults );

		if ( 'all' != $key ) {
			return isset( $options[ $key ] ) ? $options[ $key ] : false;
		}

		return $options;
	}

	/***** Validate featured content settings *****/

	public static function validate_settings( $input ) {
		$output = array();

		if ( empty( $input['tag-name'] ) ) {
			$output['tag-id'] = 0;
		} else {
			$term = get_term_by( 'name', $input['tag-name'], 'post_tag' );

			if ( $term ) {
				$output['tag-id'] = $term->term_id;
			} else {
				$new_tag = wp_create_tag( $input['tag-name'] );

				if ( ! is_wp_error( $new_tag ) && isset( $new_tag['term_id'] ) ) {
					$output['tag-id'] = $new_tag['term_id'];
				}
			}

			$output['tag-name'] = $input['tag-name'];
		}

		$output['hide-tag'] = isset( $input['hide-tag'] ) && $input['hide-tag'] ? 1 : 0;

		self::delete_transient();

		return $output;
	}
}

MH_Cicero_Featured_Content::setup();