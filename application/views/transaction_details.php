<!-- transaction_details.php -->
<?php foreach ($details as $detail) : ?>
    <tr>
        <td><?= $detail->product_id ?></td>
        <td><?= $detail->name ?></td>
        <td><?= $detail->price ?></td>
        <td><?= $detail->qty ?></td>
    </tr>
<?php endforeach; ?>
