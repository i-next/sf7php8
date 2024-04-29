import '../app.js';
import $ from 'jquery';
import '../styles/breeders.css';

$(document).ready(function(){
  let options = {
    pageLength: 10,
    order: [[1, 'asc']],
    columns: [
      {
        name: 'urlPhoto',
        orderable: false,
        data: 'logo'
      },
      {
        name: 'name',
        data: 'name'
      }],
    columnDefs: [
      {
        targets: 0,
        render: function(data, type, row) {
          if(data == ''){
            return '<img src="'+$(".datatables").data('noimg')+'" alt="nologo" class="logo" />'
          }

          return '<img src="'+window.location.origin+'/'+data+'" alt="nologo" class="logo" />'
        }
      },
      {
        targets: 1,
        render: function(data, type, row) {
          let route = '';
          if($(this).DataTable.settings[0].json.admin){
            route = '<a href="/breeder/del/' + row['id'] + '"><i class="bi bi-trash button_action"></i></a>';
          }

          return '<a href="/breeder/' + row['id'] + '">' + data + ' (' + row['quantity'] + ')</a>'+ route;
        }
      },
      {
        "targets": 'no-sort',
        "orderable": false,
      }
    ],
    ajax: {
      url: $(".datatables").data('url'),
      type: 'POST',
      data: {
        filters: {'user_id': { 0: 'null', 1: $(".datatables").data('version')}}
      }
    },
    processing: true,
    serverSide: true

  }
  $('.datatables').DataTable(options);
})
