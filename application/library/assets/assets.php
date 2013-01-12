<?
/**
 * class: assets
 *  Based on code from Get Simple CMS
 */
class assets
{
    protected static $scripts = array();
    protected static $styles = array();


    /**
     * Function: register_script
     *   Register a script to include in Themes
     *
     * Parameters:
     *   $handle - String, name for the Style
     *   $src - String, location of the src for loading
     *   $ver - String, Style version
     *   $in_footer - String, load the Style in the footer if true
     */
    static function register_script( $handle, $src, $ver, $in_footer=FALSE )
    {
        static::$scripts[$handle] = array(
            'name' => $handle,
            'src' => $src,
            'ver' => $ver,
            'in_footer' => $in_footer,
            'where' => 0
        );
    }


    /**
     * Function: deregister_script
     *   Deregisters a script
     *
     * Parameters:
     *   $handle - String, name for the script to remove
     */
    static function deregister_script( $handle )
    {
        if ( array_key_exists( $handle, static::$scripts ) )
        {
            unset(static::$scripts[$handle]);
        }
    }


    /**
     * Function: queue_script
     *   Queue a script for loading
     *
     * Parameters:
     *   $handle - String, name for the script to load
     *   $where - Init
     */
    static function queue_script( $handle, $where )
    {
        if ( array_key_exists( $handle, static::$scripts ) )
        {
            static::$scripts[$handle]['load'] = true;
            static::$scripts[$handle]['where'] = static::$scripts[$handle]['where'] | $where;
        }
    }


    /**
     * Function: dequeue_script
     *   Remove a queued Style
     *
     * Parameters:
     *   $handle - String, name for the Script
     *   $where - Init
     */
    static function dequeue_script( $handle, $where )
    {
        if ( array_key_exists( $handle, static::$scripts ) )
        {
            static::$scripts[$handle]['load'] = false;
            static::$scripts[$handle]['where'] = static::$scripts[$handle]['where'] & ~ $where;
        }
    }


    /**
     * Function: get_scripts_frontend
     *   Echo and load scripts
     *
     * Parameters:
     *   $footer - Boolean, Load only script with footer flag set
     */
    static function get_scripts_frontend($footer=FALSE)
    {
        if (!$footer)
            self::get_styles_frontend();

        foreach (static::$scripts as $script)
        {
            if ($script['where'] & ASSET_FRONT )
            {
                if (!$footer){
                    if ($script['load'] == TRUE && $script['in_footer'] == FALSE )
                    {
                        echo '<script src="'.$script['src'].'?v='.$script['ver'].'"></script>';
                    }
                } else
                {
                    if ($script['load'] == TRUE && $script['in_footer'] == TRUE )
                    {
                        echo '<script src="'.$script['src'].'?v='.$script['ver'].'"></script>';
                    }
                }
            }
        }
    }


    /**
     * Function: get_scripts_backend
     *   Echo and load scripts
     *
     * Parameters:
     *   $footer - Boolean, Load only script with footer flag set
     */
    static function get_scripts_backend($footer=FALSE)
    {
        if (!$footer)
            self::get_styles_backend();

        foreach (static::$scripts as $script)
        {
            if ($script['where'] & ASSET_BACK ){
                if (!$footer)
                {
                    if ($script['load']==TRUE && $script['in_footer'] == FALSE )
                        echo '<script src="'.$script['src'].'?v='.$script['ver'].'"></script>';

                } else
                {
                    if ($script['load']==TRUE && $script['in_footer'] == TRUE )
                        echo '<script src="'.$script['src'].'?v='.$script['ver'].'"></script>';

                }
            }
        }
    }


    /**
     * Function: queue_style
     *   Queue a Style for loading
     *
     * Parameters:
     *   $handle - String, name for the Style
     *   $where - Init
     */
    static function queue_style( $handle, $where=1 )
    {
        if ( array_key_exists( $handle, static::$styles ) )
        {
            static::$styles[$handle]['load'] = true;
            static::$styles[$handle]['where'] = static::$styles[$handle]['where'] | $where;
        }
    }


    /**
     * Function: dequeue_style
     *   Remove a queued Style
     *
     * Parameters:
     *   $handle - String, name for the Style
     *   $where - Init
     */
    static function dequeue_style( $handle, $where )
    {
        if ( array_key_exists( $handle, static::$styles ) )
        {
            static::$styles[$handle]['load'] = false;
            static::$styles[$handle]['where'] = static::$styles[$handle]['where'] & ~$where;
        }
    }


    /**
     * Function: register_style
     *   Echo and load Styles on Admin
     *
     * Parameters:
     *   $handle - String, name for the Style
     *   $src - String, location of the src for loading
     *   $ver - String, Style version
     *   $media - String, load the Style in the footer if true
     */
    static function register_style($handle, $src, $ver, $media)
    {
        static::$styles[$handle] = array(
            'name' => $handle,
            'src' => $src,
            'ver' => $ver,
            'media' => $media,
            'where' => 0
        );
    }


    /**
     * Function: get_styles_frontend
     *   Echo and load Styles on Admin
     *
     * Returns:
     *   HTML
     */
    static function get_styles_frontend(){
        foreach (static::$styles as $style)
        {
            if ($style['where'] & ASSET_FRONT )
            {

                if ($style['load'] == TRUE)
                    echo '<link href="'.$style['src'].'?v='.$style['ver'].'" rel="stylesheet" media="'.$style['media'].'">';

            }
        }
    }


    /**
     * Function: get_styles_backend
     *   Echo and load Styles on Admin
     *
     * Returns:
     *    HTML
     */
    static function get_styles_backend()
    {
        foreach (static::$styles as $style)
        {
            if ($style['where'] & ASSET_BACK )
            {

                if ($style['load'] == TRUE)
                    echo '<link href="'.$style['src'].'?v='.$style['ver'].'" rel="stylesheet" media="'.$style['media'].'">';

            }
        }
    }
}