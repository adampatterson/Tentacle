(function($){

  function makeSortable()
  {
    $('fieldset').sortable().bind('sortupdate', function() {
//      updateOrderNumbers();
    });
  }


  function updateOrderNumbers()
  {
    $('#blocks fieldset').each(function(){
      $(this).children('.row').each(function(i){
        $(this).children('label.order').html(i+1);
      });
    });
  };


  $(document).ready(function()
  {

    var blocks = {

      _init : function( )
      {
        makeSortable();
      },

      add : function ( $that )
      {
        $repeater = $($that).closest('.repeaters');
        $row_limit = parseInt($repeater.attr('data-block_limit'));
        $row_count = $repeater.children('fieldset').children('div.row').length;

        opt =  {
          that: $that,
          repeater: $repeater,
          row_limit: $row_limit,
          row_count: $row_count
        };

        blocks.createNewField( opt );
//        updateOrderNumbers();
      },

        createNewField : function ( $opt )
        {
          var new_block = $opt.repeater.children('fieldset').children('div.repeater_row').clone(false);
          new_block.attr('class', 'row');
          $opt.repeater.children('fieldset').append(new_block);

          // update names
          new_block.find('[name]').each(function() {
            var name = $(this).attr('name').replace('[999]','['+$opt.row_count+']');
            $(this).attr('name', name);
            $(this).attr('id', name);
            console.log('success?')
          });
        },

      remove : function ( $that ) {
        $row = $($that).closest('.row');

        $row.animate( {'opacity':'0', 'height' : '0px'}, 100,function() {
          $row.remove();
//          updateOrderNumbers();
        });
      }
    }

    // Events
    $('#blocks .repeater').each(function()
    {
      blocks._init(this);
    });

    // add field
    $(document).on('click', '#scaffold .repeaters a#add_block', function(e)
    {
      e.preventDefault();
      blocks.add(this);
    });

    // remove field
    $(document).on('click', '#scaffold .repeaters a.remove_block', function(e)
    {
      e.preventDefault();
      blocks.remove(this);
    });
  });

})(jQuery);