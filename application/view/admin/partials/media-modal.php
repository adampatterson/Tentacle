<div id="myModal" class="reveal-modal xlarge">
    <a class="close-reveal-modal">&#215;</a>
    <? load::view ( 'admin/media/insert', array( 'media'=> load::model( 'media' )->get() ) ); ?>
</div>