
$(function () {
    $('#p1').hover(function show() {
        //Change the attribute to text  
        $('.pass1').attr('type','text');
        $('#changei1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    },
        function hide() {
            //Change the attribute back to password  
            $('.pass1').attr('type','password');
            $('#changei1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        });

    $('#p2').hover(function show() {
        //Change the attribute to text  
        $('.pass2').attr('type','text');
        $('#changei2').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    },
        function hide() {
            //Change the attribute back to password  
            $('.pass2').attr('type','password');
            $('#changei2').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        });
    $('.dobtext').datepicker({
        changeMonth:true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        yearRange: '1950:2020'
        });

});




