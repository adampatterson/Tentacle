<?php
class  scaffold
{

  static $return_data;

  static public function build( $input, $blocks = null, $data = null )
  {
    $builder = new builder();

    $build_data = "";

    $input_name = string::underscore( string::camelize( $input['name']) );

    if ( $blocks ):
      $block_array = 'block[0][';
      $block_end_array = ']';
    else:
      $block_array = '';
      $block_end_array = '';
    endif;

    if ( array_key_exists( 'notes', $input ) )
      $input_notes = $input['notes'];
    else
      $input_notes = null;

    builder::$bd =  array(
      'input_name'        => $input_name,
      'input'             => $input,
      'input_notes'       => $input_notes,
      'block_array'       => $block_array,
      'block_end_array'   => $block_end_array,
      'is_block'          => $blocks
    );

    return $builder->$input['type']( $blocks );
  }


  static public function process( $scaffold_data, $blocks = null )
  {
    unset( $scaffold_data[ 'display' ] );

    foreach ($scaffold_data as $key => $input):

      if( $key == 'blocks' ):
      // No forgroup wrapper
        self::$return_data .= builder::start( true );

          self::$return_data .= builder::block_start( true );
            self::$return_data .= self::process( $input, true );
          self::$return_data .= builder::block_finish( true );

          self::$return_data .= builder::block_start( );
            self::$return_data .= self::process( $input, true );
            self::$return_data .= builder::block_finish( );
          self::$return_data .= builder::add_row( true );

        self::$return_data .= builder::finish( true );

      else:
        self::$return_data .= self::build($input, $blocks);
      endif;

    endforeach;
  }


  static public function render() {
    echo self::$return_data;
  }


  static public function populate( $data, $get_page_meta )
  {
    if ( $page_id = '' )
      return false;

    $return_data = "";

//        if ( $data[ 'display' ] == 'admin' ):

    $return_data = "";

    //        if ( $blocks )
    //            $return_data .= '<div class="scaffold-block well">';

    // Remove the display key because it is not used for rendering the forms.
    unset($data[ 'display' ]);

    foreach ($data as $key => $input):

      if( $key == 'blocks' ) {
        echo '<br> Block';
        $return_data .= self::populate( $input, $blocks = true );
      } else {
        echo '<br> No Block';
        //$return_data .= self::build($input, $blocks, $data);
      }

    endforeach;

    //        if ( $blocks )
    //            $return_data .= '</div>';

    echo $return_data;

//        endif;

    /*
       foreach ($data as $key => $input):

           $input_name = string::underscore( string::camelize( $input['name']) );

           if ( in_array( 'notes', $input ) )
               $input_notes = $input['notes'];
           else
               $input_notes = '';

           switch($input['type']) {
               case 'text':
                   $return_data .= '<div class="form-group"><label for="'.$input_name.'">'.$input['name'].'</label><div class="input"><input type="text" class="xlarge" name="'.$input_name.'" value="'.$get_page_meta->$input_name.'"/></div></div>';
               break;
               case 'password':
                   $return_data .= '<div class="form-group"><label for="'.$input_name.'">'.$input['name'].'</label><div class="input"><input type="password" class="xlarge" name="'.$input_name.'" value="'.$get_page_meta->$input_name.'"/></div></div>';
               break;
               case 'button':

                   if ( $data[ 'display' ] != 'admin' ):
                       $return_data .= self::create_button($input['button_name']);
                   endif;
               break;
               case 'option':
                   $return_data .= '<div class="form-group">
                                       <label for="'.$input_name.'">'.$input['name'].'</label>
                                       <div class="input">
                                           <select name="'.$input_name.'">';
                                       foreach ($input['options'] as $option) {
                                           $return_data .= '<option value="'.$option.'">'.$option.'</option>';
                                       }
                   $return_data .= '		</select>
                                       </div>
                                   </div>';
                   break;
                   case 'multiline':
                       $return_data .= '<div class="form-group"><label for="'.$input_name.'">'.$input['name'].'</label><div class="input"><textarea cols="120" rows="15" name="'.$input_name.'" class="xlarge">'.$get_page_meta->$input_name.'</textarea></div></div>';
                       break;
                   default:

                   break;
           }// switch

       endforeach;
   */

  }
}


class builder
{

  static $bd;

  public function debug ()
  {
    var_dump( self::$bd );
  }


  public function text( $block )
  {
    $text_block = null;

    if ( $block )
      $text_block .= '<div class="col-md-12">';
    else
      $text_block .= '<div class="row"><div class="col-md-12">';

    $text_block .= '<label for="scaffold'.self::$bd['input_name'].'">'.self::$bd['input']['name'].'</label>
                  <input type="text" id="scaffold'.self::$bd['input_name'].'" class="form-control" name="'.self::$bd['block_array'].self::$bd['input_name'].self::$bd['block_end_array'].'" />'
                  .self::set_helper();

    if ( $block )
      $text_block .= '</div>';
    else
      $text_block .= '</div></div>';

    return $text_block;
  }


  public function password()
  {
    return null;
  }


  public function select()
  {
    return $this->option();
  }


  public function option()
  {
    return '<div class="form-group">
              <label for="scaffold'.self::$bd['input_name'].'">'.self::$bd['input']['name'].'</label>
              <select class="form-control" id="scaffold'.self::$bd['input_name'].'" name="'.self::$bd['input_name'].'">'
                .self::option_loop(self::$bd['input']['options']).
            '</select>'
            .self::set_helper().
          '</div>';
  }


  public function textarea()
  {
    return '<div class="form-group">
                <label for="'.self::$bd['input_name'].'">'.self::$bd['input']['name'].'</label>
                <textarea cols="120" rows="15" name="'.self::$bd['input_name'].'" class="form-control"></textarea>'
                .self::set_helper().
            '</div>';
  }


  public function multiline()
  {
    return $this->textarea();
  }


  static function set_helper()
  {
    if( self::$bd['input_notes'] != null )
      return '<span class="help-block">'.self::$bd['input_notes'].'</span>';
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


  static function block_start( $hidden_row = null )
  {
    if( $hidden_row )
      return '<div class="repeater_row">';
    else
      return '<div class="row">';
  }


  static function block_finish( )
  {
    $block_finish = self::remove_buttons();
    $block_finish .= '<div class="clearfix"></div>
      </div>';

    return $block_finish;
  }


  static function start( $block = null )
  {
    if( $block )
      return '<div class="repeater" data-min_block="0" data-block_limit="999">';
    else
      return '';
  }


  static function finish( $block = null )
  {
    if( $block )
      return '</div>';
    else
      return  '';
  }


  static function add_row ( $block = null )
  {
    return '<div class="repeater-footer actions row">
            <a href="#" id="add_block" class="add-row-end btn btn-primary">Add Row</a>
          </div>';
  }
}