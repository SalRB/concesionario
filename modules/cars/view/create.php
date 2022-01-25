<div id="contenido">
    <form method="post" name="create_car" id="create_car">
        <h1>New car</h1>
        <table border='0'>
            <tr>
                <td>Plate: </td>
                <td><input type="text" id="plate" name="plate" placeholder="plate" value="" /></td>
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
                <td><input type="text" id="frame_number" name="frame_number" placeholder="frame_number" value="" /></td>
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
                <td><input type="text" id="release_date" name="release_date" placeholder="release_date" value="" autocomplete="off"/></td>
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
                <td><input type="text" id="brand" name="brand" placeholder="brand" value="" /></td>
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
                <td><input type="text" id="model" name="model" placeholder="model" value="" /></td>
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
                <td><input type="text" id="color" name="color" placeholder="color" value="" /></td>
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
                <td>
                    <input type="checkbox" id= "extras[]" name="extras[]" placeholder= "extras[]" value="Tinted glass"/>Tinted glass
                    <input type="checkbox" id= "extras[]" name="extras[]" placeholder= "extras[]" value="Hyper speakers"/>Hyper speakers
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
                <td><input type="text" id="capacity" name="capacity" placeholder="capacity" value="" /></td>
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
                    <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Diesel" checked/>Diesel
                    <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Gasoline" />Gasoline
                    <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Electric" />Electric
                    <input type="radio" id="fuel" name="fuel" placeholder="fuel" value="Hybrid" />Hybrid
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
                <td>
                    <input type="radio" id="type" name="type" placeholder="type" value="Manual" checked/>Manual
                    <input type="radio" id="type" name="type" placeholder="type" value="Automatic" />Automatic
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
                <td><input type="button" name="create" value="create" onclick="validate_js('create')" /></td>
                <td align="right"><a href="index.php?module=cars&op=list">Volver</a></td>
            </tr>
        </table>
    </form>
</div>