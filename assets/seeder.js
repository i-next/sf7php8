import './app.js';
import $ from 'jquery';
import language from 'datatables.net-plugins/i18n/fr-FR.mjs';
import './styles/plants.css';
$(document).ready(function(){
  $('.datatables').DataTable({
    language,
    lengthMenu: [10, 25, 50, { label: 'All', value: -1 }],
    pageLength: 50,
  });
})
