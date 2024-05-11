<?php

class Mydental_Photos_Blog_Testimonials_Option {



    public function __construct() {
        
        if(!empty($_POST['mydental_photos_blog_testimonials_options'])) {
            update_option( 'mydental_photos_blog_testimonials_options', $_POST['mydental_photos_blog_testimonials_options']);

        }

        add_action('admin_menu', array($this, 'add_plugin_page'));

        // add_action('admin_init', array($this, 'virtual_consultation_register_settings'));

        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue'));

    }



    public function add_plugin_page() {

        add_menu_page(

            'Mydental Touch Social (photos, blog, testimonials) Settings',

            'Mydental Touch Social (photos, blog, testimonials)',

            'manage_options',

            'mydental-photos-blog-testimonials-settings',

            array($this, 'create_admin_page'),

            'dashicons-admin-generic',

            80

        );

    }


    public function create_admin_page() {


        $active_tab = 'general_setting';
        if(!empty($_POST['active_tab'])) {
            $active_tab = $_POST['active_tab'];
        }

        ?>

        <div class="wrap">

            <h1>Mydental Touch Social (photos, blog, testimonials) Settings</h1>

            <nav class="nav-tab-wrapper">
                <a href="#" data-tab="#general_setting" class="<?php echo($active_tab==='general_setting'?'active':'') ?> nav-tab">General Settings</a>
                <a href="#" data-tab="#man_setting" class="<?php echo($active_tab==='man_setting'?'active':'') ?> nav-tab" style="display:none">Men's Settings</a>
            </nav>

            <form method="post">
                
                <input type="hidden" name="active_tab" value="<?php echo $active_tab;  ?>"/>

                <div id="general_setting" class="nav-tab_item <?php echo($active_tab==='general_setting'?'active':'') ?>">

                    <h2>Button Styles</h2>
                    <table class="form-table">

                        <tr valign="top">

                            <th scope="row">Button Background Color</th>

                            <td><input type="color" name="mydental_photos_blog_testimonials_options[button_background_color]" value="<?php echo esc_attr(get_option('mydental_photos_blog_testimonials_options')['button_background_color']); ?>" /></td>

                        </tr>

                        <tr valign="top">

                            <th scope="row">Button Text Color</th>

                            <td><input type="color" name="mydental_photos_blog_testimonials_options[button_text_color]" value="<?php echo esc_attr(get_option('mydental_photos_blog_testimonials_options')['button_text_color']); ?>" /></td>

                        </tr>

                        <!-- Add more fields for button styles -->

                        <tr valign="top">

                            <th scope="row">Border Light</th>

                            <td><input type="color" name="mydental_photos_blog_testimonials_options[border_light]" value="<?php echo esc_attr(get_option('mydental_photos_blog_testimonials_options')['border_light']); ?>" /></td>

                        </tr>

                        <tr valign="top">

                            <th scope="row">Border Dark</th>

                            <td><input type="color" name="mydental_photos_blog_testimonials_options[border_dark]" value="<?php echo esc_attr(get_option('mydental_photos_blog_testimonials_options')['border_dark']); ?>" /></td>

                        </tr>

                    </table>
                    <h2>Text Styles</h2>
                    <table class="form-table">

                        <tr valign="top">

                            <th scope="row">Text Color</th>

                            <td><input type="color" name="mydental_photos_blog_testimonials_options[text_color]" value="<?php echo esc_attr(get_option('mydental_photos_blog_testimonials_options')['text_color']); ?>" /></td>

                        </tr>

                        <tr valign="top">

                            <th scope="row">Font Family</th>

                            <td><input type="text" name="mydental_photos_blog_testimonials_options[font_family]" value="<?php echo esc_attr(get_option('mydental_photos_blog_testimonials_options')['font_family']); ?>" /></td>

                        </tr>

                        <tr valign="top">

                            <th scope="row">Received Email Notifications</th>
                            <td>
                                <input rows=10 type="text" name="mydental_photos_blog_testimonials_options[admin_email]" value="<?php echo esc_attr(get_option('mydental_photos_blog_testimonials_options')['admin_email']); ?>">
                            </td>
                        </tr>



                        <!-- Add more fields for text styles -->

                    </table>
                    
                </div>
                
                
                <?php

                submit_button('Save Settings');

                ?>

            </form>
            <style>
                .concern-header {
                    display: flex;
                    justify-content: space-between;
                }
                div[data-concern]{
                    border: 1px solid;
                    border-radius: 5px;
                    padding: 5px;
                    margin: 5px 0;
                }
                .add{
                    font-size: 34px;
                    cursor: pointer;
                }

                .concerns span.concern-item {
                    cursor: pointer; 
                    font-size: 0.5rem;
                    font-weight: bolder;
                    display: flex;
                    margin: 0 0.5rem 0.5rem;
                }

                .concerns {
                    display: flex;
                    flex-wrap: wrap;
                }
               /* Style for form container */
                .wrap {
                    max-width: 800px;
                    margin: 20px auto 0 auto;
                    padding: 20px;
                    background-color: #f9f9f9;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                }

                /* Style for form headings */
                h1, h2, h3 {
                    margin-top: 0;
                    font-family: Arial, sans-serif;
                }

                .wpbody-content h1{
                    margin-bottom: 20px;
                }

                /* Style for form table */
                .form-table {
                    width: 100%;
                    border-collapse: collapse;
                }

                /* Style for form table headings */
                .form-table th {
                    font-weight: bold;
                    text-align: left;
                    padding: 8px;
                }

                /* Style for form table cells */
                .form-table td {
                    padding: 8px;
                }

                /* Style for input fields */
                input[type="color"], input[type="email"], input[type="text"], textarea {
                    width: 100%;
                    padding: 8px;
                    border: 1px solid #ccc;
                    border-radius: 3px;
                    box-sizing: border-box;
                    margin-top: 4px;
                    margin-bottom: 8px;
                    font-size: 14px;
                }

                /* Style for buttons */
                button {
                    background-color: #4CAF50;
                    color: white;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 3px;
                    cursor: pointer;
                    font-size: 16px;
                }

                button:hover {
                    background-color: #45a049;
                }

                /* Style for concerns section */
                .concerns_container {
                    margin-top: 20px;
                }

                .concern-header {
                    display: flex;
                    justify-content: space-between;
                }

                .add {
                    font-size: 24px;
                    cursor: pointer;
                }

                .concerns span.concern-item {
                    cursor: pointer;
                    font-size: 14px;
                    font-weight: bold;
                    display: inline-block;
                    margin-right: 10px;
                    margin-bottom: 10px;
                    padding: 6px 10px;
                    border-radius: 3px;
                    background-color: #f0f0f0;
                }

                .concerns span.concern-item p.delete {
                    display: inline;
                    margin-left: 10px;
                    cursor: pointer;
                }

                .concerns span.concern-item:hover {
                    background-color: #e0e0e0;
                }


                /* Style for input[type="color"] */
                input[type="color"] {
                    width: 100px; /* Adjust width as needed */
                    height: 40px; /* Adjust height as needed */
                    padding: 0; /* Remove padding */
                    border: none; /* Remove border */
                    border-radius: 5px; /* Add border-radius */
                    outline: none; /* Remove default focus outline */
                    cursor: pointer; /* Change cursor on hover */
                }

                /* Style for input[type="color"] on hover */
                input[type="color"]:hover {
                    filter: brightness(1.2); /* Increase brightness on hover */
                }
                

                .image-thumbnail_container {
                    height: 100px;
                    width: 100px;
                }

                .image-thumbnail_container img{

                    object-fit: contain;
                    height: inherit;
                    width: fit-content;
                }

                .concerns-label {
                    display: flex;
                    padding: 0 1.5rem;
                }

                a.active.nav-tab {
                    color: black;
                    font-weight: bold;
                }
                nav.nav-tab-wrapper {
                    margin-bottom: 1rem;
                }


                #general_setting,#man_setting,#woman_setting {
                    display: none;
                }
                .active#general_setting,.active#man_setting,.active#woman_setting {                    
                    display: unset !important;
                }

            </style>

        </div>

        <?php

    }


    public function admin_enqueue() {
        wp_enqueue_media();
        wp_enqueue_script('mydental-photos-blog-testimonials-style', plugin_dir_url(__FILE__) . '../../assets/js/admin.js',array('jquery'), null, true);
    }

    public function enqueue_styles_and_scripts() {

        wp_enqueue_style('mydental-photos-blog-testimonials-style', plugin_dir_url(__FILE__) . '../css/style.css');

        wp_enqueue_style('mydental-photos-blog-testimonials-style', plugin_dir_url(__FILE__) . '../js/admin.js',array('jquery'), null, true);

        wp_enqueue_script('mydental-photos-blog-testimonials-script', plugin_dir_url(__FILE__) . '../js/script.js', array('jquery'), null, true);

    }

}



$virtual_consultation = new Mydental_Photos_Blog_Testimonials_Option();

