<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedCountry = $_POST['country'];
    $selectedrovince = $_POST['province'];
    echo "Selected Country: " . $selectedCountry . " - Selected Province: " . $selectedrovince;
} else {
    echo "Error: Invalid request";
}