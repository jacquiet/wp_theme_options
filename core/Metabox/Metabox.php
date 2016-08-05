<?php
// Class: Metabox

// Supported public metafields:

// - input[type=text]
// - input[type=number]
// - input[type=checkbox]
// - input[date-picker]
// - input[image-uploader]
// - textarea
// - select [single choice]
// - WYSIWYG


class Metabox {


    // @param string $type
    // @param array $args
    public function createField($type, $args) {

        switch ($type) {
            case 'input_text':
                $this->_createTextInput($args);
                break;
            case 'input_number':
                $this->_createNumberInput($args);
                break;
            case 'input_checkbox':
                $this->_createCheckbox($args);
                break;
            case 'input_date':
                $this->_createDateInput($args);
                break;
            case 'input_image_upload':
                $this->_createImageUploadInput($args);
                break;
            case 'textarea':
                $this->_createTextarea($args);
                break;
            case 'dropdown_single':
                $this->_createDropdownSingle($args);
                break;
            case 'wysiwyg':
                $this->_createWYSIWYG($args);
                break;
        }
    }


    public function createOptionFields() {
        global $sa_options;

        // Get module options
        $settings = get_option('sa_options', $sa_options);

        // Iterate over all setting fields
        foreach ($settings as $name => $value) {

            // Create hidden input
            $this->_createHiddenInput(array(
                'name'  => $name,
                'value' => $value
            ));
        }
    }


    // @param array $args
    protected function _createTextInput($args) {
        global $sa_options;

        // Get module options
        $settings = get_option('sa_options', $sa_options);

        // Get field value
        $field_value = $settings[$args['name']];

        // Set required
        $required = $args['required'] ? 'required="required"' : '';

        // Set field markup
        $html =
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '"/>' .
            '<p class="view-field-title">' . $args['title'] . '</p>' .
            '<input type="text" class="view-field" name="' . 'sa_options['.$args['name'].']' . '" value="' . $field_value . '" ' . $required . ' title="' . $args['description'] . '"/><br/>';

        echo $html;
    }


    // @params array $args
    protected function _createNumberInput($args) {
        global $sa_options;

        // Get module options
        $settings = get_option('sa_options', $sa_options);

        // Get field value
        $field_value = $settings[$args['name']];

        // Set required
        $required = $args['required'] ? 'required="required"' : '';

        // Set field markup
        $html =
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '"/>' .
            '<p class="view-field-title">' . $args['title'] . '</p>' .
            '<input type="number" step="0.01" min="1" max="100000" class="view-field" name="' . 'sa_options['.$args['name'].']' . '" value="' . $field_value . '" ' . $required . ' title="' . $args['description'] . '"/><br/>';

        echo $html;
    }


    // @params array $args
    protected function _createHiddenInput($args) {

        // Set field markup
        $html =
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '"/>' .
            '<input type="hidden" class="view-field-hidden" name="' . 'sa_options['.$args['name'].']' . '" value="' . $args['value'] . '"/>';

        echo $html;
    }


    // @param array $args
    protected function _createCheckbox($args) {
        global $sa_options;

        // Get module options
        $settings = get_option('sa_options', $sa_options);

        // Set required
        $required = $args['required'] ? 'required="required"' : '';

        // Set field name
        $field_name = '"sa_options[' . $args['name'] . ']"';

        // Get field value
        $field_value = $settings[$args['name']];

        // Check if checked
        $checked = $field_value === '1' ? 'checked="checked"' : '';

        // Set field markup
        $html =
            '<input type="hidden" class="view-field" name="' . 'sa_options['.$args['name'].']' . '" value="' . $field_value . '" ' . ' title="' . $args['description'] . '"/>' .
            '<p class="view-field-title">' . $args['title'] . '</p>' .
            '<label>' .
            '<input type="checkbox" class="view-field" name="' . $args['name'] . '" ' . $checked . ' ' . $required . '/>' . $args['description'] .
            '</label><br/><br/>';

        ?>
        <script type="text/javascript">
            // Helper
            jQuery(document).ready(function($) {
                $("input[type=checkbox][name=<?php echo $args['name']; ?>").on('change', function() {
                    if ( $(this).is(':checked') ) {
                        $('input[name=<?php echo $field_name; ?>]').val(1);
                        $('input[name=<?php echo $field_name; ?>]').attr('value', 1);
                    } else {
                        $('input[name=<?php echo $field_name; ?>]').val(0);
                        $('input[name=<?php echo $field_name; ?>]').attr('value', 0);
                    }
                })
            });
        </script>
        <?php

        echo $html;
    }


    // @param array $args
    protected function _createDateInput($args) {
        global $sa_options;

        // Get module options
        $settings = get_option('sa_options', $sa_options);

        // Get field value
        $field_value = $settings[$args['name']];

        // Set field name
        $field_name = '"sa_options[' . $args['name'] . ']"';

        // Set required
        $required = $args['required'] ? 'required="required"' : '';

        // Set field markup
        $html =
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '"/>' .
            '<p class="view-field-title">' . $args['title'] . '</p>' .
            '<input type="text" class="view-field" name="' . 'sa_options['.$args['name'].']' . '" value="' . $field_value . '" ' . $required . ' title="' . $args['description'] . '"/><br/>';

        ?>
        <script type="text/javascript">
            // Helper
            jQuery(document).ready(function($) {
                $('input[name=<?php echo $field_name; ?>]').datepicker({
                    dateFormat: 'dd/mm/yy'
                });
            });
        </script>
        <?php

        echo $html;
    }


