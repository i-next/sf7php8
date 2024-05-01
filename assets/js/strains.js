import '../app.js';
// import $ from 'jquery';
import '../styles/strains.css';

$(document).ready(function(){
  console.log('iii')
  function format(d) {
    if(navigator.language != 'fr-FR' && d.descriptionen != '') {
      return ( d.descriptionen);
    }else{
      return ( d.description);
    }
  }
  let addyourstock = ''
  if(navigator.language != 'fr-FR' && d.descriptionen != '') {
    addyourstock = "Add to your stock";
  }else{
    addyourstock = "Ajouter dans votre stock";
  }
  let options = {
    pageLength: 10,
    order: [[2, 'asc']],
    columns: [
      {
        className: 'view',
        orderable: false,
        data: null,
      },
      {
        name: 'urlPhoto',
        orderable: false,
        data: 'logo'
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
        targets: 0,
        render: function (data,type,row) {
          return '<i class="bi bi-eye button_view" title="Description"></i> <i class="bi bi-bookmark-plus-fill button_add_my_seeds" title="'+addyourstock+'" data_seed_id="'+row.id+'"></i>'
        }
      },
      {
        targets: 1,
        render: function(data, type, row) {
          if(data == ''){
            return '<img src="'+$(".datatables").data('noimg')+'" alt="nologo" class="logo" />'
          }
          return '<img src="'+window.location.origin+'/'+data+'" alt="nologo" class="logo" />'
        }
      },{
        targets: 3,
        render: function(data,type,row){
          if(data == true){
            return '<i class="bi bi-check-circle-fill"></i>';
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
  let datatableStrain = $('.datatables').DataTable(options);

  datatableStrain.on('click', 'i.button_view', function (e) {
    let tr = e.target.closest('tr');
    let row = datatableStrain.row(tr);

    if (row.child.isShown()) {
      // This row is already open - close it
      row.child.hide();
    }
    else {
      $('.details').hide();
      // Open this row
      row.child(format(row.data()),'details').show();
    }
  });
})
