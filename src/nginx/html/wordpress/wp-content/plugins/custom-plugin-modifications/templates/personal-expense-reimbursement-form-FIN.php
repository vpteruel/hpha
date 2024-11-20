<?php
/**
 * Purchase Requisition Form Template.
 *
 * @since  1.0.0
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Personal Expense Reimbursement</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 20px; color: #333;">

    <h2 style="color: #333;">Personal Expense Reimbursement</h2>
    
    <table width="100%" cellspacing="0" cellpadding="5">
        <!-- Requested by and Department/Cost Centre in one row -->
        <tr>
            <td style="width: 50%;">
                <label style="font-weight: bold;">Invoice ID:</label><br>
                <div style="width: 50%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:640}</div>
            </td>
        </tr>
        <tr>
            <td style="width: 50%;">
                <label style="font-weight: bold;">Requested by:</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:193}</div>
            </td>
            <td style="width: 50%;">
                <label style="font-weight: bold;">Request Date:</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:575}</div>
            </td>
        </tr>
        
        <!-- My primary site and KMs to site in one row -->
        <tr>
            <td style="width: 50%;">
                <label style="font-weight: bold;">Amount:</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:423}</div>
            </td>
            <td style="width: 50%;">
                <label style="font-weight: bold;">Department/Cost Centre</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:565}</div>
            </td>
        </tr>
    </table>

    <h3 style="color: #333; margin-top: 30px;"></h3>
    <table width="100%" cellspacing="0" cellpadding="5">
        <!-- Travel Date, From, To, and KMs in one row -->
    <tr>
        <td style="width: 25%;">
            <label style="font-weight: bold;">Account #</label><br>
            <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:429}</div>
        </td>
        <td style="width: 25%;">
            <label style="font-weight: bold;">EOC</label><br>
            <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:579}</div>
        </td>
        <td style="width: 25%;">
            <label style="font-weight: bold;">Amount</label><br>
            <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:428}</div>
        </td>
        <td style="width: 25%;">
            <label style="font-weight: bold;">HST</label><br>
            <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:435}</div>
        </td>
    </tr>
</body>
</html>
