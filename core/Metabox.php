<?php

namespace ThemeOptions;

/**
 * Class Metabox
 * This class contains metafield creation methods
 * @package ThemeOptions
 *
 * Supported metafields:
 * - text
 * - email
 * - hidden
 * - number
 * - checkbox
 * - date
 * - file
 * - image
 * - textarea
 * - dropdown_single
 * - dropdown_multiple
 * - editor
 * - map
 * - gallery
 * - plain_text
 */
class Metabox {


    /**
     * @property bool $createNonce
     */
    protected static $createNonce = false;


    /**
     * Construct
     */
    public function __construct() {

    }


    /**
     * Create field
     * @param $args
     * @param bool $createNonce
     */
    public static function createField($args, $createNonce = false) {
        self::$createNonce = $createNonce;

        switch ($args['type']) {
            case 'text':
                self::_createTextInput($args);
                break;
            case 'email':
                self::_createEmailInput($args);
                break;
            case 'hidden':
                self::_createHiddenInput($args);
                break;
            case 'number':
                self::_createNumberInput($args);
                break;
            case 'checkbox':
                self::_createCheckboxInput($args);
                break;
            case 'date':
                self::_createDateInput($args);
                break;
            case 'file':
                self::_createFileInput($args);
                break;
            case 'image':
                self::__createImageInput($args);
                break;
            case 'textarea':
                self::_createTextarea($args);
                break;
            case 'dropdown_single':
                self::_createDropdownSingle($args);
                break;
            case 'dropdown_multiple':
                self::_createDropdownMultiple($args);
                break;
            case 'editor':
                self::_createWYSIWYG($args);
                break;
            case 'map':
                self::_createMap($args);
                break;
            case 'gallery':
                self::_createGallery($args);
                break;
            case 'plain_text':
                self::_createPlainText($args);
                break;
            default:
                break;
        }
    }


    /**
     * Create text input
     * @param $args
     */
    protected static function _createTextInput($args) {
        $value       = $args['value'];
        $name        = $args['name'];
        $fieldName   = self::getFieldName($args['option_name'], $name);
        $label       = $args['label'];
        $description = isset($args['description']) ? $args['description'] : '';
        $size        = isset($args['size']) ? $args['size'] : '';
        $required    = isset($args['required']) && $args['required'] === 'true' ? 'required' : '';
        $selector    = isset($args['selector']) ? $args['selector'] : '';

        ?>
            <div class="ksfc-metafield <?php echo $size; ?>" data-metafield="text">
                <?php if ( self::$createNonce ) : ?>
                    <?php self::createNonce($args); ?>
                <?php endif; ?>
                <label for="<?php echo $fieldName; ?>" title="<?php echo $description; ?>"><?php echo $label; ?></label>
                <input type="text" class="metafield <?php echo $selector; ?>" name="<?php echo $fieldName; ?>" value="<?php echo $value; ?>" title="<?php echo $description; ?>" <?php echo $required; ?>/>
            </div>
        <?php
    }


    /**
     * Create text input
     * @param $args
     */
    protected static function _createEmailInput($args) {
        $value       = $args['value'];
        $name        = $args['name'];
        $fieldName   = self::getFieldName($args['option_name'], $name);
        $label       = $args['label'];
        $description = isset($args['description']) ? $args['description'] : '';
        $size        = isset($args['size']) ? $args['size'] : '';
        $required    = isset($args['required']) && $args['required'] === 'true' ? 'required' : '';
        $selector    = isset($args['selector']) ? $args['selector'] : '';

        ?>
        <div class="ksfc-metafield <?php echo $size; ?>" data-metafield="email">
            <?php if ( self::$createNonce ) : ?>
                <?php self::createNonce($args); ?>
            <?php endif; ?>
            <label for="<?php echo $fieldName; ?>" title="<?php echo $description; ?>"><?php echo $label; ?></label>
            <input type="email" pattern="[a-z0-9!#$%&'*+/=?^_`{|}~.-]+@[a-z0-9-]+(\.[a-z0-9-]+)*" class="metafield <?php echo $selector; ?>" name="<?php echo $fieldName; ?>" value="<?php echo $value; ?>" title="<?php echo $description; ?>" <?php echo $required; ?>/>
        </div>
    <?php
    }


