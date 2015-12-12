<?php
/**
 * WP Idea Stream Custom.
 *
 * Manage WordCamp talk proposals.
 *
 * Required config:
 * - WordPress 4.0 (not multisite)
 * - WP Idea Stream 2.1.0-alpha
 *
 * License: GNU/GPL 2
 * Author: imath
 * Contributor: gregoirenoyelle
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/** Specific translation ******************************************************/

/**
 * Load the mo file regarding locale
 *
 * Put your translation file in :
 * /wp-content/languages/wc-talk/
 *
 * Call the file 'wc-talk-xx_XX.mo'
 *
 * @return bool true if found, false otherwise
 */
function wc_talk_load_textdomain() {
	$domain = 'wc-talk';
	$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
	$mofile = sprintf( '%1$s-%2$s.mo', $domain, $locale );

	// Setup paths to custom dir in wp-content/languages/wc-talk
	$mofile = WP_LANG_DIR . '/' . $domain . '/' . $mofile;

	// Load the translation file
	load_textdomain( $domain, $mofile );
}
add_action( 'wp_idea_stream_loaded', 'wc_talk_load_textdomain' );

/** Talk Post Type ************************************************************/

/**
 * Override IdeaStream's post type identifier
 *
 * @param  string $post_type_id the post type identifier
 * @return string               the new type identifier
 */
function wc_talk_get_post_type( $post_type_id = '' ) {
	return 'talks';
}
add_filter( 'wp_idea_stream_get_post_type', 'wc_talk_get_post_type', 10, 1 );

/**
 * Override IdeaStream's menu icon
 *
 * @param  array  $post_type_args the post type arguments
 * @return array                  the post type arguments
 */
function wc_talk_post_type_register_args( $post_type_args = array() ) {
	$post_type_args['menu_icon'] = 'dashicons-megaphone';

	return $post_type_args;
}
add_filter( 'wp_idea_stream_post_type_register_args', 'wc_talk_post_type_register_args', 10, 1 );

/**
 * Override IdeaStream's post type labels
 *
 * @param  array  $post_type_labels the post type labels
 * @return array                    the post type labels
 */
function wc_talk_post_type_label_args( $post_type_labels = array() ) {
	return array(
		'labels' => array(
			'name'               => __( 'Talks',                   'wc-talk' ),
			'menu_name'          => __( 'WordCamp Talks',          'wc-talk' ),
			'all_items'          => __( 'All Talks',               'wc-talk' ),
			'singular_name'      => __( 'Talk',                    'wc-talk' ),
			'add_new'            => __( 'Add a Talk',              'wc-talk' ),
			'add_new_item'       => __( 'Add a new Talk',          'wc-talk' ),
			'edit_item'          => __( 'Edit Talk',               'wc-talk' ),
			'new_item'           => __( 'New Talk',                'wc-talk' ),
			'view_item'          => __( 'View Talk',               'wc-talk' ),
			'search_items'       => __( 'Seach Talks',             'wc-talk' ),
			'not_found'          => __( 'No Talks found',          'wc-talk' ),
			'not_found_in_trash' => __( 'No Talks found in trask', 'wc-talk' ),
		)
	);
}
add_filter( 'wp_idea_stream_post_type_register_labels', 'wc_talk_post_type_label_args', 10, 1 );

/** Talk Types ****************************************************************/

/**
 * Override IdeaStream's category identifier
 *
 * @param  string $category_id the category identifier
 * @return string              the type identifier
 */
function wc_talk_get_category( $category_id = '' ) {
	return 'talk-type';
}
add_filter( 'wp_idea_stream_get_category', 'wc_talk_get_category', 10, 1 );

/**
 * Override IdeaStream's category labels
 *
 * @param  array  $category_labels the category labels
 * @return array                   the type labels
 */
function wc_talk_category_label_args( $category_labels = array() ) {
	if ( empty( $category_labels['labels'] ) ) {
		return $category_labels;
	}

	$category_labels['labels'] = array_merge(
		$category_labels['labels'],
		array(
			'name'              => __( 'Talk Types',    'wc-talk' ),
			'singular_name'     => __( 'Talk Type',     'wc-talk' ),
			'edit_item'         => __( 'Edit Type',     'wc-talk' ),
			'update_item'       => __( 'Update Type',   'wc-talk' ),
			'add_new_item'      => __( 'Add New Type',  'wc-talk' ),
			'new_item_name'     => __( 'New Type Name', 'wc-talk' ),
			'all_items'         => __( 'All Types',     'wc-talk' ),
			'search_items'      => __( 'Search Types',  'wc-talk' ),
			'parent_item'       => __( 'Parent Type',   'wc-talk' ),
			'parent_item_colon' => __( 'Parent Type:',  'wc-talk' ),
		)
	);

	return $category_labels;
}
add_filter( 'wp_idea_stream_category_register_labels', 'wc_talk_category_label_args', 10, 1 );

/** Talk Focuses **************************************************************/

/**
 * Override IdeaStream's tag identifier
 *
 * @param  string $tag_id the tag identifier
 * @return string         the focus identifier
 */
function wc_talk_get_tag( $tag_id = '' ) {
	return 'talk-focus';
}
add_filter( 'wp_idea_stream_get_tag', 'wc_talk_get_tag', 10, 1 );

/**
 * Override IdeaStream's tag labels
 *
 * @param  array  $tag_labels the tag labels
 * @return array              the focus labels
 */
function wc_talk_tag_label_args( $tag_labels = array() ) {
	if ( empty( $tag_labels['labels'] ) ) {
		return $tag_labels;
	}

	$tag_labels['labels'] = array_merge(
		$tag_labels['labels'],
		array(
			'name'                       => __( 'Talk Focuses',                         'wc-talk' ),
			'singular_name'              => __( 'Talk Focus',                           'wc-talk' ),
			'edit_item'                  => __( 'Edit Focus',                           'wc-talk' ),
			'update_item'                => __( 'Update Focus',                         'wc-talk' ),
			'add_new_item'               => __( 'Add New Focus',                        'wc-talk' ),
			'new_item_name'              => __( 'New Focus Name',                       'wc-talk' ),
			'all_items'                  => __( 'All Focuses',                          'wc-talk' ),
			'search_items'               => __( 'Search Focuses',                       'wc-talk' ),
			'popular_items'              => __( 'Popular Focuses',                      'wc-talk' ),
			'separate_items_with_commas' => __( 'Separate Focuses with commas',         'wc-talk' ),
			'add_or_remove_items'        => __( 'Add or remove Focuses',                'wc-talk' ),
			'choose_from_most_used'      => __( 'Choose from the most popular Focuses', 'wc-talk' ),
		)
	);

	return $tag_labels;
}
add_filter( 'wp_idea_stream_tag_register_labels', 'wc_talk_tag_label_args', 10, 1 );


/** User contact Methods ******************************************************/

/**
 * Add Specific contact methods to the user
 *
 * @param  array  $methods the contact methods (should be an empty array since 3.6)
 * @return array           the specific contact methods
 */
function wc_talk_contactmethods( $methods = array() ) {
	// Get rid of g+
	if ( ! empty( $methods['googleplus'] ) ) {
		unset( $methods['googleplus'] );
	}

	return array_merge(
		$methods,
		array(
			'company'    => __( 'Company',         'wc-talk' ),
			'phone'      => __( 'Phone number',    'wc-talk' ),
			'twitter'    => __( 'Twitter account', 'wc-talk' ),
		)
	);
}
add_filter( 'user_contactmethods', 'wc_talk_contactmethods', 20, 1 );

/**
 * Add Fields to IdeaStream's signup form
 * ! require at least WP Idea Stream 2.1.0-alpha
 *
 * @param  array  $fields the signup fields (login + email)
 * @return array          the new signup fields.
 */
function wc_talk_signup_field( $fields = array() ) {
	if ( empty( $fields ) ) {
		return $fields;
	}

	return array_merge(
		$fields,
		array(
			'first_name' => __( 'First Name', 'wc-talk' ),
			'last_name'  => __( 'Last Name', 'wc-talk' ),
		)
	);
}
add_filter( 'wp_idea_stream_user_get_signup_fields', 'wc_talk_signup_field', 10, 1 );

