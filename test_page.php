<?php
/**
 * Test page for the delicious_tags module. If there's a 'url' parameter, it will use the module
 * to look up the top delicious tags for that page
 *
 */

require_once ('delicious_tags.php');

if (isset($_REQUEST['url'])) {
	$url = urldecode($_REQUEST['url']);
} else {
	$url = '';
}
?>
<html>
<head>
<title>Test page for the delicious_tags module</title>
</head>
<body>
<div style="padding:20px;">
<center>
<form method="GET" action="test_page.php">
Enter a URL to see its top Delicious tags: <input type="text" size="40" name="url" value="<?=$url?>"/>
<input type="submit" value="Go"/>
</form>
</center>
</div>
<div>
<?php
if ($url!='') {

    $toptags = get_tags_for_url($url);
    
    if (empty($toptags))
    {
        print 'No tags found for '.htmlspecialchars($url);
    }
    else
    {
        print 'Tags for '.htmlspecialchars($url);
        print '<br>';
        print '<br>';
        foreach ($toptags as $tag => $count)
        {
            print htmlspecialchars($tag).', '.htmlspecialchars($count).' times';
            print '<br>';
        }
    }
}
?>
</div>
</body>
</html>