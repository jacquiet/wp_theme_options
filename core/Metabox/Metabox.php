<?php
// Class: Metabox
// Description: This class contains metafield creation methods

// Supported public metafields through the createdField public method:

// - input_text
// - input_number
// - input_checkbox
// - input_date
// - image_uploader
// - file_uploader
// - gallery
// - textarea
// - dropdown_simple
// - dropdown_multiple
// - wysiwyg
// - map


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
            case 'image_upload':
                $this->_createImageUpload($args);
                break;
            case 'file_upload':
                $this->_createFileUpload($args);
                break;
            case 'gallery':
                $this->_createGallery($args);
                break;
            case 'textarea':
                $this->_createTextarea($args);
                break;
            case 'dropdown_single':
                $this->_createDropdownSingle($args);
                break;
            case 'dropdown_multiple':
                $this->_createDropdownMultiple($args);
                break;
            case 'wysiwyg':
                $this->_createWYSIWYG($args);
                break;
            case 'map':
                $this->_createMap($args);
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
            $this->_createHiddenTextarea(array(
                'name'  => $name,
                'value' => $value
            ));
        }
    }


    // @param array $args
    // @return string $html
    protected function _createTextInput($args) {
        global $sa_options;

        // Get module options
        $settings = get_option('sa_options', $sa_options);

        // Get field value
        $field_value = $settings[$args['name']];

        // Set required
        $required = $args['required'] ? 'required' : '';

        // Set field markup
        $html =
            '<div class="view-metafield" data-view-metafield="text-input">' .
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '"/>' .
            '<p class="view-field-title">' . $args['title'] . '</p>' .
            '<input type="text" class="view-field" name="' . 'sa_options['.$args['name'].']' . '" value="' . $field_value . '" title="' . $args['description'] . '" ' . $required . '/>' .
            '</div>';

        echo $html;
    }


    // @params array $args
    // @return string $html
    protected function _createNumberInput($args) {
        global $sa_options;

        // Get module options
        $settings = get_option('sa_options', $sa_options);

        // Get field value
        $field_value = $settings[$args['name']];

        // Set required
        $required = $args['required'] ? 'required' : '';

        // Set field markup
        $html =
            '<div class="view-metafield" data-view-metafield="number_input">' .
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '"/>' .
            '<p class="view-field-title">' . $args['title'] . '</p>' .
            '<input type="number" step="0.01" min="0" max="100000" class="view-field" name="' . 'sa_options['.$args['name'].']' . '" value="' . $field_value . '" title="' . $args['description'] . '" ' . $required . ' />' .
            '</div>';

        echo $html;
    }


    // @params array $args
    // @return string $html
    protected function _createHiddenInput($args) {

        // Set field markup
        $html =
            '<div class="view-metafield-hidden" data-view-metafield="hidden_input">' .
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '"/>' .
            '<input type="hidden" class="view-field-hidden" name="' . 'sa_options['.$args['name'].']' . '" value="' . $args['value'] . '"/>' .
            '</div>';

        echo $html;
    }


    // @params array $args
    // @echo string $html
    protected function _createHiddenTextarea($args) {

        // Set field markup
        $html =
            '<div class="view-metafield-hidden" data-view-metafield="hidden_textarea">' .
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '"/>' .
            '<textarea class="textarea-hidden" name="' . 'sa_options['.$args['name'].']' . '">' .  $args['value'] . '</textarea>' .
            '</div>';

        echo $html;
    }


    // @param array $args
    // @return string $html
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
            '<div class="view-metafield" data-view-metafield="checkbox">' .
            '<input type="hidden" class="view-field" name="' . 'sa_options['.$args['name'].']' . '" value="' . $field_value . '" ' . ' title="' . $args['description'] . '"/>' .
            '<p class="view-field-title">' . $args['title'] . '</p>' .
            '<label>' .
            '<input type="checkbox" class="view-field" name="' . $args['name'] . '" ' . $checked . ' ' . $required . '/>' . $args['description'] .
            '</label>' .
            '</div>';

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
    // @return string $html
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
            '<div class="view-metafield" data-view-metafield="date_input">' .
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '"/>' .
            '<p class="view-field-title" title="' . $args['description'] . '">' . $args['title'] . '</p>' .
            '<input type="text" class="view-field" name="' . 'sa_options['.$args['name'].']' . '" value="' . $field_value . '" ' . $required . ' title="' . $args['description'] . '"/>' .
            '</div>';

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
    // @return string $html
    protected function _createImageUpload($args) {
        global $sa_options;

        // Get module options
        $settings = get_option('sa_options', $sa_options);

        // Get field value
        $field_value = $settings[$args['name']];

        // Set field name
        $field_name = '"sa_options[' . $args['name'] . ']"';

        // Set image style
        $img_style = empty($field_value) ? 'style="display:none"' : '';

        // Set required
        $required = $args['required'] ? 'required="required"' : '';

        // Set field markup
        $html =
            '<div class="view-metafield" data-view-metafield="image_upload">' .
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '"/>' .
            '<p class="view-field-title">' . $args['title'] . '</p>' .
            '<div class="view-image-upload-box" id="' . $args['name'] . '-image-box' . '">' .
            '<a class="gallery-image-link" href="' . $field_value . '"><img src="'. $field_value . '" ' . $img_style . '/></a></div>' .
            '<input type="hidden" class="view-field" name="' . 'sa_options['.$args['name'].']' . '" value="' . $field_value . '" ' . $required . ' title="' . $args['description'] . '"/>' .
            '<input type="button" class="button-image-upload" id="' . $args['name'] . '-button' . '" value="'. __('Select image') . '" title="' . $args['description'] . '"/>' .
            '</div>';

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
                        title: '<?php echo __( 'Choose or Upload an Image' ); ?>',
                        button: {
                            text:  '<?php echo __( 'Use this image' ); ?>'
                        }
                    });

                    // Runs when an image is selected.
                    meta_image_frame.on('select', function(){
                        // Grabs the attachment selection and creates a JSON representation of the model.
                        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
                        // Sends the attachment URL to our custom image input field.
                        $('input[name=<?php echo $field_name; ?>]').val(media_attachment.url);

                        var $imgBox = $('#<?php echo $args['name']; ?>-image-box');
                        $imgBox.hide();
                        $imgBox.find('img').attr('src', media_attachment.url);
                        $imgBox.find('img').show();
                        $imgBox.fadeIn(300);
                    });

                    // Runs on open
                    meta_image_frame.on('open', function() {
                        setTimeout(function() {
                            var selection = meta_image_frame.state().get('selection');
                            var $allImages = $('.attachments li');
                            var selectedId = $('[name=<?php echo $field_name; ?>]').val();

                            for (var i = 0, j = $allImages.length; i < j; i++) {
                                var $img = $allImages.eq(i);
                                var id = $img.find('img').attr('src');
                                var cleanUrl = id.replace(/-\d+x\d+((\.png)|(\.jpg)|(\.gif)|(\.tif))/g, '');

                                if ( selectedId.indexOf(cleanUrl) !== -1 && !$img.hasClass('selected') ) {
                                    $img.addClass('selected');
                                    selection.add(wp.media.attachment(selectedId));
                                    break;
                                }
                            }
                        }, 500);
                    });

                    // Opens the media library frame.
                    meta_image_frame.open();
                });
            });
        </script>
        <?php

        echo $html;
    }


    // @param array @args
    // @return string $html
    protected function _createFileUpload($args) {
        global $sa_options;

        // Get module options
        $settings = get_option('sa_options', $sa_options);

        // Get field value
        $field_value = $settings[$args['name']];

        // Set visibility
        $visibility = !empty($field_value) ? 'style="display:block"' : '';

        // Set link
        $link = !empty($field_value) ? $field_value : '#';

        // Set field name
        $field_name = '"sa_options[' . $args['name'] . ']"';

        // Set required
        $required = $args['required'] ? 'required="required"' : '';

        // Set remove button
        $remove_btn = !empty($field_value) ? '<a href="#" class="button-remove-file" title="' . __('Remove file') . '"><span class="mdi-navigation-close"></span>' : '';

        // Set field markup
        $html =
            '<div class="view-metafield" data-view-metafield="file_upload">' .
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '"/>' .
            '<p class="view-field-title">' . $args['title'] . '</p>' .
            $remove_btn . '</a><a href="' . $link . '" class="button-download-file" id="' . $args['name'] . '-button-download-file" ' . $visibility . ' title="' . __('Open file') . '" target="_blank"></span><span class="mdi-action-description"></span></a>' .
            '<input type="hidden" class="view-field" name="' . 'sa_options['.$args['name'].']' . '" value="' . $field_value . '" ' . $required . ' title="' . $args['description'] . '"/>' .
            '<input type="button" class="button-image-upload" id="' . $args['name'] . '-button' . '" value="'. __('Select file') . '" title="' . $args['description'] . '"/>' .
            '</div>';

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

                        var $buttonDownloadFile = $('#<?php echo $args['name']; ?>-button-download-file');

                        $buttonDownloadFile.before('<?php echo '<a href="#" class="button-remove-file" title="' . __('Remove file') . '"><span class="mdi-navigation-close"></span>'; ?>');
                        $buttonDownloadFile.attr('href', media_attachment.url);
                        $buttonDownloadFile.css({display: 'block'});

                        $('.button-remove-file').on('click', function(e) {
                            e.preventDefault();

                            $('input[name=<?php echo $field_name; ?>]').val('');

                            var $wrapper = $(this).parent();

                            $wrapper.find('.button-download-file').hide();
                            $(this).remove();
                        });
                    });

                    // Opens the media library frame.
                    meta_image_frame.open();
                });

                $('.view-metafield[data-view-metafield=file_upload]').hover(function(e) {
                   var $btnRemove = $(this).find('.button-remove-file');

                    $btnRemove.addClass('active');
                }, function(e) {
                    var $btnRemove = $(this).find('.button-remove-file');

                    $btnRemove.removeClass('active');
                });

                $('.button-remove-file').on('click', function(e) {
                    e.preventDefault();

                    $('input[name=<?php echo $field_name; ?>]').val('');

                    var $wrapper = $(this).parent();

                    $wrapper.find('.button-download-file').hide();
                    $(this).remove();
                });


            });
        </script>
        <?php

        echo $html;
    }


    // @params array $args
    // @return string $html
    protected function _createGallery($args) {
        global $sa_options;

        // Get module options
        $settings = get_option('sa_options', $sa_options);

        // Get field value
        $field_value = $settings[$args['name']];

        // Set field name
        $field_name = '"sa_options[' . $args['name'] . ']"';

        // Set gallery markup
        $gallery_html = '<div class="gallery-frame" id="' . $args['name'] . '"><ul>';

        if ( !empty($field_value) ) {
            $gallery_data = json_decode($field_value);

            foreach ($gallery_data as $entry) {
                $gallery_html .=
                    '<li><div class="gallery-image-wrapper">' .
                    '<a class="gallery-image-link" href="' . $entry . '"><img src="' . $entry . '"/></a>' .
                    '</div></li>';
            }
        }

        $gallery_html .= '</ul></div>';

        // Set required
        $required = $args['required'] ? 'required="required"' : '';

        // Set field markup
        $html =
            '<div class="view-metafield" data-view-metafield="gallery">' .
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '"/>' .
            '<p class="view-field-title">' . $args['title'] . '</p>' .
            '<div class="view-gallery-wrapper" id="' . $args['name'] . '-gallery-wrapper' . '">' . $gallery_html . '</div>' .
            '<textarea class="textarea-hidden" name="' . 'sa_options['.$args['name'].']' . '">' . $field_value . '</textarea>' .
            '<input type="button" class="button-image-upload" id="' . $args['name'] . '-button' . '" value="'. __('Select images') . '" title="' . $args['description'] . '"/>' .
            '</div>';
        ?>
        <script type="text/javascript">
            // Helper
            jQuery(document).ready(function($) {

                var meta_image_frame;

                var contains = function(ids, val) {

                    for (var i in ids.urls) {
                        var cleanUrl = val.replace(/-\d+x\d+((\.png)|(\.jpg)|(\.gif)|(\.tif))/g, '');

                        if (ids.urls[i].indexOf(cleanUrl) !== -1 && !ids.checked[i] ) {
                            ids.checked[i] = true;
                            return ids.urls[i];
                        }
                    }

                    return -1;
                };

                // Sets up the media library frame
                meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                    title: '<?php echo __( 'Choose or Upload an Image' ); ?>',
                    button: {
                        text:  '<?php echo __( 'Use this image' ); ?>'
                    },
                    multiple: true
                });

                // Runs when an image is added
                meta_image_frame.on('select', function(){

                    // Get image data
                    var data = meta_image_frame.state().get('selection').toJSON();
                    var urls = [];

                    for (i in data) {
                        urls.push(data[i].url);
                    }

                    var dataStr = JSON.stringify(urls);

                    // Add urls as value to the metafield
                    $('[name=<?php echo $field_name; ?>]').html(dataStr);

                    var $galleryWrapper = $('#<?php echo $args['name']; ?>-gallery-wrapper');

                    $galleryWrapper.hide();

                    $galleryWrapper.empty();

                    var $html = '<div class="gallery-frame"><ul>';

                    for (var u in urls) {

                        $html += '<li><div class="gallery-image-wrapper"><a class="gallery-image-link" href="' + urls[u] + '"><img src="' + urls[u] + '"/></a></div></li>';
                    }

                    $html += '</ul></div>';

                    $galleryWrapper.append($html);

                    // Start programatically metafield [gallery]

                    $.themeOptions.App.start('metafield', 'gallery');

                    $galleryWrapper.fadeIn(300);
                });

                // Runs on open
                meta_image_frame.on('open', function() {

                    setTimeout(function() {
                        var selection = meta_image_frame.state().get('selection');

                        var $allImages = $('.attachments li');

                        var ids = {
                            urls: JSON.parse($('[name=<?php echo $field_name; ?>]').val()),
                            checked: []
                        };

                        for (var k in ids.urls) {
                            ids.checked.push(false);
                        }

                        for (var i = 0, j = $allImages.length; i < j; i++) {
                            var $img = $allImages.eq(i);
                            var id = $img.find('img').attr('src');

                            if ( contains(ids, id) !== -1 && !$img.hasClass('selected') ) {
                                var idOriginal = contains(ids, id);

                                $img.addClass('selected');
                                selection.add(wp.media.attachment(idOriginal));
                            }
                        }
                    }, 500);
                });

                $('#<?php echo $args['name']; ?>-button').click(function(e){
                    e.preventDefault();

                    // Opens the media library frame.
                    meta_image_frame.open();
                });
            });
        </script>
        <?php

        echo $html;
    }


    // @param array $args
    // @return string $html
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
            '<div class="view-metafield" data-view-metafield="textarea">' .
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__)) . '"/>' .
            '<p class="view-field-title" title="' . $args['description'] . '">' . $args['title'] . '</p>' .
            '<textarea class="view-field" name="' . 'sa_options['.$args['name'].']' . '" ' . $required . '>' . $field_value . '</textarea>' .
            '</div>';

        echo $html;
    }


    // @param array $args
    // @return string $html
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
            '<div class="view-metafield" data-view-metafield="dropdown_single">' .
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '"/>' .
            '<p class="view-field-title">' . $args['title'] . '</p>' .
            '<select class="view-dropdown-single" name="' . 'sa_options['.$args['name'].']' . '" title="' . $args['description'] . '">' .
            '<option value="-1" selected="selected" ' . $required . '>' . __('Select from the dropdown') . '</option>';

        foreach ($args['data'] as $item) {

            $selected = $field_value == $item->ID ? 'selected="selected"' : '';
            $html .= '<option value="' . $item->ID . '" ' . $selected . '>' . $item->post_title . '</option>';
        }

        $html .= '</select></div>';

        echo $html;
    }


    // @param array $args
    // @return string $html
    protected function _createDropdownMultiple($args) {
        global $sa_options;

        // Get module options
        $settings = get_option('sa_options', $sa_options);

        // Get field value
        $field_values = isset($settings[$args['name']]) && gettype($settings[$args['name']]) === 'array' ? $settings[$args['name']] : array();

        // Set required
        $required = $args['required'] ? 'required' : '';

        // Set field markup
        $html =
            '<div class="view-metafield" data-view-metafield="dropdown_multiple">' .
            '<input type="hidden" name="' . $args['name'] . '_noncename" id="' . $args['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '"/>' .
            '<p class="view-field-title">' . $args['title'] . '</p>' .
            '<ul class="view-dropdown-multiple">';

        foreach ($args['data'] as $item) {

            $checked = in_array($item->ID, $field_values) ? 'checked="checked"' : '';
            $html .= '<li><input type="checkbox" name="' . 'sa_options[' . $args['name'] . '][]' . '" value="'. $item->ID . '" ' . $checked . '/>' . $item->post_title . '</li>';
        }

        $html .= '</ul></div>';

        echo $html;
    }


    // @param array $args
    // @return string $html
    protected function _createWYSIWYG($args) {
        global $module;

        global $sa_options;

        // Get modules directory
        $modules_dir = get_template_directory_uri() . '/modules/';

        // Set icons directory
        $wysiwyg_icons_dir = $modules_dir . $module['name'] . '/assets/fonts/trumbowyg/icons.svg';

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
            '<div class="view-metafield" data-view-metafield="wysiwyg">' .
            '<textarea class="textarea-hidden" name="' . 'sa_options['.$args['name'].']' . '">' . $field_value . '</textarea>' .
            '<p class="view-field-title" title="' . $args['description'] . '">' . $args['title'] . '</p>' .
            '<div id="' . $field_id . '"></div>' .
            '</div>';

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


    // @param array $args
    // @echo string $html
    protected function _createMap($args) {
        global $module;

        global $sa_options;

        // Get module options
        $settings = get_option('sa_options', $sa_options);

        // Get field value
        $field_value = $settings[$args['name']];

        // Decode values
        $values = json_decode($field_value);

        $default_lat_val = 20;
        $default_lng_val = 5;
        $default_zoom_val = 11;

        $lat_val = isset($values->lat) && !empty($values->lat) ? $values->lat : $default_lat_val;
        $lng_val = isset($values->lng) && !empty($values->lng) ? $values->lng : $default_lng_val;
        $zoom_val = isset($values->zoom) && !empty($values->zoom) ? $values->zoom : $default_zoom_val;

        $lat_val_base = $lat_val === $default_lat_val ? '' : $lat_val;
        $lng_val_base = $lng_val === $default_lng_val ? '' : $lng_val;
        $zoom_val_base = $zoom_val === $default_zoom_val ? '' : $zoom_val;

        // Set field name
        $field_name = 'sa_options[' . $args['name'] . ']';

        // Set field id
        $field_id = $args['name'] . '-wysiwyg';

        // Set required
        $required = $args['required'] ? 'required="required"' : '';

        // Set field markup
        $html =
            '<div class="view-metafield" data-view-metafield="map">' .
            '<div class="map-controls">' .
            '<a href="#" class="button-open-map-settings" title="' . __('Toggle map settings') . '" data-control-opened="false"><span class="mdi-action-settings"></span></a>' .
            '<label>' . __('Latitude') . '</label><br/>' .
            '<p><input type="number" min="-200" max="200" step="0.0000001" name="' . $args['name'] . '_lat" class="view-field-small" value="' . $lat_val_base . '"/></p>' .
            '<label>' . __('Longitude') . '</label><br/>' .
            '<p><input type="number" min="-200" max="200"  step="0.0000001" name="' . $args['name'] . '_lng" class="view-field-small" value="' . $lng_val_base . '"/></p>' .
            '<label>' . __('Zoom level') . '</label><br/>' .
            '<p><input type="number" min="0" max="22"  name="' . $args['name'] . '_zoom" class="view-field-small" value="' . $zoom_val_base . '"/></p>' .
            '<a href="#" class="button-update-map" title="' . __('Press to update the map') . '">' . __('Update map') . '</a>' .
            '</div>' .
            '<textarea class="textarea-hidden" name="' . $field_name . '">' . $field_value . '</textarea>' .
            '<p class="view-field-title">' . $args['title'] . '</p>' .
            '<div id="' . $field_id . '" class="view-field-map">' .
            '</div>' .
            '</div>';

        ?>
        <script type="text/javascript">
            // Helper
            jQuery(document).ready(function($) {

                var mapStyle = [];

                var mapDiv = document.getElementById('<?php echo $field_id; ?>');
                var map = new google.maps.Map(mapDiv, {
                    center: {
                        lat: <?php echo $lat_val; ?>,
                        lng: <?php echo $lng_val; ?>
                    },
                    zoom: <?php echo $zoom_val; ?>,
                    styles: mapStyle
                });

                var marker = new google.maps.Marker({
                    position: {
                        lat: <?php echo $lat_val; ?>,
                        lng: <?php echo $lng_val; ?>
                    },
                    map: map,
                    title: 'Selected location',
                    icon: '<?php echo get_template_directory_uri(); ?>' + '/modules/' + '<?php echo $module['name']; ?>' + '/assets/images/map-marker.png'
                });

                google.maps.event.addDomListener(window, "resize", function() {
                    var center = map.getCenter();
                    google.maps.event.trigger(map, "resize");
                    map.setCenter(center);
                });

                $('.map-controls input').on('keyup keydown keypress click', function(e) {

                    var data = {
                        lat: $('input[name=<?php echo $args['name'] . '_lat'; ?>]').val(),
                        lng: $('input[name=<?php echo $args['name'] . '_lng'; ?>]').val(),
                        zoom: $('input[name=<?php echo $args['name'] . '_zoom'; ?>]').val()
                    };

                    $('textarea[name="<?php echo $field_name; ?>"]').html(JSON.stringify(data));
                });

                $('.button-update-map').on('click', function(e) {
                    e.preventDefault();
                    
                    var data = {
                        lat: parseFloat($('input[name=<?php echo $args['name'] . '_lat'; ?>]').val()),
                        lng: parseFloat($('input[name=<?php echo $args['name'] . '_lng'; ?>]').val()),
                        zoom: parseInt($('input[name=<?php echo $args['name'] . '_zoom'; ?>]').val())
                    };

                    var map = new google.maps.Map(mapDiv, {
                        center: {
                            lat: data.lat,
                            lng: data.lng
                        },
                        zoom: data.zoom,
                        styles: mapStyle
                    });

                    var marker = new google.maps.Marker({
                        position: {
                            lat: data.lat,
                            lng: data.lng
                        },
                        map: map,
                        title: 'Selected location',
                        icon: '<?php echo get_template_directory_uri(); ?>' + '/modules/' + '<?php echo $module['name']; ?>' + '/assets/images/map-marker.png'
                    });
                });
            });
        </script>
        <?php

        echo $html;
    }

}