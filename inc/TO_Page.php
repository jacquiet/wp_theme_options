<?php

class TO_Page {

    /*
     * @property string $name
     */
    protected $name = '';


    /*
     * @property array $sections
     */
    protected $sections = array();


    /*
     * Construct
     * @param array $args
     */
    public function __construct($args) {

        // validate input
        $isValid = $this->validate('input', $args);

        // if valid
        if ( $isValid ) {

            // setup page
            $this->setupPage($args);
        }
    }


    /*
     * Setup page
     * @param array $args
     */
    protected function setupPage($args) {

        // set name
        $this->name = strtolower(basename($args['name'], '.php'));

        // check if sections exist
        if ( $this->exists($args['sections']) ) {

            // iterate over sections
            foreach ($args['sections'] as $key => $data) {
                $this->sections[$key] = (object) $data;
            }

            // convert sections to object
            $this->sections = (object) $this->sections;
        }

    }


    /*
     * Validate
     * @param string $type
     * @param array $args
     * @return boolean $isValid
     */
    protected function validate($type, $args) {
        $isValid = true;

        switch ($type) {
            case 'input':
                if ( ! $this->exists($args['name']) ) {
                    $isValid = false;
                }
                break;
            default:
                break;
        }

        return $isValid;
    }


    /*
     * Exists
     * @param mixed $var
     * @return boolean
     */
    protected function exists($var) {
        return isset($var) || !empty($var);
    }


    /*
     * Get name
     * @return property $name
     */
    public function getName() {
        return $this->name;
    }


    /*
     * Get sections
     * @return property sections
     */
    public function getSections() {
        return $this->sections;
    }

    /*
     * Display
     * @param string $prop
     * @echo $prop
     */
    public function display($prop) {
        if ( $this->exists($this->$prop) ) {
            echo __(ucfirst($this->$prop));
        }
    }


    /*
     * Before section
     * @param string $section
     * @adds the before content of section
     */
    public function beforeSection($section) {
        ?>

        <!-- view-block -->
        <div class="view-block">

            <!-- title -->
            <div class="view-block-title">
                <p class="block-title"><?php echo $section->title; ?></p>

                <p class="block-subtitle"><?php echo $section->subtitle; ?></p>
            </div>
            <!-- /title -->

            <!-- content -->
            <div class="view-block-content">

        <?php
    }


    /*
     * After section
     * @param string $sections
     * @adds the after content of section
     */
    public function afterSection() {
        ?>

        </div>
        <!-- /content -->

        </div>
        <!-- /view-block -->

        <?php
    }


    /*
     * Before content
     * @adds the before content of page
     */
    public function beforeContent() {

        // instantiate helper
        $helper = new Helper();

        // instantiate metabox
        $metabox = new Metabox();

        ?>

        <!-- view-page -->
        <div class="view-page" data-view-page="<?php echo $this->getName(); ?>">

        <!-- REQUIRED: form -->
        <form class="view-form" action="options.php" method="POST">

        <!-- REQUIRED: insert security fields -->
        <?php settings_fields('sa_theme_options'); ?>

        <!-- REQUIRED: create hidden fields for module options -->
        <?php $metabox->createOptionFields(); ?>

        <!-- page name -->
        <p class="view-page-heading"><?php echo $helper->getPageTitle($this->name); ?></p>

        <?php
    }


    /*
     * After content
     * @adds the after content of page
     */
    public function afterContent() {

        ?>

        <!-- REQUIRED: button-submit-hidden -->
        <!-- This hidden button is triggered via JS, without it the form validation doesn't work -->
        <input type="submit" class="button-submit-hidden"/>

        </form>
        <!-- /form -->

        </div>
        <!-- /view-page -->

        <?php
    }
}