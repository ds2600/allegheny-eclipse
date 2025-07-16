<?php
// Display rewrite info
echo "Rewrite Test Page\n";
echo "----------------\n";
echo "Requested URL: " . htmlspecialchars($_SERVER['REQUEST_URI']) . "\n";
echo "Query Parameter 'url': " . (isset($_GET['url']) ? htmlspecialchars($_GET['url']) : 'Not set') . "\n";
echo "Full Query String: " . htmlspecialchars($_SERVER['QUERY_STRING']) . "\n";
echo "----------------\n";
?>
