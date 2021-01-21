<?php
/**
 * Template Name: Contact Page
 *
 * @package WordPress
 * @subpackage Alshorts
 * @since Alshorts 1.0
 */
get_header();

/**
 * For Contact Register.
 */
if (!empty($_POST) && !empty($_POST['contact_form_register_submit'])) {
    $name = ucwords(strtolower($_POST['contact_name']));
    $email = strtolower($_POST['contact_email']);

    //Create new post into contacts post_type
    $contacts_post_create = array(
        'post_title' => wp_strip_all_tags($name),
        'post_content' => $_POST['contact_description'],
        'post_status' => 'publish',
        'post_type' => 'contacts',
    );

// Insert the post into the database
    $getting_contact_form_id = wp_insert_post($contacts_post_create);
    if (!empty($getting_contact_form_id)) {
        //update contact phone number.
        update_post_meta($getting_contact_form_id, 'contact_phone', $_POST['contact_phone_number']);

        //update contact email number.
        update_post_meta($getting_contact_form_id, 'contact_email', $email);

        //update contact interest number.
        update_post_meta($getting_contact_form_id, 'contact_interested', $_POST['contact_interest']);

        //update contact project budget number.
        update_post_meta($getting_contact_form_id, 'contact_project_budget', $_POST['contact_budget']);

        //update contact project deadline number.
        update_post_meta($getting_contact_form_id, 'contact_project_deadline', date("d-m-Y", strtotime($_POST['contact_deadline'])));

        //update contact NDA.
        update_post_meta($getting_contact_form_id, 'contact_nda', (!empty($_POST['contact_nda']) ? $_POST['contact_nda'] : 'no'));

        //Getting attached file
        if (!empty($_FILES['contact_file_rfp'])) {
            $applicant_nationalid = wp_upload_bits($_FILES['contact_file_rfp']['name'], null, file_get_contents($_FILES['contact_file_rfp']['tmp_name']));
            //update contact upload RFP.
            if (!empty($applicant_nationalid['url'])) {
                update_post_meta($getting_contact_form_id, 'contact_upload_rfp', $applicant_nationalid['url']);
            }
        }
        $reg_success_message = "Form submit successfully!!"; //success message set
        //echo "<script type='text/javascript'>window.location.href='" . home_url('/contact/') . "'</script>";
        //exit();
    } else {
        $reg_error_message = "Form not submit"; //error message set
    }
}
?>
<style>
    .error {
        color: red;
    }
</style>
<!-- Main Top Sec -->
<section class="contact-main">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-9">
                <?php if (!empty($reg_success_message)) { ?>
                    <div class="alert alert-success">
                        <?= $reg_success_message; ?>
                    </div>
                <?php } if (!empty($reg_error_message)) { ?>
                    <div class="alert alert-danger">
                        <?= $reg_error_message; ?>
                    </div>
                <?php } unset($_POST); ?>
                <div class="contact-form">
                    <!-- Contact Us Form Start -->
                    <form onsubmit="return contactCheckBeforeSubmit()" name="contact_form_register" method="post" autocomplete="off" enctype="multipart/form-data" action="">
                        <div class="row">
                            <div class="col-12 col-sm-6 position-relative">
                                <div class="form-group">
                                    <div class="before-border"></div>
                                    <input type="text" name="contact_name" placeholder="Your Name" autocomplete="new-contact_name" class="form-control input-img text">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 position-relative">
                                <div class="form-group">
                                    <div class="before-border"></div>
                                    <input type="mail" name="contact_email" placeholder="Your Email" autocomplete="new-contact_email" class="form-control input-img mail">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 position-relative">
                                <div class="form-group">
                                    <div class="before-border"></div>
                                    <input type="phone" name="contact_phone_number" placeholder="Your Phone" autocomplete="new-contact_phone_number" class="form-control input-img phone">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 position-relative">
                                <div class="form-group">
                                    <div class="before-border"></div>
                                    <input type="text" name="contact_interest" placeholder="I am Interested in" autocomplete="new-contact_interest" class="form-control input-img interest">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 position-relative">
                                <div class="form-group">
                                    <div class="before-border"></div>
                                    <input type="number" name="contact_budget" min="1" placeholder="Select Project Budget (in USD)*" autocomplete="new-contact_budget" class="form-control input-img budget">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 position-relative contact_deadline_div">
                                <div class="form-group">
                                    <div class="before-border"></div>
