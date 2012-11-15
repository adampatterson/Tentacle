<?
class transiant_model  
{
	/**
	 * Delete a transient.
	 *
	 * @since 2.8.0
	 * @package WordPress
	 * @subpackage Transient
	 *
	 * @uses do_action() Calls 'delete_transient_$transient' hook before transient is deleted.
	 * @uses do_action() Calls 'deleted_transient' hook on success.
	 *
	 * @param string $transient Transient name. Expected to not be SQL-escaped.
	 * @return bool true if successful, false otherwise
	 */
	function delete_transient( $transient ) {
		global $_wp_using_ext_object_cache;

		do_action( 'delete_transient_' . $transient, $transient );

		if ( $_wp_using_ext_object_cache ) {
			$result = wp_cache_delete( $transient, 'transient' );
		} else {
			$option_timeout = '_transient_timeout_' . $transient;
			$option = '_transient_' . $transient;
			$result = delete_option( $option );
			if ( $result )
				delete_option( $option_timeout );
		}

		if ( $result )
			do_action( 'deleted_transient', $transient );
		return $result;
	}


	/**
	 * Get the value of a transient.
	 *
	 * If the transient does not exist or does not have a value, then the return value
	 * will be false.
	 *
	 * @uses apply_filters() Calls 'pre_transient_$transient' hook before checking the transient.
	 * 	Any value other than false will "short-circuit" the retrieval of the transient
	 *	and return the returned value.
	 * @uses apply_filters() Calls 'transient_$option' hook, after checking the transient, with
	 * 	the transient value.
	 *
	 * @since 2.8.0
	 * @package WordPress
	 * @subpackage Transient
	 *
	 * @param string $transient Transient name. Expected to not be SQL-escaped
	 * @return mixed Value of transient
	 */
	function get_transient( $transient ) {
		global $_wp_using_ext_object_cache;

		$pre = apply_filters( 'pre_transient_' . $transient, false );
		if ( false !== $pre )
			return $pre;

		if ( $_wp_using_ext_object_cache ) {
			$value = wp_cache_get( $transient, 'transient' );
		} else {
			$transient_option = '_transient_' . $transient;
			if ( ! defined( 'WP_INSTALLING' ) ) {
				// If option is not in alloptions, it is not autoloaded and thus has a timeout
				$alloptions = wp_load_alloptions();
				if ( !isset( $alloptions[$transient_option] ) ) {
					$transient_timeout = '_transient_timeout_' . $transient;
					if ( get::option( $transient_timeout ) < time() ) {
						delete_option( $transient_option  );
						delete_option( $transient_timeout );
						return false;
					}
				}
			}

			$value = get::option( $transient_option );
		}

		return apply_filters( 'transient_' . $transient, $value );
	}


