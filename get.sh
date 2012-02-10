#!/bin/sh
# curl get.tcms.me | sh
	echo "*** Installing Tentacle CMS..."

	curl -sL https://github.com/adampatterson/Tentacle/tarball/master | tar -xz --strip-components 1
	
	echo "All done!"

	echo "You can now visit the site in your browser to begin the install"
