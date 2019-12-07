$(document).ready(function () {
    $("input[type='checkbox']").iCheck({
        checkboxClass: 'icheckbox_minimal-blue'
    });


    $(".omb_loginForm").bootstrapValidator({
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'The User Id is required'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Password is required'
                    },
                    different: {
                        field: 'first_name,last_name',
                        message: 'Password should not match user Name'
                    }
                }
            }
        }
    });
});