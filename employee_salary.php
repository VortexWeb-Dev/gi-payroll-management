<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Salary</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <style>
        .action-btn {
            margin: 0 5px;
        }
    </style>
</head>

<body>
    <div class="mx-5 my-5">
        <h1 class="mb-1">Employee Salary</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Employee Salary</li>
            </ol>
        </nav>
        <div class="row mt-4 mb-3">
            <div class="col-md-8" style="opacity: 0;">
                <form class="form-inline" action="employee_salary.php" method="GET">
                    <label class="my-1 mr-2" for="filterByName">Filter by Name:</label>
                    <input type="number" class="form-control my-1 mr-sm-2" id="filterByName" name="filterByName" placeholder="Enter name">
                    <label class="my-1 mr-2" for="filterByRole">Filter by Role:</label>
                    <select class="custom-select my-1 mr-sm-2" id="filterByRole" name="filterByRole">
                        <option selected>Choose...</option>
                        <option value="Manager">Manager</option>
                        <option value="Developer">Developer</option>
                        <option value="Designer">Designer</option>
                        <option value="Tester">Tester</option>
                    </select>
                    <button type="submit" style="background-color: #0f4a3c; color: white;" class="btn btn-primary my-1">Filter</button>
                </form>
            </div>
            <div class="col-md-4 text-right">
                <button class="btn" style="background-color: #0f4a3c; color: white;" data-toggle="modal" data-target="#addSalaryModal">Add Salary</button>
            </div>
        </div>
        <table id="employeeTable" class="table table-bordered table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Employee ID</th>
                    <!-- <th>Email</th> -->
                    <th>Salary</th>
                    <th>Payslip</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $employees = include('employees.php');

                foreach ($employees as $employee) {


                    echo "<tr>
                        <td>{$employee['ufCrm33EmployeeName']}</td>
                        <td>{$employee['ufCrm33EmployeeId']}</td>
                        
                        <td>{$employee['ufCrm33NetSalary']}</td>
                        <td>
                            <form id='payslipForm{$employee['ufCrm33EmployeeId']}' action='payslip.php' method='POST' target='_blank'>
                                <input type='hidden' name='employeeId' value='{$employee['ufCrm33EmployeeId']}'>
                                <button type='submit' class='btn btn-primary btn-sm action-btn'>Generate Payslip</button>
                            </form>
                            
                        </td>
                        <td>
                            <button class='btn btn-warning btn-sm action-btn edit-btn' data-toggle='modal' data-target='#editEmployeeModal'  data-edit-employee-id='{$employee['id']}'>Edit</button>
                            <button class='btn btn-danger btn-sm action-btn delete-btn' data-toggle='modal' data-target='#deleteEmployeeModal' data-delete-employee-id='{$employee['id']}'>Delete</button>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modals -->
    <div class="modal fade px-2" id="addSalaryModal" tabindex="-1" role="dialog" aria-labelledby="addSalaryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSalaryModalLabel">Add Salary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="salaryForm" method="POST" action='./add_salary.php'>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="employeeId" class="form-label">Employee Name</label>
                                <select class="form-control" id="employeeId" name="employeeId">
                                    <option value="">Select Employee</option>
                                    <?php
                                    require_once(__DIR__ . '/crest/crest.php');

                                    $result = CRest::call('user.get');

                                    // Example PHP code to include employees data
                                    $employees = $result['result'];
                                    foreach ($employees as $employee) : ?>
                                        <option value="<?php echo $employee['ID']; ?>"><?php echo trim($employee['NAME'] . ' ' . $employee['LAST_NAME']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col">
                                <label for="employeeSalary" class="form-label">Net Salary</label>
                                <input type="number" class="form-control" id="employeeSalary" name="employeeSalary" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <h5 class="text-primary">Earnings</h5>
                                <div class="form-group mb-3">
                                    <label for="basic">Basic</label>
                                    <input type="number" class="form-control earnings" id="basic" name="basic">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="da">DA (40%)</label>
                                    <input type="number" class="form-control earnings" id="da" name="da">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="hra">HRA (15%)</label>
                                    <input type="number" class="form-control earnings" id="hra" name="hra">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="conveyance">Conveyance</label>
                                    <input type="number" class="form-control earnings" id="conveyance" name="conveyance">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="allowance">Allowance</label>
                                    <input type="number" class="form-control earnings" id="allowance" name="allowance">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="medical">Medical Allowance</label>
                                    <input type="number" class="form-control earnings" id="medical" name="medical">
                                </div>
                            </div>
                            <div class="col">
                                <h5 class="text-primary">Deductions</h5>
                                <div class="form-group mb-3">
                                    <label for="tds">TDS</label>
                                    <input type="number" class="form-control deductions" id="tds" name="tds">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="esi">ESI</label>
                                    <input type="number" class="form-control deductions" id="esi" name="esi">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="pf">PF</label>
                                    <input type="number" class="form-control deductions" id="pf" name="pf">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="leave">Leave</label>
                                    <input type="number" class="form-control deductions" id="leave" name="leave">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="profTax">Prof. Tax</label>
                                    <input type="number" class="form-control deductions" id="profTax" name="profTax">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="labourWelfare">Labour Welfare</label>
                                    <input type="number" class="form-control deductions" id="labourWelfare" name="labourWelfare">
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" style="background-color: #0f4a3c; color: white;" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editSalaryForm" method="POST" action='./edit_salary.php'>
                        <input type="hidden" id="editEmployeeId" name="editEmployeeId">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="editEmployeeName" class="form-label">Employee Name</label>
                                <input type="text" class="form-control" id="editEmployeeName" name="editEmployeeName" readonly>
                            </div>

                            <div class="col">
                                <label for="editEmployeeSalary" class="form-label">Net Salary</label>
                                <input type="number" class="form-control" id="editEmployeeSalary" name="editEmployeeSalary" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <h5 class="text-primary">Earnings</h5>
                                <div class="form-group mb-3">
                                    <label for="basic">Basic</label>
                                    <input type="number" class="form-control earnings" id="editEmployeeBasic" name="basic">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="da">DA (40%)</label>
                                    <input type="number" class="form-control earnings" id="editEmployeeDa" name="da">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="hra">HRA (15%)</label>
                                    <input type="number" class="form-control earnings" id="editEmployeeHra" name="hra">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="conveyance">Conveyance</label>
                                    <input type="number" class="form-control earnings" id="editEmployeeConveyance" name="conveyance">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="allowance">Allowance</label>
                                    <input type="number" class="form-control earnings" id="editEmployeeAllowance" name="allowance">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="medical">Medical Allowance</label>
                                    <input type="number" class="form-control earnings" id="editEmployeeMedicalAllowance" name="medical">
                                </div>

                            </div>
                            <div class="col">
                                <h5 class="text-primary">Deductions</h5>
                                <div class="form-group mb-3">
                                    <label for="tds">TDS</label>
                                    <input type="number" class="form-control deductions" id="editEmployeeTds" name="tds">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="esi">ESI</label>
                                    <input type="number" class="form-control deductions" id="editEmployeeEsi" name="esi">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="pf">PF</label>
                                    <input type="number" class="form-control deductions" id="editEmployeePf" name="pf">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="leave">Leave</label>
                                    <input type="number" class="form-control deductions" id="editEmployeeLeave" name="leave">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="profTax">Prof. Tax</label>
                                    <input type="number" class="form-control deductions" id="editEmployeeProfTax" name="profTax">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="labourWelfare">Labour Welfare</label>
                                    <input type="number" class="form-control deductions" id="editEmployeeLabourWelfare" name="labourWelfare">
                                </div>

                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" style="background-color: #0f4a3c; color: white;" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="deleteEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteEmployeeModalLabel">Delete Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this employee?
                </div>
                <form class="modal-footer" id="deleteEmployeeForm" method="POST" action="./delete_employee.php">
                    <input type="hidden" id="deleteEmployeeId" name="deleteEmployeeId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </fo>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script>
        // Initialize DataTables
        $(document).ready(function() {
            $('#employeeTable').DataTable();
        });

        $(document).ready(function() {
            $('.edit-btn').click(async function() {
                var editEmployeeId = $(this).data('edit-employee-id');
                console.log(this)

                await fetch('https://gicrm.ae/rest/1945/7mnw3te56u363prw/crm.item.get.json?entityTypeId=1068&id=' + Number(editEmployeeId))
                    .then(response => response.json())
                    .then(data => data.result.item)
                    .then(item => {
                        console.log(item)
                        document.getElementById('editEmployeeName').value = item.ufCrm33EmployeeName;
                        document.getElementById('editEmployeeSalary').value = item.ufCrm33NetSalary;

                        document.getElementById('editEmployeeBasic').value = item.ufCrm33Basic;
                        document.getElementById('editEmployeeTds').value = item.ufCrm33Tds;
                        document.getElementById('editEmployeeDa').value = item.ufCrm33Da;
                        document.getElementById('editEmployeeEsi').value = item.ufCrm33Esi;
                        document.getElementById('editEmployeeHra').value = item.ufCrm33Hra;
                        document.getElementById('editEmployeePf').value = item.ufCrm33Pf;
                        document.getElementById('editEmployeeConveyance').value = item.ufCrm33Conveyance;
                        document.getElementById('editEmployeeLeave').value = item.ufCrm33Leave;
                        document.getElementById('editEmployeeAllowance').value = item.ufCrm33Allowance;
                        document.getElementById('editEmployeeProfTax').value = item.ufCrm33ProfTax;
                        document.getElementById('editEmployeeMedicalAllowance').value = item.ufCrm33MedicalAllowance;
                        document.getElementById('editEmployeeLabourWelfare').value = item.ufCrm33LabourWelfare;

                    })
                    .catch(error => {
                        console.error('Error:', error);
                    })
                $('#editEmployeeId').val(editEmployeeId);
            });

            $('.delete-btn').click(async function() {
                var deleteEmployeeId = $(this).data('delete-employee-id');
                console.log(this)
                $('#deleteEmployeeId').val(deleteEmployeeId);
            });
        });



        // Calculate net salary dynamically
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('salaryForm');
            const earningsFields = form.querySelectorAll('.earnings');
            const deductionsFields = form.querySelectorAll('.deductions');
            const netSalaryField = document.getElementById('employeeSalary');

            // Function to calculate net salary
            function calculateNetSalary() {
                let earningsTotal = 0;
                let deductionsTotal = 0;

                earningsFields.forEach(function(field) {
                    earningsTotal += parseFloat(field.value) || 0;
                });

                deductionsFields.forEach(function(field) {
                    deductionsTotal += parseFloat(field.value) || 0;
                });

                const netSalary = earningsTotal - deductionsTotal;
                netSalaryField.value = netSalary.toFixed(2); // Display net salary with two decimal places
            }

            // Event listeners to recalculate net salary on input change
            earningsFields.forEach(function(field) {
                field.addEventListener('input', calculateNetSalary);
            });

            deductionsFields.forEach(function(field) {
                field.addEventListener('input', calculateNetSalary);
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editSalaryForm');
            const earningsFields = form.querySelectorAll('.earnings');
            const deductionsFields = form.querySelectorAll('.deductions');
            const netSalaryField = document.getElementById('editEmployeeSalary');

            // Function to calculate net salary
            function calculateNetSalary() {
                let earningsTotal = 0;
                let deductionsTotal = 0;

                earningsFields.forEach(function(field) {
                    earningsTotal += parseFloat(field.value) || 0;
                });

                deductionsFields.forEach(function(field) {
                    deductionsTotal += parseFloat(field.value) || 0;
                });

                const netSalary = earningsTotal - deductionsTotal;
                netSalaryField.value = netSalary.toFixed(2); // Display net salary with two decimal places
            }

            // Event listeners to recalculate net salary on input change
            earningsFields.forEach(function(field) {
                field.addEventListener('input', calculateNetSalary);
            });

            deductionsFields.forEach(function(field) {
                field.addEventListener('input', calculateNetSalary);
            });
        });
    </script>
</body>

</html>