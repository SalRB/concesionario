<div id="contenido">
    <div class="container">
        <div class="row">
            <h3>LOGS</h3>
        </div>
        <div class="row">
            <p><a href="index.php?module=exceptions&op=clear_logs">Clear logs</a></p>
            <p><a href="index.php?module=exceptions&op=error_plus">+1 error</a></p>
            <table>
                <tr>
                    <td width=200><b>Date</b></th>
                    <td width=200><b>Error ID</b></th>
                    <td width=200><b>message</b></th>
                </tr>
                <?php
                if ($rdo->num_rows === 0) {
                    echo '<tr>';
                    echo '<td align="center"  colspan="3">THERE IS NO ERROR</td>';
                    echo '</tr>';
                } else {
                    foreach ($rdo as $row) {
                        echo '<tr>';
                        echo '<td width=200>' . $row['date'] . '</td>';
                        echo '<td width=200>' . $row['code_id'] . '</td>';
                        echo '<td width=200>' . $row['message'] . '</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>