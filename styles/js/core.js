$(document).ready(function(){
    $('#button').click(function(){
        var rxp, error = false, date = new Date;
        // number
        var numberCard = $('#cardNumber')
        if(numberCard.validateCreditCard().card_type === null || !(/^([0-9]{13,16})+$/.test(numberCard.val()))){
            numberCard.css('border', '1px solid #f00');
            error = true;
        }
        else
            numberCard.css('border', '1px solid #0f0');

        // cvc
        rxp =  /^([0-9]{3})+$/;
        var cvc = $('#cvc');
        if(cvc === '' || !rxp.test(cvc.val())){
            cvc.css('border', '1px solid #f00');
            error = true;
        }
        else
            cvc.css('border', '1px solid #0f0');

        // name
        rxp =  /^(([A-Z]{2,15})+\ ([A-Z]{2,40})+)+$/;
        var name = $('#name');
        if(name === '' || !rxp.test(name.val())){
            name.css('border', '1px solid #f00');
            error = true;
        }
        else
            name.css('border', '1px solid #0f0');

        // month
        rxp =  /^([0-9]{2})+$/;
        var month = $('#month');
        if(month.val() > 12 || !rxp.test(month.val())){
            month.css('border', '1px solid #f00');
            error = true;
        }
        else
            month.css('border', '1px solid #0f0');

        // year
        rxp =  /^([0-9]{4})+$/;
        var year = $('#year');
        if(year.val() > (date.getFullYear() + 10) || year.val() < date.getFullYear() || !rxp.test(year.val())){
            year.css('border', '1px solid #f00');
            error = true;
        }
        else
            year.css('border', '1px solid #0f0');

        // email
        rxp =  /^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$/;
        var email = $('#email');
        if(email === '' || !rxp.test(email.val())){
            email.css('border', '1px solid #f00');
            error = true;
        }
        else
            email.css('border', '1px solid #0f0');

        if(error){
            return false;
        }
    });

    $('#name').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
});

