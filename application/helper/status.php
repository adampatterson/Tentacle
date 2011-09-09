<?
function show_403() {
	header("Status: 403");
	// Set Error
}

function show_404() {
	header("HTTP/1.1 404 Not Found");
	// Set Error
}

function show_500() {
	header("Status: 500");
	// Set Error
}
?>