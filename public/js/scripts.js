window.subscribeEmail = function()
{
    var mail = $('#subscribe_email').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    $.ajax({
        url: '/subscribe',
        data: {
            email:mail
        },
        mimeType:'multipart/form-data',
        type: "post"
    });

    $('#subscribe_form').hide();
    $('#email_sub_done').show();

    return false;
}

window.leaveComment = function()
{
    var uid = $('#comment_id').val();
    var utype = $('#comment_type').val();
    var uname = $('#comment_name').val();
    var mail = $('#comment_email').val();
    var utext = $('#comment_text').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    $.ajax({
        url: '/comment',
        data: {
            id:uid,
            type:utype,
            name:uname,
            email:mail,
            text:utext,
        },
        mimeType:'multipart/form-data',
        type: "post"
    });

    $('#leave_comment_form').hide();
    $('#leave_comment_form_done').show();

    return false;
}

window.leaveExcursionOrder = function()
{
    var uid = $('#excursion_order_id').val();
    var uname = $('#excursion_order_name').val();
    var mail = $('#excursion_order_email').val();
    var phones = $('#excursion_order_phone').val();
    var pcount = $('#excursion_order_pcount').val();
    var udate = $('#excursion_order_date').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    $.ajax({
        url: '/excursion_order',
        data: {
            id:uid,
            name:uname,
            email:mail,
            phone:phones,
            count:pcount,
            date:udate
        },
        mimeType:'multipart/form-data',
        type: "post"
    });

    $('#excursion_order_form_title').hide();
    $('#excursion_order_form').hide();
    $('#excursion_order_form_done').show();

    return false;
}

window.makeFavorite = function (_type,_photo_id,_data_id)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    $.ajax({
        url: '/fav',
        data: {
            type: _type,
            photo_id: _photo_id,
            data_id:_data_id
        },
        mimeType:'multipart/form-data',
        type: "post"
    });

    return false;
}