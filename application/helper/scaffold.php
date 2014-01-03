<?php
class  scaffold
{

  static $return_data;

  public function test () {
    $builder = new builder();
    $builder->test();
  }

  static public function build( $input, $blocks = null, $data = null )
  {
    $builder = new builder();
    #var_dump($blocks);

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
      'block_end_array'   => $block_end_array
    );

    return $builder->$input['type']();
  }

  static public function process( $scaffold_data, $blocks = null )
  {
    if ( $blocks )
      self::$return_data .= '<div class="scaffold-block well">';

    unset( $scaffold_data[ 'display' ] );

    foreach ($scaffold_data as $key => $input):

      if( $key == 'blocks' )
        self::$return_data .= self::process( $input, true );
      else
        self::$return_data .= self::build($input, $blocks);

    endforeach;

    if ( $blocks )
      self::$return_data .= '</div>';
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

  public function start ( $block = null )
  {
    if( $block == true )
      echo '<fieldset class="form-inline">';
    else
      echo '<div class="row">';
  }


  public function debug ()
  {
    var_dump( self::$bd );
  }


  public function text( )
  {
    return '<div class="form-group">
                  <label for="scaffold'.self::$bd['input_name'].'">'.self::$bd['input']['name'].'</label>
                  <input type="text" id="scaffold'.self::$bd['input_name'].'" class="form-control" name="'.self::$bd['block_array'].self::$bd['input_name'].self::$bd['block_end_array'].'" />'
                  .self::set_helper().
              '</div>';
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

  public function multiline(){
    return $this->textarea();
  }


  public function textarea()
  {
    return '<div class="form-group">
                <label for="'.self::$bd['input_name'].'">'.self::$bd['input']['name'].'</label>
                <textarea cols="120" rows="15" name="'.self::$bd['input_name'].'" class="form-control"></textarea>'
                .self::set_helper().
            '</div>';
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


  public function end ( $block = null )
  {
    if( $block == true )
      echo '</fieldset>';
    else
      echo  '</div>';
  }
}