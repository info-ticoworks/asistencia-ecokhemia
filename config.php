<?php
try {
echo '<script>console.log("Paso 3")</script>';

// echo "Connected successfully";
} catch (Exception $e) {
  log_exception($e);
  echo '<script>console.log("Errorcito")</script>';
}

?>
