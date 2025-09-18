<?php

$e = [
    'TELEGRAM_BOT_TOKEN_FOR_BACKWORD' => env('TELEGRAM_BOT_TOKEN_FOR_BACKWORD', ''),
    'user_ids' => []];

foreach (range(1, 10) as $i) {
    $e['user_ids'][] = env('TELEGRAM_ID_' . $i, '');
}

return $e;
