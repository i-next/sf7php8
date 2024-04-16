import '../app.js';
import $ from 'jquery';
import '../styles/plants.css';
$(document).ready(function(){
  $('.datatables').DataTable({
    pageLength: -1,
  });
})


