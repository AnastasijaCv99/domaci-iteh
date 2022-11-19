//$("#btnObrisi").onclick(function deleteTask() {
function deleteTask(id){
  event.preventDefault();
  let rowId = "#row" + id;
    const checked = $(rowId);
    console.log("nesto");

    request = $.ajax({
      url: "handler/delete.php",
      type: "post",
      dataType: "json",
      data: { taskID: id },
      success: function (data) {
        if (data.status == 'success') {
            alert("Izbrisali ste task!");
        checked.closest("tr").remove();

        } else if (data.status == 'error') {
            alert(data.status);
        }
    }});
}
