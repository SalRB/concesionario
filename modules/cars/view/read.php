<div id="contenido">
    <h1>Car information</h1>
    <p>
    <table border='2'>
        <tr>
            <td>ID: </td>
            <td>
                <?php
                    echo $car['ID'];
                ?>
            </td>
        </tr>
    
        <tr>
            <td>Plate: </td>
            <td>
                <?php
                    echo $car['plate'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Frame number: </td>
            <td>
                <?php
                    echo $car['frame_number'];
                ?>
            </td>
        </tr>

        <tr>
            <td>Release date: </td>
            <td>
                <?php
                    echo $car['release_date'];
                ?>
            </td>
        </tr>

        <tr>
            <td>Brand: </td>
            <td>
                <?php
                    echo $car['brand'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Model: </td>
            <td>
                <?php
                    echo $car['model'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Color: </td>
            <td>
                <?php
                    echo $car['color'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Extras: </td>
            <td>
                <?php
                    echo $car['extras'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Capacity: </td>
            <td>
                <?php
                    echo $car['capacity'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Fuel: </td>
            <td>
                <?php
                    echo $car['fuel'];
                ?>
            </td>
            
        </tr>
        
        <tr>
            <td>Type: </td>
            <td>
                <?php
                    echo $car['type'];
                ?>
            </td>
        </tr>
        
    </table>
    </p>
    <p><a href="index.php?module=cars&op=list">Volver</a></p>
</div>