import './app.js';
import $ from 'jquery';
import language from 'datatables.net-plugins/i18n/fr-FR.mjs';
import './styles/plants.css';
/*import '@fortawesome/fontawesome-free';
import '@fortawesome/fontawesome-free/css/fontawesome.min.css';*/
$(document).ready(function(){
  $('.datatables').DataTable({
    language,
    lengthMenu: [10, 25, 50, { label: 'All', value: -1 }],
    pageLength: -1,
    columnDefs: [
      {
        targets: -1,
        searchable: false,
        orderable: false
      }
    ]
  });
})

