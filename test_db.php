<?php
require 'shared/db_config.php';

if ($conn) {
    echo "Conexión exitosa";
} else {
    echo "Error en la conexión";
}
?>
