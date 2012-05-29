<?
// http://stackoverflow.com/questions/42/best-way-to-allow-plugins-for-a-php-application

/** Plugin system **/

$listeners = array();

/* Create an entry point for plugins */
function hook(){
  global $listeners;

  $num_args = func_num_args();
  $args = func_get_args();

  if($num_args < 2)
    trigger_error("Insufficient arguments", E_USER_ERROR);

  // Hook name should always be first argument
  $hook_name = array_shift($args);

  if(!isset($listeners[$hook_name]))
    return; // No plugins have registered this hook

  foreach($listeners[$hook_name] as $func){
    $args = $func($args); 
  }

  return $args;
}

/* Attach a function to a hook */
function add_listener($hook, $function_name){
  global $listeners;

  $listeners[$hook][] = $function_name;
}


/////////////////////////

/** Sample Plugin **/
add_listener('a_b', 'my_plugin_func1');
add_listener('str', 'my_plugin_func2');

function my_plugin_func1($args){
  return array(4, 5);
}
function my_plugin_func2($args){
  return str_replace('sample', 'CRAZY', $args[0]);
}

/////////////////////////

/** Sample Application **/

$a = 1;
$b = 2;

list($a, $b) = hook('a_b', $a, $b);

$str  = "This is my sample application\n";
$str .= "$a + $b = ".($a+$b)."\n";
$str .= "$a * $b = ".($a*$b)."\n";

$str = hook('str', $str);

echo $str;