<?php
#############################################################
// BANNER - mostra todas as imagens do diretorio selecionado
#############################################################
//set images directory
$directory = 'images/banner';
try {
    // create slideshow div to be manipulated by the above jquery function
    echo "<div id=\"slideshow\">";
    //iterate through the directory, get images, set the path and echo them in img tags.
    foreach (new DirectoryIterator($directory) as $item) {
        if ($item->isFile()) {
            $path = $directory . "/" . $item;
            echo "<img src=\"" . $path . "\" width='1024px' height='100px' />";
        }
    }
    echo "</div>";
}
//if directory is empty throw an exception.
catch (Exception $exc) {
    echo 'the directory you chose seems to be empty';
}
?>