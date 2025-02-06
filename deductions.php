<?php
require_once(__DIR__ . '/crest/crest.php');
require_once(__DIR__ . '/crest/settings.php');

function getAllDeductions()
{
  $allDeductions = [];
  $start = 0;

  do {
    $result = CRest::call('crm.item.list', [
      'entityTypeId' => PAYROLL_DEDUCTIONS_ENTITY_TYPE_ID,
      'start' => $start
    ]);

    $deductions = $result['result']['items'] ?? [];
    $allDeductions = array_merge($allDeductions, $deductions);

    $start = $result['next'] ?? null;
  } while ($start !== null);

  return $allDeductions;
}

$deductions = getAllDeductions();

return $deductions;
