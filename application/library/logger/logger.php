<?php
/**
 * File: logger
 */
class logger
{
    protected static $instances = array();

    /**
     * Function: logger
     * 	Used to return an array containing the query run, what file and line number called it.
     *
     * Parameters:
     *	$sql - String ( Query string )
     *
     * Returns:
     * 	$dbug_query - Array
     */
    function logger($sql)
    {
        global $dbug_query;
        $uid = uniqid();

        $bt = debug_backtrace();
        $caller = array_shift($bt);

        $dbug_query[$uid]['query'] = $sql;
        $dbug_query[$uid]['file'] = $caller['file'].' from line #'.$caller['line'];
    }


    /**
     * Debug Console set
     */
    static function set($name, $txt, $level=0 ) {

        switch ($level) {
            case 0:
                $level = '';
                break;
            case 1:
                $level = 'info';
                break;
            case 2:
                $level = 'success';
                break;
            case 3:
                $level = 'warning';
                break;
            case 4:
                $level = 'error';
                break;
        }

        $value = array(
            'level' => $level,
            'name'      => $name,
            'message'   => $txt
        );

        static::$instances[] = &$value;
    }

    static function get()
    {
        return static::$instances;
    }

    static function environment()
    {
        return memory_usage();
    }

    static function render()
    {
        $html = '<p><br /><br /></p><h2>Debug Log</h2>
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th width="30">&nbsp;</th>
                  <th width="200">Name</th>
                  <th>Log</th>
                </tr>
              </thead>
              <tbody>';

        foreach (static::$instances as  $key => $log)
        {
            $html .= '<tr class="'.$log['level'].'">
              <th>'.$key.'</th>
              <td>'.$log['name'].'</td>
              <td>'.$log['message'].'</td>
              </tr>';
        }

        $html .= '</tbody> </table>';

        echo $html;
    }
}

function is_debugable(){
    if ( DEBUG && user::valid())
        logger::render();
}