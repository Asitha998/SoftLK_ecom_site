<?php

require "connection.php";

    $type_rs = Database::search("SELECT * FROM `type` ");
    $type_num = $type_rs->num_rows;


        for ($x = 0; $x < $type_num; $x++) {
            $type_data = $type_rs->fetch_assoc();

        ?>
            <option value="<?php echo $type_data["id"]; ?>"><?php echo $type_data["type"]; ?></option>
        <?php

        }

?>