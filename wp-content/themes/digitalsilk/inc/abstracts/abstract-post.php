<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Abstract Post
 *
 * Handles generic post data and database interaction
 *
 * @class     DS_AbstractPost
 * @version   1.1
 */
class DS_AbstractPost {
	/** @public int Post (post) ID. */
	public $id = 0;

	/** @var $post WP_Post. */
	public $post = null;

	/** @public string Status. */
	public $post_status = '';

	/** @public string Date. */
	public $post_date = '';

	/** @public string Modified Date. */
	public $modified_date = '';


	/**
	 * Get the order if ID is passed, otherwise the order is new and empty.
	 * This class should NOT be instantiated, but the get_order function or new _Factory.
	 * should be used. It is possible, but the aforementioned are preferred and are the only.
	 * methods that will be maintained going forward.
	 *
	 * @param  int|object
	 */
	public function __construct( $post = 0 ) {
		$this->init( $post );
	}

	/**
	 * Init/load the strategy object. Called from the constructor.
	 *
	 * @param  int|object $post Post to init.
	 */
	protected function init( $post ) {
		if ( is_numeric( $post ) ) {
			$this->id   = absint( $post );
			$this->post = get_post( $post );
			$this->get_post( $this->id );
		} elseif ( $post instanceof WP_Post ) {
			$this->id   = absint( $post->ID );
			$this->post = $post->post;
			$this->get_post( $this->id );
		} elseif ( isset( $post->ID ) ) {
			$this->id   = absint( $post->ID );
			$this->post = $post;
			$this->get_post( $this->id );
		}
	}


	/**
	 * Gets an strategy from the database.
	 *
	 * @param int $id (default: 0).
	 *
	 * @return bool
	 */
	public function get_post( $id = 0 ) {

		if ( ! $id ) {
			return false;
		}

		if ( $result = get_post( $id ) ) {
			$this->populate( $result );

			return true;
		}

		return false;
	}

	/**
	 * Populates an post from the loaded post data.
	 *
	 * @param mixed $result
	 */
	public function populate( $result ) {

		foreach ( $result as $prop => $val ) {
			$this->{$prop} = $val;
		}

		// Standard post data
		$this->id            = $result->ID;
		$this->modified_date = $result->post_modified;
		$this->status        = $result->post_status;
		$this->author        = $result->post_author;

	}

	/**
	 * __isset function.
	 *
	 * @param mixed $key
	 *
	 * @return bool
	 */
	public function __isset( $key ) {

		if ( ! $this->id ) {
			return false;
		}

		return metadata_exists( 'post', $this->id, '_' . $key );
	}

	/**
	 * __get function.
	 *
	 * @param mixed $key
	 *
	 * @return mixed
	 */
	public function __get( $key ) {
		// Get values or default if not set.

		switch ( $key ) {
			case 'title':
				$value = $this->get_title();
				break;
			case 'status':
				$value = $this->post_status;
				break;
			default:
				$value = get_post_meta( $this->id, $key, true );
				if (!$value)
					$value = get_post_meta( $this->id, '_' . $key, true );
				break;
		}

		return $value;
	}

	/**
	 * Returns the unique ID for this object.
	 *
	 * @return int
	 */
	public function get_id() {
		return $this->id;
	}

	public function get_terms( $taxonomy = '' ) {
		if ( empty( $taxonomy ) ) {
			return false;
		}
		$args  = array( 'fields' => 'all' );
		$terms = wp_get_post_terms( $this->id, $taxonomy, $args );

		return $terms;
	}

	public function set_term( $term, $taxonomy = '' ) {
		if ( empty( $taxonomy ) ) {
			return false;
		}

		return wp_set_object_terms( $this->id, $term, $taxonomy );
	}

	/**
	 * Get the post's title.
	 *
	 * @return string
	 */
	public function get_title() {
		if( $this->get_id() === 0 ) return '';
		return get_the_title( $this->get_id() );
	}

	/**
	 * Get the post's content.
	 *
	 * @return string
	 */
	public function get_content() {
		return $this->post_content;
	}


	/**
	 * Post permalink.
	 * @return string
	 */
	public function get_permalink() {
		return get_permalink( $this->get_id() );
	}

	/**
	 * Post preview permalink.
	 * @return string
	 */
	public function get_preview_link() {
		return get_preview_post_link( $this->get_id() );
	}

	/**
	 * Return the post thumbnail URL.
	 *
	 * @param string|array $size Optional. Registered image size to retrieve the source for or a flat
	 *                           array of height and width dimensions. Default 'post-thumbnail'.
	 *
	 * @return string|false Post thumbnail URL or false if no URL is available.
	 */
	public function get_thumbnail_url( $size = 'post-thumbnail' ) {
		if( is_array($size) && function_exists( 'theme_post_thumbnail' ) ){
			return theme_post_thumbnail( array(
				'post_id' => $this->get_id(),
				'width'   => $size[0],
				'height'  => $size[1],
				'type'    => 'url',
				'crop'    => true,
			) );
		}
		return get_the_post_thumbnail_url( $this->get_id(), $size );


	}

	/**
	 * Retrieve the post thumbnail.
	 *
	 * @param string|array $size Optional. Registered image size to retrieve the source for or a flat
	 *                           array of height and width dimensions. Default 'post-thumbnail'.
	 * @param string|array $attr Optional. Query string or array of attributes. Default empty.
	 *
	 * @return string The post thumbnail image tag.
	 */
	public function get_thumbnail( $size = 'post-thumbnail', $attr = '' ) {
		return get_the_post_thumbnail( $this->get_id(), $size, $attr );
	}


	/**
	 * Check if post has an image attached.
	 *
	 * @since 1.1.4
	 *
	 * @return bool Whether the post has an image attached.
	 */
	public function has_thumbnail() {
		return has_post_thumbnail( $this->get_id() );
	}

	/**
	 * Get post author ID
	 *
	 * @return int
	 */
	public function get_author_id() {
		return get_post_field( 'post_author', $this->get_id() );
	}

	public function get_date(){
		return get_the_date('', $this->get_id());
	}

	public function get_documents() {
		if ( !have_rows('documents',$this->ID)  ) return false;

		$rows = get_field('documents', $this->ID);
		$documents = [];
		foreach ($rows as $row){
			$documents[] = $row['document'];
		}
		return array_filter($documents);
	}
}
