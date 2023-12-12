<?php

function ekhos_ids_settings_page()
{
    ?>
    <div id="idsbody">
        <?php
        include_once "header.php";
        include_once "linked.php";
        include_once "character.php";
        include_once "sound.php";
        include_once "settings.php";
        ?>
    </div>
    <script src="<?= plugin_dir_url(__DIR__) . 'assets/scripts/script.js' ?>" type="module"></script>
    <?php
}
