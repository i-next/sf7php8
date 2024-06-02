import '../app.js';
import $ from 'jquery';
import '../styles/myplants.css'
$(document).ready(function(){
  let columns = [];
  let columnDefs = [];
  function showState(d){

    if(d.finished){

      if(d.harvests && d.harvests.length !== 0){
        return finished;
      }
      if(d.blooms && d.blooms.length !== 0){
        return abandoned+' ('+bloom+')';
      }
      if(d.preblooms && d.preblooms.length !== 0){
        return abandoned+' ('+prebloom+')';
      }
      if(d.growths && d.growths.length !== 0){
        return abandoned+' ('+growths+')';
      }
      return abandoned+' (Germination)';
    }else{
      if(d.harvests && d.harvests.length !== 0){
        return finished;
      }
      if(d.blooms && d.blooms.length !== 0){
        return bloom;
      }
      if(d.preblooms && d.preblooms.length !== 0){
        return prebloom;
      }
      if(d.growths && d.growths.length !== 0){
        return growths;
      }
      return 'Germination';
    }
  }
  if($('.datatables').data('entity') != "all"){

    columns = [
      {
      name: 'actions',
      orderable: false,
      data: 'id'
      },
      {
        name: 'name',
        data: 'my_plants.name'
      },
      {
        name: 'breeder',
        data: 'my_plants.my_seeds.strain.breeder.name'
      },
      {
        name: 'duration',
        data: 'my_plants.duration'
      },
      {
        name: 'started',
        data: 'date_active'
      }
    ];

    columnDefs = [
      {
        targets: 'actions:name',
        render: function(data, type, row){
          //TODO mettre les alt
          return '<span data-state="'+$('.datatables').data('entity')+'" data-id="'+data+'" data-my-plants-id="'+row.my_plants.id+'">' +
            '<i class="bi bi-info-circle-fill button_action myplantsinfo" data-bs-toggle="modal" data-bs-target="#myPlantsInfoModal"></i> '+
            '<i class="bi bi-forward-fill button_action changestate" data-bs-toggle="modal" data-bs-target="#changeStateModal"></i> '
            +'<i class="bi bi-trash3-fill button_action" data-bs-toggle="modal" data-bs-target="#deleteModal"></i></span>'

        }
      },
      {
        targets: 'name:name',
        render: function(data,type,row){
          if ( type === 'display' || type === 'filter' ) {
            let img = '';

            if (row.my_plants.my_seeds.strain.logo != null) {
              img = '<img src="' + window.location.origin + '/' + row.my_plants.my_seeds.strain.logo + '" alt="nologo" class="logo logostrain" /> ';
            }
            if (data == "") {
              return img + row.my_plants.my_seeds.strain.name;
            }
            if (data != row.my_plants.my_seeds.strain.name) {
              return img + data + ' (' + row.my_plants.my_seeds.strain.name + ')';
            }
            return img + data;
          }
          return data;
        }
      },
      {
        targets: 'breeder:name',
        render: function(data,type,row){
          let img = data;

          if(row.my_plants.my_seeds.strain.breeder.logo != null){
            img = '<img src="'+window.location.origin+'/'+row.my_plants.my_seeds.strain.breeder.logo+'" alt="nologo" class="logo" /> ';
          }

          return img;
        }

      },
      {
        targets: 'started:name',
        render: function (data, type, row) {
          let days = ' days';
          if(navigator.language == "fr-FR" || navigator.language == 'fr'){
             days = ' jours'
          }
          let date_active = new Date(data.date);
          let date_now = new Date();
          let Difference_In_Time  = date_now.getTime() - date_active.getTime();
          let Difference_In_Days = Math.round(Difference_In_Time / (1000 * 3600 * 24));
          return date_active.toLocaleDateString(navigator.language)+' ('+Difference_In_Days+days+')'
        }
      }
    ]
  }else{
    columns = [
      {
        name: 'id',
        data: 'id'
      },
      {
        name: 'name',
        data: 'name'
      },
      {
        name: 'breeder',
        data: 'my_seeds.strain.breeder.name'
      },
      {
        name: 'state',
      }
    ];
    columnDefs = [
      {
        targets: 'id:name',
        render: function(data,type,row){
          return '<span data-state="'+$('.datatables').data('entity')+'" data-id="'+data+'" data-my-plants-id="'+data+'">' +
            '<i class="bi bi-info-circle-fill button_action myplantsinfo" data-bs-toggle="modal" data-bs-target="#myPlantsInfoModal"></i> '+
            '<i class="bi bi-forward-fill button_action changestate" data-bs-toggle="modal" data-bs-target="#changeStateModal"></i> '
            +'<i class="bi bi-trash3-fill button_action" data-bs-toggle="modal" data-bs-target="#deleteModal"></i></span>'
        }
      },
      {
        targets: 'state:name',
        className: 'changestate',
        render: function (data,type,row) {
          return showState(row);
        }
      },
      {
        targets: 'name:name',
        render: function (data,type,row){
          let img = '<img src="'+window.location.origin +'/'+$(".datatables").data('noimg')+'" alt="no-logo" class="logo">';
          if(row.my_seeds.strain.logo){
            img = '<img src="'+window.location.origin +'/'+row.my_seeds.strain.logo+'" alt="no-logo" class="logo">';
          }
          return img +' '+ data;
        }
      },{
      targets: 'breeder:name',
        render: function(data,type,row){
          let img = '<img src="'+window.location.origin +'/'+$(".datatables").data('noimg')+'" alt="no-logo" class="logo">';
          if(row.my_seeds.strain.breeder.logo){
            img = '<img src="'+window.location.origin +'/'+row.my_seeds.strain.breeder.logo+'" alt="no-logo" class="logo">';
          }
          return img + ' '+ data;
        }
      }
    ];

  }
  let options = {
    pageLength: 10,
    order: [[1, 'asc']],
    columns: columns,
    columnDefs: columnDefs,
    ajax: {
      url: $(".datatables").data('url'),
      type: 'POST',
      data: {
        entity: $(".datatables").data('entity')
      }
    },
    processing: true,
    serverSide: true,
  };
  let count = parseInt($("#"+$('.datatables').data('entity')+"count").html());
  if(count<11){
    options.searching=false;
    options.paging = false;
    options.info = false;
  }
  let datatablesMyPlants = $('.datatables').DataTable(options);
  DataTable.responsive(datatablesMyPlants);
  $(document).on('show.bs.modal','#changeStateModal', function(e) {
    let idseed = $(e.relatedTarget).parent().data('id');
    let state = $(e.relatedTarget).parent().data('state');
    $.ajax({
      method: 'POST',
      url: '/myplants/changestate',
      data:{id:idseed,state:state},
      success: function (res) {
          $('.modal-body').html(res.form);
          $('.change_plant').on('click',function(){
          $('.modal-body-change').find('form').submit();
        })
      }
    });
  });

  $(document).on('show.bs.modal','#deleteModal', function(e) {
    let idseed = $(e.relatedTarget).parent().data('id');
    let state = $(e.relatedTarget).parent().data('state');
    $.ajax({
      method: 'POST',
      url: '/myplants/delete',
      data:{ idmyplants:idseed,state:state},
      success: function (res) {
        $('.modal-body-delete').html(res.form);
        $('.delete_plant').on('click',function(){
          $(".modal-body").find('form').submit();
        })
      }
    });
  });
  $(document).on('show.bs.modal','#myPlantsInfoModal', function(e) {
    let idseed = $(e.relatedTarget).parent().data('id');
    let state = $(e.relatedTarget).parent().data('state');
    let idplant = $(e.relatedTarget).parent().data('my-plants-id');
    $.ajax({
      method: 'POST',
      url: '/myplants/info',
      data:{ idmyplants:idplant,state:state},
      success: function (res) {
        $('.modal-body-info').html(res.data);
      }
    });
  });
});
