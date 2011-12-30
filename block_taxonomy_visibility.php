/*
    This small snipset permits to show a block according to a taxonomy, and desired terms.
*/
<?php
    $match = FALSE;
    $desired_path = 'elibrarycat';
    $desired_terms = array(3);
    $types = array('elibrary_content' => 1);

    if (arg(0) == 'node' && is_numeric(arg(1))) {
        $nid = arg(1);

        $node = node_load(arg(1));
        $node = node_load($nid);
        $type = $node->type;
        if (isset($types[$type])) {
            $match = TRUE;
        }

    }

    if (substr($_SERVER["REQUEST_URI"], 0, 10) == '/elibrary') { $match = TRUE;}

    if (substr($_SERVER["REQUEST_URI"], 0) == "/node/add/content-petites_annonces") {
        $match = TRUE;
    }

    if (strlen(strstr(substr($_SERVER["REQUEST_URI"], 0),"elibrary"))>0) {
        $match = TRUE;
    }


    if ($_GET['q']) {

        $my_drupal_path = $_GET['q'];

    } else {

        $my_drupal_path = substr($_SERVER['REQUEST_URI'], 1);
    }

    // this will convert a path like node/37 to clean/url/path, if one exists
    $my_path_alias = drupal_get_path_alias($my_drupal_path);


    // check for the the url path component anywhere in the alias
    // change this to $mypathalias == $desired_path to get an exact match instead
    if (stristr($my_path_alias, $desired_path) === TRUE ) {
        $match = TRUE;
    }

    return $match;
?>