<?php

function mo_wc_openid_custom_registration_form()
{?>
    <div class="mo_openid_table_layout" id="customization_ins" style="display: block">
        <table>
            <tr>
                <td >
                    <h3><?php echo mo_wc_sl('Custom Registration Form');?>
                        <input type="button" value="<?php echo mo_wc_sl('Purchase');?>"
                               onclick="mosocial_addonform('wp_social_login_extra_attributes_addon')"
                               id="mosocial_purchase_cust_addon"
                               class="button button-primary button-large"
                               style="float: right; margin-left: 10px;">
                        <input type="button" value="<?php echo mo_wc_sl('Verify Key');?>"
                               id="mosocial_purchase_cust_addon_verify"
                               class="button button-primary button-large"
                               style="float: right;">

                    </h3>
                    <b><?php echo mo_wc_sl('Custom Registration Form Add-On helps you to integrate details of new as well as existing users. You
                        can add as many fields as you want including the one which are returned by
                        social sites at time of registration');?>.</b>
                </td>
            </tr>
        </table>
        <table class="mo_openid_display_table table" id="mo_openid_extra_attributes_addon_video">
            <tr>
                <td colspan="2">
                    <hr>
                    <p>
                        <br><center>
                        <iframe width="450" height="250" src="https://www.youtube.com/embed/cEvU9d3YBus"
                                frameborder="0" allow="autoplay; encrypted-media" allowfullscreen
                                style=""></iframe></center>
                    </p>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td style="vertical-align:top; ">
                    <div class="mo_openid_table_layout"><br/>
                        <form method="post">
                            <h3><?php echo mo_wc_sl('Customization Fields');?></h3>
                            <input type="checkbox" disabled="disabled" id="customised_field_enable"
                                   value="1" checked
                            <b><?php echo mo_wc_sl('Enable Auto Field Registration Form');?></b>

                            <style>
                                .tableborder {
                                    border-collapse: collapse;
                                    width: 100%;
                                    border-color: #eee;
                                }

                                .tableborder th, .tableborder td {
                                    text-align: left;
                                    padding: 8px;
                                    border-color: #eee;
                                }

                                .tableborder tr:nth-child(even) {
                                    background-color: #f2f2f2
                                }
                            </style>
                            <!--mo_openid_custom_field_update-->
                            <table id="custom_field" style="width:100%; text-align: center;" class="table mo_openid_mywatermark">
                                <div id="myCheck">
                                    <h4><?php echo mo_wc_sl('Registration page link');?> <input type="text" name="profile_completion_page"
                                                                                                style="width: 350px" disabled="disabled"
                                                                                                value="<?php echo get_option('profile_completion_page'); ?>"
                                                                                                required/></h4>
                                    <thead>
                                    <tr>
                                        <th><?php echo mo_wc_sl('Existing Field');?></th>
                                        <th><?php echo mo_wc_sl('Field');?></th>
                                        <th><?php echo mo_wc_sl('Custom name');?></th>
                                        <th><?php echo mo_wc_sl('Field Type');?></th>
                                        <th><?php echo mo_wc_sl('Field Options');?></th>
                                        <th><?php echo mo_wc_sl('Required Field');?></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <?php
                                    ?>
                                    <tr>
                                        <td style="width: 15%"><br><input type="text" disabled="disabled" placeholder="Existing meta field"
                                                                          style="width:90%;"/></td>
                                        <td style="width: 15%"><br><select id="field_1_name" disabled="disabled"
                                                                           onchange="myFunction('field_1_name','opt_field_1_name','field_1_value','additional_field_1_value')"
                                                                           style="width:80%">
                                                <option value=""><?php echo mo_wc_sl('Select Field');?></option>
                                            </select></td>
                                        <td style="width: 15%"><br><input type="text" id="opt_field_1_name" disabled="disabled"
                                                                          placeholder="Custom Field Name"
                                                                          style="width:90%;"/></td>
                                        <td style="width: 15%"><br><select id="field_1_value" name="field_1_value" disabled="disabled"
                                                                           onchange="myFunction2('field_1_name','opt_field_1_name','field_1_value','additional_field_1_value')"
                                                                           style="width:80%">
                                                <option value="default"><?php echo mo_wc_sl('Select Type');?></option>
                                            </select></td>
                                        <td style="width: 20%"><br><input type="text" id="additional_field_1_value" disabled="disabled"
                                                                          placeholder="e.g. opt1;opt2;opt3"
                                                                          style="width:90%;"/></td>
                                        <td style="width: 10%"><br><select name="mo_openid_custom_field_1_Required" disabled="disabled"
                                                                           style="width:57%">
                                                <option value="no"><?php echo mo_wc_sl('No');?></option>
                                            </select></td>
                                        <td style="width: 10%"><br><input type="button" disabled="disabled"
                                                                          value="+" onclick="add_custom_field();"
                                                                          class=" button-primary"/>&nbsp;
                                            <input type="button" name="mo_remove_attribute" value="-" disabled="disabled"
                                                   onclick="remove_custom_field();" class=" button-primary"/>
                                        </td>
                                    </tr>
                                </div>
                                <tr id="mo_openid_custom_field">
                                    <td align="center" colspan="7"><br>
                                        <input name="mo_openid_save_config_element" type="submit" disabled="disabled"
                                               value="Save"
                                               class="button button-primary button-large"/>
                                        &nbsp &nbsp <a class="button button-primary button-large" disabled="disabled"><?php echo mo_wc_sl('Cancel');?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" colspan="7">
                                        <h3><?php echo mo_wc_sl('Instructions to setup');?>:</h3>
                                        <p>
                                        <ol>
                                            <li> <?php echo mo_wc_sl('Create a page and use shortcode');?> <b>[miniorange_social_custom_fields]</b>
                                                <?php echo mo_wc_sl('where you want your form to be displayed');?>.
                                            </li>
                                            <li><?php echo mo_wc_sl( 'Copy the page link and paste it in the above field <b>Registration page
                                                    link');?></b>.
                                            </li>
                                            <li><?php echo mo_wc_sl( "If you have any existing wp_usermeta field then enter that field's name in");?>
                                                <b><?php echo mo_wc_sl('Existing
                                                    Field');?></b> <?php echo mo_wc_sl('column. For example, if you are saving');?> <b><?php echo mo_wc_sl('First Name');?></b> <?php echo mo_wc_sl('as');?>
                                                <b><?php echo mo_wc_sl('fname');?></b>
                                                <?php echo mo_wc_sl('in wp_usermeta field then enter fname in Existing Field
                                                column.');?>
                                            </li>
                                            <li> <?php echo mo_wc_sl('Select field name under the ');?><b><?php echo mo_wc_sl('Field');?></b> <?php echo mo_wc_sl('dropdown');?>.</li>
                                            <li> <?php echo mo_wc_sl('If selected field is other than custom, then');?> <b><?php echo mo_wc_sl('Field Type');?></b> <?php echo mo_wc_sl('will
                                                automatically be');?> <b><?php echo mo_wc_sl('Textbox');?></b> <?php echo mo_wc_sl('and there is no need to enter');?> <b><?php echo mo_wc_sl('Custom
                                                    name');?></b> <?php echo mo_wc_sl('and');?> <b><?php echo mo_wc_sl('Field options');?></b>.
                                            </li>
                                            <li> <?php echo mo_wc_sl('If selected field is custom, then enter');?> <b><?php echo mo_wc_sl('Custom name');?></b>.</li>
                                            <li> <?php echo mo_wc_sl('Select');?> <b><?php echo mo_wc_sl('Field Type');?></b>, <?php echo mo_wc_sl('if selected');?> <b><?php echo mo_wc_sl('Field Type');?></b> <?php echo mo_wc_sl('is');?>
                                                <b><?php echo mo_wc_sl('Checkbox');?></b><?php echo mo_wc_sl( 'or');?> <b><?php echo mo_wc_sl('Dropdown');?></b> <?php ('then enter the desire options in');?> <b><?php echo mo_wc_sl('Field
                                                    Options');?></b> <?php echo mo_wc_sl('seprated by semicolon ');?><b>;</b>'<?php echo mo_wc_sl( 'otherwise leave');?> <b><?php echo mo_wc_sl('Field
                                                    Options');?></b> <?php echo mo_wc_sl('blank.');?>
                                            </li>
                                            <li> <?php echo mo_wc_sl('Select');?> <b><?php echo mo_wc_sl('Required Field');?></b> <?php echo mo_wc_sl('as');?> <b><?php echo mo_wc_sl('Yes');?></b> <?php echo mo_wc_sl('if you want to make that field
                                                compulsory for user');?>.
                                            </li>
                                            <li> <?php echo mo_wc_sl('If you want to add more than 1 fields at a time click on');?> <b>"+"</b>.</li>
                                            <li> <?php echo mo_wc_sl('Last click on');?> <b><?php echo mo_wc_sl('Save');?></b> <?php echo mo_wc_sl('button');?>.</li>
                                        </ol>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <br>
                        <hr>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <td>
        <form style="display:none;" id="mosocial_loginform" action="<?php echo get_option( 'mo_openid_host_name' ) . '/moas/login'; ?>"
              target="_blank" method="post" >
            <input type="email" name="username" value="<?php echo esc_attr(get_option('mo_openid_admin_email')); ?>" />
            <input type="text" name="redirectUrl" value="<?php echo esc_attr(get_option( 'mo_openid_host_name')).'/moas/initializepayment'; ?>" />
            <input type="text" name="requestOrigin" id="requestOrigin"/>
        </form>
        <script>
            function mosocial_addonform(planType) {
                jQuery('#requestOrigin').val(planType);
                jQuery('#mosocial_loginform').submit();
            }
        </script>
    </td>
    <td>
        <script type="text/javascript">
            //to set heading name
            jQuery('#mo_openid_page_heading').text('<?php echo mo_wc_sl('Social Login Add On'); ?>');
            jQuery(document).ready(function($){
                jQuery("#mosocial_purchase_cust_addon_verify").on("click",function(){
                    jQuery.ajax({
                        url: "<?php echo admin_url("admin-ajax.php");?>", //the page containing php script
                        method: "POST", //request type,
                        dataType: 'json',
                        data: {
                            action: 'mo_register_customer_toggle_update',
                        },
                        success: function (result){
                            if (result.status){
                                mo_verify_add_on_license_key();
                            }
                            else{
                                alert("Please register/login with miniOrange to verify key and use the Custom Registration Form Add on");
                                window.location.href="<?php echo site_url()?>".concat("/wp-admin/admin.php?page=mo_wc_openid_general_settings&tab=profile");
                            }
                        }
                    });
                });
            });

            function mo_verify_add_on_license_key() {
                jQuery.ajax({
                    type: 'POST',
                    url: '<?php echo admin_url("admin-ajax.php"); ?>',
                    data: {
                        action:'verify_addon_licience',
                        plan_name:'extra_attributes_addon',

                    },
                    crossDomain :!0, dataType:"html",
                    success: function(data) {
                        var flag=0;
                        jQuery("input").each(function(){
                            if(jQuery(this).val()=="mo_openid_verify_license") flag=1;
                        });
                        if(!flag) {
                            jQuery(data).insertBefore("#mo_openid_extra_attributes_addon_video");
                            jQuery("#customization_ins").find(jQuery("#cust_supp")).css("display", "none");
                        }
                    },
                    error: function (data){}
                });
            }
        </script>
    </td>
    <?php
}