/**
 * Add a description to user email to try to get an email
 * associated to a Gravatar account
 * ! require at least WP Idea Stream 2.1.0-alpha
 *
 * @param  string $retval      empty string
 * @param  array  $field_array sanitized key/value
 * @return string HTML Output
 */
function wc_talk_signup_field_add_description( $retval = '', $field_array = array() ) {
	if ( ! empty( $field_array['key'] ) && 'user_email' == $field_array['key'] ) {
		$retval = '<p class="description">' . sprintf( __( 'If possible, choose an email that is associated to your %s account', 'wc-talk' ), '<a href="http://en.gravatar.com" title="Gravatar">Gravatar</a>'  ) . '</p>';
	}

	return $retval;
}
add_filter( 'wp_idea_stream_users_after_signup_field', 'wc_talk_signup_field_add_description', 10, 2 );

/**
 * Force some signup fields to be required
 * ! require at least WP Idea Stream 2.1.0-alpha
 *
 * @param  bool    $retval wether the field is required or not
 * @param  string  $key    the field key
 * @return bool            true if required, false otherwise
 */
function wc_talk_required_fields( $retval = false, $key = '' ) {
	if ( in_array( $key, array( 'first_name', 'last_name', 'description' ) ) ) {
		$retval = true;
	}

	return $retval;
}
add_filter( 'wp_idea_stream_users_is_signup_field_required', 'wc_talk_required_fields', 10, 2 );

/**
 * Include the user's bio in signup form
 * ! require at least WP Idea Stream 2.1.0-alpha
 *
 * @return string HTML Output
 */
function wc_talk_signup_description() {
	$description = '';

	if ( ! empty( $_POST['wp_idea_stream_signup']['description'] ) ) {
		$allowed_html = wp_kses_allowed_html( 'user_description' );
		$description = wp_kses( $_POST['wp_idea_stream_signup']['description'], $allowed_html );
		$description = wp_unslash( $description );
	}
	?>
	<label for="_wp_idea_stream_signup_description"><?php esc_html_e( 'Short biography', 'wc-talk' ) ;?>  <span class="required">*</span></label>
	<textarea id="_wp_idea_stream_signup_description" name="wp_idea_stream_signup[description]"><?php echo $description ;?></textarea>
	<?php
}
add_action( 'wp_idea_stream_signup_custom_field_after', 'wc_talk_signup_description', 10 );

/**
 * Include a field to let the user set his language
 * ! require at least WP Idea Stream 2.1.0-alpha
 * en_US or site's language
 *
 * @return string HTML output
 */
function wc_talk_signup_language() {
	$language = get_locale();

	if ( isset( $_POST['wp_idea_stream_signup']['language'] ) ) {
		$language = esc_html( $_POST['wp_idea_stream_signup']['language'] );
	}

	$languages = get_available_languages();

	if ( empty( $languages ) ) {
		return;
	}

	if ( ! in_array( $language, $languages ) ) {
		$language = '';
	}
	?>
	<label for="_wp_idea_stream_signup_language"><?php esc_html_e( 'Site language', 'wc-talk' ) ;?>
		<?php wp_dropdown_languages( array(
			'name'      => 'wp_idea_stream_signup[language]',
			'id'        => '_wp_idea_stream_signup_language',
			'selected'  => $language,
			'languages' => $languages,
			'show_available_translations' => false
		) ); ?>
	</label>
	<?php

}
add_action( 'wp_idea_stream_signup_custom_field_before', 'wc_talk_signup_language', 11 );

/**
 * Save the language preferences for the user
 * ! require at least WP Idea Stream 2.1.0-alpha
 *
 * @param  integer $user_id   the id of the created user
 * @param  array   $edit_user the userdata sent from the signup form
 */
function wc_talk_save_signup_language_for_user( $user_id = 0, $edit_user = array() ) {
	if ( ! isset( $edit_user['language'] ) || empty( $user_id ) ) {
		return;
	}

	// Defaults to US.
	if ( empty( $edit_user['language'] ) ) {
		$edit_user['language'] = 'en_US';
	}

	update_user_meta( $user_id, 'wp_user_lang', $edit_user['language'] );
}
add_action( 'wp_idea_stream_users_signup_user_created', 'wc_talk_save_signup_language_for_user', 10, 2 );

/**
 * Check for a cookie to eventually unset locale & fallback to en_US
 *
 * @param  string $locale language locale
 * @return string         language locale
 */
function wc_talk_set_locale( $locale = '' ) {
	if ( empty( $_COOKIE['wp-lang-' . COOKIEHASH] ) ) {
		return $locale;
	}

	if ( 'fr_FR' != $_COOKIE['wp-lang-' . COOKIEHASH] ) {
		$locale = '';
	}

	return $locale;
}
add_filter( 'locale', 'wc_talk_set_locale', 10, 1 );

/**
 * Store the user's local preferences in a cookie
 *
 * @param  string $lang language local
 */
function wc_talk_set_language_cookie( $lang = '' ) {
	if ( empty( $lang ) ) {
		$lang = 'en_US';
	}

	$expire = time() + 10 * DAY_IN_SECONDS;

	setcookie( 'wp-lang-' . COOKIEHASH, $lang, $expire, COOKIEPATH );
}

/**
 * Display a welcome message to english speakers to explain them
 * how to set the site's language to en_US.
 *
 * @return string HTML output
 */
function wc_talk_english_speaker_info() {
	$messages = array(
		10 => esc_html__( 'Please be aware that speakers are not remunerated nor defrayed. Your presentation or workshop is a volontary participation in the WordPress community.', 'wc-talk' ),
		20 => sprintf( esc_html__( 'Please be also aware that you may be filmed and that the video of your presentation can be available on %s.', 'wc-talk' ), '<a href="http://wordpress.tv/category/wordcamptv/">WordPress TV</a>' ),
	);

	// en_US language is set, don't display the message
	if ( ( empty( $_COOKIE['wp-lang-' . COOKIEHASH] ) || 'en_US' != $_COOKIE['wp-lang-' . COOKIEHASH] ) && '' != get_locale() ) {
		$en_message  = 'English speakers are welcome to WordCamp Paris! You can set the language of the site to english by choosing this language';
		$en_message .= ' in the "Language du site" dropdown field, and then directly submit the sign-up making sure to leave all other fields empty.';
	}

	if ( ! empty( $en_message ) ) {
		?>
		<div class="message info">
			<p><?php echo esc_html( $en_message ); ?></p>
		</div>
		<?php
	}

	if ( ! wc_talk_donot_print_warning() ) {
		?>
		<div class="message error">
			<?php foreach ( $messages as $message ) : ?>
				<p><?php echo $message; ?></p>
			<?php endforeach; ?>
		</div>
		<?php
	}

}
add_action( 'wp_idea_stream_signup_before_content', 'wc_talk_english_speaker_info' );

/**
 * By default the form will be in fr_FR, the english speaker
 * can submit the form selecting the language and leaving all fields empty
 * in order to set the site's language
 * ! require at least WP Idea Stream 2.1.0-alpha
 *
 * @param  string $user_login the user login
 * @param  string $user_email the user email
 * @param  string $edit_user  the userdata
 */
function wc_talk_maybe_set_language_cookie( $user_login = '', $user_email = '', $edit_user = '' ) {
	// Let the signup process do his job. User must be a french guy :)
	if ( ! empty( $user_login ) || ! empty( $user_email ) ) {
		return;
	}

	if ( isset( $edit_user['language'] ) ) {
		// Set the cookie, then redirect
		wc_talk_set_language_cookie( $edit_user['language'] );
		wp_safe_redirect( wp_idea_stream_users_get_signup_url() );
		exit();
	}
}
add_action( 'wp_idea_stream_users_before_signup_field_required', 'wc_talk_maybe_set_language_cookie', 10, 3 );

/**
 * Refreshes the cookie
 *
 * @param  string $login the user login
 * @param  WP_User $user the user object
 */
