<?php
return [
    // Usar  "php yii message/extract @common/config/i18n.php" para extraer todas las cadenas
    'sourcePath' => '/home/hftomler/web/chipionacity',
    'languages' => ['es-ES'], // Añado el lenguaje español
    'translator' => 'Yii::t',
    'sort' => false,
    'removeUnused' => false,
    'only' => ['*.php'],
    'except' => [
        '.svn',
        '.git',
        '.gitignore',
        '.gitkeep',
        '.hgignore',
        '.hgkeep',
        '/messages',
        '/vendor',
    ],
    'format' => 'php',
    'messagePath' => __DIR__ . DIRECTORY_SEPARATOR . 'messages',
    'overwrite' => true,
];
