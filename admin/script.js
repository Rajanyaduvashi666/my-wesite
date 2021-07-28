
function deleteData(rid,md)
{
 if (confirm('Are you sure you want to delete this?')) {
      $.ajax({
             url: "ajax.php", 
             method : "GET",
             data: {row_id: rid.mode : md},
             dataType: "text", 
             cache:false,
             success: function(dt)
             {
               var did="tr_" + rid; 
               $('#' + did).remove();
               alert(dt);
             }
      });
  }
}