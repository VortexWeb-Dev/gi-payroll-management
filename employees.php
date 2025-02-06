<?php
require_once(__DIR__ . '/crest/crest.php');
require_once(__DIR__ . '/crest/settings.php');

function getAllEmployeeSalaries()
{
    $allEmployees = [];
    $start = 0;

    do {
        $result = CRest::call('crm.item.list', [
            'entityTypeId' => EMPLOYEE_SALARY_ENTITY_TYPE_ID,
            'start' => $start
        ]);

        $employees = $result['result']['items'] ?? [];
        $allEmployees = array_merge($allEmployees, $employees);

        $start = $result['next'] ?? null;
    } while ($start !== null);

    return $allEmployees;
}

$employees = getAllEmployeeSalaries();

return $employees;
