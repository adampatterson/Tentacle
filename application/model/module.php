<?

class module_model
{
    // Get all and acive modules
    public function get($active=false) {

        if ($active == true) {
            return enabled_module();
        } else {
            $modules = new Modules();
            return $modules->get_modules();
        }
    }


    public function activate( $module ) {
        $module = array($module);

        if (!module_enabled($module)):

            $updated_modules = serialize(array_merge(enabled_module(), $module));
            $modules = load::model('settings')->update('active_modules', $updated_modules);

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
}