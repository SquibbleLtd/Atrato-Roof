<?php

function import_svg_filename($name)
{
    return file_get_contents(get_stylesheet_directory() . "/img/icons/$name.svg");
}