    /**
     * Create number input
     * @param $args
     */
    protected static function _createNumberInput($args) {
        $value       = $args['value'];
        $name        = $args['name'];
        $fieldName   = self::getFieldName($args['option_name'], $name);
        $label       = $args['label'];
        $description = isset($args['description']) ? $args['description'] : '';
        $size        = isset($args['size']) ? $args['size'] : '';
        $required    = isset($args['required']) && $args['required'] === 'true' ? 'required' : '';
        $selector    = isset($args['selector']) ? $args['selector'] : '';
        $min         = isset($args['min']) && is_numeric(floatval($args['min'])) ? $args['min'] : 0;
        $max         = isset($args['max']) && is_numeric(floatval($args['max'])) ? $args['max'] : 200;
        $step        = isset($args['step']) && is_numeric(floatval($args['step'])) ? $args['step'] : 1;

        ?>
        <div class="ksfc-metafield <?php echo $size; ?>" data-metafield="number">
            <?php if ( self::$createNonce ) : ?>
                <?php self::createNonce($args); ?>
            <?php endif; ?>
            <label for="<?php echo $name; ?>" title="<?php echo $description; ?>"><?php echo $label; ?></label>
            <input type="number" step="<?php echo $step; ?>" min="<?php echo $min; ?>" max="<?php echo $max; ?>" class="metafield <?php echo $selector; ?>" name="<?php echo $fieldName; ?>" value="<?php echo $value; ?>" title="<?php echo $description; ?>" <?php echo $required; ?>/>
        </div>
        <?php
    }


    /**
     * Create hidden input
     * @param $args
     */
    protected static function _createHiddenInput($args) {
        $value       = $args['value'];
        $name        = $args['name'];
        $fieldName   = self::getFieldName($args['option_name'], $name);
        ?>
        <div class="ksfc-metafield hidden" data-metafield="hidden_input">
            <?php if ( self::$createNonce ) : ?>
                <?php self::createNonce($args); ?>
            <?php endif; ?>
            <input type="hidden" class="metafield" name="<?php echo $fieldName; ?>" value="<?php echo $value; ?>" />
        </div>
        <?php
    }


    /**
     * Create checkbox input
     * @param $args
     */
    protected static function _createCheckboxInput($args) {
        $value       = $args['value'];
        $name        = $args['name'];
        $label       = $args['label'];
        $description = isset($args['description']) ? $args['description'] : '';
        $size        = isset($args['size']) ? $args['size'] : '';
        $required    = isset($args['required']) && $args['required'] === 'true' ? 'required' : '';
        $checked     = intval($value) === 1 ? 'checked' : '';
        $selector    = isset($args['selector']) ? $args['selector'] : '';
        ?>

        <div class="ksfc-metafield <?php echo $size; ?>" data-metafield="checkbox">
            <?php if ( self::$createNonce ) : ?>
                <?php self::createNonce($args); ?>
            <?php endif; ?>

            <?php self::_createHiddenInput($args); ?>

            <input type="checkbox" id="<?php echo $name; ?>" class="metafield <?php echo $selector; ?>" value="<?php echo $value; ?>" title="<?php echo $description; ?>" <?php echo $required; ?> <?php echo $checked; ?>/>

            <label for="<?php echo $name; ?>" title="<?php echo $description; ?>" style="display: inline;">
                <?php echo $label; ?>
            </label>
        </div>

        <script type="text/javascript">
            // Helper
            jQuery(document).ready(function($) {
                $("#" + "<?php echo $name; ?>").on('change', function() {

                    var $field = $(this).parent().find('input[type="hidden"]');
                    if ( $(this).is(':checked') ) {
                        $field.val(1);
                        $field.attr('value', 1);
                    } else {
                        $field.val(0);
                        $field.attr('value', 0);
                    }
                });
            });
        </script>
        <?php
    }


    /**
     * Create date input
     * @param $args
     */
    protected static function _createDateInput($args) {
        $value       = $args['value'];
        $name        = $args['name'];
        $fieldName   = self::getFieldName($args['option_name'], $name);
        $label       = $args['label'];
        $description = isset($args['description']) ? $args['description'] : '';
        $size        = isset($args['size']) ? $args['size'] : '';
        $required    = isset($args['required']) && $args['required'] === 'true' ? 'required' : '';
        $dateFormat  = isset($args['format']) ? $args['format'] : 'dd/mm/yy';
        $selector    = isset($args['selector']) ? $args['selector'] : '';

        ?>
        <div class="ksfc-metafield <?php echo $size; ?>" data-metafield="date">
            <?php if ( self::$createNonce ) : ?>
                <?php self::createNonce($args); ?>
            <?php endif; ?>
            <label for="<?php echo $name; ?>" title="<?php echo $description; ?>"><?php echo $label; ?></label>
            <input type="text" class="metafield <?php echo $selector; ?>" id="<?php echo $name; ?>" name="<?php echo $fieldName; ?>" value="<?php echo $value; ?>" title="<?php echo $description; ?>" <?php echo $required; ?>/>
        </div>

        <script type="text/javascript">
            // Helper
            jQuery(document).ready(function($) {
                $('#' + '<?php echo $name; ?>').datepicker({
                    dateFormat: '<?php echo $dateFormat; ?>'
                });
            });
        </script>
        <?php
    }


