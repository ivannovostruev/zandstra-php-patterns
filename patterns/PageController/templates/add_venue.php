<?php
/**
 * @var \patterns\PageController\Request $request
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Venue</title>
</head>
<body>
    <h1>Add venue</h1>
    <table>
        <tr>
            <td><?= $request->getFeedbackToString()?></td>
        </tr>
    </table>
    <form action="AddVenue.php" method="post">
        <input type="hidden" name="submitted" value="yes">
        <input type="text" name="venue_name">
    </form>
</body>
</html>
