import '../app.js';
import $ from 'jquery';
import '../styles/strains.css';

$(document).ready(function(){
  function format(d) {
    if(navigator.language != 'fr-FR' && d.descriptionen != '') {
      return ( d.descriptionen);
    }else{
      return ( d.description);
    }
  }
  let options = {
    pageLength: 10,
    order: [[2, 'asc']],
    columns: [
      {
        className: 'dt-control',
        orderable: false,
        data: null,
        defaultContent: ''
      },
      {
        name: 'urlPhoto',
        orderable: false,
        data: 'url_photo'
      },
      {
        name: 'name',
        data: 'name'
      },
      {
        name: 'auto',
        data: 'auto'
      },
      {
        name: 'duration',
        data: 'duration'
      },
      {
        name: 'type',
        data: 'type'
      }
      ],
    columnDefs: [
      {
        targets: 1,
        render: function(data, type, row) {
          if(data == ''){
            return '<img src="'+$(".datatables").data('noimg')+'" alt="nologo" class="logo" />'
          }
          return '<img src="'+data+'" alt="nologo" class="logo" />'
        }
      },{
        targets: 3,
        render: function(data,type,row){
          if(data == true){
            return 'Auto';
          }else{
            return '';
          }
        }
      }],
    ajax: {
      url: $(".datatables").data('url'),
      type: 'POST',
      data: {
        filters: {breeder: $(".datatables").data('breederid')}
      }
    },
    processing: true,
    serverSide: true

  }
  let datatableStrain =$('.datatables').DataTable(options);
  datatableStrain.on('click', 'td.dt-control', function (e) {
    let tr = e.target.closest('tr');
    let row = datatableStrain.row(tr);

    if (row.child.isShown()) {
      // This row is already open - close it
      row.child.hide();
    }
    else {
      // Open this row
      row.child(format(row.data())).show();
    }
  });

})
