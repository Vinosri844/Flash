<script>
    $(document).ready(function() {
		
		@if(Route::currentRouteName() == 'admin.login')
        // Login Validation
        $('#login_form').formValidation({
        //  live: 'disabled',
            message: 'This value is not valid',
            excluded: ':disabled', 
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: 'Username is required'
                        },
                        
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Password is required'
                        }
                    }
                },
            }
        });
		@endif

        
		
		@if(Route::currentRouteName() == 'admin.category_create')
        // Login Validation
        $('#category_form').formValidation({
        //  live: 'disabled',
            message: 'This value is not valid',
            excluded: ':disabled', 
            fields: {
                category_name: {
                    validators: {
                        notEmpty: {
                            message: 'Category name is required'
                        }
                        
                    }
                },
                t_category_name: {
                    validators: {
                        notEmpty: {
                            message: 'T Category name is required'
                        }
                        
                    }
                },
                category_description: {
                    validators: {
                        stringLength: {
                            min: 6,
                            message: 'Description must be more than 6 characters long'
                        }
                        
                    }
                }
            }
        });
		@endif

});


</script>