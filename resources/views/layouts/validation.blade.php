<script>
    $(document).ready(function() {
		
		@if(Route::currentRouteName() == 'login')
        // Login Validation
        $('#login_form').formValidation({
        //  live: 'disabled',
            message: 'This value is not valid',
            excluded: ':disabled', 
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: 'Email is required'
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

        
		
		@if(Route::currentRouteName() == 'category_create')
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
                category_image: {
                    validators: {
                        notEmpty: {
                            message: 'Category image is required'
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

        @if(Route::currentRouteName() == 'category_edit')
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

        @if(Route::currentRouteName() == 'subcategory_create')
        // Login Validation
        $('#subcategory_form').formValidation({
        //  live: 'disabled',
            message: 'This value is not valid',
            excluded: ':disabled', 
            fields: {
                subcategory_name: {
                    validators: {
                        notEmpty: {
                            message: 'Subcategory name is required'
                        }
                        
                    }
                },
                t_subcategory_name: {
                    validators: {
                        notEmpty: {
                            message: 'T Subcategory name is required'
                        }
                        
                    }
                },
                category_id: {
                    validators: {
                        notEmpty: {
                            message: 'Category name is required'
                        }
                        
                    }
                },
                subcategory_image: {
                    validators: {
                        notEmpty: {
                            message: 'Subcategory image is required'
                        }
                        
                    }
                },
                subcategory_description: {
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

        @if(Route::currentRouteName() == 'subcategory_edit')
        // Login Validation
        $('#subcategory_form').formValidation({
        //  live: 'disabled',
            message: 'This value is not valid',
            excluded: ':disabled', 
            fields: {
                subcategory_name: {
                    validators: {
                        notEmpty: {
                            message: 'Subcategory name is required'
                        }
                        
                    }
                },
                t_subcategory_name: {
                    validators: {
                        notEmpty: {
                            message: 'T Subcategory name is required'
                        }
                        
                    }
                },
                category_id: {
                    validators: {
                        notEmpty: {
                            message: 'Category name is required'
                        }
                        
                    }
                },
                subcategory_description: {
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