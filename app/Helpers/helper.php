<?php

function getFileUrl($image, $directory)
{
    $extension = $image->extension();
    $newName = rand(100000, 50000000) . "." . $extension;
    $image->move($directory, $newName);
    return $directory . $newName;
};
