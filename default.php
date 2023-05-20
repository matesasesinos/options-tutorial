<?php

//Add a admin menu | Agregamos un menú de administrador

if (!function_exists('mtAddAdminMenu')) { // we check that the function or method does not exist | comprobamos que no exista la funcion o metodo
    function mtAddAdminMenu()
    {
        add_menu_page('Custom Menu 1', 'Custom Menu 1', 'manage_options', 'custom-menu', 'mtCustomMenu', 'dashicons-admin-site', 2);
    }

    //Add a admin menu hook | Hook de agregar el menú al administrador
    add_action('admin_menu', 'mtAddAdminMenu');
}

//Admin menu callback | Callback del menú
if (!function_exists('mtCustomMenu')) { //show options page | mostrar la página de opciones
    function mtCustomMenu()
    {
?>
        <div class="wrap">
            <h1>Opciones de Tema</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('mtOptionsCustom');
                do_settings_sections('mtOptionsCustom');
                ?>
                <label for="textField">Campo de Texto</label>
                <input type="text" name="textField" id="textField" value="<?php echo esc_attr(get_option('textField')); ?>">

                <label for="selectField">Campo de Selección</label>
                <select name="selectField" id="selectField">
                    <option value="opcion1" <?php selected(get_option('selectField'), 'opcion1'); ?>>Opción 1</option>
                    <option value="opcion2" <?php selected(get_option('selectField'), 'opcion2'); ?>>Opción 2</option>
                    <option value="opcion3" <?php selected(get_option('selectField'), 'opcion3'); ?>>Opción 3</option>
                </select>

                <label>Grupo de Checkbox</label><br>
                <input type="checkbox" name="checkbox1" value="1" <?php checked(get_option('checkbox1'), '1'); ?>> Checkbox 1<br>
                <input type="checkbox" name="checkbox2" value="1" <?php checked(get_option('checkbox2'), '1'); ?>> Checkbox 2<br>


                <label>Grupo de Botones de Opción</label><br>
                <input type="radio" name="gradioGroup" value="opcion1" <?php checked(get_option('gradioGroup'), 'opcion1'); ?>> Opción 1<br>
                <input type="radio" name="gradioGroup" value="opcion2" <?php checked(get_option('gradioGroup'), 'opcion2'); ?>> Opción 2<br>
                <input type="radio" name="gradioGroup" value="opcion3" <?php checked(get_option('gradioGroup'), 'opcion3'); ?>> Opción 3<br>

                <label for="textareaField">Campo de Texto de Área</label>
                <textarea name="textareaField" id="textareaField" rows="5" cols="50"><?php echo esc_textarea(get_option('textareaField')); ?></textarea>

                <?php submit_button(); ?>
            </form>
        </div>
<?php
    }
}

function mtRegisterOptions()
{
    register_setting('mtOptionsCustom', 'textField');
    register_setting('mtOptionsCustom', 'selectField');
    register_setting('mtOptionsCustom', 'checkbox1');
    register_setting('mtOptionsCustom', 'checkbox2');
    register_setting('mtOptionsCustom', 'gradioGroup');
    register_setting('mtOptionsCustom', 'textareaField');
}
add_action('admin_init', 'mtRegisterOptions');
