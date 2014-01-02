<? load::view('admin/partials/header', array('title' => 'Resource', 'assets' => array('sortable')));?>
<div id="wrap">
  <div class="full-content">
    <div id="post-body">
      <div class="row">
        <div class="title pad-right">
          <h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" />Test Page</h1>
        </div>
      </div>
    </div>
    <div class="row">

      <div id="blocks" class="field field_type-repeater" data-field_name="repeater_test" data-field_key="field_525472e84c655" data-field_type="repeater">

        <div class="repeater" data-min_block="0" data-block_limit="5">

          <fieldset class="form-inline">

            <div class="row">
              <label class="order col-md-1" for="field-0">1</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="fields[0]" id="field-0" value="Adam" placeholder="Name">
              </div>
              <div class="remove col-md-1">
                <a class="add_block_after btn btn-xs btn-success" href="#">Add</a> <a class="remove_block btn btn-xs btn-danger " href="#">Remove</a>
              </div>
            </div>

            <div class="row">
              <label class="order col-md-1" for="field-1">2</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="fields[1]" id="field-1" value="Kristi" placeholder="Name">
              </div>
              <div class="remove col-md-1">
                <a class="add_block_after btn btn-xs btn-success" href="#">Add</a> <a class="remove_block btn btn-xs btn-danger " href="#">Remove</a>
              </div>
            </div>

            <div class="row">
              <label class="order col-md-1" for="field-2">3</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="fields[2]" id="field-2" value="Amber" placeholder="Name">
              </div>
              <div class="remove col-md-1">
                <a class="add_block_after btn btn-xs btn-success" href="#">Add</a> <a class="remove_block btn btn-xs btn-danger " href="#">Remove</a>
              </div>
            </div>

            <div class="row">
              <label class="order col-md-1" for="field-3">4</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="fields[3]" id="field-3" value="Aiden" placeholder="Name">
              </div>
              <div class="remove col-md-1">
                <a class="add_block_after btn btn-xs btn-success" href="#">Add</a> <a class="remove_block btn btn-xs btn-danger " href="#">Remove</a>
              </div>
            </div>


            <div class="repeater_row">
              <label class="order col-md-1" for="field-999">1</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="fields[999]" id="field-999" value="" placeholder="Name">
              </div>
              <div class="remove col-md-1">
                <a class="add_block_after btn btn-xs btn-success" href="#">Add</a> <a class="remove_block btn btn-xs btn-danger " href="#">Remove</a>
              </div>
            </div>

          </fieldset>

          <div class="repeater-footer actions row">
            <a href="#" id="add_block" class="add-row-end btn btn-primary">Add Row</a>
          </div>

        </div>

        <style>
          .repeater .repeater_row {
            display: none;
          }
        </style>

      </div>

    </div><!-- .full-content -->
  </div><!-- #wrap -->
  <? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>
