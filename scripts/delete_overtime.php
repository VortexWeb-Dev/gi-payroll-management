<?php
require_once('../crest/crest.php');
require_once('../crest/settings.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $result = CRest::call('crm.item.delete', [
        'entityTypeId' => PAYROLL_OVERTIMES_ENTITY_TYPE_ID,
        'id' => $data['deleteOvertimeId']
    ]);

    header('Location: ../payroll.php');
}
