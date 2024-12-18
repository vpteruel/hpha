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
        background-color: #f9a825;
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
        color: #f9a825;
        text-decoration: none;
        font-weight: bold;
    }
    .timeline {
        list-style: none;
        padding: 0;
        margin: 20px 0;
    }
    .timeline li {
        position: relative;
        margin-bottom: 20px;
        padding-left: 30px;
    }
    .timeline li:before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 10px;
        height: 10px;
        background-color: #4caf50;
        border-radius: 50%;
    }
</style>

<div class="container">
    <div class="header">
        <h1>Purchase Requisition Not Authorized</h1>
    </div>
    <div class="content">
        <p>You are not authorized for purchases over $1,000. To continue this purchase, ask your manager to submit the purchase requisition. Below are the details:</p>

        <div class="section-title">Basic Information:</div>
        <table class="details-table">
            <tr>
                <th>PR#</th>
                <td>{entry_id}</td>
            </tr>
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
                <th>Requisitioned by</th>
                <td>{Requisitioned by:56}</td>
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

        <div class="section-title">Requested Items:</div>
    </div>
</div>

<table class="details-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Quantity</th>
            <th>Unit of Measure</th>
            <th>Vendor's Catalogue No.</th>
            <th>Description</th>
            <th>Unit Price</th>
            <th>Total Amount</th>
            <th>EOC/CIP</th>
        </tr>
    </thead>
    <tbody>
        <tr class="odd">
            <td>1</td>
            <td>{item1Qty:34}</td>
            <td>{item1UnitMeasure:35}</td>
            <td>{item1VendorsCatalogueNo:36}</td>
            <td>{item1Description:218}</td>
            <td>{item1UnitPrice:72}</td>
            <td>{item1TotalAmount:37}</td>
            <td>{item1Eoc:73}</td>
        </tr>
<?php
    foreach ( $number_fields as $field ) {
        
        $value = rgar( $entry, $field->id );
        
        if ( $field->id == 42 && $value >= 0 ) { ?>
            <tr class="even">
                <td>2</td>
                <td>{item2Qty:39}</td>
                <td>{item2UnitMeasure:40}</td>
                <td>{item2VendorsCatalogueNo:74}</td>
                <td>{item2Description:219}</td>
                <td>{item2UnitPrice:75}</td>
                <td>{item2TotalAmount:42}</td>
                <td>{item2Eoc:76}</td>
            </tr>
        <?php }

        if ( $field->id == 46 && $value >= 0 ) { ?>
            <tr class="odd">
                <td>3</td>
                <td>{item3Qty:43}</td>
                <td>{item3UnitMeasure:44}</td>
                <td>{item3VendorsCatalogueNo:78}</td>
                <td>{item3Description:220}</td>
                <td>{item3UnitPrice:81}</td>
                <td>{item3TotalAmount:46}</td>
                <td>{item3Eoc:82}</td>
            </tr>
        <?php }

        if ( $field->id == 50 && $value >= 0 ) { ?>
            <tr class="even">
                <td>4</td>
                <td>{item4Qty:47}</td>
                <td>{item4UnitMeasure:48}</td>
                <td>{item4VendorsCatalogueNo:79}</td>
                <td>{item4Description:221}</td>
                <td>{item4UnitPrice:85}</td>
                <td>{item4TotalAmount:50}</td>
                <td>{item4Eoc:83}</td>
            </tr>
        <?php }

        if ( $field->id == 54 && $value >= 0 ) { ?>
            <tr class="odd">
                <td>5</td>
                <td>{item5Qty:51}</td>
                <td>{item5UnitMeasure:52}</td>
                <td>{item5VendorsCatalogueNo:80}</td>
                <td>{item5Description:222}</td>
                <td>{item5UnitPrice:86}</td>
                <td>{item5TotalAmount:54}</td>
                <td>{item5Eoc:84}</td>
            </tr>
        <?php }

        if ( $field->id == 110 && $value >= 0 ) { ?>
            <tr class="even">
                <td>6</td>
                <td>{item6Qty:105}</td>
                <td>{item6UnitMeasure:106}</td>
                <td>{item6VendorsCatalogueNo:107}</td>
                <td>{item6Description:223}</td>
                <td>{item6UnitPrice:109}</td>
                <td>{item6TotalAmount:110}</td>
                <td>{item6Eoc:111}</td>
            </tr>
        <?php }

        if ( $field->id == 119 && $value >= 0 ) { ?>
            <tr class="odd">
                <td>7</td>
                <td>{item7Qty:114}</td>
                <td>{item7UnitMeasure:115}</td>
                <td>{item7VendorsCatalogueNo:116}</td>
                <td>{item7Description:224}</td>
                <td>{item7UnitPrice:118}</td>
                <td>{item7TotalAmount:119}</td>
                <td>{item7Eoc:120}</td>
            </tr>
        <?php }

        if ( $field->id == 130 && $value >= 0 ) { ?>
            <tr class="even">
                <td>8</td>
                <td>{item8Qty:125}</td>
                <td>{item8UnitMeasure:126}</td>
                <td>{item8VendorsCatalogueNo:127}</td>
                <td>{item8Description:225}</td>
                <td>{item8UnitPrice:129}</td>
                <td>{item8TotalAmount:130}</td>
                <td>{item8Eoc:131}</td>
            </tr>
        <?php }

        if ( $field->id == 139 && $value >= 0 ) { ?>
            <tr class="odd">
                <td>9</td>
                <td>{item9Qty:134}</td>
                <td>{item9UnitMeasure:135}</td>
                <td>{item9VendorsCatalogueNo:136}</td>
                <td>{item9Description:226}</td>
                <td>{item9UnitPrice:138}</td>
                <td>{item9TotalAmount:139}</td>
                <td>{item9Eoc:140}</td>
            </tr>
        <?php }

        if ( $field->id == 148 && $value >= 0 ) { ?>
            <tr class="even">
                <td>10</td>
                <td>{item10Qty:143}</td>
                <td>{item10UnitMeasure:144}</td>
                <td>{item10VendorsCatalogueNo:145}</td>
                <td>{item10Description:227}</td>
                <td>{item10UnitPrice:147}</td>
                <td>{item10TotalAmount:148}</td>
                <td>{item10Eoc:149}</td>
            </tr>
        <?php }

        if ( $field->id == 157 && $value >= 0 ) { ?>
            <tr class="odd">
                <td>11</td>
                <td>{item11Qty:152}</td>
                <td>{item11UnitMeasure:153}</td>
                <td>{item11VendorsCatalogueNo:154}</td>
                <td>{item11Description:228}</td>
                <td>{item11UnitPrice:156}</td>
                <td>{item11TotalAmount:157}</td>
                <td>{item11Eoc:158}</td>
            </tr>
        <?php }

        if ( $field->id == 166 && $value >= 0 ) { ?>
            <tr class="even">
                <td>12</td>
                <td>{item12Qty:161}</td>
                <td>{item12UnitMeasure:162}</td>
                <td>{item12VendorsCatalogueNo:163}</td>
                <td>{item12Description:229}</td>
                <td>{item12UnitPrice:165}</td>
                <td>{item12TotalAmount:166}</td>
                <td>{item12Eoc:167}</td>
            </tr>
        <?php }

        if ( $field->id == 175 && $value >= 0 ) { ?>
            <tr class="odd">
                <td>13</td>
                <td>{item13Qty:170}</td>
                <td>{item13UnitMeasure:171}</td>
                <td>{item13VendorsCatalogueNo:172}</td>
                <td>{item13Description:230}</td>
                <td>{item13UnitPrice:174}</td>
                <td>{item13TotalAmount:175}</td>
                <td>{item13Eoc:176}</td>
            </tr>
        <?php }

        if ( $field->id == 184 && $value >= 0 ) { ?>
            <tr class="even">
                <td>14</td>
                <td>{item14Qty:179}</td>
                <td>{item14UnitMeasure:180}</td>
                <td>{item14VendorsCatalogueNo:181}</td>
                <td>{item14Description:231}</td>
                <td>{item14UnitPrice:183}</td>
                <td>{item14TotalAmount:184}</td>
                <td>{item14Eoc:185}</td>
            </tr>
        <?php }

        if ( $field->id == 193 && $value >= 0 ) { ?>
            <tr class="odd">
                <td>15</td>
                <td>{item15Qty:188}</td>
                <td>{item15UnitMeasure:189}</td>
                <td>{item15VendorsCatalogueNo:190}</td>
                <td>{item15Description:232}</td>
                <td>{item15UnitPrice:192}</td>
                <td>{item15TotalAmount:193}</td>
                <td>{item15Eoc:194}</td>
            </tr>
        <?php }
    }
