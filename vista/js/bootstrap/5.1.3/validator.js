//INFO PELICULAS
$(document).ready(function () {
    $('#tp3eje3').bootstrapValidator({
        message: 'Este valor no es valido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            titulo: {
                validators: {
                    notEmpty: {
                        message: ' Se requiere un título'
                    }
                }
            },
            actores: {
                validators: {
                    notEmpty: {
                        message: ' Ingresar actores'
                    }
                }
            },
            director: {
                validators: {
                    notEmpty: {
                        message: ' Se requiere el director'
                    }
                }
            },
            imagen: {
                validators: {
                    notEmpty: {
                        message: ' Se requiere seleccionar una imagen'
                    },
                    file: {
                        maxSize: 683 * 1024,
                        message: ' Excede el tamaño máximo'
                    }
                },
                custom: {
                    fileheight: function ($el) {
                        if ($el[0].files[0].height / ($el[0].files[0].width) > 1.5) {
                            return "Debe ser una relación de aspecto de 2/3"
                        }
                    }
                }
            },
            guion: {
                validators: {
                    notEmpty: {
                        message: ' Se requiere un guión'
                    }
                }
            },
            produccion: {
                validators: {
                    notEmpty: {
                        message: ' Se requiere el nombre de producción'
                    }
                }
            },
            year: {
                validators: {
                    notEmpty: {
                        message: ' Año obligatorio'
                    }
                }
            },
            nacion: {
                validators: {
                    notEmpty: {
                        message: ' La nacionalidad es obligatoria'
                    },
                    regexp: {
                        regexp: /^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/,
                        message: ' La primer letra en mayúscula. Solo letras.'
                    }
                }
            },
            minutos: {
                validators: {
                    notEmpty: {
                        message: ' Se requiere duración'
                    }
                }
            },
            edad: {
                validators: {
                    notEmpty: {
                        message: ' Se requiere seleccionar una opción'
                    }
                }
            },
            sinopsis: {
                validators: {
                    notEmpty: {
                        message: ' Debe añadir una descripción'
                    }
                }
            }
        },
    });
});

//LOGIN
$(document).ready(function () {
    $('#tp2ej3').bootstrapValidator({
        message: 'Este valor no es valido',

        fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: ' El nombre de usuario es requerido'
                    },
                    stringLength: {
                        min: 4,
                        message: ' Debe superar los 4 caracteres'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: ' Completar campo <br>'
                    },
                    regexp: {
                        regexp: /(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/,
                        message: ' Debe contener letras y números <br>'
                    },
                    stringLength: {
                        min: 8,
                        message: ' Debe tener mínimo 8 caracteres <br>'
                    },
                    different: {
                        field: 'username',
                        message: ' La contraseña no debe ser igual al nombre del usuario'
                    }
                }
            },
        }
    });
});
