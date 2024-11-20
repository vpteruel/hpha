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
    <title>Travel Expense Reimbursement</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 20px; color: #333;">

    <h2 style="color: #333;">Travel Expense Reimbursement</h2>

    <table width="100%" cellspacing="0" cellpadding="5">
        <td style="width: 50%;">
            <label style="font-weight: bold;">Invoice ID:</label><br>
            <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:576}</div>
        </td>

        <td style="width: 50%;">
            <label style="font-weight: bold;">Department/Cost Centre:</label><br>
            <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:565}</div>
        </td>

    </table>
    <table width="100%" cellspacing="0" cellpadding="5">
        <!-- Requested by and Department/Cost Centre in one row -->
        <tr>
            <td style="width: 50%;">
                <label style="font-weight: bold;">Requested by:</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:193}</div>
            </td>
            <td style="width: 50%;">
                <label style="font-weight: bold;">Requested date:</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:575}</div>
            </td>
        </tr>
        
        <!-- My primary site and KMs to site in one row -->
        <tr>
            <td style="width: 50%;">
                <label style="font-weight: bold;">My primary site is:</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:461}</div>
            </td>
            <td style="width: 50%;">
                <label style="font-weight: bold;">KMs from my home to primary site is:</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:450}</div>
            </td>
        </tr>
    </table>

    <h3 style="color: #333; margin-top: 30px;">Travel Details</h3>
    <table width="100%" cellspacing="0" cellpadding="5">
    <?php
    foreach ( $number_fields as $field ) {
        
        $value = rgar( $entry, $field->id );
        
        if ( $field->id == 23 && $value > 0 ) { ?>
        <!-- Travel Date, From, To, and KMs in one row -->
        <tr>
            <td style="width: 25%;">
                <label style="font-weight: bold;">Travel Date</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:47}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">From</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:506}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">To</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:507}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">KMs</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:13}</div>
            </td>
        </tr>
    <?php } ?>

    <?php
    if ( $field->id == 348 && $value > 0 ) { ?>
        <!-- Travel Date, From, To, and KMs in one row -->
        <tr>
            <td style="width: 25%;">
                <label style="font-weight: bold;">Travel Date</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:54}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">From</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:508}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">To</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:509}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">KMs</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:348}</div>
            </td>
        </tr>
    <?php } ?>

    <?php
    if ( $field->id == 353 && $value > 0 ) { ?>
        <!-- Travel Date, From, To, and KMs in one row -->
        <tr>
            <td style="width: 25%;">
                <label style="font-weight: bold;">Travel Date</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:60}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">From</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:510}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">To</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:511}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">KMs</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:353}</div>
            </td>
        </tr>
    <?php } ?>

    <?php
    if ( $field->id == 357 && $value > 0 ) { ?>
        <!-- Travel Date, From, To, and KMs in one row -->
        <tr>
            <td style="width: 25%;">
                <label style="font-weight: bold;">Travel Date</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:66}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">From</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:512}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">To</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:513}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">KMs</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:357}</div>
            </td>
        </tr>
    <?php } ?>

    <?php
    if ( $field->id == 361 && $value > 0 ) { ?>
        <!-- Travel Date, From, To, and KMs in one row -->
        <tr>
            <td style="width: 25%;">
                <label style="font-weight: bold;">Travel Date</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:72}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">From</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:514}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">To</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:515}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">KMs</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:361}</div>
            </td>
        </tr>
    <?php } ?>

    <?php
    if ( $field->id == 365 && $value > 0 ) { ?>
        <!-- Travel Date, From, To, and KMs in one row -->
        <tr>
            <td style="width: 25%;">
                <label style="font-weight: bold;">Travel Date</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:78}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">From</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:516}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">To</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:517}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">KMs</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:365}</div>
            </td>
        </tr>
    <?php } ?>

    <?php
    if ( $field->id == 369 && $value > 0 ) { ?>
        <!-- Travel Date, From, To, and KMs in one row -->
        <tr>
            <td style="width: 25%;">
                <label style="font-weight: bold;">Travel Date</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:84}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">From</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:518}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">To</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:519}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">KMs</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:369}</div>
            </td>
        </tr>
    <?php } ?>


    <?php
    if ( $field->id == 373 && $value > 0 ) { ?>
        <!-- Travel Date, From, To, and KMs in one row -->
        <tr>
            <td style="width: 25%;">
                <label style="font-weight: bold;">Travel Date</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:90}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">From</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:520}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">To</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:521}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">KMs</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:373}</div>
            </td>
        </tr>
    <?php } ?>

    <?php
    if ( $field->id == 381 && $value > 0 ) { ?>
        <!-- Travel Date, From, To, and KMs in one row -->
        <tr>
            <td style="width: 25%;">
                <label style="font-weight: bold;">Travel Date</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:102}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">From</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:524}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">To</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:525}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">KMs</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:381}</div>
            </td>
        </tr>
    <?php } ?>

    <?php
    if ( $field->id == 385 && $value > 0 ) { ?>
        <!-- Travel Date, From, To, and KMs in one row -->
        <tr>
            <td style="width: 25%;">
                <label style="font-weight: bold;">Travel Date</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:108}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">From</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:526}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">To</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:527}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">KMs</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:385}</div>
            </td>
        </tr>
    <?php } ?>

    <?php
    if ( $field->id == 389 && $value > 0 ) { ?>
        <!-- Travel Date, From, To, and KMs in one row -->
        <tr>
            <td style="width: 25%;">
                <label style="font-weight: bold;">Travel Date</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:114}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">From</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:528}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">To</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:529}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">KMs</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:389}</div>
            </td>
        </tr>
    <?php } ?>

    <?php
    if ( $field->id == 393 && $value > 0 ) { ?>
        <!-- Travel Date, From, To, and KMs in one row -->
        <tr>
            <td style="width: 25%;">
                <label style="font-weight: bold;">Travel Date</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:120}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">From</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:530}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">To</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:531}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">KMs</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:393}</div>
            </td>
        </tr>
    <?php } ?>

    <?php
    if ( $field->id == 397 && $value > 0 ) { ?>
        <!-- Travel Date, From, To, and KMs in one row -->
        <tr>
            <td style="width: 25%;">
                <label style="font-weight: bold;">Travel Date</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:126}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">From</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:532}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">To</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:533}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">KMs</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:397}</div>
            </td>
        </tr>
    <?php } ?>

    <?php if ( $field->id == 401 && $value > 0 ) { ?>
        <tr>
            <td style="width: 25%;">
                <label style="font-weight: bold;">Travel Date</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:132}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">From</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:534}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">To</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:535}</div>
            </td>
            <td style="width: 25%;">
                <label style="font-weight: bold;">KMs</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:401}</div>
            </td>
        </tr>
    <?php } 
    }?>

    </table>

    <div style="margin-bottom: 20px; margin-top: 20px;"></div> <!-- Extra space between rows -->
    
    <table width="100%" cellspacing="0" cellpadding="5">
        <!-- Travel, Other Travel, and Additional Expenses in one row -->
        <tr>
            <td style="width: 33%;">
                <label style="font-weight: bold;">Travel KMs (6240000)</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:23}</div>
            </td>
            <td style="width: 33%;">
                <label style="font-weight: bold;">$ Other Travel (6240000)</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:468}</div>
            </td>
            <td style="width: 33%;">
                <label style="font-weight: bold;">Additional Expenses (6240600)</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:30}</div>
            </td>
        </tr>
    </table>
    
    <h3 style="color: #333; margin-top: 30px;">Total Charge to Account Code(s)</h3>
    
    <table width="100%" cellspacing="0" cellpadding="5">
        <!-- Travel, Other Travel, and Additional Expenses in one row -->
        <tr>
            <td style="width: 33%;">
                <label style="font-weight: bold;">Total Claim</label><br>
                <div style="width: 33%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:167}</div>
        </tr>
    </table>
    <div style="margin-bottom: 20px;"></div>
    <table width="100%" cellspacing="0" cellpadding="5">
        <!-- Travel, Other Travel, and Additional Expenses in one row -->
        <tr>
            <td style="width: 33%;">
                <label style="font-weight: bold;">Travel KMs Account</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:38}</div>
            </td>
            <td style="width: 33%;">
                <label style="font-weight: bold;">$ Amount</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:39}</div>
            </td>
            <td style="width: 33%;">
                <label style="font-weight: bold;">HST</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:41}</div>
            </td>
        </tr>
    </table>
        <table width="100%" cellspacing="0" cellpadding="5">
        <!-- Travel, Other Travel, and Additional Expenses in one row -->
        <tr>
            <td style="width: 33%;">
                <label style="font-weight: bold;">Additional Expenses Account</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:455}</div>
            </td>
            <td style="width: 33%;">
                <label style="font-weight: bold;">$ Amount</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:456}</div>
            </td>
            <td style="width: 33%;">
                <label style="font-weight: bold;">HST</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:458}</div>
            </td>
        </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="5">
        <!-- Travel, Other Travel, and Additional Expenses in one row -->
        <tr>
            <td style="width: 33%;">
                <label style="font-weight: bold;">Other Travel Account</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:42}</div>
            </td>
            <td style="width: 33%;">
                <label style="font-weight: bold;">$ Amount</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:43}</div>
            </td>
            <td style="width: 33%;">
                <label style="font-weight: bold;">HST</label><br>
                <div style="width: 100%; border: 1px solid #ccc; padding: 8px; background-color: #f9f9f9;">{:454}</div>
            </td>
        </tr>
    </table>
</body>
</html>