<!--                                    <input type="text" name="contact_deadline" placeholder="What is your Project deadline?*" autocomplete="new-contact_deadline" class="form-control input-img deadline" onfocus="(this.type = 'date')"/>-->
                                    <input type="text" name="contact_deadline" placeholder="What is your Project deadline?*" autocomplete="new-contact_deadline" class="form-control input-img deadline" id="contact_deadline" onfocus="(this.type = 'date')"/>
                                </div>
                            </div>
                            <div class="col-12 position-relative">
                                <div class="form-group">
                                    <div class="before-border"></div>
                                    <textarea name="contact_description" placeholder="About your Project" autocomplete="new-contact_description" class="form-control input-img textarea"></textarea>
                                </div>
                            </div>
                            <div class="col-12 position-relative">
                                <div class="row align-items-center">
                                    <div class="col-sm-8">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <div class="form-group d-flex file">
                                                    <input type="file" name="contact_file_rfp" autocomplete="new-contact_file_rfp">
                                                    <label><strong>Upload & RFP</strong>10 MB Max</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group d-flex checkbox">
                                                    <input type="checkbox" name="contact_nda" autocomplete="new-contact_nda" id="checkbox" value="yes">
                                                    <label for="checkbox">Send me NDA</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 text-sm-right">
                                        <input type="submit" name="contact_form_register_submit" value="Submit" placeholder="Submit" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Contact Us Form End -->

                    <div class="contact-inner">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="email-wrep">
                                    <div class="inner">
                                        <div class="them-icon"><img src="<?= get_template_directory_uri(); ?>/images/email-icon.svg"></div>
                                        <span>Work for Us</span></div>
                                    <span class="mail-id"><a href="mailto:jobs@alshorts.com">jobs@alshorts.com</a></span></div>
                            </div>
                            <div class="col-sm-5">
                                <div class="email-wrep">
                                    <div class="inner">
                                        <div class="them-icon"><img src="<?= get_template_directory_uri(); ?>/images/email-icon.svg"></div>
                                        <span>Work for Us</span></div>
                                    <span class="mail-id"><a href="mailto:jobs@alshorts.com">jobs@alshorts.com</a></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="contact-inner style-2">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="email-wrep">
                                    <div class="inner">
                                        <div class="them-icon"><img src="<?= get_template_directory_uri(); ?>/images/email-icon.svg"></div>
                                        <span>Come to meet US</span></div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="email-wrep">
                                    <div class="inner">
                                        <div class="them-icon"><img src="<?= get_template_directory_uri(); ?>/images/email-icon.svg"></div>
                                        <span>Copyright Infrigement/Feedback</span></div>
                                    <span class="mail-id"><a href="mailto:jobs@alshorts.com">jobs@alshorts.com</a></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="addres">
                        <h3>Alshorts FZC LLC</h3>
                        <p>Office No. 35, Level 38, Media one hotel<br>
                            Dubai, Media City, PO Box 113999, UAE</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="call-ditels"><span>Call:</span><span><a href="#0">+971 44 396302</a><a href="#0">+971 44 396302</a></span></div>
                            <div class="call-ditels"><span>Email:</span><span><a href="#0">business@alshorts.com</a></span></div>
                        </div>
                        <div class="col-sm-5">
                            <div class="follow-on"><span>Follow Us on:</span>
                                <ul class="social-list">
                                    <li><a href="#0"><img src="<?= get_template_directory_uri(); ?>/images/facebook.svg" alt="facebook"/></a></li>
                                    <li><a href="#0"><img src="<?= get_template_directory_uri(); ?>/images/instagram.svg" alt="instagram"/></a></li>
                                    <li><a href="#0"><img src="<?= get_template_directory_uri(); ?>/images/linkedin.svg" alt="linkedin"/></a></li>
                                    <li><a href="#0"><img src="<?= get_template_directory_uri(); ?>/images/twitter.svg" alt="twitter"/></a></li>
                                    <li><a href="#0"><img src="<?= get_template_directory_uri(); ?>/images/youtube.svg" alt="youtube"/></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3"></div>
        </div>
    </div>
</section>
<?php get_footer(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script type="text/javascript">
                                        /**
                                         * Single Click Form Submit
                                         * @type type
                                         */
                                        var wasSubmitted = false;
                                        function contactCheckBeforeSubmit() {
                                            if (!wasSubmitted) {
                                                wasSubmitted = true;
                                                return wasSubmitted;
                                            }
                                            return false;
                                        }
                                        
                                        /**
                                         * Phone number field type only number.
                                         */
                                        $(".phone").keypress(function (e) {
                                            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                                                return false;
                                            }
                                        });

                                        $(document).ready(function () {

                                            $(".alert-success,.alert-danger").delay(3000).fadeOut(); //fadeout alert message div.

                                            //contact form validation
                                            $("form[name='contact_form_register']").validate({
                                                rules: {
                                                    contact_name: {
                                                        required: true,
                                                    },
                                                    contact_email: {
                                                        required: true,
                                                        email: true
                                                    },
                                                    contact_phone_number: {
                                                        required: true,
                                                        number: true,
                                                        minlength: 10,
                                                        maxlength: 10
                                                    },
                                                    contact_interest: {
                                                        required: true,
                                                    },
                                                    contact_budget: {
                                                        required: true,
                                                    },
                                                    contact_deadline: {
                                                        required: true,
                                                    },
                                                    contact_description: {
                                                        required: true,
                                                    },
                                                },
                                                messages: {
                                                    contact_name: "Name field required",
                                                    contact_phone_number: {
                                                        required: "Phone number field required",
                                                        minlength: "Phone number must be 10 digit long.",
                                                        maxlength: "Phone number must be 10 digit long."
                                                    },
                                                    contact_email: "Please enter a valid email address",
                                                    contact_interest: "Interest field required",
                                                    contact_budget: "Project budget field required",
                                                    contact_deadline: "Project deadline field required",
                                                    contact_description: "Project description field required",
                                                },
                                                submitHandler: function (form) {
                                                    form.submit();
                                                }
                                            });
                                        });
</script>

