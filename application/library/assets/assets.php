<?
/**
 * class: script
 *  Based on code from Get Simple CMS
 */
class script {
# @todo: add minification
    protected static $_scripts = array();

    /**
     * Function: on
     *   Register a script to include in Themes
     *
     * Parameters:
     *   $handle - String, name for the Style
     *   $src - String, location of the src for loading
     *   $ver - String, Style version
     *   $in_footer - String, load the Style in the footer if true
     */
    static function on( $handle, $src, $ver, $in_footer=FALSE )
    {
        static::$_scripts[$handle] = array(
            'name' => $handle,
            'src' => $src,
            'ver' => $ver,
            'in_footer' => $in_footer,
            'where' => 0
        );
    }


    /**
     * Function: off
     *   Unregisters a script
     *
     * Parameters:
     *   $handle - String, name for the script to remove
     */
    static function off( $handle )
    {
        if ( array_key_exists( $handle, static::$_scripts ) )
        {
            unset(static::$_scripts[$handle]);
        }
    }


    /**
     * Function: queue
     *   Queue a script for loading
     *
     * Parameters:
     *   $handle - String, name for the script to load
     *   $where - Init
     */
    static function queue( $handle, $where )
    {
        if ( array_key_exists( $handle, static::$_scripts ) )
        {
            static::$_scripts[$handle]['load'] = true;
            static::$_scripts[$handle]['where'] = static::$_scripts[$handle]['where'] | $where;
        }
    }


    /**
     * Function: dequeue
     *   Remove a queued Style
     *
     * Parameters:
     *   $handle - String, name for the Script
     *   $where - Init
     */
    static function dequeue( $handle, $where )
    {
        if ( array_key_exists( $handle, static::$_scripts ) )
        {
            static::$_scripts[$handle]['load'] = false;
            static::$_scripts[$handle]['where'] = static::$_scripts[$handle]['where'] & ~ $where;
        }
    }


    /**
     * Function: get_frontend
     *   Echo and load scripts
     *
     * Parameters:
     *   $footer - Boolean, Load only script with footer flag set
     */
    static function get_frontend($footer=FALSE)
    {
        if (!$footer)
            style::get_frontend();

        foreach (static::$_scripts as $script)
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
     * Function: get_backend
     *   Echo and load scripts
     *
     * Parameters:
     *   $footer - Boolean, Load only script with footer flag set
     */
    static function get_backend($footer=FALSE)
    {
        if (!$footer)
            style::get_backend();

        foreach (static::$_scripts as $script)
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
}


/**
 * class: style
 *  Based on code from Get Simple CMS
 */
class style {
# @todo: add minification
    protected static $_styles = array();

    /**
     * Function: on
     *   Echo and load Styles on Admin
     *
     * Parameters:
     *   $handle - String, name for the Style
     *   $src - String, location of the src for loading
     *   $ver - String, Style version
     *   $media - String, load the Style in the footer if true
     */
    static function on($handle, $src, $ver, $media)
    {
        static::$_styles[$handle] = array(
            'name' => $handle,
            'src' => $src,
            'ver' => $ver,
            'media' => $media,
            'where' => 0
        );
    }


    /**
     * Function: off
     *   Unregisters a style
     *
     * Parameters:
     *   $handle - String, name for the script to remove
     */
    static function off( $handle )
    {
        if ( array_key_exists( $handle, static::$_scripts ) )
        {
            unset(static::$_scripts[$handle]);
        }
    }


    /**
     * Function: queue
     *   Queue a Style for loading
     *
     * Parameters:
     *   $handle - String, name for the Style
     *   $where - Init
     */
    static function queue( $handle, $where=1 )
    {
        if ( array_key_exists( $handle, static::$_styles ) )
        {
            static::$_styles[$handle]['load'] = true;
            static::$_styles[$handle]['where'] = static::$_styles[$handle]['where'] | $where;
        }
    }


    /**
     * Function: dequeue
     *   Remove a queued Style
     *
     * Parameters:
     *   $handle - String, name for the Style
     *   $where - Init
     */
    static function dequeue( $handle, $where )
    {
        if ( array_key_exists( $handle, static::$_styles ) )
        {
            static::$_styles[$handle]['load'] = false;
            static::$_styles[$handle]['where'] = static::$_styles[$handle]['where'] & ~$where;
        }
    }


    /**
     * Function: get_frontend
     *   Echo and load Styles on Admin
     *
     * Returns:
     *   HTML
     */
    static function get_frontend(){
        foreach (static::$_styles as $style)
        {
            if ($style['where'] & ASSET_FRONT )
            {

                if ($style['load'] == TRUE)
                    echo '<link href="'.$style['src'].'?v='.$style['ver'].'" rel="stylesheet" media="'.$style['media'].'">';

            }
        }
    }


    /**
     * Function: get_backend
     *   Echo and load Styles on Admin
     *
     * Returns:
     *    HTML
     */
    static function get_backend()
    {
        foreach (static::$_styles as $style)
        {
            if ($style['where'] & ASSET_BACK )
            {

                if ($style['load'] == TRUE)
                    echo '<link href="'.$style['src'].'?v='.$style['ver'].'" rel="stylesheet" media="'.$style['media'].'">';

            }
        }
    }
}