<?php
$output = [];
$return_var = '';
exec('git fetch', $output, $return_var);

if ($return_var === 0) {
    echo "Git fetch successful\n";
} else {
    echo "Git fetch failed\n";
    echo "Error: " . implode("\n", $output) . "\n";
}
