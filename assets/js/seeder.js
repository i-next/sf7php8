import '../app.js';
import $ from 'jquery';
import '../styles/plants.css';
import '../styles/seeder.css';
$(document).ready(function(){
  $('.datatables').DataTable({
    pageLength: 10,
    order: [[1, 'asc']],
    columns: [
      {
        name: 'urlPhoto',
        orderable: false,
        data: 'url_photo'
      },
      {
        name: 'name',
        data: 'name'
      }/*,
      {
        name: 'name_id',
        data: 'name_id'
      },
      {
        name: 'quantity',
        data: 'quantity'
      }*/],
    columnDefs: [
      {
        targets: 0,
        render: function(data, type, row) {
          return '<img src="'+data+'" alt="nologo" class="logo" />'
        }
      },
      {
        targets: 1,
        render: function(data, type, row) {

          return data  + ' (' + row['quantity'] + ')';
        }
      }
    ],
    ajax: {
      url: $(".datatables").data('url'),
      type: 'POST',
      // dataSrc: 'data',
    },
    processing: true,
    serverSide: true
  });
})
/*
columnDefs: [
      {
        render: (data, type, row) => data  + ' (' + row[3] + ')',
        targets: 'name'
      },
      { visible: false, targets: [3] }
    ],

 */
