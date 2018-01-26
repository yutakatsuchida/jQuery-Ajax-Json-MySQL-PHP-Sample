$( document ).ready(function() {
  var $displayData = $('#displayData');
  var $html = '';

  $.ajax({
    // choose url: dbjson.php or dbjson-pdo.php
    url: "dbjson-pdo.php",
    type: "GET",
    dataType: 'json',
  }).done(function(data){
    data.forEach(function(element){
      $html += `
        <tr>
          <th>${element.id}</th>
          <td>${element.first_name}</td>
          <td>${element.last_name}</td>
          <td>${element.email}</td>
        </tr>
      `;
    });
    $displayData.html($html);
  }).fail(function(){
    $displayData.text('No data. Please refresh the browser.');
  });
});