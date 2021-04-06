
<?php if ( have_comments() ) : ?>
    <div class="comments ">
        <h5 class="comments-header"><?php comments_number() ?></h5>
        <div class="comments-body">
            <?php wp_list_comments(['callback' => 'mini_blog_comment']) ?>
        </div>
</div>
<?php endif; ?>
<?php
    $comments_arg = array(
        'form'  => array(
            'class' => 'form-horizontal'
            ),
        'fields' => apply_filters( 'comment_form_default_fields', 
                array(
                    'author' => '<div class="form-group">'.
                                    '<label for="author">' . __( 'Họ và tên' ) . '</label> ' .
                                    '<input id="author" name="author" class="form-control" type="text"  size="30" />
                                </div>',

                    'email' => '<div class="form-group">'.
                                    '<label for="email">' . __( 'Email' ) . '</label> ' .
                                    '<input type="email" id="email" name="email" class="form-control" type="text" size="30" />
                                </div>',

                    'url'   => '<div class="form-group">'.
                                    '<label for="url">' . __( 'URL' ) . '</label> ' .
                                    '<input type="url" id="url" name="url" class="form-control" type="text" size="30" />
                                </div>' )
                ),
                'comment_field'         => '<div class="form-group">' . 
                                                '<label for="comment">' . __( 'Your email address will not be published. Required fields are marked' ) . '</label><span>*</span>' .
                                                '<textarea id="comment" class="form-control" style=" border: 2px solid #f2f3f8; name="comment" rows="4" aria-required="true" placeholder="Comment *"></textarea>' .
                                                '<div class="d-flex mt-3">'.
                                                '<div class="col-xl-6 pl-0 pr-2">'.
                                                   '<input class="w-100 " style="padding:5px 0; border: 2px solid #f2f3f8;" id="name" class="" name="name"  placeholder="Name *"></input>' .
                                                '</div>'.
                                                '<div class="col-xl-6 pr-0 pl-2">'.
                                                   '<input class="w-100" style="padding:5px 0; border: 2px solid #f2f3f8;" id="name" class="" name="name"  placeholder="Name *"></input>' .
                                                '</div>'.
                                                '</div>'. 
                                                
                                            '</div>',
                                            
                'comment_notes_after'   => '',
                'title_reply'           => 'Leave a Reply ',
                'title_reply_to'        => 'Trả lời bình luận của %s',
                'cancel_reply_link'     => '( Hủy )',
                'comment_notes_before'  => 'Địa chỉ email của bạn sẽ không công khai.',
                'class_submit'          => 'btn btn-primary',
                'label_submit'          => 'Post Comment '
            ); 

    comment_form($comments_arg);
?>

