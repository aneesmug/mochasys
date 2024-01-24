<?php include('./includes/menu.php'); ?>
<?php $query_team = mysqli_query($conDB, "SELECT * FROM `employees` WHERE `emptype`='Manager' AND `status`='active' AND `emp_id` <> '2' ORDER BY `emp_id` ASC "); ?>
<!-- Begin content -->
<div id="page-content-wrapper" class="no-title">
<div class="inner">
<!-- Begin main content -->
<div class="inner-wrapper">
<div class="sidebar-content fullwidth">
<div data-elementor-type="wp-page" data-elementor-id="3954" class="elementor custom-css-style" data-elementor-settings="[]">
<div class="elementor-inner">
<div class="elementor-section-wrap">
    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-f198032 elementor-section-stretched elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle"
        data-id="f198032"
        data-element_type="section"
        data-settings='{"stretch_section":"section-stretched","background_background":"classic","craftcoffee_ext_is_background_parallax":"true","craftcoffee_ext_is_background_parallax_speed":{"unit":"px","size":0.8000000000000000444089209850062616169452667236328125,"sizes":[]}}'
    >
        <div class="elementor-background-overlay"></div>
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-row">
                <div
                    class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-ded849a"
                    data-id="ded849a"
                    data-element_type="column"
                    data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                >
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div
                                class="elementor-element elementor-element-0f9fe24 elementor-widget elementor-widget-heading"
                                data-id="0f9fe24"
                                data-element_type="widget"
                                data-settings='{"craftcoffee_ext_is_smoove":"true","craftcoffee_ext_smoove_disable":"769","craftcoffee_ext_smoove_duration":1000,"craftcoffee_ext_smoove_scalex":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_scaley":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_translatey":{"unit":"px","size":100,"sizes":[]},"craftcoffee_ext_is_fadeout_animation":"true","craftcoffee_ext_is_fadeout_animation_velocity":{"unit":"px","size":0.299999999999999988897769753748434595763683319091796875,"sizes":[]},"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_smoove_rotatex":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_rotatey":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_rotatez":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_translatex":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_translatez":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_skewx":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_skewy":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_perspective":{"unit":"px","size":1000,"sizes":[]},"craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation_direction":"up"}'
                                data-widget_type="heading.default"
                            >
                                <div class="elementor-widget-container">
                                    <h3 class="elementor-heading-title elementor-size-default">Meet Our</h3>
                                </div>
                            </div>
                            <div
                                class="elementor-element elementor-element-205a0be elementor-widget elementor-widget-heading"
                                data-id="205a0be"
                                data-element_type="widget"
                                data-settings='{"craftcoffee_ext_is_smoove":"true","craftcoffee_ext_smoove_disable":"769","craftcoffee_ext_smoove_duration":1000,"craftcoffee_ext_smoove_scalex":{"unit":"px","size":2,"sizes":[]},"craftcoffee_ext_smoove_scaley":{"unit":"px","size":2,"sizes":[]},"craftcoffee_ext_is_fadeout_animation":"true","craftcoffee_ext_is_fadeout_animation_direction":"down","craftcoffee_ext_is_fadeout_animation_velocity":{"unit":"px","size":0.5,"sizes":[]},"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_smoove_rotatex":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_rotatey":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_rotatez":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_translatex":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_translatey":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_translatez":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_skewx":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_skewy":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_perspective":{"unit":"px","size":1000,"sizes":[]},"craftcoffee_ext_is_infinite":"false"}'
                                data-widget_type="heading.default"
                            >
                                <div class="elementor-widget-container">
                                    <h1 class="elementor-heading-title elementor-size-default">Team</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-3bcf3af elementor-section-stretched elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle"
        data-id="3bcf3af"
        data-element_type="section"
        data-settings='{"stretch_section":"section-stretched","background_background":"classic","craftcoffee_ext_is_background_parallax":"false"}'
    >
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-row">
                <div
                    class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-e67c6b7"
                    data-id="e67c6b7"
                    data-element_type="column"
                    data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                >
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div
                                class="elementor-element elementor-element-f740045 elementor-widget elementor-widget-spacer"
                                data-id="f740045"
                                data-element_type="widget"
                                data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                data-widget_type="spacer.default"
                            >
                                <div class="elementor-widget-container">
                                    <div class="elementor-spacer">
                                        <div class="elementor-spacer-inner"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-563af5c elementor-section-stretched elementor-section-height-min-height elementor-section-items-top elementor-section-full_width elementor-section-height-default"
        data-id="563af5c"
        data-element_type="section"
        data-settings='{"stretch_section":"section-stretched","background_background":"classic","craftcoffee_ext_is_background_parallax":"false"}'
    >
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-row">
                <div
                    class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-0402a64"
                    data-id="0402a64"
                    data-element_type="column"
                    data-settings='{"background_background":"classic","craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                >
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div
                                class="elementor-element elementor-element-ff26c41 elementor-widget elementor-widget-spacer"
                                data-id="ff26c41"
                                data-element_type="widget"
                                data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                data-widget_type="spacer.default"
                            >
                                <div class="elementor-widget-container">
                                    <div class="elementor-spacer">
                                        <div class="elementor-spacer-inner"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-43fe0ae"
                    data-id="43fe0ae"
                    data-element_type="column"
                    data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                >
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div
                                class="elementor-element elementor-element-127140c elementor-widget__width-auto elementor-widget-divider--view-line elementor-widget elementor-widget-divider"
                                data-id="127140c"
                                data-element_type="widget"
                                data-settings='{"craftcoffee_ext_is_smoove":"true","craftcoffee_ext_smoove_disable":"769","craftcoffee_ext_smoove_duration":1000,"craftcoffee_ext_smoove_scalex":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_scaley":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_smoove_rotatex":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_rotatey":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_rotatez":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_translatex":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_translatey":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_translatez":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_skewx":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_skewy":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_perspective":{"unit":"px","size":1000,"sizes":[]},"craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                data-widget_type="divider.default"
                            >
                                <div class="elementor-widget-container">
                                    <div class="elementor-divider">
                                        <span class="elementor-divider-separator"> </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="elementor-element elementor-element-1005988 elementor-widget__width-auto elementor-invisible elementor-widget elementor-widget-heading"
                                data-id="1005988"
                                data-element_type="widget"
                                data-settings='{"_animation":"fadeIn","_animation_delay":1000,"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                data-widget_type="heading.default"
                            >
                                <div class="elementor-widget-container">
                                    <h2 class="elementor-heading-title elementor-size-default">Our Founder</h2>
                                </div>
                            </div>
                            <div
                                class="elementor-element elementor-element-79b23c8 elementor-invisible elementor-widget elementor-widget-heading"
                                data-id="79b23c8"
                                data-element_type="widget"
                                data-settings='{"_animation":"fadeIn","_animation_delay":1200,"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false"}'
                                data-widget_type="heading.default"
                            >
                                <div class="elementor-widget-container">
                                    <h1 class="elementor-heading-title elementor-size-default">Mohammed Medher</h1>
                                </div>
                            </div>
                            <div
                                class="elementor-element elementor-element-1af6dc3 elementor-invisible elementor-widget elementor-widget-text-editor"
                                data-id="1af6dc3"
                                data-element_type="widget"
                                data-settings='{"_animation":"fadeIn","_animation_delay":1400,"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                data-widget_type="text-editor.default"
                            >
                                <div class="elementor-widget-container">
                                    <div class="elementor-text-editor elementor-clearfix">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget diam nec purus blandit rutrum. Nulla congue libero lorem, non sollicitudin urna cursus sed. Cras eu sapien sit amet erat luctus aliquam. Duis ut scelerisque diam. Ut auctor facilisis ante non viverra. In et fringilla orci, at luctus ex. Quisque ac dolor at massa euismod fringilla.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="elementor-element elementor-element-8ed920b elementor-invisible elementor-widget elementor-widget-image"
                                data-id="8ed920b"
                                data-element_type="widget"
                                data-settings='{"_animation":"fadeIn","_animation_delay":1600,"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                data-widget_type="image.default"
                            >
                                <div class="elementor-widget-container">
                                    <div class="elementor-image">
                                        <img
                                            width="350"
                                            height="48"
                                            src="upload/signature-1-e1592385747477.png"
                                            class="attachment-large size-large"
                                            alt=""
                                            loading="lazy"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div
                                class="elementor-element elementor-element-1e7a162 elementor-absolute elementor-widget elementor-widget-image"
                                data-id="1e7a162"
                                data-element_type="widget"
                                data-settings='{"_position":"absolute","craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                data-widget_type="image.default"
                            >
                                <div class="elementor-widget-container">
                                    <div class="elementor-image">
                                        <img
                                            width="350"
                                            height="333"
                                            src="upload/coffee-bg-4-e1592387391691.png"
                                            class="attachment-full size-full"
                                            alt=""
                                            loading="lazy"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-a22753f elementor-section-stretched elementor-section-full_width elementor-section-height-default elementor-section-height-default"
        data-id="a22753f"
        data-element_type="section"
        data-settings='{"stretch_section":"section-stretched","background_background":"classic","craftcoffee_ext_is_background_parallax":"false"}'
    >
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-row">
                <div
                    class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-78a07df"
                    data-id="78a07df"
                    data-element_type="column"
                    data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                >
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div
                                class="elementor-element elementor-element-3e83b1c elementor-widget elementor-widget-craftcoffee-team-grid"
                                data-id="3e83b1c"
                                data-element_type="widget"
                                data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                data-widget_type="craftcoffee-team-grid.default"
                            >
                                <div class="elementor-widget-container">
                                    <div class="portfolio-classic-container contain craftcoffee-team-grid">
