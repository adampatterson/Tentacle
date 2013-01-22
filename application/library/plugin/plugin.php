<?
/**
 * Function: plugin_enabled
 * Returns whether the given plugin is enabled or not.
 *
 * Parameters:
 *     $name - The folder name of the plugin.
 *
 * Returns:
 *     Whether or not the requested plugin is enabled.
 */
function plugin_enabled( $name ) {
    return in_array( $name, enabled_plugin() );
}


/**
 * Function: enabled_plugin
 * Returns an array of enabled plugins.
 *
 */
function enabled_plugin() {
    return unserialize(ACTIVE_PLUGINS);
}


/**
 * Function: init_extensions
 * Initialize all Plugins
 */
function init_extensions() {

    //$plugins = new Plugins();

    $enabled_plugins  = plugin::get_plugins();

    foreach ($enabled_plugins['enabled_plugins'] as $plugin => $info ) {

        if (!file_exists(TENTACLE_PLUGIN."/".$plugin."/".$plugin.".php")) {
            unset($enabled_plugins[$plugin]);
            continue;
        }

        require TENTACLE_PLUGIN."/".$plugin."/".$plugin.".php";

//        foreach (YAML::load(TENTACLE_PLUGIN."/".$plugin."/info.yaml") as $key => $val)
//            event::$instances[$plugin]->$key = (is_string($val)) ? $val : $val ;
    }


}


/**
 * Class: plugin
 */
class plugin extends event {

    # @todo Add the ability to load and parse README.md files as help docs with plugins.
    static function get_plugins(){
        $context["enabled_plugins"] = $context["disabled_plugins"] = array();

        $classes = array();
        // Move to the plugin folder
        chdir(TENTACLE_PLUGIN);
        $plugin_path = array_filter(glob('*'), 'is_dir');

        // Reset to the app root
        chdir(APP_ROOT);

        foreach ($plugin_path as $folder) {


            if (!file_exists(TENTACLE_PLUGIN."/".$folder."/".$folder.".php") ) continue;

            $info = get::yaml( TENTACLE_PLUGIN."/".$folder."/".$folder.".php" );

            if (!isset($classes[$folder]))
                $classes[$folder] = array($folder);
            else
                array_unshift($classes[$folder], $folder);

            #$info = YAML::load(TENTACLE_PLUGIN."/".$folder."/info.yaml");

            $info["conflicts_true"] = array();
            $info["depends_true"] = array();

            if (!empty($info["conflicts"])) {
                $classes[$folder][] = "conflict";

                foreach ((array) $info["conflicts"] as $conflict)
                    if (file_exists(TENTACLE_PLUGIN."/".$conflict."/".$conflict.".php"))
                        $classes[$folder][] = "conflict_".$conflict;
            }

            $dependencies_needed = array();
            if (!empty($info["depends"])) {
                $classes[$folder][] = "depends";

                foreach ((array) $info["depends"] as $dependency) {
                    if (!plugin_enabled($dependency)) {
                        if (!in_array("missing_dependency", $classes[$folder]))
                            $classes[$folder][] = "missing_dependency";

                        $classes[$folder][] = "needs_".$dependency;

                        $dependencies_needed[] = $dependency;
                    }

                    $classes[$folder][] = "depends_".$dependency;

                    fallback($classes[$dependency], array());
                    $classes[$dependency][] = "depended_by_".$folder;
                }
            }

            fallback($info["name"], $folder);
            fallback($info["version"], "0");
            fallback($info["url"]);
            fallback($info["description"]);
            fallback($info["author"], array("name" => "", "url" => ""));
            fallback($info["help"]);

            $info["description"] = $info["description"];
            $info["description"] = preg_replace(array("/<code>(.+)<\/code>/se", "/<pre>(.+)<\/pre>/se"),
                array("'<code>'.fix('\\1').'</code>'", "'<pre>'.fix('\\1').'</pre>'"),
                $info["description"]);

            $info["author"]["link"] = !empty($info["author"]["url"]) ?
                '<a href="'.string::fix($info["author"]["url"]).'">'.string::fix($info["author"]["name"]).'</a>' :
                $info["author"]["name"] ;

            $category = (plugin_enabled($folder)) ? "enabled_plugins" : "disabled_plugins" ;
            $context[$category][$folder] = array("name" => $info["name"],
                "version" => $info["version"],
                "url" => $info["url"],
                "description" => $info["description"],
                "author" => $info["author"],
                "help" => $info["help"],
                "classes" => $classes[$folder],
                "dependencies_needed" => $dependencies_needed);
        }

        foreach ($context["enabled_plugins"] as $plugin => &$attrs)
            $attrs["classes"] = $classes[$plugin];

        foreach ($context["disabled_plugins"] as $plugin => &$attrs)
            $attrs["classes"] = $classes[$plugin];


        return $context;
    }
}