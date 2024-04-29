import '../app.js';
import $ from 'jquery';
import '../styles/myseeds.css';
import '../styles/strains.css';
import TomSelect from 'tom-select';
$(document).ready(function(){

/*  $(".minus-seeds").on('click',function(){
    console.log('toto');
  })*/
  $('.qtyplus').click(function (e) {
    e.preventDefault();
    console.log($(this));
  });
  $(".plus-seeds").on('click',function(){
    console.log($(this),$(this.data('id')))
  })
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
        name: 'actions',
        orderable: false,
        data: 'id'
      },
      {
        name: 'strain.urlPhoto',
        orderable: false,
        data: 'strain.url_photo'
      },
      {
        name: 'strain.name',
        data: 'strain.name'
      },
      {
        name: 'strain.breeder',
        data: 'strain.breeder'
      },
      {
        name: 'quantity',
        data: 'quantity'
      },
      {
        name: 'strain.duration',
        data: 'strain.duration'
      },
      {
        name: 'strain.auto',
        data: 'strain.auto'
      },
      {
        name: 'strain.type',
        data: 'strain.type'
      },
      {
        className: 'view',
        orderable: false,
        data: null,
        defaultContent: '<i class="bi bi-eye button_action"></i>'
      }],
    columnDefs: [
      {
        targets: 0,
        render: function (data, type, row) {
          return '<a href="/myseeds/delete/'+data+'"><i class="bi bi-trash button_action"></i></a>'
        }
      },
      {
        targets: 1,
        render: function(data, type, row) {
          if(data == ''){
            return ''
          }
          return '<img src="'+data+'" alt="nologo" class="logo" />'
        }
      },
      {
        targets: 3,
        render: function (data, type, row) {
          if(data.url_photo == ''){
            return '<img src="'+$(".datatables").data('noimg')+'" alt="nologo" class="logo" /> '+data.name;
          }
          return '<img src="'+data.url_photo+'" alt="nologo" class="logo" /> '+data.name;
        }
      },
      {
        targets: 4,
        render: function (data, type, row) {
          return '<div class="input-group">\n' +
            '                  <span class="input-group-text changemyseeds" data-id="'+row.id+'" data-type="minus">-</span>\n' +
            '                  <input type="text" class="form-control quantityseeds'+row.id+'" value="'+data+'" disabled>\n' +
            '                  <span class="input-group-text changemyseeds" data-id="'+row.id+'" data-type="plus">+</span>\n' +
            '                </div>'

          /*'<div class="">' +
            '<span class="input-group-btn"><button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">-</button></span>'
            + data +
            '<span class="input-group-btn"><button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="plus" data-field="quant[1]">+</button></span>'
            +'</div>';*/
        }
      }
    ],
    ajax: {
      url: $(".datatables").data('url'),
      type: 'POST',
      data: {
        user_id: 451
      }
    },
    processing: true,
    serverSide: true

  }
  let datatablesMySeeds = $('.datatables').DataTable(options);
  datatablesMySeeds.on('click', 'td.view', function (e) {
    let tr = e.target.closest('tr');
    let row = datatablesMySeeds.row(tr);

    if (row.child.isShown()) {
      // This row is already open - close it
      row.child.hide();
    }
    else {
      // Open this row
      row.child(format(row.data().strain)).show();
    }
  });

  $('#my_seeds_strain-ts-control').on('change',function(){
    $('.newseed').hide();
  });
  $('#my_seeds_strain').on('change',function(){

    if($.isNumeric($(this).val()) || $(this).val() == ''){
      $('.newseed').hide();
      $('#my_seeds_newstrain_breeder-ts-label').removeClass('required');
      $('#my_seeds_newstrain_duration').removeAttr('required');
    }else{
      $('.newseed').show();
      $('#my_seeds_newstrain_breeder-ts-label').addClass('required');
      $('#my_seeds_newstrain_duration').prop('required',true);
    }
  });
  $('#my_seeds_newstrain_breeder').on('change',function(){
    if($.isNumeric($(this).val()) || $(this).val() == ''){
      $('.newbreeder').hide();
    }else{
      $('.newbreeder').show();
    }
  });
  $("#my_seeds").submit(function(e){
    $("#my_seeds").addClass('was-validated');
    e.preventDefault();
    e.stopPropagation()
  });
  datatablesMySeeds.on('click', '.changemyseeds', function (e) {
    let mytag = $('.quantityseeds'+$(this).data('id'));
    $.ajax({
      method: 'POST',
      url: '/myseeds/changeqty',
      data: {type:$(this).data('type'), id: $(this).data('id')},
    }).done(function(qty){
      mytag.val(qty.result);
    });

  });

});