function wc_talk_refresh_user_language( $login = '', $user = null ) {
	if ( empty( $user->ID ) ) {
		return;
	}

	$lang = get_user_meta( $user->ID, 'wp_user_lang', true );

	if ( empty( $lang ) ) {
		$lang = 'fr_FR';
	}

	wc_talk_set_language_cookie( $lang );
}
add_action( 'wp_login', 'wc_talk_refresh_user_language', 10, 2 );

/** Custom Speaker role *******************************************************/

/**
 * Register the custom speaker role caps
 * ! require at least WP Idea Stream 2.1.0-alpha
 *
 * @return array custom speaker role caps
 */
function wc_talk_get_speaker_caps() {
	$post_type_object = get_post_type_object( wp_idea_stream_get_post_type() );

	$caps = array(
		'read' => true,
	);

	if ( ! empty( $post_type_object->cap ) ) {

		$caps = array_merge(
			$caps,
			array(
				$post_type_object->cap->publish_posts => true,
				$post_type_object->cap->read_post     => true,
				$post_type_object->cap->edit_post     => true,
			)
		);

		$taxonomies = get_object_taxonomies( wp_idea_stream_get_post_type(), 'object' );

		$taxo_caps = wp_list_pluck( $taxonomies, 'cap' );

		foreach ( $taxo_caps as $taxo_cap ) {
			if ( empty( $taxo_cap->assign_terms ) ) {
				continue;
			} else {
				$caps[ $taxo_cap->assign_terms ] = true;
			}
		}
	}

	return $caps;
}

/**
 * Register the speaker role
 * ! require at least WP Idea Stream 2.1.0-alpha
 */
function wc_talk_get_role() {
	$speaker = get_role( 'speaker' );

	// Create the role if not already done.
	if ( is_null( $speaker ) ) {
		$speaker = add_role( 'speaker', __( 'Speaker', 'wc-talk' ), wc_talk_get_speaker_caps() );
	}
}
add_action( 'wp_idea_stream_init', 'wc_talk_get_role' );

/**
 * Update the user role if sign-up was made from IdeaStream's signup
 * ! require at least WP Idea Stream 2.1.0-alpha
 *
 * @param  object $userdata the userdata sent from the signup form
 * @return object           the userdata including the custom role
 */
function wc_talk_set_signup_role( $userdata = null ) {
	if ( empty( $userdata->ID ) ) {
		return $userdata;
	}

	// Set the speaker role to users registering form the IdeaStream signup page
	$userdata->role = 'speaker';
	return $userdata;
}
add_filter( 'wp_idea_stream_users_signup_userdata', 'wc_talk_set_signup_role', 10, 1 );

/**
 * Set the user role for network users when they submit a talk for the first time
 * ! require at least WP Idea Stream 2.2.0-alpha
 *
 * @param  string $default_role default role to use for IdeaStream
 * @return string the speaker role
 */
function wc_talk_set_network_user_default_role( $default_role = 'subscriber' ) {
	if ( ! is_multisite() ) {
		return $default_role;
	}

	return 'speaker';
}
add_filter( 'wp_idea_stream_users_get_default_role', 'wc_talk_set_network_user_default_role', 10, 1 );

/**
 * Customize WP Idea Stream to make it a private WordCamp talk submission tool
 *
 * Speakers will be able to submit their talk privately. This will make sure each speaker will
 * be able to view their submissions and site admins will be able too
 *
 * Comments will be used by admins to discuss about the submission, so we will make them unavaible to speakers
 * - in the different action links
 * - in the single template of the talk
 * - in the rss feeds !
 *
 * Rates will be used by admins to make the best submission rise to the top! So we'll need to make them unavailable to
 * speakers.
 * - to do so simply neutralize all rating stuff for speaker
 *
 * The user nav will need to be neutralized for speakers, as they can only submit talks without viewing others.
 * A speaker seeing another speaker profile must be redirected to IdeaStream's root url.
 *
 * All these things are set using the plugin API as soon as the current user is set
 * @see wc_talk_set_current_user()
 */

/**
 * Force the IdeaStream's default idea status to be private for speakers
 *
 * @param  string $status the idea post type (overriden to 'talk') default status
 * @return string         private!
 */
function wc_talk_speaker_default_idea_status( $status = 'publish' ) {
	if ( ! wp_idea_stream_user_can( 'wp_idea_stream_ideas_admin' ) || wp_idea_stream_is_addnew() ) {
		$status = 'private';
	}

	return $status;
}
add_filter( 'wp_idea_stream_ideas_insert_status', 'wc_talk_speaker_default_idea_status', 10, 1 );

/**
 * Make sure feeds won't request comments for speakers
 * It avoids a speaker to see what admins are discussing :)
 *
 * @param  string   $limit    the limit args of the WP_Query comment subquery
 * @param  WP_Query $wp_query WordPress main query
 * @return string             LIMIT 0 !
 */
function wc_talk_neutralize_feeds_step_one( $limit = '', $wp_query = null ) {
	// Force the comments query to return nothing
	if ( ! empty( $wp_query->query['post_type'] ) && wp_idea_stream_get_post_type() == $wp_query->query['post_type'] ) {
		$limit = 'LIMIT 0';
	}
	return $limit;
}

/**
 * Redirect the speaker trying to cheat by adding the feed argument to the talk url :)
 */
function wc_talk_neutralize_feeds_step_two() {
	if ( is_feed() && wp_idea_stream_is_ideastream() ) {
		wp_idea_stream_add_message( array(
			'type'    => 'info',
			'content' => __( 'Ah! caught trying to spy!', 'wc-talk' ),
		) );
		wp_safe_redirect( wp_idea_stream_get_redirect_url() );
		exit();
	}
}

/**
 * Empty comments for speaker
 *
 * @param  array   $comments the comments array
 * @param  int     $post_id  the post id comments are attached to
 * @return array             empty array!
 */
function wc_talk_neutralize_comments( $comments = array(), $post_id = 0 ) {
	if ( ! wp_idea_stream_is_ideastream() ) {
		return $comments;
	}

	return array();
}

/**
 * Neutralize user nav for speakers
 *
 * @param  array  $user_nav IdeaStream's user nav
 * @return array            empty array!
 */
function wc_talk_unset_user_nav( $user_nav = array() ) {
	return array();
}

/**
 * Adapt User's profile editing to use a link to WordPress Administration
 * instead of front end editing.
 *
 * @since  2015/12/12
 */
function wc_tak_edit_profile_in_wp_admin() {
	if ( ! wp_idea_stream_is_user_profile() ) {
		return;
	}
	$wp_scripts = wp_scripts();

	$data = $wp_scripts->get_data( 'wp-idea-stream-script', 'data' );
	$data .= "\n
if ( 'undefined' !== typeof jQuery ) {
	if ( 'undefined' !== typeof wp_idea_stream_vars.profile_editing ) {
		wp_idea_stream_vars.profile_editing = undefined;
		jQuery( '#wp_idea_stream_profile_form' ).remove();
	} else {
		jQuery( '#wp-idea-stream .user-description' ).remove();
	}
}
	";

	$wp_scripts->add_data( 'wp-idea-stream-script', 'data', $data );
}
add_action( 'wp_idea_stream_enqueue_scripts', 'wc_tak_edit_profile_in_wp_admin', 20 );

/**
 * Display user's profile fields
 *
 * @return string HTML Output
 */
