<?php
/**
 * Personal Expense Reimbursement Form Template.
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
        background-color: #388e3c;
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
    .link {
        margin-top: 20px;
        text-align: center;
    }
    .link a {
        color: #388e3c;
        text-decoration: none;
        font-weight: bold;
    }
</style>

<div class="container">
    <div class="header">
        <h1>Travel Expense Reimbursement Approved</h1>
    </div>
    <div class="content">
        <p>The following travel expense reimbursement has been approved. Below are the details:</p>

        <div class="section-title">Basic Information:</div>
        <table class="details-table">
            <tr>
                <th>Requested by</th>
                <td>{Requested by:193}</td>
            </tr>
            <tr>
                <th>Requested Date</th>
                <td>{Requested Date:575}</td>
            </tr>
            <tr>
                <th>Department/Cost Centre</th>
                <td>{Department/cost centre:565}</td>
            </tr>
            <tr>
                <th>Total Claim</th>
                <td>{$ Total Claim:167}</td>
            </tr>
        </table>
    </div>
</div>
        
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
