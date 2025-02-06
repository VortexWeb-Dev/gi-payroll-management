<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['employeeId'])) {
    $employeeId = $_POST['employeeId'];

    $employees = include('employees.php');
    $employee = null;

    foreach ($employees as $emp) {
        if ($emp['ufCrm33EmployeeId'] == $employeeId) {
            $employee = $emp;
            break;
        }
    }

    if ($employee) {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Payslip for {$employee['NAME']}</title>
            <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js'></script>
        </head>
        <body>
            <div class='container my-5'>
                <div id='payslip' class='card'>
                    <div class='card-header text-center'>
                        <h1>Gi Properties</h1>
                        
                        <p>Hassanicor - No. 202-203, 2nd - Al Barsha 1 - Dubai</p>
                    </div>
                    <div class='card-body'>
                        <form>
                            <h4>Employee Details</h4>
                            <div class='form-group'>
                                <label for='employeeId'>Employee ID:</label>
                                <input type='text' class='form-control' id='employeeId' value='{$employee['ufCrm33EmployeeId']}' disabled>
                            </div>
                            <div class='form-group'>
                                <label for='name'>Name:</label>
                                <input type='text' class='form-control' id='name' value='{$employee['ufCrm33EmployeeName']}' disabled>
                            </div>
                           
                            <h4>Salary Details</h4>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <h4>Earnings</h4>
                                    <div class='form-group'>
                                        <label for='basic'>Basic:</label>
                                        <input type='text' class='form-control' id='basic' value='{$employee['ufCrm33Basic']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='da'>DA (40%):</label>
                                        <input type='text' class='form-control' id='da' value='{$employee['ufCrm33Da']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='hra'>HRA (15%):</label>
                                        <input type='text' class='form-control' id='hra' value='{$employee['ufCrm33Hra']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='conveyance'>Conveyance:</label>
                                        <input type='text' class='form-control' id='conveyance' value='{$employee['ufCrm33Conveyance']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='allowance'>Allowance:</label>
                                        <input type='text' class='form-control' id='allowance' value='{$employee['ufCrm33Allowance']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='medicalAllowance'>Medical Allowance:</label>
                                        <input type='text' class='form-control' id='medicalAllowance' value='{$employee['ufCrm33MedicalAllowance']}' disabled>
                                    </div>
                                </div>                            
                                <div class='col-md-6'>
                                    <h4>Deductions</h4>
                                    <div class='form-group'>
                                        <label for='tds'>TDS:</label>
                                        <input type='text' class='form-control' id='tds' value='{$employee['ufCrm33Tds']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='esi'>ESI:</label>
                                        <input type='text' class='form-control' id='esi' value='{$employee['ufCrm33Esi']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='pf'>PF:</label>
                                        <input type='text' class='form-control' id='pf' value='{$employee['ufCrm33Pf']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='leave'>Leave:</label>
                                        <input type='text' class='form-control' id='leave' value='{$employee['ufCrm33Leave']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='profTax'>Prof. Tax:</label>
                                        <input type='text' class='form-control' id='profTax' value='{$employee['ufCrm33ProfTax']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='labourWelfare'>Labour Welfare:</label>
                                        <input type='text' class='form-control' id='labourWelfare' value='{$employee['ufCrm33LabourWelfare']}' disabled>
                                    </div>
                                </div>                            
                            </div>
                            <div class='form-group'>
                                <label for='salary'>Net Salary:</label>
                                <input type='text' class='form-control' id='salary' value='{$employee['ufCrm33NetSalary']}' disabled>
                            </div>
                        </form>
                    </div>
                    <div class='card-footer text-center'>
                        <button class='btn btn-primary' onclick='downloadCSV()'>Download CSV</button>
                        <button class='btn btn-secondary' onclick='downloadPDF()'>Download PDF</button>
                    </div>
                </div>
            </div>
            <script>
                function downloadCSV() {
                    const data = [
                        ['ID', 'Name', 'Net Salary', 'Basic', 'DA', 'HRA', 'Conveyance', 'Allowance', 'Medical Allowance', 'TDS', 'ESI', 'PF', 'Leave', 'Prof. Tax', 'Labour Welfare'],
                        ['{$employee['ufCrm33EmployeeId']}', '{$employee['ufCrm33EmployeeName']}', '{$employee['ufCrm33NetSalary']}', '{$employee['ufCrm33Basic']}', '{$employee['ufCrm33Da']}', '{$employee['ufCrm33Hra']}', '{$employee['ufCrm33Conveyance']}', '{$employee['ufCrm33Allowance']}', '{$employee['ufCrm33MedicalAllowance']}', '{$employee['ufCrm33Tds']}', '{$employee['ufCrm33Esi']}', '{$employee['ufCrm33Pf']}', '{$employee['ufCrm33Leave']}', '{$employee['ufCrm33ProfTax']}', '{$employee['ufCrm33LabourWelfare']}'],
                    ];

                    let csvContent = 'data:text/csv;charset=utf-8,';
                    data.forEach(row => {
                        csvContent += row.join(',') + '\\r\\n';
                    });

                    const encodedUri = encodeURI(csvContent);
                    const link = document.createElement('a');
                    link.setAttribute('href', encodedUri);
                    link.setAttribute('download', 'payslip for {$employee['ufCrm33EmployeeId']}.csv');
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }

                function downloadPDF() {
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF();
                    
                    doc.setFontSize(18);
                    doc.text('Payslip', 14, 22);
                    doc.setFontSize(12);
                    doc.text('Gi Properties', 14, 30);
                    doc.text('Hassanicor - No. 202-203, 2nd - Al Barsha 1 - Dubai', 14, 36);
                    
                    doc.setFontSize(14);
                    doc.text('Employee Details', 14, 46);
                    doc.setFontSize(12);
                    doc.text('Employee ID: {$employee['ufCrm33EmployeeId']}', 14, 54);
                    doc.text('Name: {$employee['ufCrm33EmployeeName']}', 14, 60);
                    
                    
                    doc.setFontSize(14);
                    doc.text('Salary Details', 14, 76);
                    doc.setFontSize(12);
                    
                    const earnings = [
                        ['Basic', '{$employee['ufCrm33Basic']}'],
                        ['DA (40%)', '{$employee['ufCrm33Da']}'],
                        ['HRA (15%)', '{$employee['ufCrm33Hra']}'],
                        ['Conveyance', '{$employee['ufCrm33Conveyance']}'],
                        ['Allowance', '{$employee['ufCrm33Allowance']}'],
                        ['Medical Allowance', '{$employee['ufCrm33MedicalAllowance']}']
                    ];
                    const deductions = [
                        ['TDS', '{$employee['ufCrm33Tds']}'],
                        ['ESI', '{$employee['ufCrm33Esi']}'],
                        ['PF', '{$employee['ufCrm33Pf']}'],
                        ['Leave', '{$employee['ufCrm33Leave']}'],
                        ['Prof. Tax', '{$employee['ufCrm33ProfTax']}'],
                        ['Labour Welfare', '{$employee['ufCrm33LabourWelfare']}']
                    ];
                    
                    doc.autoTable({
                        head: [['Earnings', 'Amount']],
                        body: earnings,
                        startY: 80,
                        theme: 'grid'
                    });
                    
                    doc.autoTable({
                        head: [['Deductions', 'Amount']],
                        body: deductions,
                        startY: doc.previousAutoTable.finalY + 10,
                        theme: 'grid'
                    });
                    
                    doc.text('Net Salary: {$employee['ufCrm33NetSalary']}', 14, doc.previousAutoTable.finalY + 20);
                    
                    doc.save('payslip for {$employee['ufCrm33EmployeeName']}.pdf');
                }
            </script>
        </body>
        </html>";
    } else {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Employee Not Found</title>
            <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
        </head>
        <body>
            <div class='container mt-5'>
                <div class='alert alert-danger'>
                    <strong>Error:</strong> Employee not found.
                </div>
            </div>
        </body>
        </html>";
    }
} else {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Invalid Request</title>
        <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body>
        <div class='container mt-5'>
            <div class='alert alert-danger'>
                <strong>Error:</strong> Invalid request.
            </div>
        </div>
    </body>
    </html>";
}
