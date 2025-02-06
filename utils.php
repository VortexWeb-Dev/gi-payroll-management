<?php
function formatDate($date)
{
    $dateTime = new DateTime($date);
    return $dateTime->format('d/m/Y');
}
