#!/bin/sh
# curl get.tcms.me | sh
	echo "*** Installing Tentacle CMS..."

echo "	   _/_/_/_/_/                      _/                          _/
       _/      _/_/    _/_/_/    _/_/_/_/    _/_/_/    _/_/_/  _/    _/_/
      _/    _/_/_/_/  _/    _/    _/      _/    _/  _/        _/  _/_/_/_/
     _/    _/        _/    _/    _/      _/    _/  _/        _/  _/
    _/      _/_/_/  _/    _/      _/_/    _/_/_/    _/_/_/  _/    _/_/_/"

	curl -sL https://github.com/adampatterson/Tentacle/tarball/beta-wip | tar -xz --strip-components 1
	
#	<?php
#	echo shell_exec( 'curl get.tcms.me | sh' );

#	echo '<strong>All done!</strong>';
#	echo '<p>To start the install simply refresh this page to begin.</p>';