<?php

if (isset($params['id'])) {
    $eventId = filter_var($params['id'], FILTER_SANITIZE_NUMBER_INT);
    echo $eventId;
} else {
    http_response_code(400);
    echo "Event ID is required.";
    exit;
}