function wc_talk_displat_user_profile() {
	$user_id = wp_idea_stream_users_displayed_user_id();

	if ( empty( $user_id ) ) {
		return;
	}

	$user = wp_idea_stream_users_get_user_data( 'id', $user_id, 'all' );
	$allowed_html = wp_kses_allowed_html( 'user_description' );

	foreach ( (array) wp_idea_stream_user_get_fields() as $key => $label ) {
		$value = $user->{$key};

		if ( empty( $value ) ) {
			continue;

		// Specific case: Twitter
		} else if ( 'twitter' == $key ) {
			if ( preg_match('!^(http|https)://!i', $user->twitter ) ) {
				$twitter_url = $user->twitter;
				$twitter_account = str_replace( array( 'https://twitter.com/', 'http://twitter.com/' ), '', $user->twitter );
			} else {
				$twitter_account = str_replace( '@', '', $user->twitter );
				$twitter_url     = 'https://twitter.com/' . $twitter_account;
			}
			$value = '<a href="' . esc_url( $twitter_url ) . '" title="Twitter">@' . esc_html( $twitter_account ) . '</a>';
		} else {
			$value = esc_html( $value );
		}
		?>
		<p>
			<strong><?php echo esc_html( $label ) ;?> :</strong>
			<?php echo $value; ?>
		</p>
		<?php
	}

	if ( ! empty( $user->description ) ) : ?>
		<p>
			<strong><?php esc_html_e( 'Short biography', 'wc-talk' ) ;?> :</strong>
			<?php echo wp_kses( $user->description, $allowed_html ); ?>
		</p>
	<?php endif ;?>

	<?php if ( wp_idea_stream_is_current_user_profile() ) : ?>

		<a href="<?php echo esc_url( get_edit_profile_url( $user_id ) );?>" class="button"><?php esc_html_e( 'Edit your profile', 'wc-talk' ) ;?></a>

	<?php endif;
}
add_action( 'wp_idea_stream_user_profile_after_avatar', 'wc_talk_displat_user_profile' );

/**
 * Redirect the speaker trying to see another speaker profile
 *
 * @param  string $context the template context
 */
function wc_talk_redirect_viewing_other_profile( $context = '' ) {
	if ( 'user-profile' == $context && ! wp_idea_stream_is_current_user_profile() ) {
		wp_safe_redirect( wp_idea_stream_get_redirect_url() );
		exit();
	}
}

/**
 * Redirect the user viewing another user's talk
 *
 * @param  WP_Post $talk the talk object
 */
function wc_talk_redirect_viewing_other_talk( $talk = null ) {
	if ( empty( $talk->post_author ) ) {
		return;
	}

	if ( wp_idea_stream_users_current_user_id() != $talk->post_author && 'private' == $talk->post_status ) {
		wp_safe_redirect( wp_idea_stream_get_redirect_url() );
		exit();
	}
}

/**
 * Make sure speakers won't be notified in case a comment has been added to their talks
 *
 * @param  array   $emails     list of emails
 * @param  int     $comment_id the comment id
 * @return array               list of emails without the speaker one
 */
function wc_talk_dont_notify_speakers( $emails = array(), $comment_id = 0 ) {
	if ( empty( $comment_id ) ) {
		return $emails;
	}

	$comment = wp_idea_stream_comments_get_comment( $comment_id );

	// check if it relates to a talk
	if ( empty( $comment->comment_post_type ) || wp_idea_stream_get_post_type() != $comment->comment_post_type ) {
		return $emails;
	}

	/**
	 * Get the speaker email
	 */
	$author_email = wp_idea_stream_users_get_user_data( 'id', $comment->comment_post_author, 'user_email' );

	// Found speaker's email in the list ? If so, let's remove it.
	if ( ! empty( $author_email ) && in_array( $author_email, $emails ) ) {
		$emails = array_diff( $emails, array( $author_email ) );
	}

	return $emails;
}
add_filter( 'comment_notification_recipients', 'wc_talk_dont_notify_speakers', 10, 2 );

/**
 * Check the closing date and eventually disable new talks
 *
 * @param  bool $can whether user can publish
 * @return bool       [description]
 */
function wc_talk_talks_opened( $can = false, $cap = '' ) {
	if ( 'publish_ideas' != $cap ) {
		return $can;
	}

	$closing = (int) wc_talk_get_closing_date( true );

	// No closing date defined, free to post if you can!
	if ( empty( $closing ) ) {
		return $can;
	}

	$now = strtotime( date_i18n( 'Y-m-d H:i' ) );

	if ( $closing < $now ) {
		$can = false;
	}

	return $can;
}

/**
 * If the option to set a role when first idea is published is set, allow
 * network users to post an idea
 *
 * ! require at least WP Idea Stream 2.2.0-alpha
 */
function wc_talk_map_meta_caps( $caps = array(), $cap = '', $user_id = 0, $args = array() ) {

	// Allow Network users to create if site's is allowing WP Idea Stream to create a role
	// for him once he posted an idea
	if ( 'publish_ideas' == $cap ) {

		if ( ! function_exists( 'wp_idea_stream_user_new_idea_set_role' ) ) {
			return $caps;
		}

		if ( ! wp_idea_stream_user_new_idea_set_role() ) {
			return $caps;
		}

		if ( ! empty( $user_id ) ) {
			$caps = array( 'exist' );
		}
	}

	return $caps;
}

/**
 * Hook to wp_idea_stream_setup_current_user and build the private tool!
 */
function wc_talk_set_current_user() {
	$user = wp_get_current_user();

	// Not an admin ?
	if ( empty( $user->roles ) || in_array( 'speaker', $user->roles ) || ! wp_idea_stream_user_can( 'wp_idea_stream_ideas_admin' ) ) {
		// Neutralize IdeaStream caps mapping
		remove_filter( 'map_meta_cap', 'wp_idea_stream_map_meta_caps', 10, 4 );

		if ( is_multisite() && empty( $user->roles ) ) {
			add_filter( 'map_meta_cap', 'wc_talk_map_meta_caps', 12, 4 );
		}

		add_filter( 'wp_idea_stream_user_can', 'wc_talk_talks_opened', 10, 2 );

		// Hide the comment link
		add_filter( 'wp_idea_stream_ideas_get_idea_comment_link', '__return_false' );

		// Neutralize all rating stuff
		add_filter( 'wp_idea_stream_is_rating_disabled', '__return_true' );

		// Neutralize comments
		add_filter( 'comment_feed_limits',                        'wc_talk_neutralize_feeds_step_one', 10, 2 );
		add_action( 'wp_idea_stream_template_redirect',           'wc_talk_neutralize_feeds_step_two',  1    );
		add_filter( 'comments_array',                             'wc_talk_neutralize_comments',       10, 2 );
		add_filter( 'wp_idea_stream_is_comments_allowed',         '__return_false'                           );

		// Neutralize stuff in user's profile
		add_filter( 'wp_idea_stream_users_get_profile_nav_items', 'wc_talk_unset_user_nav',                    10, 1 );
		add_action( 'wp_idea_stream_set_core_template',           'wc_talk_redirect_viewing_other_profile',    10, 1 );
		add_action( 'wp_idea_stream_set_single_template',         'wc_talk_redirect_viewing_other_talk',       10, 1 );
	}
}
add_action( 'wp_idea_stream_setup_current_user', 'wc_talk_set_current_user' );

/**
 * Let 1 hour to speaker to edit their submitted talk
 * ! require at least WP Idea Stream 2.1.0-alpha
 * FYI: If the talk received a comment or a rate, speaker won't be able to edit his talk
 *
 * @param  string $timediff
 * @return string
 */
function wc_talk_editing_time( $timediff = '' ) {
	return '+1 hour';
}
add_filter( 'wp_idea_stream_ideas_can_edit_time', 'wc_talk_editing_time', 10, 1 );

/**
 * Get 10 focus in the tag cloud
 * ! require at least WP Idea Stream 2.1.0-alpha
 *
 * @param  array  $term_args IdeaStream tag cloud args
 * @return array             focus cloud args
 */
function wc_talk_focus_cloud_args( $term_args = array() ) {
	return array(
		'hide_empty' => false,
		'orderby'    => 'name',
		'order'      => 'ASC'
	);
}
add_filter( 'wp_idea_stream_generate_tag_cloud_args', 'wc_talk_focus_cloud_args' );

/**
 * Too afraid to break something, let's do this the dirty way!
 *
 * @return string JS Output
 */
function wc_talk_add_javascript_tricks() {
	?>
	<script type="text/javascript">
	/* <![CDATA[ */
	( function( $ ) {

		var enUS = $( '#_wp_idea_stream_signup_language option:eq(0)' ).text();

		$( '#_wp_idea_stream_signup_language option:eq(0)' ).text(
			enUS.replace( ' (United States)', '' )
		);

		$( '#wp-idea-stream ul.category-list :checkbox' ).click( function() {
			that = $( this );

			$( '#wp-idea-stream ul.category-list :checked' ).each( function() {
				if ( $( this ).prop( 'id' ) != that.prop( 'id' ) ) {
					$( this ).prop( 'checked', false );
				}
			} );

		} );

	} )(jQuery);
	/* ]]> */
	</script>
	<?php
}
add_action( 'wp_idea_stream_ideas_after_form',     'wc_talk_add_javascript_tricks' );
add_action( 'wp_idea_stream_signup_after_content', 'wc_talk_add_javascript_tricks' );

