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
    <?php
}
