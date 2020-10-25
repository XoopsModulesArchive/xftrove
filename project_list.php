<?php

if ('yes' == $projlookup) {
    $projlookup = true;

    require_once '../../mainfile.php';
} else {
    $projlookup = false;

    include 'header.php';
}

require_once XOOPS_ROOT_PATH . '/modules/xfmod/include/pre.php';
require_once XOOPS_ROOT_PATH . '/modules/xfmod/include/vars.php';
require_once XOOPS_ROOT_PATH . '/modules/xfmod/include/trove.php';
require_once XOOPS_ROOT_PATH . '/modules/xftrove/include/listlib.php';
$GLOBALS['xoopsOption']['template_main'] = 'xftrove_project_list.html';

if (!$projlookup) {
    $metaTitle = ': Project Search';

    require_once XOOPS_ROOT_PATH . '/header.php';
} else {
    // Include the right headers, without drawing the entire theme.

    xoops_header(false);

    $currenttheme = getTheme();

    require XOOPS_ROOT_PATH . '/themes/' . $currenttheme . '/theme.php';

    if (file_exists(XOOPS_ROOT_PATH . '/themes/' . $currenttheme . '/language/lang-' . $xoopsConfig['language'] . '.php')) {
        require XOOPS_ROOT_PATH . '/themes/' . $currenttheme . '/language/lang-' . $xoopsConfig['language'] . '.php';
    } elseif (file_exists(XOOPS_ROOT_PATH . '/themes/' . $currenttheme . '/language/lang-english.php')) {
        require XOOPS_ROOT_PATH . '/themes/' . $currenttheme . '/language/lang-english.php';
    }
}

if ('^' == mb_substr($startswith, 0, 1)) {
    $startswith = mb_substr($startswith, 1);
}

if (!isset($range)) {
    $range = 10;
}

if ($range > 100) {
    $range = 100;
}

if (!isset($offset)) {
    $offset = 0;
}

if (!isset($firsttimeonpage)) {
    $descriptiondetail = 'on';

    $firsttimeonpage = '';
}

if (!$projlookup) {
    $xoopsTpl->assign(
        'displayProjectListHeader',
        displayProjectListHeader($startswith, $contains, $range, $offset, $projlookup, $trovedetail, $descriptiondetail, $firsttimeonpage)
    );
} else {
    echo displayProjectListHeader($startswith, $contains, $range, $offset, $projlookup, $trovedetail, $descriptiondetail, $firsttimeonpage);
}
if ($startswith) {
    $startswith = '^' . $startswith;
} elseif ($contains) {
    $startswith = $contains;
}

if (!$projlookup) {
    $xoopsTpl->assign(
        'displayProjectListNav',
        displayProjectListNav($startswith, $offset, $range, $projlookup, $trovedetail, $descriptiondetail)
    );

    $xoopsTpl->assign(
        'displayProjectList',
        displayProjectList($startswith, $offset, $range, $projlookup, $trovedetail, $descriptiondetail)
    );

    require_once XOOPS_ROOT_PATH . '/footer.php';
} else {
    echo displayProjectListNav($startswith, $offset, $range, $projlookup, $trovedetail, $descriptiondetail);

    echo displayProjectList($startswith, $offset, $range, $projlookup, $trovedetail, $descriptiondetail);
}