/** Custom fields *************************************************************/

/**
 * Register new talk metas
 *
 * Different arguments (admin/form/single) are callback
 * functions to display the meta in the corresponding
 * context.
 */
function wc_talk_register_talk_metas() {
	$wc_talk_fields = array(
		'level' => array(
			'admin'  => 'wc_talk_level_admin_display',
			'single' => 'wc_talk_level_single_display',
		),
		'audience' => array(
			'admin'  => 'wc_talk_audience_admin_display',
			'single' => 'wc_talk_audience_single_display',
		),
	);

	foreach ( $wc_talk_fields as $key => $callbacks ) {
		wp_idea_stream_ideas_register_meta( $key, $callbacks );
	}
}
add_action( 'wp_idea_stream_init', 'wc_talk_register_talk_metas' );

/**
 * Level admin/form callback
 */
function wc_talk_level_admin_display( $display_meta = '' , $meta_object = null, $context = '' ) {
	if ( empty( $meta_object->field_name ) ) {
		return;
	}

	// In case of checkboxes, use an array as more than 1 choice is possible
	$field_name = $meta_object->field_name . '[]';

	$field_value = array();

	if ( ! empty( $meta_object->field_value ) ) {
		$field_value = $meta_object->field_value;
	}
	?>
	<div class="field-group">
		<p><?php esc_html_e( 'Targetted level', 'wc-talk' ) ;?></p>
		<div class="checkbox">
			<label for="level_novice">
				<input type="checkbox" id="level_novice" name="<?php echo esc_attr( $field_name );?>" value="novice" <?php checked( in_array( 'novice', $field_value ) )?>>
					<?php esc_html_e( 'Novice', 'wc-talk' ) ;?>
				</input>
			</label>
		</div>
		<div class="checkbox">
			<label for="level_advanced">
				<input type="checkbox" id="level_advanced" name="<?php echo esc_attr( $field_name );?>" value="advanced" <?php checked( in_array( 'advanced', $field_value ) )?>>
					<?php esc_html_e( 'Advanced', 'wc-talk' ) ;?>
				</input>
			</label>
		</div>
		<div class="checkbox">
			<label for="level_expert">
				<input type="checkbox" id="level_expert" name="<?php echo esc_attr( $field_name );?>" value="expert" <?php checked( in_array( 'expert', $field_value ) )?>>
					<?php esc_html_e( 'Expert', 'wc-talk' ) ;?>
				</input>
			</label>
		</div>
		<?php // Add others here! ?>
	</div>
	<?php
}

/**
 * Level single callback
 */
function wc_talk_level_single_display( $display_meta = '' , $meta_object = null, $context = '' ) {
	if ( empty( $meta_object->field_value ) ) {
		return;
	}

	$levels = array(
		'novice'   => esc_html__( 'Novice',   'wc-talk' ),
		'advanced' => esc_html__( 'Advanced', 'wc-talk' ),
		'expert'   => esc_html__( 'Expert',   'wc-talk' ),
	);

	$selected_level = array_fill_keys( (array) $meta_object->field_value, true );
	$human_level    = array_intersect_key( $levels, $selected_level );

	$output = join( ', ', $human_level );
	?>
	<p>
		<strong class="talk-meta-level"><?php esc_html_e( 'Targetted level', 'wc-talk' ) ;?></strong> : <?php echo esc_html( $output );?>
	</p>
	<?php
}

/**
 * Audience admin/form callback
 */
function wc_talk_audience_admin_display( $display_meta = '' , $meta_object = null, $context = '' ) {
	if ( empty( $meta_object->field_name ) ) {
		return;
	}

	// In case of checkboxes, use an array as more than 1 choice is possible
	$field_name = $meta_object->field_name . '[]';

	$field_value = array();

	if ( ! empty( $meta_object->field_value ) ) {
		$field_value = $meta_object->field_value;
	}
	?>
	<div class="field-group">
		<p><?php esc_html_e( 'Targetted audience', 'wc-talk' ) ;?></p>
		<div class="checkbox">
			<label for="audience_developers">
				<input type="checkbox" id="audience_developers" name="<?php echo esc_attr( $field_name );?>" value="developers" <?php checked( in_array( 'developers', $field_value ) )?>>
					<?php esc_html_e( 'Developers', 'wc-talk' ) ;?>
				</input>
			</label>
		</div>
		<div class="checkbox">
			<label for="audience_designers">
				<input type="checkbox" id="audience_designers" name="<?php echo esc_attr( $field_name );?>" value="designers" <?php checked( in_array( 'designers', $field_value ) )?>>
					<?php esc_html_e( 'Designers', 'wc-talk' ) ;?>
				</input>
			</label>
		</div>
		<div class="checkbox">
			<label for="audience_managers">
				<input type="checkbox" id="audience_managers" name="<?php echo esc_attr( $field_name );?>" value="project_managers" <?php checked( in_array( 'project_managers', $field_value ) )?>>
					<?php esc_html_e( 'Project Managers', 'wc-talk' ) ;?>
				</input>
			</label>
		</div>
		<div class="checkbox">
			<label for="audience_producers">
				<input type="checkbox" id="audience_producers" name="<?php echo esc_attr( $field_name );?>" value="content_producers" <?php checked( in_array( 'content_producers', $field_value ) )?>>
					<?php esc_html_e( 'Content Producers', 'wc-talk' ) ;?>
				</input>
			</label>
		</div>
		<div class="checkbox">
			<label for="audience_marketers">
				<input type="checkbox" id="audience_marketers" name="<?php echo esc_attr( $field_name );?>" value="marketers" <?php checked( in_array( 'marketers', $field_value ) )?>>
					<?php esc_html_e( 'Marketers', 'wc-talk' ) ;?>
				</input>
			</label>
		</div>
		<div class="checkbox">
			<label for="audience_customers">
				<input type="checkbox" id="audience_customers" name="<?php echo esc_attr( $field_name );?>" value="customers" <?php checked( in_array( 'customers', $field_value ) )?>>
					<?php esc_html_e( 'Customers', 'wc-talk' ) ;?>
				</input>
			</label>
		</div>
		<?php // Add others here! ?>
	</div>
	<?php
}

/**
 * Audience single callback
 */
function wc_talk_audience_single_display( $display_meta = '' , $meta_object = null, $context = '' ) {
	if ( empty( $meta_object->field_value ) ) {
		return;
	}

	$audiences = array(
		'developers'        => esc_html__( 'Developers',        'wc-talk' ),
		'designers'         => esc_html__( 'Designers',         'wc-talk' ),
		'project_managers'  => esc_html__( 'Project Managers',  'wc-talk' ),
		'content_producers' => esc_html__( 'Content Producers', 'wc-talk' ),
		'marketers'         => esc_html__( 'Marketers',         'wc-talk' ),
		'customers'         => esc_html__( 'Customers',         'wc-talk' ),
	);

	$selected = array_fill_keys( (array) $meta_object->field_value, true );
	$human    = array_intersect_key( $audiences, $selected );

	$output = join( ', ', $human );
	?>
	<p>
		<strong class="talk-meta-audience"><?php esc_html_e( 'Targetted audience', 'wc-talk' ) ;?></strong> : <?php echo esc_html( $output );?>
	</p>
	<?php
}

/**
 * Add the signup link to the widget
 */
function wc_talk_widget_nav_items( $nav_items = array() ) {
	if ( ! wp_idea_stream_is_signup_allowed_for_current_blog() || ( is_user_logged_in() && ! is_admin() ) ) {
		return $nav_items;
	}

	return array_merge( $nav_items, array(
		'signup' => array(
			'url'  => wp_idea_stream_users_get_signup_url(),
			'name' => __( 'Sign Up', 'wc-talk' )
		)
	) );
}
add_filter( 'wp_idea_stream_widget_nav_items', 'wc_talk_widget_nav_items', 10, 1 );

