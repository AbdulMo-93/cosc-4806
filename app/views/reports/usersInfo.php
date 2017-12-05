
<div class="row">
    <h2>Users Info</h2>
    <table class="table table-stripped">
        <tbody>
            <?php
            foreach ($data->report() as $report) {
            ?>
                <tr>
                    <td><?= $report['Username'] ?></td>
                    <td><?= $report['Email'] ?></td>
                    <td><?= $report['Time'] ?></td>
                    <td><?= $report['count'] ?></td>
                    <td>
                        <a href="<?=EXPORT  . DS . $report['Username'] 
                                            . DS . $report['Email']
                                            . DS . $report['Time']
                                            . DS . $report['count']?>">Export</a>
                    </td>
                </tr>
        </tbody>
    </table>
</div>