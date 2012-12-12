<?

class module_model
{
    // Get all and acive modules
    public function get($active='') {
        $modules = new Modules();
        $get_modules = $modules->get_modules();

        if ($active == 'active') {
            return $get_modules['enabled_modules'];
        } elseif ($active == 'inactive') {
            return $get_modules['disabled_modules'];
		} else {
            return $get_modules;
        }
    }


    public function activate( $module ) {
        $module = array($module);

        if (!module_enabled($module)):

            $updated_modules = serialize(array_merge(enabled_module(), $module));
            $modules = load::model('settings')->update('active_modules', $updated_modules);
            return true;
        else:
            return false;
        endif;
    }


    public function deactivate ( $module ) {

        if (module_enabled($module)):
            $modules = enabled_module();

            foreach ( $modules as $key => $value):

                if ($module == $value):
                   unset($modules[$key]);
                endif;

            endforeach;

            $updated_modules = serialize($modules);
            $modules = load::model('settings')->update('active_modules', $updated_modules);

            return $modules;

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