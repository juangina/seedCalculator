
<?php
$differenceMessage = "Total Number of Days to Plant Message.";
$plantingMessage = "Total Number of Days Message.";
$startPlantingMessage = "Last Start Date to Plant Message.";

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['frost_date'] != '') {
        
        $plantingDays = 0;
        $frostDate = $_POST['frost_date'];
        $numberOfDays = $_POST['number_of_days'];

        $date01 = date_create();
        $date02 = date_create($frostDate);
        $dateDifference = date_diff($date01,$date02);
        $plantingDays = $dateDifference->days - $numberOfDays;

        if($plantingDays > 0) {
                $lastPlantingDate = date_add(date_create(), date_interval_create_from_date_string($plantingDays.' days'));
                $differenceMessage = 'You have a total of <strong>' . $dateDifference->days . '</strong> days until the frost date.';
                $plantingMessage = 'You have <strong>' . $plantingDays . '</strong> days to plant your seeds and harvest your crop before the frost begins.';
                $startPlantingMessage = 'You have until <strong>' . date_format($lastPlantingDate, "m-d-Y") . '</strong> to plant your seeds and harvest your crop before the frost begins.';
        } else {
                $plantingMessage = 'You do not have time to plant your seeds and harvest your crop before the frost begins.';
        }
}
?>

<!DOCTYPE html>
<html lang="en">
        <head>
                <title>Seed Starting Calculator</title>
                <style>
                        label, .currentDate {
                                color: purple;
                        }                
                </style>
        </head>
        <body>
                <h2 style="text-align: center;">Seed Starting Calculator</h2>
                <section class="currentDate">
                        <?php echo date("l jS \of F Y") . "<br>"; ?>
                </section>
                <form action="" method="post">
                        <section class="selectDays">
                                <label for="number_of_days">Enter Number of Days (1 to 100):</label>
                                <input id="number_of_days" type="number" name="number_of_days" min="1" max="100" value="55" />
                                <br />                                
                        </section>
                        <section class="selectDate">
                                <label for="frost_date">Enter Frost Date:</label>
                                <input id="frost_date" type="date" name="frost_date">
                                <br />
                         </section>   
                         <input type="submit" value="Calculate">
                </form>
                <?php echo '<p>'.$differenceMessage.'</p>'; ?>
                <?php echo '<p>'.$plantingMessage.'</p>'; ?>
                <?php echo '<p>'.$startPlantingMessage.'</p>'; ?>
                <p style="text-align: center;" style="margin: 0;" style="padding: 0;">
                        <a href="index.php">Reset</a>
                </p>
        <br />
        </body>
</html>