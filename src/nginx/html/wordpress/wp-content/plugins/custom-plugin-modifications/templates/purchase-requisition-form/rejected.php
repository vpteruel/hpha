<?php
/**
 * Purchase Requisition Form Template.
 *
 * @since  1.0.0
 */
?>

<style>
    body {
        font-family: Arial, sans-serif;
    }
    .container {
        width: 700px;
        margin: 0 auto;
    }
    .header {
        background-color: #f44336;
        color: white;
        padding: 10px;
        text-align: center;
        border-radius: 5px 5px 0 0;
    }
    .content {
        margin: 20px 0;
    }
    .section-title {
        font-weight: bold;
        margin-top: 20px;
    }
    .details-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    .details-table, .details-table th, .details-table td {
        border: 1px solid #ddd;
    }
    .details-table th, .details-table td {
        padding: 10px;
        text-align: left;
    }
    .details-table th {
        background-color: #f2f2f2;
    }
    .link {
        margin-top: 20px;
        text-align: center;
    }
    .link a {
        color: #f44336;
        text-decoration: none;
        font-weight: bold;
    }
</style>

<div class="container">
    <div class="header">
        <h1>Purchase Requisition Rejected</h1>
    </div>
    <div class="content">
        <p>Dear {Requisitioned by:56},</p>
        <p>The following purchase requisition has been rejected:</p>

        <div class="section-title">Basic Information:</div>
        <table class="details-table">
            <tr>
                <th>Date</th>
                <td>{Date:6}</td>
            </tr>
            <tr>
                <th>Type</th>
                <td>{Type:5}</td>
            </tr>
            <tr>
                <th>Site</th>
                <td>{Site:89}</td>
            </tr>
            <tr>
                <th>Department/Cost Centre</th>
                <td>{Department/cost centre:196}</td>
            </tr>
            <tr>
                <th>Tel. ext. #</th>
                <td>{Tel. ext. #:92}</td>
            </tr>
            <tr>
                <th>Suggested supplier</th>
                <td>{Suggested supplier:12}</td>
            </tr>
            <tr>
                <th>Comments</th>
                <td>{Comments:93}</td>
            </tr>
        </table>

        <div class="section-title">Approval Status:</div>
        <table class="details-table">
            <tr>
                <th>Rejected by</th>
                <td>{assignees}</td>
            </tr>
            <tr>
                <th>Note</th>
                <td>{workflow_note}</td>
            </tr>
        </table>

        <div class="section-title">First Item Details:</div>
        <table class="details-table">
            <tr>
                <th>Quantity</th>
                <td>{item1Qty:34}</td>
            </tr>
            <tr>
                <th>Unit of measure</th>
                <td>{item1UnitMeasure:35}</td>
            </tr>
            <tr>
                <th>Vendor's catalogue NO.</th>
                <td>{item1VendorsCatalogueNo:36}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{item1Description:218}</td>
            </tr>
            <tr>
                <th>Unit price</th>
                <td>{item1UnitPrice:72}</td>
            </tr>
            <tr>
                <th>Total amount</th>
                <td>{item1TotalAmount:37}</td>
            </tr>
            <tr>
                <th>EOC/CIP</th>
                <td>{item1Eoc:73}</td>
            </tr>
        </table>

        <div class="link">
            <p>For more details, please <a href="{workflow_entry_url}">click here</a>.</p>
        </div>
    </div>
</div>
