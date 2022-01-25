<?php $cosa = 2; ?>
<div id="contenido">
    <form method="post" name="update_car" id="update_car">
        <h1>Edit car</h1>
        <table border='0'>
            <td>ID: </td>
            <td><input type="text" id="ID" name="ID" placeholder="ID" value="<?php echo $car['ID']; ?>" readonly /></td>
            </tr>
            <tr>
                <td>Plate: </td>
                <td><input type="text" id="plate" name="plate" placeholder="plate" value="<?php echo $car['plate']; ?>" readonly/></td>
                <td>
                    <font color="red">
                        <span id="error_plate" class="error">

                        </span>
                    </font>
                    </font>
                </td>
            </tr>
            <tr>
                <td>Frame number: </td>
                <td><input type="text" id="frame_number" name="frame_number" placeholder="frame_number" value="<?php echo $car['frame_number']; ?>" readonly/></td>
                <td>
                    <font color="red">
                        <span id="error_frame_number" class="error">

                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>Release date: </td>
                <td><input type="text" id="release_date" name="release_date" placeholder="release_date" value="<?php echo $car['release_date']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_release_date" class="error">

                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>Brand: </td>
                <td><input type="text" id="brand" name="brand" placeholder="brand" value="<?php echo $car['brand']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_brand" class="error">

                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>Model: </td>
                <td><input type="text" id="model" name="model" placeholder="model" value="<?php echo $car['model']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_model" class="error">

                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>Color: </td>
                <td><input type="text" id="color" name="color" placeholder="color" value="<?php echo $car['color']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_color" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>Extras: </td>
                <?php
                $ex = explode(":", $car['extras']);
                ?>
                <td>
                    <?php
                    $find = in_array("Tinted glass", $ex);
                    if ($find) {
                    ?>
                        <input type="checkbox" id="extras[]" name="extras[]" placeholder="extras[]" value="Tinted glass" checked />Tinted glass
                    <?php
                    } else {
                    ?>
                        <input type="checkbox" id="extras[]" name="extras[]" placeholder="extras[]" value="Tinted glass" />Tinted glass
                    <?php
                    }
                    ?>
                    <?php
                    $find = in_array("Hyper speakers", $ex);
                    if ($find) {
                    ?>
                        <input type="checkbox" id="extras[]" name="extras[]" placeholder="extras[]" value="Hyper speakers" checked />Hyper speakers
                    <?php
                    } else {
                    ?>
                        <input type="checkbox" id="extras[]" name="extras[]" placeholder="extras[]" value="Hyper speakers" />Hyper speakers
                    <?php
                    }
                    ?>
                </td>
                <td>
                    <font color="red">
                        <span id="error_extras" class="error">

                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>Capacity: </td>
                <td><input type="text" id="capacity" name="capacity" placeholder="capacity" value="<?php echo $car['capacity']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_capacity" class="error">

                        </span>
                    </font>
                    </font>
                </td>
            </tr>


            <tr>
                <td>Fuel: </td>
                <td>
                    <?php
                    if ($car['fuel'] === "Diesel") {
                    ?>
                        <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Diesel" checked />Diesel
                        <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Gasoline" />Gasoline
                        <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Electric" />Electric
                        <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Hybrid" />Hybrid
                    <?php
                    } elseif ($car['fuel'] === "Gasoline") {
                    ?>
                        <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Diesel" />Diesel
                        <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Gasoline" checked />Gasoline
                        <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Electric" />Electric
                        <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Hybrid" />Hybrid
                    <?php
                    } elseif ($car['fuel'] === "Electric") {
                    ?>
                        <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Diesel" />Diesel
                        <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Gasoline" />Gasoline
                        <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Electric" checked />Electric
                        <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Hybrid" />Hybrid
                    <?php
                    } else {
                    ?>
                        <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Diesel" />Diesel
                        <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Gasoline" />Gasoline
                        <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Electric" />Electric
                        <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Hybrid" checked />Hybrid
                    <?php
                    }
                    ?>

                </td>
                <td>

                    <font color="red">
                        <span id="error_fuel" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>Type: </td>
                <td> <?php
                        if ($car['type'] === "Manual") {
                        ?>
                        <input type="radio" id="type" name="type" placeholder="type" value="Manual" checked />Manual
                        <input type="radio" id="type" name="type" placeholder="type" value="Automatic" />Automatic
                    <?php
                        } else {
                    ?>
                        <input type="radio" id="type" name="type" placeholder="type" value="Manual" />Manual
                        <input type="radio" id="type" name="type" placeholder="type" value="Automatic" checked />Automatic
                    <?php
                        }
                    ?>
                </td>
                <td>
                    <font color="red">
                        <span id="error_type" class="error">

                        </span>
                    </font>
                    </font>
                </td>
            </tr>



            <tr>
                <td><input id="update" type="button" name="update" value="update" onclick="validate_js('update')" /></td>
                <td align="right"><a href="index.php?module=cars&op=list">Volver</a></td>
            </tr>
        </table>
    </form>
</div>