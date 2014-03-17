<?
class blocks
{
  static $return_data;

  public static function process($blocks)
  {
    unset($blocks['display']);
    $construct = new construct();

    self::$return_data .= '<div id="scaffold">';

    $id = 0;
    foreach( $blocks as $key => $block ):
      if(is_array($block)):

        self::$return_data .= '<div class="repeaters" data-min_block="0" data-block_limit="5"><fieldset>';
        self::build_row($key, $block, $id, true);         // Build the repeater_row then
        self::build_row($key, $block, $id );              // Build the row
        self::$return_data .= '</fieldset>'.
                              $construct->add_row().      // Add Row
                              '</div>';
        $id++;
      else:
        self::$return_data .= '<div class="row">';
        self::build($key, $block);                        // Build a single input. Needs .row and .col
        self::$return_data .= '</div>';
      endif;
    endforeach;

    self::$return_data .= '</div>';
  }

  public static function build_row($repeater_key, $repeater, $id = null, $is_repeater = null )
  {
    $construct = new construct();

    if ( $is_repeater )
      self::$return_data .= '<div class="repeater_row">';
    else
      self::$return_data .= '<div class="row">';

    foreach( $repeater as $key => $block ):
      $data = self::clean($key, $block, $repeater_key, $is_repeater, $id);
      construct::$bd = $data;
      self::$return_data .= $construct->$data['data'][0]( );
    endforeach;

    self::$return_data .= $construct->remove_buttons().   // Builds the buttons for adding and removing a row.
                          '</div>';                       // .row / .repeater_row
  }


  /*
   * Builds a single input for the form builder, Not repeatable.
   */
  public static function build( $key, $block )
  {
    $construct = new construct();
    $data = self::clean($key, $block);
    construct::$bd = $data;
    self::$return_data .= $construct->$data['data'][0]( $data );  // Needs .row and .col
  }


  /*
  * Takes a data block and manipulates the value of an array
  * to create the necessary elements for processing.
   */
  static function clean($key, $data, $repeater_key = null, $is_repeater = null, $id = null )
  {
    if( $is_repeater )
      $id = 999;

    return array('key' => $key, 'repeater_key' => $repeater_key, 'id' => $id, 'data' => explode(':', $data));
  }


  public static function render()
  {
    echo self::$return_data;
  }
}


class construct
{
  static $bd;

  public function text( )
  {
    if ( is_null( self::$bd['repeater_key'] ) )
      $id = self::$bd['key'];
    else
      $id = self::$bd['repeater_key'].'-'.self::$bd['key'].'-'.self::$bd['id'];

    if ( is_null( self::$bd['repeater_key'] ) )
      $name = self::$bd['key'];
    else
      $name = self::$bd['repeater_key'].'-'.self::$bd['key'].'['.self::$bd['id'].']';

    return '<div class="col-md-12">
          <label for="'.$id.'">'.self::$bd['data'][1].'</label>
          <input type="text" id="'.$id.'" class="form-control" name="'/*self::$bd['block_array'].*/.$name./*self::$bd['block_end_array'].*/'" />'
          .self::set_helper().
        '</div>';
  }


  public function password( $is_scaffold = null )
  {
    return null;
  }


  public function option( $is_scaffold = null )
  {
    return '<div class="form-group">
              <label for="'.self::$bd['key'].'">'.self::$bd['data']['1'].'</label>
              <select class="form-control" id="scaffold'.self::$bd['key'].'" name="'.self::$bd['input_name'].'">'
    .self::option_loop(self::$bd['input']['options']).
    '</select>'
    .self::set_helper().
    '</div>';
  }


  public function textarea( $is_scaffold = null )
  {
    return '<div class="form-group">
                <label for="'.self::$bd['key'].'">'.self::$bd['data']['1'].'</label>
                <textarea cols="120" rows="15" name="'.self::$bd['key'].'" class="form-control"></textarea>'
    .self::set_helper().
    '</div>';
  }


  static function set_helper( $is_scaffold = null )
  {
    if( array_key_exists(2, self::$bd['data']) )
      return '<span class="help-block">'.self::$bd['data'][2].'</span>';
  }


  static function option_loop( $options = null ) {
    $option_data = null;

    foreach ($options as $option) {
      $option_data .= '<option value="'.$option.'">'.$option.'</option>';
    }

    return $option_data;
  }


  static function remove_buttons()
  {
    return '<div class="remove col-md-2">
                <!--<a class="add_block_after btn btn-xs btn-success" href="#">Add</a> --><a class="remove_block btn btn-xs btn-danger " href="#">Remove</a>
            </div>';
  }

  static function add_row ( )
  {
    return '<div class="repeater-footer actions row">
            <a href="#" id="add_block" class="add-row-end btn btn-primary">Add Row</a>
          </div>';
  }
}