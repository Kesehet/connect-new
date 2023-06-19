<?php 
function executeCommand($command) {
    $output = '';
    $return_var = '';

    // Execute the command
    exec($command, $output, $return_var);

    // Check the return value
    if ($return_var === 0) {
        // Command executed successfully
        return $output;
    } else {
        // Command execution failed
        return false;
    }
}

$result = executeCommand('bash /opt/lampp/htdocs/gconnect/update.sh');
if ($result !== false) {
    echo "Command executed successfully:\n";
    echo implode("\n", $result);
} else {
    echo "Command execution failed.";
}
