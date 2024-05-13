let appointments = [];

$("#appointment-form").validate({
    rules: {
        "appointment-name": {
            required: true,
            minlength: 5
        },
        "appointment-email": {
            required: true,
            email: true
        },
        
        "appointment-date": {
            required: true,
            dateISO: true
        },
        "appointment-service": {
            required: true
        }
       
    },
    messages: {
        "appointment-name": {
            required: "Please enter your name"
        },
        "appointment-email": {
            required: "Please enter an email"
        },
       
        "appointment-date": {
            required: "Please enter a valid date"
        },
        "appointment-service":{
            required: "Please enter a service that you need"
        }
       
    },
    submitHandler: function(form, event) {
        event.preventDefault(); // da mi ne submita
        blockUi("body");
        let appointment = serializeForm(form);
        console.log(JSON.stringify(appointment));
        

        appointments.push(appointment);

        
        console.log("APPOINTMENTS = ", appointments);
        $("#appointment-form")[0].reset();

        unblockUi("body");
    }
});

$("body").on("click focus", "input, textarea", function() {
    const $inputs = $("input, textarea");
    const $blankInputs = $inputs.filter(function() {
        return !$(this).val().trim();
    });

    $inputs.css("border", "1px solid rgba(20, 20, 20, 0.1)");
    $blankInputs.css("border", "1px solid red");
});

blockUi = (element) => {
    $(element).block({
        message: '<div class="spinner-border text-primary" role="status"></div>',
        css: {
            backgroundColor: "transparent",
            border: "0"
        },
        overlayCSS: {
            backgroundColor: "#000000",
            opacity: 0.25
        }
    });
}

unblockUi = (element) => {
    $(element).unblock({});
}

serializeForm = (form) => {
    let jsonResult = {};
    //console.log($(form).serializeArray());
    //serializeArray() reutrns an array of: name: [name of filed], value: [value of filed] for each field in the form
    $.each($(form).serializeArray(), function() {
        jsonResult[this.name] = this.value;
    });
    return jsonResult;
}