<?php
/**
 * File: logger
 */
class logger
{
    protected static $instances = array();

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
        $html = '<p><br /><br /></p><h2 style="margin: 0 20px 10px;">Debug Log</h2>
            <table class="table table-striped table-bordered table-hover" style="margin: 0 20px 60px 20px;">
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

    /**
     * Function: file
     *	Simply logs to a text file
     *
     * Parameters:
     *	$message - String
     *	$level - Int
     */
    static function file($message, $level = 0)
    {
        $date = date('g:i A M d Y');

        switch ($level) {
            case 0:
                $level = 'General';
                break;
            case 1:
                $level = 'Warning';
                break;
            case 2:
                $level = 'Fatal';
                break;
            default:
                $level = 'General';
        }

        $fh = fopen(DEV_LOG_FILE,'a');
        flock($fh,LOCK_EX);

        if (is_array($message))
        {
            fwrite($fh,"[$date] {$level}:\n");
            fwrite($fh,"===================================\n");

            foreach($message as $key => $value)
            {
                $message = $key.' ## '.$value;

                fwrite($fh,"\t".$message."\n");
            }

            fwrite($fh,"===================================\n");

        }
        else
        {
            fwrite($fh,"[$date] {$level}: {$message}\n");
        }
        flock($fh,LOCK_UN);
        fclose($fh);
    }
}

function is_debugable(){
    if ( DEBUG && user::valid())
        logger::render();
}