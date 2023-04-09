<?php 

$date1 = date_create('2023-03-07');
$date2 = date_create('2023-04-07');
$diff = date_diff($date1, $date2);

if ($diff->y > 0) {
    echo $diff->y . ' year' . ($diff->y > 1 ? 's' : '');
} else if ($diff->m > 0) {
    echo $diff->m . ' month' . ($diff->m > 1 ? 's' : '');
} else if ($diff->d > 0) {
    echo $diff->d . ' day' . ($diff->d > 1 ? 's' : '');
} else {
    echo '0 days';
}