<div class="container">
<div class="row">
                                        <?php /* ?><div class="portfolio-classic-content-wrapper portfolio-classic layout-craftcoffee-three-cols row"
                                        data-cols="<?php echo mysqli_num_rows($query_team) ?>" ><?php */ ?>
                                            <?php
												while ($row = mysqli_fetch_assoc($query_team)) {
													$emp_name = $row['name'];
													$dept = $row['dept'];
                                                    $country = $row['country'];
                                            ?>
                                            <div class="col-4" style="border: solid #fff 0px !important;">
                                            <div
                                                class="portfolio-classic-grid-wrapper  portfolio-<?=$id?> tile scale-anm all smoove disable_tablet"
                                                data-delay="150"
                                                
                                                data-move-y="45px"
                                            >
                                                <div class="grid_tilt" style="margin-bottom: 50px !important;">
                                                    <img src="./../public/<?=$row['avatar'];?>" style="width: 200px !important; height: 200px !important; border-radius: 100% !important;" />
                                                    <div>
                                                        <a href=""></a>
                                                    </div>
                                                </div>
                                                <br class="clear" />
                                                <div class="portfolio-classic-content">
                                                    <div class="portfolio-classic-subtitle"><?=($country == "Saudi Arabia") ? "".$dept." Manager" : "".$dept." Incharge" ; ?> </div>
                                                    <h3 class="portfolio-classic_title"><a href=""><?=$emp_name?></a></h3> 

                                                    <div class="portfolio-classic-description"></div>
                                                </div>
                                            </div>
                                            </div>
                                        	<?php } ?>

                                            <br class="clear" />
                                        <!-- </div> -->
</div>
</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
</div>
<div class="comment_disable_clearer"></div>
</div>
</div>
<!-- End main content -->