<?

class plugin_model
{
    // Get all and acive plugins
    public function get($active='') {
        $pluginss = new Plugins();
        $get_plugins = $pluginss->get_plugins();

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
    public function navigation( $rout = '' ) {
        $trigger 		= Trigger::current();

        $subnav["settings"] = $trigger->filter($subnav["settings"], "settings_nav");
		
		if ( $subnav["settings"] != null) {
			
			foreach ($subnav["settings"] as $key => $value) {
	            $subnav["settings"][$key] = array(
	                'title'     => $value['title'],
	                'rout'      => $value['rout'],
	                'uri'       => $value['uri']
	            );
	        }
	        return $subnav["settings"];
		} else {
			return false;
		}

        
    }
}