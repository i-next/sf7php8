<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true,
    ],
    'plants' => [
        'path' => './assets/plants.js',
        'entrypoint' => true,
    ],
    'seeders' => [
        'path' => './assets/seeder.js',
        'entrypoint' => true,
    ],
    'breeders' => [
        'path' => './assets/js/breeders.js',
        'entrypoint' => true,
    ],
    'strains' => [
        'path' => './assets/js/strains.js',
        'entrypoint' => true,
    ],
    'bootstrap' => [
        'version' => '5.3.3',
    ],
    '@popperjs/core' => [
        'version' => '2.11.8',
    ],
    'bootstrap/dist/css/bootstrap.min.css' => [
        'version' => '5.3.3',
        'type' => 'css',
    ],
    'jquery' => [
        'version' => '3.7.1',
    ],
    'apexcharts' => [
        'version' => '3.46.0',
    ],
    'boxicons' => [
        'version' => '2.1.4',
    ],
    'boxicons/css/boxicons.min.css' => [
        'version' => '2.1.4',
        'type' => 'css',
    ],
    'echarts' => [
        'version' => '5.5.0',
    ],
    'tslib' => [
        'version' => '2.6.2',
    ],
    'zrender/lib/zrender.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/util.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/env.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/timsort.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/Eventful.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/Text.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/tool/color.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/Path.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/tool/path.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/matrix.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/vector.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/Transformable.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/Image.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/Group.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/shape/Circle.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/shape/Ellipse.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/shape/Sector.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/shape/Ring.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/shape/Polygon.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/shape/Polyline.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/shape/Rect.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/shape/Line.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/shape/BezierCurve.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/shape/Arc.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/CompoundPath.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/LinearGradient.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/RadialGradient.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/BoundingRect.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/OrientedBoundingRect.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/Point.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/IncrementalDisplayable.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/helper/subPixelOptimize.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/dom.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/helper/parseText.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/WeakMap.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/LRU.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/contain/text.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/canvas/graphic.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/platform.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/contain/polygon.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/PathProxy.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/contain/util.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/curve.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/svg/Painter.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/canvas/Painter.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/event.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/tool/parseSVG.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/tool/parseXML.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/graphic/Displayable.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/core/bbox.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/contain/line.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/contain/quadratic.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/animation/Animator.js' => [
        'version' => '5.5.0',
    ],
    'zrender/lib/tool/morphPath.js' => [
        'version' => '5.5.0',
    ],
    'quill' => [
        'version' => '1.3.7',
    ],
    'simple-datatables' => [
        'version' => '9.0.0',
    ],
    'simple-datatables/dist/style.min.css' => [
        'version' => '9.0.0',
        'type' => 'css',
    ],
    'tinymce' => [
        'version' => '6.8.3',
    ],
    'zrender' => [
        'version' => '5.5.0',
    ],
    'bootstrap-icons/font/bootstrap-icons.min.css' => [
        'version' => '1.11.3',
        'type' => 'css',
    ],
    'datatables.net-dt' => [
        'version' => '2.0.1',
    ],
    'datatables.net' => [
        'version' => '2.0.1',
    ],
    'datatables.net-dt/css/dataTables.dataTables.min.css' => [
        'version' => '2.0.1',
        'type' => 'css',
    ],
    'datatables.net-plugins/i18n/fr-FR.mjs' => [
        'version' => '1.13.6',
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    'tom-select' => [
        'version' => '2.3.1',
    ],
];