/** Admin Stuff ***************************************************************/

/**
 * Add the custom fields in the column headers when the csv file is downloaded
 * ! require at least WP Idea Stream 2.1.0-alpha
 *
 * @param  array  $columns list of WP_List_Table columns
 * @return array           same list with custom fields
 */
function wc_talk_csv_column_headers( $columns = array() ) {
	return array_merge( $columns, array(
		'level'    => esc_html__( 'Targetted level',    'wc-talk' ),
		'audience' => esc_html__( 'Targetted audience', 'wc-talk' )
	) );
}
add_filter( 'wp_idea_stream_admin_csv_column_headers', 'wc_talk_csv_column_headers', 20, 1 );

/**
 * Add the custom fields in the row datas when the csv file is downloaded
 * ! require at least WP Idea Stream 2.1.0-alpha
 *
 * @param  string  $column  name of the column
 * @param  int     $talk_id the id of the talk
 * @return string  HTML output
 */
function wc_talk_csv_column_data( $column = '', $talk_id = 0 ) {
	if ( ! in_array( $column, array( 'level', 'audience' ) ) ) {
		return;
	}

	$meta = wp_idea_stream_ideas_get_meta( $talk_id, $column );

	if ( is_array( $meta ) ) {
		echo join( ', ', array_map( 'esc_html', $meta ) );
	} else {
		echo esc_html( $meta );
	}
}
add_action( 'wp_idea_stream_admin_column_data', 'wc_talk_csv_column_data', 30, 2 );

// Allow inline edit
add_filter( 'wp_idea_stream_admin_ideas_inline_edit', '__return_true' );

/**
 * Prevents a meta_key restricted to admin usage to be deleted from front-end
 * ! require at least WP Idea Stream 2.1.0-alpha
 *
 * @param  array  $meta_keys list meta_keys to skip
 * @return array             same list with the workfow_state one
 */
function wc_talk_meta_key_skip_save( $meta_keys = array() ) {
	$meta_keys[] = 'workflow_state';
	return $meta_keys;
}
add_filter( 'wp_idea_stream_meta_key_skip_save', 'wc_talk_meta_key_skip_save', 10, 1 );

/**
 * Worflow states
 *
 * @return array list of states
 */
function wc_talk_workflow_states() {
	return array(
		'pending'   => __( 'Pending',      'wc-talk' ),
		'shortlist' => __( 'Short-listed', 'wc-talk' ),
		'selected'  => __( 'Selected',     'wc-talk' ),
		'rejected'  => __( 'Rejected',     'wc-talk' ),
		// Add states here
	);
}

/**
 * Get a specific Worflow state
 *
 * @return string human readable state
 */
function wc_talk_get_workflow_state( $state = 'pending' ) {
	$states = wc_talk_workflow_states();

	if ( ! empty( $states[ $state ] ) ) {
		return $states[ $state ];
	}
}

/**
 * Builds a dropdown to select worklow state
 *
 * @param  string $selected  the db state
 * @param  string $select_id the name/id of select field
 * @return string HTML Output
 */
function wc_talk_dropdown_workflow( $selected = '', $select_id = 'wc_talk_workflow_states' ) {
	$workflow_states = wc_talk_workflow_states();

	printf( '<select name="%s" id="%s">', esc_attr( $select_id ), esc_attr( $select_id ) );

	if ( 'workflow_states' == $select_id ) {
		printf( '<option value="">%s</option>', esc_attr__( 'Filter by state', 'wc-talk' ) );
	}

	foreach ( $workflow_states as $key_state => $state ) {
		$current = selected( $selected, $key_state, false );
		printf(
			'<option value="%s" %s>%s</option>',
			esc_attr( $key_state ),
			$current,
			esc_html( $state )
		);
	}

	echo '</select>';
}

/**
 * Register a new IdeaStream Metabox
 *
 * @param  array  $metaboxes list of IdeaStream's metabox
 * @return array             same list with the workflow one
 */
function wc_talk_mini_workflow_meta_boxe( $metaboxes = array() ) {
	$workflow_metabox = array(
		'workflow' => array(
			'id'            => 'wc_talk_workflow_metabox',
			'title'         => __( 'Workflow', 'wc-talk' ),
			'callback'      => 'wc_talk_mini_workflow_do_metabox',
			'context'       => 'side',
			'priority'      => 'high'
		)
	);

	return array_merge( $metaboxes, $workflow_metabox );
}
add_filter( 'wp_idea_stream_admin_get_meta_boxes', 'wc_talk_mini_workflow_meta_boxe', 30 );

/**
 * Builds the output for the workflow metabox
 *
 * @param  WP_Post $talk the post object
 * @return string HTML output
 */
function wc_talk_mini_workflow_do_metabox( $talk = null ) {
	$id = $talk->ID;

	$state = 'pending';
	$db_state = wp_idea_stream_ideas_get_meta( $id, 'workflow_state' );

	if ( ! empty( $db_state ) ) {
		$state = sanitize_key( $db_state );
	}
	?>

	<p>
		<label class="screen-reader-text" for="wc_talk_workflow_states"><?php esc_html_e( 'State of the talk', 'wc-talk' ); ?></label>
		<?php wc_talk_dropdown_workflow( $state ); ?>
	</p>

	<?php
	wp_nonce_field( 'wc_talk_workflow_metabox_save', 'wc_talk_workflow_metabox_metabox' );
}

/**
 * Save the workflow state
 *
 * @param  int     $id     id of the talk
 * @param  WP_Post $talk   the talk object
 * @param  bool    $update whether it's an update
 * @return int             id of the talk
 */
function wc_talk_mini_workflow_save_metabox( $id = 0, $talk = null, $update = false ) {
	// Nonce check
	if ( ! empty( $_POST['wc_talk_workflow_metabox_metabox'] ) && check_admin_referer( 'wc_talk_workflow_metabox_save', 'wc_talk_workflow_metabox_metabox' ) ) {

		$db_state = wp_idea_stream_ideas_get_meta( $id, 'workflow_state' );
		$states   = array_keys( (array) wc_talk_workflow_states() );

		// No need to update
		if ( empty( $_POST['wc_talk_workflow_states'] ) ) {
			return $id;
		}

		// State is to update or to delete
		if ( ! empty( $_POST['wc_talk_workflow_states'] ) ) {
			$state = $_POST['wc_talk_workflow_states'];

			// Not a valid state!
			if ( ! in_array( $state, $states ) ) {
				return $id;
			}

			if ( 'pending' == $state && ! empty( $db_state ) ) {
				wp_idea_stream_ideas_delete_meta( $id, 'workflow_state' );
				return $id;
			}

			if ( 'pending' != $state ) {
				wp_idea_stream_ideas_update_meta( $id, 'workflow_state', $state );
			}
		}
	}

	// inline edit
	if ( ! empty( $_REQUEST['_ideastream_workflow_state'] ) ) {
		check_ajax_referer( 'inlineeditnonce', '_inline_edit' );

		if ( 'pending' == $_REQUEST['_ideastream_workflow_state'] ) {
			wp_idea_stream_ideas_delete_meta( $id, 'workflow_state' );
		} else {
			wp_idea_stream_ideas_update_meta( $id, 'workflow_state', $_REQUEST['_ideastream_workflow_state'] );
		}
	}

	return $id;
}
add_action( 'wp_idea_stream_save_metaboxes', 'wc_talk_mini_workflow_save_metabox', 10, 3 );

/**
 * Add a column header to list workflow states
 *
 * @param  array  $columns column headers
 * @return array           columns headers + workflow stati
 */
function wc_talk_manage_columns_header( $columns = array() ) {
	$new_columns = array(
		'workflow_state' => esc_html__( 'State of the talk', 'wc-talk' ),
	);

	// Eventually move rates column after group one
	if ( ! empty( $columns['rates'] ) ) {
		$new_columns['rates'] = $columns['rates'];
		unset( $columns['rates'] );
	}

	return array_merge( $columns, $new_columns );
}
add_filter( 'wp_idea_stream_admin_column_headers', 'wc_talk_manage_columns_header', 20, 1 );

