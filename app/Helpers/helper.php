<?php



function resource_collection($resource): array
{
    return json_decode($resource->response()->getContent(), true) ?? [];
}


function availableLanguages(){
    return ['en', 'ar','de'];
}

function generate_code_unique() {
    // Generate a random prefix of length 2 using letters
    $prefix = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3);

    // Get the current date in the format "YmdHis" (YearMonthDayHourMinuteSecond)
    $currentDate = date('Ym');

    // Generate a random number between 1000 and 9999
    $randomNumber = mt_rand(10, 99);

    // Combine the prefix, date, and random number to create the code
    $code = $prefix . $currentDate . $randomNumber;

    return $code;
}

