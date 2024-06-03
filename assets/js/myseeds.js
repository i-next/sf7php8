import '../app.js';
import $ from 'jquery';
import '../styles/myseeds.css';
import '../styles/strains.css';
import TomSelect from 'tom-select';
$(document).ready(function(){


  $('.qtyplus').click(function (e) {
    e.preventDefault();

  });
  $(".plus-seeds").on('click',function(){
    console.log($(this),$(this.data('id')))
  })
  function format(d) {
    if(navigator.language != 'fr-FR' && navigator.language != 'fr' && d.descriptionen != '') {
      return ( d.descriptionen);
    }else{
      return ( d.description);
    }
  }
  let options = {
    responsive: true,
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
        data: 'strain.logo',
        className: 'logostrain',
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
        data: 'strain.auto',
        className: 'logostrain',
      },
      {
        name: 'strain.type',
        data: 'strain.type',
        className: 'logostrain',
      },
      {
        name: 'comment',
        data: 'comment',
        className: 'logostrain',
      }],
    columnDefs: [
      {
        targets: 'actions:name',
        render: function (data, type, row) {

          return '<span data-id="'+data+'">'+
          '<i class="bi bi-eye button_action myplantsinfo" data-bs-toggle="modal" data-bs-target="#mySeedsInfoModal"></i> '+
            '<i class="bi bi-node-plus-fill button_action add-to-germination" title="Germination" data-id='+data+' data-bs-toggle="modal" data-bs-target="#addplantModal"></i> '+
            '<a href="/myseeds/delete/'+data+'"><i class="bi bi-trash button_action"></i></a></span>'
        }
      },{
        targets: 'strain.name:name',
        render: function(data){
          return '<span class="dt-content-name">'+data+'</span>'
        }
      }
      ,
      {
        targets: 'strain.urlPhoto:name',
        render: function(data, type, row) {

          if(data == null){
            return ''
          }
          return '<img src="'+window.location.origin+'/'+data+'" alt="nologo" class="logo logostrain" />'
        }
      },
      {
        targets: 'strain.breeder:name',
        render: function (data, type, row) {
          if(data.url_photo == ''){
            return data;
          }
          return '<img src="'+window.location.origin+'/'+data.logo+'" alt="nologo" class="logo" />';
        }
      },
      {
        targets: 'quantity:name',
        render: function (data, type, row) {
          return '<div class="input-group">\n' +
            /*'                  <span class="input-group-text changemyseeds" data-id="'+row.id+'" data-type="minus">-</span>\n' +*/
            '                  <input type="number" name="qty" class="form-control quantityseeds" value="'+data+'" data-id="'+row.id+'">\n' +
            '<span class="dt-column-order"></span>'+
            /*'                  <span class="input-group-text changemyseeds" data-id="'+row.id+'" data-type="plus">+</span>\n' +*/
            '                </div>'
        }
      },
      {
        targets: 'strain.auto:name',
        render: function (data){
          if (data == true){
            return '<i class="bi bi-patch-check-fill"></i>';
          }
          return '';
        }
      },{
        targets: 'comment:name',
        render: function(data,type,row){
          let val = "";
          if(data != null){
            val = data;
          }
          return '<input type="text" name="comment" class="form-control commentseeds" value="'+val+'" data-id="'+row.id+'">'
        }
      }
    ],
    ajax: {
      url: $(".datatables").data('url'),
      type: 'POST',
      data: {
        /*user_id: 451*/
      }
    },
    processing: true,
    serverSide: true,

  }


  let datatablesMySeeds = $('.datatables').DataTable(options);

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
  datatablesMySeeds.on('change keyup', 'input[name="qty"]', function (e) {
    $.ajax({
      method: 'POST',
      url: '/myseeds/changeqty',
      data: {val:$(this).val(), id: $(this).data('id')},
    }).done(function(qty){
      $(this).val(qty.result);
    });

  });

  $(document).on('show.bs.modal','#addplantModal', function(e) {
    let idseed = $(e.relatedTarget).data('id');
    $.ajax({
      method: 'POST',
      url: '/myplants/add',
      data:{id:idseed},
      success: function (res) {
        $('.modal-body').html(res.form);
        $('.add_plant').on('click',function(){
          $('form[name="my_plants"]').submit();
        })
      }
    });
  });
  datatablesMySeeds.on('change keyup', 'input[name="comment"]', function (e) {
    if($(this).val().length > 3){
      $.ajax({
        method: 'POST',
        url: '/myseeds/changecomment',
        data: {val:$(this).val(), id: $(this).data('id')},
      }).done(function(comment){
        $(this).val(comment.result);
      });
    }

  });
  $(document).on('show.bs.modal','#mySeedsInfoModal', function(e) {
    let idseed = $(e.relatedTarget).parent().data('id');
    $.ajax({
      method: 'POST',
      url: '/myseeds/info',
      data: {idseed:idseed},
      success: function (res){
        $('.modal-body-info').html(res.data);
      }
    })
    console.log(idseed);
  });
});