/**
 * Add row data to the workflow states column
 *
 * @param  string  $column  name of the column
 * @param  int     $talk_id id of the talk
 * @return string HTML output
 */
function wc_talk_manage_columns_data( $column = '', $talk_id = 0 ) {
	if ( ! empty( $column ) && 'workflow_state' == $column ) {
		// Try to get avatar link
		$state = wp_idea_stream_ideas_get_meta( $talk_id, 'workflow_state' );

		if ( empty( $state ) ) {
			$state = 'pending';
		}

		// data-workflowstate is used in quick edit mode
		echo '<span data-workflowstate="' . $state . '">' . esc_html( wc_talk_get_workflow_state( $state ) ) . '</span>';
	}
}
add_action( 'wp_idea_stream_admin_column_data', 'wc_talk_manage_columns_data', 20, 2 );

/**
 * Add a quick edit way to edit workflow state
 * ! require at least WP Idea Stream 2.1.0-alpha
 *
 * @param  string $column_name the column name
 * @param  string $post_type   the post type identifier
 * @return string HTML output
 */
function wc_talk_quick_edit_workflow_state( $column_name = '', $post_type = '' ) {
	// Only in Edit Talks screen!
	if ( wp_idea_stream_get_post_type() != $post_type || 'workflow_state' != $column_name ) {
		return;
	}
	?>
	<fieldset class="inline-edit-col-right">
		<div class="inline-edit-group">
			<label class="inline-edit-workflow-state alignleft">
				<span class="title"><?php esc_html_e( 'State of the talk', 'wc-talk' ); ?></span>
				<?php wc_talk_dropdown_workflow( 'pending', '_ideastream_workflow_state' ); ?>
			</label>
		</div>
	</fieldset>
	<?php
}
add_action( 'quick_edit_custom_box', 'wc_talk_quick_edit_workflow_state', 10, 2 );

/**
 * Add a script to populate the select box regarding the row values
 * ! require at least WP Idea Stream 2.1.0-alpha
 *
 * @return string JS Output
 */
function wc_talk_quick_edit_script() {
	if ( ! wp_idea_stream_is_admin() ) {
		return;
	}

	if ( 'edit-' . wp_idea_stream_get_post_type() !=  get_current_screen()->id ) {
		return;
	}
	?>
	<script type="text/javascript">
	/* <![CDATA[ */
	( function( $ ) {

		$( '#the-list' ).on('click', 'a.editinline', function() {
			selected = $(this).closest('tr').find( 'td.workflow_state span' ).data( 'workflowstate' );
			$( "#_ideastream_workflow_state option:selected").each( function(){
				$(this).attr( "selected", false );
			} );
			$( '#_ideastream_workflow_state option[value="' + selected + '"]' ).attr( 'selected', 'selected' );
		} );

	} )(jQuery);
	/* ]]> */
	</script>
	<?php
}
add_action( 'admin_footer-edit.php', 'wc_talk_quick_edit_script', 10 );

/**
 * Add a dropdown to filter the talks by state
 * ! require at least WP Idea Stream 2.1.0-alpha
 *
 * @return string HTML Output
 */
function wc_talk_filter_by_state() {
	if ( ! wp_idea_stream_is_admin() ) {
		return;
	}

	if ( 'edit-' . wp_idea_stream_get_post_type() !=  get_current_screen()->id ) {
		return;
	}

	$state = '';
	if ( ! empty( $_REQUEST['workflow_states'] ) ) {
		$state = sanitize_key( $_REQUEST['workflow_states'] );
	}

	wc_talk_dropdown_workflow( $state, 'workflow_states' );
}
add_action( 'restrict_manage_posts', 'wc_talk_filter_by_state' );

/**
 * Add a meta query to the request to get the wanted workflow state
 * ! require at least WP Idea Stream 2.1.0-alpha
 *
 * @param  WP_Query $posts_query the posts query
 */
function wc_talk_filter_request_by_state( $posts_query = null ) {
	if ( empty( $_REQUEST['workflow_states'] ) ) {
		return;
	}

	$meta_query = array();

	if ( 'pending' == $_REQUEST['workflow_states'] ) {
		$meta_query = array(
			'key'     => '_ideastream_workflow_state',
			'compare' => 'NOT EXISTS'
		);
	} else {
		$meta_query = array(
			'key'     => '_ideastream_workflow_state',
			'compare' => '=',
			'value'   => $_REQUEST['workflow_states']
		);
	}

	$posts_query->set( 'meta_query', array( $meta_query ) );
}
add_action( 'wp_idea_stream_admin_request', 'wc_talk_filter_request_by_state' );

/** Options *******************************************************************/

/**
 * Gets the timestamp or mysql date closing limit
 *
 * @param  bool $timestamp true to get the timestamp
 * @return mixed int|string timestamp or mysql date closing limit
 */
function wc_talk_get_closing_date( $timestamp = false ) {
	$closing = get_option( '_wc_talk_closing_date', '' );

	if ( ! empty( $timestamp ) ) {
		return $closing;
	}

	if ( is_numeric( $closing ) ) {
		$closing = date_i18n( 'Y-m-d H:i', $closing );
	}

	return $closing;
}

function wc_talk_donot_print_warning( $default = false ) {
	return (bool) get_option( '_wc_talk_donot_print_warning', $default );
}

/** Settings ******************************************************************/

/**
 * Add a setting section for WordCamp Talks
 *
 * @param  array  $settings_sections Idea Stream settings sections
 * @return array                     settings sections
 */
function wc_talk_settings_section( $settings_sections = array() ) {
	$settings_sections['wc_talk_settings'] = array(
		'title'    => __( 'WordCamp Talks Settings', 'wc-talk' ),
		'callback' => 'wc_talk_settings_section_callback',
		'page'     => 'ideastream',
	);

	return $settings_sections;
}
add_filter( 'wp_idea_stream_get_settings_sections', 'wc_talk_settings_section', 10, 1 );

/**
 * Add a setting field for WordCamp Talks
 *
 * @param  array  $setting_fields Idea Stream settings fields
 * @return array                  settings fields
 */
function wc_talk_settings_field( $setting_fields = array() ) {
	$setting_fields['wc_talk_settings']['_wc_talk_closing_date'] = array(
		'title'             => __( 'Talk submissions closing date', 'wc-talk' ),
		'callback'          => 'wc_talk_settings_field_callback',
		'sanitize_callback' => 'wc_talk_settings_sanitize',
		'args'              => array()
	);

	$setting_fields['wc_talk_settings']['_wc_talk_donot_print_warning'] = array(
		'title'             => __( 'Neutralize warning on sign-up page', 'wc-talk' ),
		'callback'          => 'wc_talk_warning_settings_field_callback',
		'sanitize_callback' => 'intval',
		'args'              => array()
	);

	return $setting_fields;
}
add_filter( 'wp_idea_stream_get_settings_fields', 'wc_talk_settings_field', 10, 1 );

/**
 * Callback function for the WC Talk settings section
 *
 * @return nothing
 */
function wc_talk_settings_section_callback() {}

/**
 * Callback function for Talks submission closing date
 */
function wc_talk_settings_field_callback() {
	$closing = wc_talk_get_closing_date();
	?>
	<input name="_wc_talk_closing_date" id="_wc_talk_closing_date" type="text" class="regular-text code" placeholder="YYYY-MM-DD HH:II" value="<?php echo esc_attr( $closing ); ?>" />
	<?php
}

/**
 * Callback function for warning message
 */
function wc_talk_warning_settings_field_callback() {
	?>
	<input name="_wc_talk_donot_print_warning" id="_wc_talk_donot_print_warning" type="checkbox" value="1" <?php checked( wc_talk_donot_print_warning() ); ?> />
	<?php
}

/**
 * 'Sanitize' the date
 *
 * @param  string $option
 * @return string closing date
 */
function wc_talk_settings_sanitize( $option = '' ) {
	if ( empty( $option ) ) {
		delete_option( '_wc_talk_closing_date' );
	}

	$now    = strtotime( date_i18n( 'Y-m-d H:i' ) );
	$option = strtotime( $option );

	if ( $option <= $now ) {
		return wc_talk_get_closing_date( true );
	} else {
		return $option;
	}
}

