<?php

if (getenv('PHP_ENV') != "development") {
    echo '{"disabled":true}';
    return;
}

$deployedBuild = file_get_contents("build.txt");
if (isset($_GET["build"])) {
    $deployedBuild = $_GET["build"];
}

for ($i=0; $i<120; $i++) {
    $build = file_get_contents("build.txt");
    if ($build != $deployedBuild) {
        echo '{"reload":true, "build":' . $build . '}';
        return;
    }

    usleep(500000); // 0.5 sec
}

echo '{"reload":false, "build":' . $build . '}';

