<?php
require_once(__DIR__ . '/crest/crest.php');
require_once(__DIR__ . '/crest/settings.php');

function getAllOvertimes()
{
  $allOvertimes = [];
  $start = 0;

  do {
    $result = CRest::call('crm.item.list', [
      'entityTypeId' => PAYROLL_OVERTIMES_ENTITY_TYPE_ID,
      'start' => $start
    ]);

    $overtimes = $result['result']['items'] ?? [];
    $allOvertimes = array_merge($allOvertimes, $overtimes);

    $start = $result['next'] ?? null;
  } while ($start !== null);

  return $allOvertimes;
}

$overtimes = getAllOvertimes();

return $overtimes;