    // @param array @args
    protected function _createImageUploadInput($args) {
        global $sa_options;

        // Get module options
        $settings = get_option('sa_options', $sa_options);

        // Get field value
        $field_value = $settings[$args['name']];

        // Set field name
        $field_name = '"sa_options[' . $args['name'] . ']"';

        // Set required
        $required = $args['required'] ? 'required="required"' : '';

        // Set field markup
        $html =
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '"/>' .
            '<p class="view-field-title">' . $args['title'] . '</p>' .
            '<div class="view-image-upload-box" id="' . $args['name'] . '-image-box' . '"><img src="'. $field_value . '"/></div>' .
            '<input type="hidden" class="view-field" name="' . 'sa_options['.$args['name'].']' . '" value="' . $field_value . '" ' . $required . ' title="' . $args['description'] . '"/>' .
            '<input type="button" class="button-image-upload" id="' . $args['name'] . '-button' . '" value="'. __('Upload file') . '" title="' . $args['description'] . '"/><br/>';

        ?>
        <script type="text/javascript">
            // Helper
            jQuery(document).ready(function($) {
                var meta_image_frame;

                $('#<?php echo $args['name']; ?>-button').click(function(e){
                    e.preventDefault();

                    if ( meta_image_frame ) {
                        meta_image_frame.open();
                        return;
                    }

                    // Sets up the media library frame
                    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                        title: '<?php echo __( 'Choose or Upload a File' ); ?>',
                        button: {
                            text:  '<?php echo __( 'Use this file' ); ?>'
                        }
                    });

                    // Runs when an image is selected.
                    meta_image_frame.on('select', function(){
                        // Grabs the attachment selection and creates a JSON representation of the model.
                        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
                        // Sends the attachment URL to our custom image input field.
                        $('input[name=<?php echo $field_name; ?>]').val(media_attachment.url);

                        $('#<?php echo $args['name']; ?>-image-box').hide();
                        $('#<?php echo $args['name']; ?>-image-box').find('img').attr('src', media_attachment.url);
                        $('#<?php echo $args['name']; ?>-image-box').fadeIn(300);
                    });

                    // Opens the media library frame.
                    meta_image_frame.open();
                });
            });
        </script>
        <?php

        echo $html;
    }


    // @param array $args
    protected function _createTextarea($args) {
        global $sa_options;

        // Get module options
        $settings = get_option('sa_options', $sa_options);

        // Get field value
        $field_value = $settings[$args['name']];

        // Set required
        $required = $args['required'] ? 'required="required"' : '';

        // Set field markup
        $html =
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__)) . '"/>' .
            '<p class="view-field-title" title="' . $args['description'] . '">' . $args['title'] . '</p>' .
            '<textarea class="view-field" name="' . 'sa_options['.$args['name'].']' . '" ' . $required . '>' . $field_value . '</textarea>';

        echo $html;
    }


    // @param array $args
    protected function _createDropdownSingle($args) {
        global $sa_options;

        // Get module options
        $settings = get_option('sa_options', $sa_options);

        // Get field value
        $field_value = $settings[$args['name']];

        // Set required
        $required = $args['required'] ? 'required="required"' : '';

        // Set field markup
        $html =
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '"/>' .
            '<p class="view-field-title">' . $args['title'] . '</p>' .
            '<select class="view-dropdown" name="' . 'sa_options['.$args['name'].']' . '" title="' . $args['description'] . '">' .
            '<option value="-1" selected="selected" ' . $required . '>' . __('Select from the dropdown') . '</option>';

        foreach ($args['data'] as $item) {

            $selected = $field_value == $item->ID ? 'selected="selected"' : '';
            $html .= '<option value="' . $item->ID . '" ' . $selected . '>' . $item->post_title . '</option>';
        }

        $html .= '</select><br/>';

        echo $html;
    }


    // @param array $args
    protected function _createWYSIWYG($args) {
        global $module;

        global $sa_options;

        // Get modules directory
        $modules_dir = get_template_directory_uri() . '/modules/';

        // Set icons directory
        $wysiwyg_icons_dir = $modules_dir . '/' . $module['name'] . '/assets/fonts/trumbowyg/icons.svg';

        // Get module options
        $settings = get_option('sa_options', $sa_options);

        // Get field value
        $field_value = $settings[$args['name']];

        // Set field name
        $field_name = '"sa_options[' . $args['name'] . ']"';

        // Set field id
        $field_id = $args['name'] . '-wysiwyg';

        // Set required
        $required = $args['required'] ? 'required="required"' : '';

        // Set field markup
        $html =
            '<textarea class="textarea-hidden" name="' . 'sa_options['.$args['name'].']' . '">' . $field_value . '</textarea>' .
            '<p class="view-field-title">' . $args['title'] . '</p>' .
            '<div id="' . $field_id . '"></div>';

        ?>
        <script type="text/javascript">
            // Helper
            jQuery(document).ready(function($) {

                // Initialize WYSIWYG editor
                $('#<?php echo $field_id; ?>').trumbowyg({
                    svgPath: '<?php echo $wysiwyg_icons_dir; ?>'
                });

                // Load editor content
                $('#<?php echo $field_id; ?>').trumbowyg('html', "<?php echo $field_value; ?>");

                // Update field value on multiple events
                $('#<?php echo $field_id; ?>').on('keyup keydown keypress click', function() {
                    var editorVal = $('#<?php echo $field_id; ?>').html();
                    var encodedVal = editorVal.replace(/"/g, "'");
                    $('textarea[name=<?php echo $field_name; ?>]').val(encodedVal);
                });

                // Update field value on button press events
                $('#<?php echo $field_id; ?>').parent().find('button').on('click', function() {
                    var editorVal = $('#<?php echo $field_id; ?>').html();
                    var encodedVal = editorVal.replace(/"/g, "'");
                    $('textarea[name=<?php echo $field_name; ?>]').val(encodedVal);
                });
            });
        </script>
        <?php

        echo $html;
    }

}