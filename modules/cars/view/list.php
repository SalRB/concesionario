<div id="contenido">
    <div class="container">
        <div class="row">
            <h3>LIST OF CARS</h3>
        </div>
        <div class="row">
            <p><a href="index.php?module=cars&op=create"><img src="https://cdn.donmai.us/sample/9e/78/__cirno_touhou_drawn_by_skullchimes__sample-9e7876948b53640f6be6a63cc0d4f217.jpg" width="5%" height="5%" class="img-fluid"></a></p>
            <p><a href="index.php?module=cars&op=dummies" class="menu-btn" id="dummies" data-tr="Load dummies">Botón de emergancia por culpa del Data Table</a></p>
            <p><a href="index.php?module=cars&op=delete_all" class="menu-btn" id="delete_all" data-tr="Delete all cars"></a></p>
            <table id="list_table" class="border border-primary">
                <!--  class="display hover nowrap order-column row-border cell-border compact stripe" -->
                <thead class="border border-primary">
                    <tr class="border border-primary">
                        <td width=50 class="border border-primary"><b>ID</b></th>
                        <td width=125 class="border border-primary"><b>Plate</b></th>
                        <td width=175 class="border border-primary"><b>Frame number</b></th>
                        <td width=125 class="border border-primary"><b>Release date</b></th>
                        <td width=125 class="border border-primary"><b>Brand</b></th>
                        <td width=125 class="border border-primary"><b>Model</b></th>
                        <td width=125 class="border border-primary"><b>Color</b></th>
                        <td width=300 class="border border-primary"><b>Extras</b></th>
                        <td width=125 class="border border-primary"><b>Capacity</b></th>
                        <td width=125 class="border border-primary"><b>Fuel</b></th>
                        <td width=125 class="border border-primary"><b>Type</b></th>
                        <td width=125 class="border border-primary"><b>Operations</b></th>
                    </tr>
                </thead>
                <tbody class="border border-primary">
                    <?php
                    if ($rdo->num_rows === 0) {
                        echo '<tr>';
                        echo '<td align="center"  colspan="9">NO HAY NINGUN COCHE</td>';
                        echo '</tr>';
                    } else {
                        foreach ($rdo as $row) {
                            echo '<tr>';
                            echo '<td width=50 class="border border-primary">' . $row['ID'] . '</td>';
                            echo '<td width=125 class="border border-secondary">' . $row['plate'] . '</td>';
                            echo '<td width=175 class="border border-secondary">' . $row['frame_number'] . '</td>';
                            echo '<td width=125 class="border border-secondary">' . $row['release_date'] . '</td>';
                            echo '<td width=125 class="border border-secondary">' . $row['brand'] . '</td>';
                            echo '<td width=125 class="border border-secondary">' . $row['model'] . '</td>';
                            echo '<td width=125 class="border border-secondary">' . $row['color'] . '</td>';
                            echo '<td width=300 class="border border-secondary">' . $row['extras'] . '</td>';
                            echo '<td width=125 class="border border-secondary">' . $row['capacity'] . '</td>';
                            echo '<td width=125 class="border border-secondary">' . $row['fuel'] . '</td>';
                            echo '<td width=125 class="border border-secondary">' . $row['type'] . '</td>';
                            echo '<td width=125 class="border border-secondary">';

                            print("<div class='car' id='" . $row['ID'] . "'>Read</div>");  //READ
                            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';


                            // echo '<a class="Button_blue" href="index.php?module=cars&op=read&id=' . $row['ID'] . '">Read</a>';
                            echo '&nbsp;';
                            echo '<a class="Button_green" href="index.php?module=cars&op=update&id=' . $row['ID'] . '">Update</a>';
                            echo '&nbsp;';
                            echo '<a class="Button_red" href="index.php?module=cars&op=delete&id=' . $row['ID'] . '">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal window -->
<section id="modalcontent">
    <div id="details_car" hidden>
        <!-- <div id="details">
            <div id="container">
                ID: <div id="ID"></div></br>
                Plate: <div id="plate"></div></br>
                Frame number: <div id="frame_number"></div></br>
                Release date: <div id="release_date"></div></br>
                Brand: <div id="brand"></div></br>
                Model: <div id="model"></div></br>
                Color: <div id="color"></div></br>
                Extras: <div id="extras"></div></br>
                Capacity: <div id="capacity"></div></br>
                Fuel: <div id="fuel"></div></br>
                Type: <div id="type"></div></br>
            </div>
        </div> -->
    </div>
</section>