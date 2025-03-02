<?php
	function mo_wc_openid_social_comment($post, $url)
    {
        ?>
        <script>
            function moOpenIDShowCommentForms() {
                var commentFormElement = document.getElementById("respond");
                if (commentFormElement) {
                    <?php wp_enqueue_script( 'moopenid-comment-fb',plugins_url('includes/js/social/fb_comment.js', __FILE__), array('jquery'));?>
                    var commentForm = '<div><h3 id="mo_reply_label" class="comment-reply-title"><?php echo esc_attr(get_option("mo_openid_social_comment_heading_label")) ?></h3><br/><ul class="mo_openid_comment_tab">';
                    <?php if(get_option('mo_openid_social_comment_default')){ $commentsCount = wp_count_comments($post->ID); ?>
                    commentForm += '<li id="moopenid_social_comment_default" class="mo_openid_selected_tab"><?php echo esc_html(get_option("mo_openid_social_comment_default_label")) ?>(<?php echo ($commentsCount && isset($commentsCount -> approved) ? esc_html($commentsCount -> approved) : '') ?>)</li>';
                    <?php } if(get_option('mo_openid_social_comment_fb')){ ?>
                    commentForm += '<li id="moopenid_social_comment_fb"><?php echo esc_html(get_option("mo_openid_social_comment_fb_label")) ?></li>';
                    <?php } if(get_option('mo_openid_social_comment_disqus')){ ?>
                    commentForm += '<li id="moopenid_social_comment_disqus"><?php echo esc_html(get_option("mo_openid_social_comment_disqus_label")) ?></li>';
                    <?php } ?>
                    commentForm += '</ul>';
                    commentForm += '<br/><div id="moopenid_comment_form_default" style="display:none;">';
                    commentForm += document.getElementById("respond").innerHTML;
                    commentForm += '</div>';
                    commentForm += '<div id="moopenid_comment_form_fb" style="display:none;"><div class="fb-comments" data-href=' + '"<?php echo esc_url($url) ?>"' + '></div></div>';
                    commentForm += '<br/><div id="moopenid_comment_form_disqus" style="display:none;"></div>';
                    commentForm += '</div>';
                    document.getElementById("respond").innerHTML = commentForm;
                    document.getElementById("reply-title")&&jQuery("#reply-title").remove();

                    <?php $mo_disqus_shortname = get_option("mo_openid_social_comment_disqus_shortname"); ?>
                    var sg1 = document.createElement("script");
                    sg1.src = 'https://apis.disqus.com/js/plusone.js?onload=gapiCallback';
                    var divComm = document.createElement("div");
                    divComm.id = "disqus-comments";
                    document.getElementById("moopenid_comment_form_disqus").appendChild(divComm);
                    document.getElementById("moopenid_comment_form_disqus").appendChild(sg1);
                }
            }

            window.gapiCallback = function () {
                var sg2 = document.createElement("script");
                sg2.innerHTML = 'gapi.comments.render("disqus-comments", {href: window.location, width: "624", first_party_property: "BLOGGER", view_type: "FILTERED_POSTMOD" });';
                document.getElementById("moopenid_comment_form_disqus").appendChild(sg2);
            }
        </script>
        <?php
	}
