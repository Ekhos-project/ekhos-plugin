<?php

function ekhos_ids_settings_page()
{
    ?>
    <div id="idsbody">
        <?php
        include_once "pages/header.php";
        include_once "pages/linked.php";
        include_once "pages/character.php";
        include_once "pages/sound.php";
        include_once "pages/settings.php";
        ?>
    </div>
    <script src="<?= plugin_dir_url(__DIR__) . 'assets/scripts/script.js' ?>" type="module"></script>
    <script src="https://unpkg.com/htmx.org@1.9.10" integrity="sha384-D1Kt99CQMDuVetoL1lrYwg5t+9QdHe7NLX/SoJYkXDFfX37iInKRy5xLSi8nO7UC" crossorigin="anonymous"></script>
    <?php
}
