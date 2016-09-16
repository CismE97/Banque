<?php
    delLineBudget($_GET["spage"]);
    echo "<script>document.location.href='".BASE_URL."/budget';</script>";
?>