<div class="container">

    <h1>Bank statistics</h1>
    <p class="lead">This page displays reports about the loss / profit of the bank by months, the average deposit
        amount.</p>

    <h2 class="mt-4">Loss / Profit</h2>
    <p>The loss / profit of the bank by months. (Amount of commissions - Amount of accrued interest)</p>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Months</th>
            <th scope="col">Loss</th>
            <th scope="col">Profit</th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($this->loss_profit as $month => $data) : ?>
            <tr>
                <th scope="row"><?= $data['num']; ?></th>
                <td><?= $month; ?></td>
                <td class="text-danger"><?= $data['loss']; ?> USD</td>
                <td class="text-success"><?= $data['profit']; ?> USD</td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>

    <h2 class="mt-4">Average deposit amount</h2>
    <p>Average deposit amount (Amount of deposits / Number of deposits) for age groups.</p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Age-old group</th>
            <th scope="col">Average</th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($this->average_amount as $row) : ?>
            <tr>
                <td><?= $row['year_group']; ?></td>
                <td><?= round($row['deposit_equity'], 2); ?> USD</td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>

</div> <!-- /container -->