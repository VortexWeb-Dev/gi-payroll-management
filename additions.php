<?php
require_once(__DIR__ . '/crest/crest.php');
require_once(__DIR__ . '/crest/settings.php');

function getAllAdditions()
{
  $allAdditions = [];
  $start = 0;

  do {
    $result = CRest::call('crm.item.list', [
      'entityTypeId' => PAYROLL_ADDITIONS_ENTITY_TYPE_ID,
      'start' => $start
    ]);

    $additions = $result['result']['items'] ?? [];
    $allAdditions = array_merge($allAdditions, $additions);

    $start = $result['next'] ?? null;
  } while ($start !== null);

  return $allAdditions;
}

$additions = getAllAdditions();

return $additions;
