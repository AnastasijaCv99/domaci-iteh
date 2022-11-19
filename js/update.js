function updateTaskChecked(id){
    event.preventDefault();
    let rowId = "#row" + id;
    const checked = $(rowId);
    console.log("nestozaupd");
      
    request = $.ajax({
        url: "handler/updateTaskChecked.php",
        type: "post",
        dataType: "json",
        data: { taskID: id },
        success: function (data) {
            if (data.status == 'success') {
                console.log("cekirano");
                location.reload(true);
            } else if (data.status == 'error') {
                alert("neuspCekirano");
            }
        }});
}

function updateTaskUncheck(id){
    event.preventDefault();
    let rowId = "#row" + id;
    const checked = $(rowId);
    console.log("nestozaupd2");
  
    request = $.ajax({
        url: "handler/updateTaskUnChecked.php",
        type: "post",
        dataType: "json",
        data: { taskID: id },
        success: function (data) {
          if (data.status == 'success') {
            //$('#CheckedTask').prop('checked', false);
            console.log("odcekirano");
            location.reload(true);
          } else if (data.status == 'error') {
            console.log("neuspehOdcek");
          }
      }});
}
      