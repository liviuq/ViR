<?php
require($_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php");

$openapi = \OpenApi\Generator::scan([$_SERVER['DOCUMENT_ROOT']]);

header('Content-Type: application/x-yaml');
echo $openapi->toYaml();