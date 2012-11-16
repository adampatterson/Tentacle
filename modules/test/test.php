<?php
class Test extends Modules {

	public function __init() {
		$this->add_alias("spider_function", "test");
	}

	public function test() {
		return 'Incy Wincy spider climbed up the water spout.';
	}
}

function wincy() {
	echo 'Incy Wincy spider climbed up the water spout.';
}