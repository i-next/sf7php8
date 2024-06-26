import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */

import $ from 'jquery';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.min.css';
import 'datatables.net';
import 'datatables.net-dt/css/dataTables.dataTables.min.css';
import './styles/style.css';
import './js/main.js';
import './styles/app.css';
import './styles/header.css';
import 'datatables.net-dt/css/dataTables.dataTables.min.css';
import language from 'datatables.net-plugins/i18n/fr-FR.mjs';

window.jQuery = $;
window.$ = $;
$.extend( $.fn.dataTable.defaults, {
  ...(navigator.language == 'fr-FR' || navigator.language == 'fr') && {language},
  lengthMenu: [10, 25, 50,100, { label: 'All', value: -1 }],
})

window.finished = "Récoltée";
window.abandoned = 'Abandonnée';
window.growths = 'Croissance'
window.prebloom = 'Préfloraison'
window.bloom = 'Floraison'
if(navigator.language != 'fr-FR'  && navigator.language != 'fr'){
  finished = 'Harvested'
  abandoned = 'Abandoned'
  growths = 'Growths'
  prebloom = 'Preflowering'
  bloom = 'Flowering'
}
