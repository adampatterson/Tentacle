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

      <div id="blocks" class="field field_type-repeater">

        <div class="repeater" data-min_block="0" data-block_limit="5">

          <fieldset>

            <div class="repeater_row">
              <div class="col-md-12">
                <label class="order" for="field-999">First Name</label>
                <input type="text" class="form-control" name="fields[999]" id="field-999" value="" placeholder="Name">
              </div>
              <div class="col-md-12">
                <label class="order" for="field-999">Last Name</label>
                <input type="text" class="form-control" name="fields[999]" id="field-999" value="" placeholder="Name">
              </div>
              <div class="remove col-md-2">
                <a class="add_block_after btn btn-xs btn-success" href="#">Add</a> <a class="remove_block btn btn-xs btn-danger " href="#">Remove</a>
              </div>
            </div>


            <div class="row">
              <div class="col-md-12">
                <label class="order" for="field-12">First Name</label>
                <input type="text" class="form-control" name="fields[0]" id="field-0" value="Adam" placeholder="Name">
              </div>
              <div class="col-md-12">
                <label class="order" for="field-12">Last Name</label>
                <input type="text" class="form-control" name="fields[0]" id="field-0" value="Adam" placeholder="Name">
              </div>
              <div class="remove col-md-2">
                <a class="add_block_after btn btn-xs btn-success" href="#">Add</a> <a class="remove_block btn btn-xs btn-danger " href="#">Remove</a>
              </div>
              <div class="clearfix"></div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <label class="order" for="field-1">Name</label>
                <input type="text" class="form-control" name="fields[1]" id="field-1" value="Kristi" placeholder="Name">
              </div>
              <div class="col-md-12">
                <label class="order" for="field-1">Name</label>
                <input type="text" class="form-control" name="fields[1]" id="field-1" value="Kristi" placeholder="Name">
              </div>
              <div class="remove col-md-2">
                <a class="add_block_after btn btn-xs btn-success" href="#">Add</a> <a class="remove_block btn btn-xs btn-danger " href="#">Remove</a>
              </div>
              <div class="clearfix"></div>
            </div>

          </fieldset>

          <div class="repeater-footer actions row">
            <a href="#" id="add_block" class="add-row-end btn btn-primary">Add Row</a>
          </div>

        </div>

      </div>

    </div><!-- .full-content -->
  </div><!-- #wrap -->
  <? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>