	/**
	 * Set/update the value of a transient.
	 *
	 * You do not need to serialize values. If the value needs to be serialized, then
	 * it will be serialized before it is set.
	 *
	 * @since 2.8.0
	 * @package WordPress
	 * @subpackage Transient
	 *
	 * @uses apply_filters() Calls 'pre_set_transient_$transient' hook to allow overwriting the
	 * 	transient value to be stored.
	 * @uses do_action() Calls 'set_transient_$transient' and 'setted_transient' hooks on success.
	 *
	 * @param string $transient Transient name. Expected to not be SQL-escaped.
	 * @param mixed $value Transient value. Expected to not be SQL-escaped.
	 * @param int $expiration Time until expiration in seconds, default 0
	 * @return bool False if value was not set and true if value was set.
	 */
	function set_transient( $transient, $value, $expiration = 0 ) {
		global $_wp_using_ext_object_cache;

		$value = apply_filters( 'pre_set_transient_' . $transient, $value );

		if ( $_wp_using_ext_object_cache ) {
			$result = wp_cache_set( $transient, $value, 'transient', $expiration );
		} else {
			$transient_timeout = '_transient_timeout_' . $transient;
			$transient = '_transient_' . $transient;
			if ( false === get::option( $transient ) ) {
				$autoload = 'yes';
				if ( $expiration ) {
					$autoload = 'no';
					add_option( $transient_timeout, time() + $expiration, '', 'no' );
				}
				$result = add_option( $transient, $value, '', $autoload );
			} else {
				if ( $expiration )
					update_option( $transient_timeout, time() + $expiration );
				$result = update_option( $transient, $value );
			}
		}
		if ( $result ) {
			do_action( 'set_transient_' . $transient );
			do_action( 'setted_transient', $transient );
		}
		return $result;
	}
	
	
	/**
	 * Get the value of a site transient.
	 *
	 * If the transient does not exist or does not have a value, then the return value
	 * will be false.
	 *
	 * @see get_transient()
	 * @since 2.9.0
	 * @package WordPress
	 * @subpackage Transient
	 *
	 * @uses apply_filters() Calls 'pre_site_transient_$transient' hook before checking the transient.
	 * 	Any value other than false will "short-circuit" the retrieval of the transient
	 *	and return the returned value.
	 * @uses apply_filters() Calls 'site_transient_$option' hook, after checking the transient, with
	 * 	the transient value.
	 *
	 * @param string $transient Transient name. Expected to not be SQL-escaped.
	 * @return mixed Value of transient
	 */
	function get_site_transient( $transient ) {
		global $_wp_using_ext_object_cache;

		$pre = apply_filters( 'pre_site_transient_' . $transient, false );
		if ( false !== $pre )
			return $pre;

		if ( $_wp_using_ext_object_cache ) {
			$value = wp_cache_get( $transient, 'site-transient' );
		} else {
			// Core transients that do not have a timeout. Listed here so querying timeouts can be avoided.
			$no_timeout = array('update_core', 'update_plugins', 'update_themes');
			$transient_option = '_site_transient_' . $transient;
			if ( ! in_array( $transient, $no_timeout ) ) {
				$transient_timeout = '_site_transient_timeout_' . $transient;
				$timeout = get_site_option( $transient_timeout );
				if ( false !== $timeout && $timeout < time() ) {
					delete_site_option( $transient_option  );
					delete_site_option( $transient_timeout );
					return false;
				}
			}

			$value = get_site_option( $transient_option );
		}

		return apply_filters( 'site_transient_' . $transient, $value );
	}
	

	/**
	 * Set/update the value of a site transient.
	 *
	 * You do not need to serialize values, if the value needs to be serialize, then
	 * it will be serialized before it is set.
	 *
	 * @see set_transient()
	 * @since 2.9.0
	 * @package WordPress
	 * @subpackage Transient
	 *
	 * @uses apply_filters() Calls 'pre_set_site_transient_$transient' hook to allow overwriting the
	 * 	transient value to be stored.
	 * @uses do_action() Calls 'set_site_transient_$transient' and 'setted_site_transient' hooks on success.
	 *
	 * @param string $transient Transient name. Expected to not be SQL-escaped.
	 * @param mixed $value Transient value. Expected to not be SQL-escaped.
	 * @param int $expiration Time until expiration in seconds, default 0
	 * @return bool False if value was not set and true if value was set.
	 */
	function set_site_transient( $transient, $value, $expiration = 0 ) {
		global $_wp_using_ext_object_cache;

		$value = apply_filters( 'pre_set_site_transient_' . $transient, $value );

		if ( $_wp_using_ext_object_cache ) {
			$result = wp_cache_set( $transient, $value, 'site-transient', $expiration );
		} else {
			$transient_timeout = '_site_transient_timeout_' . $transient;
			$transient = '_site_transient_' . $transient;
			if ( false === get_site_option( $transient ) ) {
				if ( $expiration )
					add_site_option( $transient_timeout, time() + $expiration );
				$result = add_site_option( $transient, $value );
			} else {
				if ( $expiration )
					update_site_option( $transient_timeout, time() + $expiration );
				$result = update_site_option( $transient, $value );
			}
		}
		if ( $result ) {
			do_action( 'set_site_transient_' . $transient );
			do_action( 'setted_site_transient', $transient );
		}
		return $result;
	}
	
}