?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>TOTAL SUM</td>
            <td>{Total sum:4}</td>
            <td></td>
        </tr>
    </tbody>
</table>

<div class="container">
    <div class="content">
        <div class="section-title">Approval Timeline:</div>
        <ul class="timeline">
<?php
    $timeline = explode( '<br />', $workflow_timeline );
    for ( $i = 0; $i < count( $timeline ); $i++ ) {
        $timeline_item = trim( $timeline[$i] );

        if ( str_starts_with( $timeline_item, 'Outgoing Webhook:')
            || str_starts_with( $timeline_item, 'Webhook sent. URL:' ) ) {
            continue;
        }

        if ( !empty( $timeline_item ) ) {
            write_debug_log( $timeline_item );

            $position = $i % 2 == 0 ? 'even' : 'odd';

            $status_pattern = '/^(.*? - .*?):\s*(Approved|Rejected)$/i';
            $name_date_time_pattern = '/^(.*?):\s*(\w+ \d{1,2}, \d{4} at \d{1,2}:\d{1,2} (?:am|pm))$/i';
            $note_pattern = '/^Note:\s*(.*)$/';
            
            if ( preg_match( $name_date_time_pattern, $timeline_item, $matches1 ) ) {
                $name = htmlspecialchars( $matches1[1], ENT_QUOTES, 'UTF-8' );
                $date_time = htmlspecialchars( $matches1[2], ENT_QUOTES, 'UTF-8' );
                
                if ( $i > 0 ) {
                    echo '</li>';
                }
                echo '<li>';
                echo '<strong>' . $name . '</strong><br>';
                echo '<span>Date: ' . $date_time . '</span><br>';
            }
            else if ( preg_match( $status_pattern, $timeline_item, $matches2 ) ) {
                $prefix = htmlspecialchars( $matches2[1], ENT_QUOTES, 'UTF-8' );
                $status = htmlspecialchars( $matches2[2], ENT_QUOTES, 'UTF-8' );
                $class_status = strtolower( $matches2[2] );

                echo '<span>Status: ' . $prefix . ' - ' . $status . '</span><br>';
            }
            else if ( preg_match( $note_pattern, $timeline_item, $matches3 ) ) {
                $note = htmlspecialchars( $matches3[1], ENT_QUOTES, 'UTF-8' );

                if ( !empty( $note ) ) {
                    echo '<br><em>Note:</em> ' . $note;
                }
            }
            else {
                echo $timeline_item;
            }

            if ( $i == ( count( $timeline ) - 1 ) ) {
                echo '</li>';
            }
        }
    }    
?>
        </ul>

        <div class="link">
            <p>For more details, please <a href="{workflow_entry_url}">click here</a>.</p>
        </div>
    </div>
</div>
