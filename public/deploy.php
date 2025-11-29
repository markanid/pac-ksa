<?php
// filepath: public_html/deploy.php

// Optional: Set a secret for security (also set this in GitHub webhook)
$secret = 'your_secret_token';

// Verify the webhook secret (optional, for extra security)
$headers = getallheaders();
if (isset($headers['X-Hub-Signature']) && $secret !== '') {
    $payload = file_get_contents('php://input');
    $hash = 'sha1=' . hash_hmac('sha1', $payload, $secret);
    if (!hash_equals($headers['X-Hub-Signature'], $hash)) {
        http_response_code(403);
        exit('Invalid signature');
    }
}

// Run the deployment script
shell_exec('/home/apexsoft/lara/deploy.sh > /dev/null 2>&1 &');
echo "Deployment triggered";
?>
