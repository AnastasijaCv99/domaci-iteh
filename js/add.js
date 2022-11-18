$('.checkImp').click(function () { 
    console.log($('.checkImp').val());
    $(this).val() === "1" ? $(this).val("0") : $(this).val("1"); 
    console.log("bilosta");
    console.log($('.checkImp').val());
});


$('.checkUrgent').click(function () { 
    console.log($('.checkUrgent').val());
    $(this).val() === "1" ? $(this).val("0") : $(this).val("1"); 
    console.log("bilosta");
    console.log($('.checkUrgent').val());
});


$("#addTasks").submit(function() {
    
    event.preventDefault();
    console.log("radi");

    const $form = $(this);
    const $inputs = $form.find("input, checkbox, textarea");
    var $data = {};
    $data.taskTitle = $('#title').val();
    $data.taskDescription = $('#disc').val();
    $data.dateDue = $('#date').val();
    $data.taskImportant = $('.checkImp').val();
    $data.taskUrgent = $('.checkUrgent').val();

    const serijalizacija = $inputs.serialize();
    console.log("uspesna serijaz"+serijalizacija);
    console.log($data);

    $.ajax({
        url:"handler/addTasks.php",
        type: "post",
        data: $data,
        dataType: "json",
        success: function (data) {
            if (data.status == 'success') {
                alert("Dodali ste novi task!");
                location.reload(true);
    
            } else if (data.status == 'error') {
                alert(data.status);
            }
        }
    });

//prethodni ajax
    /*$.ajax({
        url:"handler/addTasks.php",
        type: "post",
        data: $data,
    }).done(function(response){
        if(response['success']){
            alert("aaa");
            location.reload(true);
        }
        //alert(response);
    });
*/
   /* request.done(function(response){
        if(response === 'Succ') {
            alert("taks dodat");
            console.log("uspesno");
            location.reload(true);
        } else if(response === "Failed") console.log("nece");
       
    request.fail(function(jqXHR, textStatus, errorThrown){
        console.error("greska" + textStatus, errorThrown)
    });
      
       
    });*/
})