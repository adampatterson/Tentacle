<?

class plugin_model
{
    // Get all and acive plugins
    public function get($active='') {
        $get_plugins = event::get_plugins();

        if ($active == 'active') {
            return $get_plugins['enabled_plugins'];
        } elseif ($active == 'inactive') {
            return $get_plugins['disabled_plugins'];
		} else {
            return $get_plugins;
        }
    }


    public function activate( $plugins ) {
        $plugins = array($plugins);

        if (!plugin_enabled($plugins)):

            $updated_plugins = serialize(array_merge(enabled_plugin(), $plugins));
            $pluginss = load::model('settings')->update('active_plugins', $updated_plugins);
            return true;
        else:
            return false;
        endif;
    }


    public function deactivate ( $plugins ) {

        if (plugin_enabled($plugins)):
            $pluginss = enabled_plugin();

            foreach ( $pluginss as $key => $value):

                if ($plugins == $value):
                   unset($pluginss[$key]);
                endif;

            endforeach;

            $updated_plugins = serialize($pluginss);
            $pluginss = load::model('settings')->update('active_plugins', $updated_plugins);

            return $pluginss;

        else:
            return false;
        endif;
    }

    // look up a URI from the rout.
    public function navigation( $event='' )
    {
        if ( event::has_events($event) != false):

            $subnav_array = array();

            foreach ( event::trigger($event, null, 'array') as $sub_page ):
                foreach ( $sub_page as $page ):
                    $subnav_array[] = $page;
                endforeach;
            endforeach;

            return $subnav_array;
        else:
            return false;
        endif;
    }
}