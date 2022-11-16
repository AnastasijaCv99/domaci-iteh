$("#addTasks").submit(function() {
    event.preventDefault();
    console.log("radi");
    const $form = $(this);
    const $inputs = $form.find('input, checkbox, button, textarea');
    const serijalizacija = $form.serialize();
    console.log("uspesna serijaz"+serijalizacija);

    request = $.ajax({
        url:"handler/addTasks.php",
        type: "post",
        data: serijalizacija
    });

    request.done(function(response, textStatus, jqXHR){
        if(response==="Succ") {
            alert("taks dodat");
            console.log("uspesno");
            location.reload(true);
        } else console.log("nece"+ response);
        console.log(response);
    });

    request.fail(function(jqXHR, textStatus, errorThrown){
        console.error("greska" + textStatus, errorThrown)
    });


})