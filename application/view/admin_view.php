<p>Admin View</p>

<?
// Load the scaffold, see addressbook page_contact and how the textile class was used
echo $scaffold->constructForm();
echo $scaffold->processThis($data);
echo $scaffold->destructForm();
?>

<hr />
<a href="<?=url::page("front/index/"); ?>">Front</a>