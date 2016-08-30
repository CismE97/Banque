<?php
    delExpense($_GET["spage"]);
    echo "<script>document.location.href='".BASE_URL."/dashboard';</script>";
?>