    /**
     * Create file input
     * @param $args
     */
    protected static function _createFileInput($args) {
        $value       = $args['value'];
        $name        = $args['name'];
        $fieldName   = self::getFieldName($args['option_name'], $name);
        $label       = $args['label'];
        $description = isset($args['description']) ? $args['description'] : '';
        $size        = isset($args['size']) ? $args['size'] : '';
        $required    = isset($args['required']) && $args['required'] === 'true' ? 'required' : '';
        $btnDownload = $name . '-button-download-file';
        $btnRemove   = $name . '-button-remove-file';
        $buttonId    = $name . '-button';

        ?>
        <div class="ksfc-metafield <?php echo $size; ?>" data-metafield="file">
            <?php if ( self::$createNonce ) : ?>
                <?php self::createNonce($args); ?>
            <?php endif; ?>
            <label for="<?php echo $name; ?>" title="<?php echo $description; ?>"><?php echo $label; ?></label>

            <a href="<?php echo !empty($value) ? $value : '#' ?>" id="<?php echo $btnDownload; ?>" class="button-download-file <?php echo !empty($value) ? '' : 'hidden' ?>" title="<?php echo __('Open file'); ?>" target="_blank"><span class="icon dashicons dashicons-media-default"></span></a>
            <input type="hidden" class="metafield" id="<?php echo $name; ?>" name="<?php echo $fieldName; ?>" value="<?php echo $value; ?>" title="<?php echo $description; ?>" <?php echo $required; ?>/>
            <input type="button" class="button-file-upload" id="<?php echo $buttonId; ?>" value="<?php echo __('Select file'); ?>" title="<?php echo $description; ?>"/>

            <input type="button" class="button-remove-file <?php echo !empty($value) ? '' : 'hidden' ?>" id="<?php echo $btnRemove; ?>" value="<?php echo __('Remove file'); ?>" "/>
        </div>
        <script type="text/javascript">
            // Helper
            jQuery(document).ready(function($) {
                var meta_image_frame;
                var $fileBtn = $('#' + '<?php echo $buttonId; ?>');

                $fileBtn.click(function(e){
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
                        $('#' + '<?php echo $name; ?>').val(media_attachment.url);

                        var $buttonDownloadFile = $('#' + '<?php echo $btnDownload;?>');

                        $('#' + '<?php echo $name; ?>').parent().find('.button-remove-file').removeClass('hidden');
                        $buttonDownloadFile.attr('href', media_attachment.url);
                        $buttonDownloadFile.removeClass('hidden');

                        $('.button-remove-file').on('click', function(e) {
                            e.preventDefault();

                            $('#' + '<?php echo $name; ?>').val('');

                            var $wrapper = $(this).parent();

                            $wrapper.find('.button-download-file').hide();
                            $(this).remove();
                        });
                    });

                    // Opens the media library frame.
                    meta_image_frame.open();
                });

                $('#' + '<?php echo $name; ?>').parent().hover(function(e) {
                    var $btnRemove = $(this).find('.button-remove-file');

                    $btnRemove.addClass('active');
                }, function(e) {
                    var $btnRemove = $(this).find('.button-remove-file');

                    $btnRemove.removeClass('active');
                });

                $('#' + '<?php echo $name; ?>').parent().find('.button-remove-file').on('click', function(e) {
                    e.preventDefault();

                    $('#' + '<?php echo $name; ?>').val('');

                    var $wrapper = $(this).parent();

                    $wrapper.find('.button-download-file').hide();
                    $(this).remove();
                });
            });
        </script>
        <?php
    }

    /**
     * Create image upload
     * @param $args
     */
    protected function __createImageInput($args) {
        $value       = $args['value'];
        $name        = $args['name'];
        $fieldName   = self::getFieldName($args['option_name'], $name);
        $label       = $args['label'];
        $description = isset($args['description']) ? $args['description'] : '';
        $size        = isset($args['size']) ? $args['size'] : '';
        $required    = isset($args['required']) && $args['required'] === 'true' ? 'required' : '';
        $btnDownload = $name . '-button-download-file';
        $btnRemove   = $name . '-button-remove-file';
        $buttonId    = $name . '-button';
        $imgBoxId    = $name . '-image-box';

        ?>
        <div class="ksfc-metafield <?php echo $size; ?>" data-metafield="image">
            <?php if ( self::$createNonce ) : ?>
                <?php self::createNonce($args); ?>
            <?php endif; ?>
            <label for="<?php echo $name; ?>" title="<?php echo $description; ?>"><?php echo $label; ?></label>

            <input type="hidden" class="metafield" id="<?php echo $name; ?>" name="<?php echo $fieldName; ?>" value="<?php echo $value; ?>" title="<?php echo $description; ?>" <?php echo $required; ?>/>

            <div class="image-upload-box <?php echo !empty($value) ? '' : 'hidden' ?>" id="<?php echo $imgBoxId; ?>">
                <a class="gallery-image-link" href="<?php echo $value; ?>"><img src="<?php echo $value; ?>" alt=""/></a>
            </div>

            <input type="button" class="button-file-upload" id="<?php echo $buttonId; ?>" value="<?php echo __('Select file'); ?>" title="<?php echo $description; ?>"/>

            <input type="button" class="button-remove-file <?php echo !empty($value) ? '' : 'hidden' ?>" id="<?php echo $btnRemove; ?>" value="<?php echo __('Remove file'); ?>" "/>

        </div>

        <script type="text/javascript">
            // Helper
            jQuery(document).ready(function($) {
                var meta_image_frame;

                $('#' + '<?php echo $buttonId; ?>').click(function(e){
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
                        $('#' + '<?php echo $name; ?>').val(media_attachment.url);

                        var $imgBox = $('#'+ '<?php echo $args['name']; ?>-image-box');
                        $imgBox.hide();
                        $imgBox.find('img').attr('src', media_attachment.url);
                        $imgBox.find('img').show();
                        $imgBox.removeClass('hidden');
                        $imgBox.fadeIn(300);

                        $('#' + '<?php echo $name; ?>').parent().find('.button-remove-file').removeClass('hidden');
                    });

                    // Runs on open
                    meta_image_frame.on('open', function() {
                        setTimeout(function() {
                            var selection = meta_image_frame.state().get('selection');
                            var $allImages = $('.attachments li');
                            var selectedId = $('#' + '<?php echo $name; ?>').val();

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

                $('#' + '<?php echo $btnRemove; ?>').on('click', function(e) {
                    e.preventDefault();

                    $('#' + '<?php echo $name; ?>').val('');
                    $('#'+ '<?php echo $args['name']; ?>-image-box').hide();

                    $(this).remove();
                });

                // initialize image magnification
                $('#' + '<?php echo $imgBoxId; ?>').find('.gallery-image-link').magnificPopup({
                    type: 'image'
                });
            });
        </script>
        <?php
    }


    /**
     * Create textarea
     * @param $args
     */
    protected function _createTextarea($args) {
        $value       = $args['value'];
        $name        = $args['name'];
        $fieldName   = self::getFieldName($args['option_name'], $name);
        $label       = $args['label'];
        $description = isset($args['description']) ? $args['description'] : '';
        $size        = isset($args['size']) ? $args['size'] : '';
        $required    = isset($args['required']) && $args['required'] === 'true' ? 'required' : '';
        $height      = isset($args['height']) ? $args['height'] : '';
        $selector    = isset($args['selector']) ? $args['selector'] : '';
        ?>

        <div class="ksfc-metafield <?php echo $size; ?>" data-metafield="textarea">
            <?php if ( self::$createNonce ) : ?>
                <?php self::createNonce($args); ?>
            <?php endif; ?>
            <label for="<?php echo $fieldName; ?>" title="<?php echo $description; ?>"><?php echo $label; ?></label>
            <textarea name="<?php echo $fieldName; ?>" title="<?php echo $description; ?>" class="ksfc-textarea <?php echo $height; ?> <?php echo $selector; ?>" <?php echo $required; ?>><?php echo $value; ?></textarea>
        </div>
        <?php
    }


    /**
     * Create dropdown single
     * @param $args
     */
    protected function _createDropdownSingle($args) {
        $value       = $args['value'];
        $name        = $args['name'];
        $fieldName   = self::getFieldName($args['option_name'], $name);
        $label       = $args['label'];
        $description = isset($args['description']) ? $args['description'] : '';
        $size        = isset($args['size']) ? $args['size'] : '';
        $required    = isset($args['required']) && $args['required'] === 'true';
        $selector    = isset($args['selector']) ? $args['selector'] : '';
        $data        = isset($args['data']) && !empty($args['data']) ? $args['data'] : array();
        ?>

        <div class="ksfc-metafield <?php echo $size; ?> <?php echo $selector; ?>" data-metafield="dropdown_single">
            <?php if ( self::$createNonce ) : ?>
                <?php self::createNonce($args); ?>
            <?php endif; ?>
            <label for="<?php echo $fieldName; ?>" title="<?php echo $description; ?>"><?php echo $label; ?></label>

            <select class="view-dropdown-single" name="<?php echo $fieldName; ?>" title="<?php echo $description; ?>">
                <option value="-1" selected="selected"><?php echo __('Select one of the options') ?></option>

                <?php foreach ($data as $item): ?>
                    <option value="<?php echo $item->ID; ?>" <?php echo $value == $item->ID ? 'selected="selected"' : ''; ?>><?php echo $item->post_title; ?></option>
                <?php endforeach ?>
            </select>
            <div class="default-select-icon"><span class="icon dashicons dashicons-arrow-down-alt2"></span></div>
        </div>
        <?php
    }


    /**
     * Create dropdown multiple
     * @param $args
     */
    protected function _createDropdownMultiple($args) {
        $value       = isset($args['value']) && gettype($args['value']) === 'array' ? $args['value'] : array();
        $name        = $args['name'];
        $fieldName   = self::getFieldName($args['option_name'], $name) . '[]';
        $label       = $args['label'];
        $description = isset($args['description']) ? $args['description'] : '';
        $size        = isset($args['size']) ? $args['size'] : '';
        $required    = isset($args['required']) && $args['required'] === 'true';
        $height      = isset($args['height']) ? $args['height'] : '';
        $selector    = isset($args['selector']) ? $args['selector'] : '';
        $data        = isset($args['data']) && !empty($args['data']) ? $args['data'] : array();
        $fieldId     = $name . '-list';
        ?>

        <div class="ksfc-metafield <?php echo $size; ?> <?php echo $selector; ?>" data-metafield="dropdown_single">
            <?php if ( self::$createNonce ) : ?>
                <?php self::createNonce($args); ?>
            <?php endif; ?>
            <label for="<?php echo $fieldName; ?>" title="<?php echo $description; ?>"><?php echo $label; ?></label>

            <?php self::_createHiddenInput($args); ?>

            <ul id="<?php echo $fieldId; ?>" class="multiple-list <?php echo $height; ?>">
                <?php foreach ($data as $item): ?>
                    <?php $itemId = 'id-' . $item->ID; ?>

                    <li>
                        <div>
                            <input type="checkbox" <?php echo in_array($item->ID, $value) ? 'checked="checked"' : ''; ?> value="<?php echo $item->ID; ?>" name="<?php echo $fieldName ?>" id="<?php echo $itemId; ?>" style="display: inline-block;"/>
                            <label for="<?php echo $itemId; ?>" style="display: inline-block; width: auto;">
                                <?php echo $item->post_title; ?>
                            </label>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function($) {

            });
        </script>
    <?php
    }


    /**
     * Create wysiwyg editor
     * @param $args
     */
    protected static function _createWYSIWYG($args) {
        $iconsDir    = get_stylesheet_directory_uri() . '/modules/' . $args['module']['dir'] . '/assets/fonts/trumbowyg/icons.svg';
        $value       = $args['value'];
        $name        = $args['name'];
        $fieldName   = self::getFieldName($args['option_name'], $name);
        $label       = $args['label'];
        $description = isset($args['description']) ? $args['description'] : '';
        $size        = isset($args['size']) ? $args['size'] : '';
        $required    = isset($args['required']) && $args['required'] === 'true' ? 'required' : '';
        $height      = isset($args['$height']) ? $args['$height'] : '';
        $textareaId  = $name . '-textarea';
        $selector    = isset($args['selector']) ? $args['selector'] : '';
        ?>
        <div class="ksfc-metafield <?php echo $size; ?>" data-metafield="editor">
            <?php if ( self::$createNonce ) : ?>
                <?php self::createNonce($args); ?>
            <?php endif; ?>
            <label for="<?php echo $textareaId; ?>" title="<?php echo $description; ?>"><?php echo $label; ?></label>
            <textarea class="textarea-hidden" id="<?php echo $name . '-wysiwyg'; ?>" name="<?php echo $fieldName; ?> <?php echo $selector; ?>"><?php echo $value; ?></textarea>
            <div id="<?php echo $name; ?>" class="wysiwyg-wrapper"></div>
        </div>
        <script type="text/javascript">
            // Helper
            jQuery(document).ready(function ($) {
                var $wysiwygEditor = $('#'+ '<?php echo $name; ?>');

                // Initialize WYSIWYG editor
                $wysiwygEditor.trumbowyg({
                    svgPath: '<?php echo $iconsDir; ?>'
                });

                // Load editor content
                $wysiwygEditor.trumbowyg('html', "<?php echo $value; ?>");

                // Update field value on multiple events
                $wysiwygEditor.on('keyup keydown keypress click', function () {
                    var editorVal = $wysiwygEditor.html();
                    var encodedVal = editorVal.replace(/"/g, "'");
                    $('#' + '<?php echo $name . '-wysiwyg'; ?>').val(encodedVal);
                });

                // Update field value on button press events
                $wysiwygEditor.parent().find('button').on('click', function () {
                    var editorVal = $wysiwygEditor.html();
                    var encodedVal = editorVal.replace(/"/g, "'");
                    $('#' + '<?php echo $name . '-wysiwyg'; ?>').val(encodedVal);
                });

                $wysiwygEditor.parent().addClass('<?php echo $height; ?>');
            });
        </script>
    <?php
    }


    /**
     * Create map
     * @param $args
     */
    protected function _createMap($args) {
        $markerDir   = get_stylesheet_directory_uri() . '/modules/' . $args['module']['dir'] . '/assets/images/map-marker.png';
        $rawValues   = !empty($args['value']) ? preg_replace('/\\\\\"/',"\"", $args['value']) : '';
        $values      = json_decode($rawValues);

        $name        = $args['name'];
        $fieldName   = self::getFieldName($args['option_name'], $name);
        $label       = $args['label'];
        $description = isset($args['description']) ? $args['description'] : '';
        $size        = isset($args['size']) ? $args['size'] : '';
        $required    = isset($args['required']) && $args['required'] === 'true' ? 'required' : '';
        $height      = isset($args['height']) && is_numeric(floatval($args['height']))? $args['height'] : '400px';

        $default_lat_val = 44;
        $default_lng_val = 23;
        $default_zoom_val = 4;

        $lat_val = isset($values->lat) && !empty($values->lat) ? $values->lat : $default_lat_val;
        $lng_val = isset($values->lng) && !empty($values->lng) ? $values->lng : $default_lng_val;
        $zoom_val = isset($values->zoom) && !empty($values->zoom) ? $values->zoom : $default_zoom_val;

        // Set field id
        $fieldId = $name . '-map';
        ?>

        <div class="ksfc-metafield <?php echo $size; ?>" data-metafield="map">
            <div class="map-controls">
                <a href="#" class="button-open-map-settings" title="<?php echo __('Toggle map settings'); ?>" data-control-opened="false"><span class="dashicons dashicons-admin-settings"></span></a>

                <label><?php echo __('Latitude'); ?></label>
                <p>
                    <input type="number" min="-200" max="200" step="0.0000001" name="<?php echo $name . '_lat'; ?>" class="view-field-small" value="<?php echo $lat_val; ?>"/>
                </p>
                <label><?php echo __('Longitude'); ?></label>
                <p>
                    <input type="number" min="-200" max="200" step="0.0000001" name="<?php echo $name . '_lng'; ?>" class="view-field-small" value="<?php echo $lng_val; ?>"/>
                </p>
                <label><?php echo __('Zoom lelve'); ?></label>
                <p>
                    <input type="number" min="0" max="22" step="1" name="<?php echo $name . '_zoom'; ?>" class="view-field-small" value="<?php echo $zoom_val; ?>"/>
                </p>
                <a href="#" class="button-update-map" title="<?php echo __('Press to update the map') ?>"><?php echo __('Update the map'); ?></a>
            </div>

            <textarea class="textarea-hidden" name="<?php echo $fieldName; ?>" id="<?php echo $name; ?>"><?php echo $rawValues; ?></textarea>
            <p class="view-field-title" title="<?php echo $description; ?>"><?php echo $label; ?></p>
            <div id="<?php echo $fieldId ?>" class="view-field-map" style="height: <?php echo $height; ?>;"></div>
        </div>


        <script type="text/javascript">
        // Helper
        jQuery(document).ready(function($) {

            var mapStyle = [];

            var mapDiv = document.getElementById('<?php echo $fieldId; ?>');
            var map = new google.maps.Map(mapDiv, {
                center: {
                    lat: <?php echo $lat_val; ?>,
                    lng: <?php echo $lng_val; ?>
                },
                zoom: <?php echo $zoom_val; ?>,
                styles: mapStyle,
                scrollwheel: false
            });

            var marker = new google.maps.Marker({
                position: {
                    lat: <?php echo $lat_val; ?>,
                    lng: <?php echo $lng_val; ?>
                },
                map: map,
                title: 'Selected location',
                icon: '<?php echo $markerDir; ?>'
            });

            google.maps.event.addDomListener(window, "resize", function() {
                var center = map.getCenter();
                google.maps.event.trigger(map, "resize");
                map.setCenter(center);
            });

            var $mapWrapper = $('#' + '<?php echo $fieldId; ?>');

            $mapWrapper.parent().find('.map-controls input').on('keyup keydown keypress click', function(e) {

                var data = {
                    lat: $('input[name=<?php echo $args['name'] . '_lat'; ?>]').val(),
                    lng: $('input[name=<?php echo $args['name'] . '_lng'; ?>]').val(),
                    zoom: $('input[name=<?php echo $args['name'] . '_zoom'; ?>]').val()
                };

                $('#' + '<?php echo $name; ?>').html(JSON.stringify(data));
            });

            $mapWrapper.parent().find('.button-update-map').on('click', function(e) {
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
                    icon: '<?php echo $markerDir; ?>'
                });
            });

            $mapWrapper.parent().find('.button-open-map-settings').on('click', function(e) {
                e.preventDefault();

                var isOpened = $(this).attr('data-control-opened') !== 'false';
                $('#' + '<?php echo $fieldId; ?>').parent().find('.map-controls').addClass('active');

                if ( isOpened ) {
                    $(this).parent().removeClass('active');
                    $(this).attr('data-control-opened', false);

                } else {
                    $(this).parent().addClass('active');
                    $(this).attr('data-control-opened', true);
                }
            });
        });
        </script>
        <?php
    }



    /**
     * Create plain text
     * @param $args
     */
    protected function _createPlainText($args) {
        $size          = $args['size'];
        $block         = is_array($args['block']) ? $args['block'] : array($args['block']);
        $block['text'] = isset($block['text']['p']) ? array($block['text']) : $block['text'];
        $selector      = isset($args['selector']) ? $args['selector'] : '';
        ?>

        <div class="ksfc-metafield <?php echo $size; ?> <?php echo $selector; ?>" data-metafield="plain_text">

        <?php

        if ( ! empty($block) ) {
            foreach( $block as $b ) {
                $currBlock = is_array($b) ? $b : array($b);

                foreach( $currBlock as $field ) {
                    $heading = isset($field['h']) ? $field['h'] : null;
                    $text = isset($field['p']) ? $field['p'] : null;
                    $link = isset($field['link']) ? $field['link'] : null;
                    $link_text = isset($field['link_text']) ? $field['link_text'] : null;
                    $ribbon = isset($field['ribbon']) ? $field['ribbon'] : null;

                    if ( $heading ) {
                        ?>
                            <p><strong><?php echo __($heading); ?></strong></p>
                        <?php
                    }

                    if ( $text ) {
                        $text = is_array($text) ? $text : array($text);
                        foreach ( $text as $t ) {
                            ?>
                                <p><?php echo __($t); ?></p>
                            <?php
                        }
                    }

                    if ( $ribbon ) {
                        $ribbon = is_array($ribbon) ? $ribbon : array($ribbon);
                        foreach ( $ribbon as $r ) {
                            ?>
                                <div class="ribbon"><p><?php echo __($r); ?></p></div>
                            <?php
                        }
                    }

                    if ( $link && $link_text ) {
                        ?>
                            <a href="<?php echo $link; ?>" target="_blank"><?php echo __($link_text); ?></a>
                        <?php
                    }
                }
            }
        }

        ?>
        </div>
        <?php
    }


    /**
     * Create gallery
     * @param $args
     */
    protected function _createGallery($args) {
        $originalVal = $args['value'];
        $rawValues   = !empty($originalVal) ? preg_replace('/\\\\\"/',"\"", $originalVal) : '';
        $value       = json_decode($rawValues);
        $name        = $args['name'];
        $fieldName   = self::getFieldName($args['option_name'], $name);
        $label       = $args['label'];
        $description = isset($args['description']) ? $args['description'] : '';
        $size        = isset($args['size']) ? $args['size'] : '';
        $required    = isset($args['required']) && $args['required'] === 'true' ? 'required' : '';
        $buttonId    = $name . '-button';
        $fieldId     = $name . '-gallery';
        $textareaId  = $name . '-textarea';
        ?>

        <div class="ksfc-metafield <?php echo $size; ?>" data-metafield="gallery">
            <?php if ( self::$createNonce ) : ?>
                <?php self::createNonce($args); ?>
            <?php endif; ?>
            <label for="<?php echo $fieldName; ?>" title="<?php echo $description; ?>"><?php echo $label; ?></label>

            <div class="view-gallery-wrapper" id="<?php echo $fieldId; ?>">

                <div class="gallery-frame" id="<?php echo $name; ?>">
                    <ul>
                        <?php if ( ! empty($value) ) : ?>

                            <?php foreach ($value as $item): ?>
                                <li>
                                    <div class="gallery-image-wrapper">
                                        <a href="<?php echo $item->url; ?>" class="gallery-image-link"><img src="<?php echo $item->url; ?>" /></a>
                                    </div>
                                </li>
                            <?php endforeach ?>
                        <?php endif; ?>
                    </ul>
                    <input type="button" class="button-image-upload" id="<?php echo $buttonId; ?>" value="<?php echo __('Select images') ?>"/>
                </div>
            </div>
            <textarea class="textarea-hidden" name="<?php echo $fieldName; ?>" id="<?php echo $textareaId; ?>"><?php echo strlen($rawValues) > 0 ? $rawValues : '{}'; ?></textarea>
        </div>
        <script type="text/javascript">
            // Helper
            jQuery(document).ready(function($) {

                // Init gallery
                kenobiSoft.metafields.gallery.init();

                var meta_image_frame;

                var contains = function(ids, val) {

                    // console.log(ids, val);

                    for (var i in ids.urls) {
                        var cleanUrl = val.replace(/-\d+x\d+((\.png)|(\.jpg)|(\.gif)|(\.tif))/g, '');

                        if (ids.urls[i].url.indexOf(cleanUrl) !== -1 && !ids.checked[i] ) {
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
                        urls.push({
                            id: data[i].id,
                            url: data[i].url
                        });
                    }

                    var dataStr = JSON.stringify(urls);

                    // Add urls as value to the metafield
                    $('#' + '<?php echo $textareaId; ?>').html(dataStr);

                    var $galleryWrapper = $('#' + '<?php echo $fieldId; ?>');

                    $galleryWrapper.hide();

                    $galleryWrapper.empty();

                    var $html = '<div class="gallery-frame"><ul>';

                    for (var u in urls) {

                        $html += '<li><div class="gallery-image-wrapper"><a class="gallery-image-link" href="' + urls[u].url + '"><img src="' + urls[u].url + '"/></a></div></li>';
                    }

                    $html += '</ul></div>';

                    $galleryWrapper.append($html);

                    // Start programatically metafield [gallery]
                    kenobiSoft.metafields.gallery.init();

                    $galleryWrapper.fadeIn(300);
                });

                // Runs on open
                meta_image_frame.on('open', function() {

                    setTimeout(function() {
                        var selection = meta_image_frame.state().get('selection');

                        var $allImages = $('.attachments li');

                        var ids = {
                            urls: JSON.parse($('#' + '<?php echo $textareaId; ?>').val()),
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

                $('#' + '<?php echo $buttonId; ?>').click(function(e){
                    e.preventDefault();

                    // Opens the media library frame.
                    meta_image_frame.open();
                });
            });
        </script>
        <?php
    }


    /**
     * Get field name
     * @param string $optionName
     * @param string $name
     * @return string
     */
    protected static function getFieldName($optionName, $name) {
        return $optionName . '[' . $name . ']';
    }


    /**
     * Create nonce
     * @param $args
     */
    protected static function createNonce($args) {
        ?>
            <input type="hidden" name="<?php echo $args['name'] . '_noncename'; ?>" id="<?php echo $args['name'] . '_noncename'; ?>" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>"/>
        <?php
    }

}