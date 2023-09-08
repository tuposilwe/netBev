<!DOCTYPE html>
<html>
<head>
    <title>Quantity and Price Entry Table</title>
</head>
<body>
    <h1>Quantity and Price Entry Table</h1>
    <form action="save_data.php" method="post">
        <table border="1">
            <tr>
                <th>Row</th>
                <th>Quantity</th>
                <th>Quantity Type</th>
                <th>Particulars</th>
                <th>Price</th>
                <th>Amount</th>
            </tr>
            <?php

            for ($i = 1; $i <= 2; $i++) {
                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td><input type="number" name="quantity[]" /></td>';
                echo '<td><input type="text" name="quantity_type[]" /></td>';
                echo '<td><input type="text" name="particulars[]" /></td>';
                echo '<td><input type="number" name="price[]" /></td>';
                echo '<td><input type="text" name="amount[]" readonly /></td>';
                echo '</tr>';
            }

            ?>
        </table>
        <input type="submit" value="Save Data" />
    </form>
</body>
</html>
