<?php


// mark job as completed
$stmt1 = $pdo->prepare('INSERT INTO completed(customer, service, booking, notes, staff)
SELECT customer, service, booking, notes, staff
FROM jobs
WHERE booking < CURRENT_DATE()');

$stmt1->execute();


$stmt2 = $pdo->prepare('DELETE FROM jobs WHERE booking < CURRENT_DATE()');
$stmt2->execute();


?>