function wc_talk_admin_bar_menu() {
	global $wp_admin_bar;

	if ( ! current_user_can( 'read' ) || current_user_can( 'manage_options' ) || ! is_admin() ) {
		return false;
	}

	// Unique ID for the 'My Account' menu
	$selector_id = 'wc-talk-user-admin-links';

	// Add the top-level User Admin button
	$wp_admin_bar->add_menu( array(
		'id'    => $selector_id,
		'title' => '<span class="ab-icon dashicons dashicons-megaphone update-plugins"></span><span class="attention">' . __( 'Talks', 'wc-talk' ) . '</span>',
		'href'  => wp_idea_stream_get_root_url()
	) );

	$wp_admin_bar->add_menu( array(
		'parent' => $selector_id,
		'id'     => $selector_id . '-new',
		'title'  => __( 'New Talk', 'wc-talk' ),
		'href'   => wp_idea_stream_get_form_url()
	) );
}
add_action( 'admin_bar_menu', 'wc_talk_admin_bar_menu', 99 );

/**
 * Add a rewrite tag for the User's Not Rated ideas.
 * 
 * @since 2015-11-30
 * @todo  Use a function to retrieve the "is_to_rate" rewrite tag
 */
function wc_talk_add_user_to_rate_rewrite_tag( ) {
	add_rewrite_tag( '%is_to_rate%', '([1]{1,})' );
}
add_action( 'wp_idea_stream_add_rewrite_tags',  'wc_talk_add_user_to_rate_rewrite_tag', 11 );

/**
 * Add rewrite rules for the User's Not Rated ideas.
 * 
 * @since 2015-11-30
 * @todo  Use a function to retrieve the "is_to_rate" rewrite tag and the "to-rate" rewrite slug
 */
function wc_talk_add_users_to_rate_rewrite_rule( ) {
	$priority  = 'top';
	$root_rule = '/([^/]+)/?$';
	$user_rid  = wp_idea_stream_user_rewrite_id();
	$user_slug = wp_idea_stream_user_slug();

	$page_slug  = wp_idea_stream_paged_slug();
	$paged_rule = '/([^/]+)/' . $page_slug . '/?([0-9]{1,})/?$';

	// User Rates
	$user_to_rate_rule       = '/([^/]+)/to-rate/?$';
	$user_to_rate_paged_rule = '/([^/]+)/to-rate/' . $page_slug . '/?([0-9]{1,})/?$';

	// User rules
	add_rewrite_rule( $user_slug . $user_to_rate_paged_rule,    'index.php?' . $user_rid . '=$matches[1]&is_to_rate=1&paged=$matches[2]', $priority );
	add_rewrite_rule( $user_slug . $user_to_rate_rule,          'index.php?' . $user_rid . '=$matches[1]&is_to_rate=1',                   $priority );
}
add_action( 'wp_idea_stream_add_rewrite_rules', 'wc_talk_add_users_to_rate_rewrite_rule', 11 );

/**
 * Parse the main query and eventually surcharge it with a Meta Query to get the
 * talk the user has not rated yet
 * 
 * @since 2015-11-30
 * @todo  Use a function to retrieve the "is_to_rate" rewrite tag
 */
function wc_talk_users_parse_query( $posts_query = null ) {
	$user_id      = wp_idea_stream_get_idea_var( 'is_user' );
	$user_to_rate = $posts_query->get( 'is_to_rate' );

	if ( ! empty( $user_id ) && ! empty( $user_to_rate ) ) {
		// We are viewing user's "to rate" talks
		wp_idea_stream_set_idea_var( 'is_user_to_rate', true );

		// Define the Meta Query to get the not rated yet talks
		$posts_query->set( 'meta_query', array(
			'relation' => 'OR',
			array(
				'key'     => '_ideastream_rates',
				'value'   => ';i:' . $user_id .';',
				'compare' => 'NOT LIKE'
			),
			array(
				'key'     => '_ideastream_average_rate',
				'compare' => 'NOT EXISTS'
			)
		) );

		// We need to see all ideas, not only the one of the current displayed user
		$posts_query->set( 'author', 0 );
	}
}
// Hook this right After WP Idea Stream!
add_action( 'parse_query', 'wc_talk_users_parse_query', 3 );

/**
 * Get a given User's Not Rated talks profile link.
 * 
 * @since 2015-11-30
 * @todo  Use a function to retrieve the "is_to_rate" rewrite tag and the "to-rate" rewrite slug
 */
function wc_talk_users_get_user_to_rate_url( $user_id = 0, $user_nicename = '' ) {
	global $wp_rewrite;

	// Bail if no user id provided
	if ( empty( $user_id ) ) {
		return false;
	}

	// Pretty permalinks
	if ( $wp_rewrite->using_permalinks() ) {
		$url = $wp_rewrite->root . wp_idea_stream_user_slug() . '/%' . wp_idea_stream_user_rewrite_id() . '%/to-rate';

		// Get username if not passed
		if ( empty( $user_nicename ) ) {
			$user_nicename = wp_idea_stream_users_get_user_data( 'id', $user_id, 'user_nicename' );
		}

		$url = str_replace( '%' . wp_idea_stream_user_rewrite_id() . '%', $user_nicename, $url );
		$url = home_url( user_trailingslashit( $url ) );

	// Unpretty permalinks
	} else {
		$url = add_query_arg( array( wp_idea_stream_user_rewrite_id() => $user_id, 'is_to_rate' => '1' ), home_url( '/' ) );
	}

	/**
	 * Filter the rates profile url once WC Talk has built it
	 *
	 * @param string $url           To rate profile Url
	 * @param int    $user_id       the user ID
	 * @param string $user_nicename the username
	 */
	return apply_filters( 'wc_talk_users_get_user_to_rate_url', $url, $user_id, $user_nicename );
}

/**
 * Add a new nav to display the not rated ideas to user's profile navigation
 * 
 * @since 2015-11-30
 */
function wc_talk_users_to_rate_nav( $nav_items, $user_id, $username ) {
	if ( ! wp_idea_stream_is_rating_disabled() ) {
		$is_user_to_rate = (bool) wp_idea_stream_get_idea_var( 'is_user_to_rate' );

		$nav_items['to_rate'] = array(
			'title'   => __( 'To rate', 'wc-talk' ),
			'url'     => wc_talk_users_get_user_to_rate_url( $user_id, $username ),
			'current' => $is_user_to_rate,
			'slug'    => 'to-rate',
		);

		// Avoid the Published nav to wrongly be the "current" one if viewing the not rated talks
		if ( ! empty( $is_user_to_rate ) ) {
			$nav_items['profile']['current'] = false;
		}
	}

	return $nav_items;
}
add_filter( 'wp_idea_stream_users_get_profile_nav_items', 'wc_talk_users_to_rate_nav', 10, 3 );

/**
 * Make sure the base argument of the paginate links is ready to paginate not rated talks
 * 
 * @since 2015-11-30
 */
function wc_talk_users_talks_loop_pagination( $paginate_args ) {
	if ( false === (bool) wp_idea_stream_get_idea_var( 'is_user_to_rate' ) || ! wp_idea_stream_is_pretty_links() ) {
		return $paginate_args;
	}

	$user_id  = wp_idea_stream_users_displayed_user_id();
	$username = wp_idea_stream_users_get_displayed_user_username();

	$paginate_args['base'] = trailingslashit( wc_talk_users_get_user_to_rate_url( $user_id, $username ) ) . '%_%';

	return $paginate_args;
}
add_filter( 'wp_idea_stream_ideas_pagination_args', 'wc_talk_users_talks_loop_pagination', 10, 1 );

/**
 * Displays a feedback message if no more talks need to be rated
 * 
 * @since 2015-11-30
 */
function wc_talk_talks_no_more_to_rate( $output ) {
	if ( false === (bool) wp_idea_stream_get_idea_var( 'is_user_to_rate' ) ) {
		return $output;
	}

	return esc_html__( 'Alright sparky, no more ideas to rate.. Good job!', 'wc-talk' );
}
add_filter( 'wp_idea_stream_ideas_get_not_found', 'wc_talk_talks_no_more_to_rate', 10, 1 );
