$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

$('#ModalDeleteWindow').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var data_id_hide = button.data('id');
    var data_name_hide = button.data('filename');
    var data_url = button.data('url');
    var data_route = button.data('route');
    var data_static = button.data('static');

    var modal = $(this);
    modal.find('.data-id').text(data_id_hide);
    modal.find('.data-filename').text(data_name_hide);
    modal.find('.data-url').text(data_url);
    modal.find('.data-route').text(data_route);
    modal.find('.data-static').text(data_static);
  });

  window.showModalWindowDelete = function(event)
{
    $('#ModalDeleteWindow').modal('hide');

    var hidden_id = $('#ModalDeleteWindow .data-id').text();
    var hidden_name = $('#ModalDeleteWindow .data-filename').text();
    var url_post = $('#ModalDeleteWindow .data-url').text();
    var url_route = $('#ModalDeleteWindow .data-route').text();
    var is_static = $('#ModalDeleteWindow .data-static').text();

    $('#item_id_'+hidden_id).hide();

    $.ajax({
        url:url_post,
        data:{
            _token: window.token,
            id: hidden_id,
            filename: hidden_name
        },
        method: 'post',
        success: function ()
        {
            if (!is_static)
            {
                if (url_route.length>0)
                {
                    window.location.href = url_route;
                } else
                {
                    window.location.reload(false);
                }
            }
        }
    });
}

window.toggleMenu = function(id)
{
    $('#menu_items_'+id).toggle();
}

window.doVisible = function(name,visible)
{
    if (visible) $(name).show(); else $(name).hide();
}

window.ShowAllFields = function()
{
    doVisible('#fieldEmail',true);
    doVisible('#fieldLength',true);
    doVisible('#fieldLink',true);
    doVisible('#fieldPhones',true);
    doVisible('#fieldPrice',true);
    doVisible('#fieldTimeBrackets',true);
    doVisible('#fieldWorkTimes',true);
    doVisible('.adress_field',true);
}

window.getCategoryInfo = function()
{
    var id = $('#category_id').val();

    if (id)
    {
    $.ajax({
        url:'/admin/category_info',
        data:{
            id: id,
        },
        method: 'post',
        success: function (res)
        {
            var d = JSON.parse(res);
            var success = d.success;

            if (success)
            {
                doVisible('#fieldEmail',d.data.is_show_email);
                doVisible('#fieldLength',d.data.is_show_length);
                doVisible('#fieldLink',d.data.is_show_link);
                doVisible('#fieldPhones',d.data.is_show_phone);
                doVisible('#fieldPrice',d.data.is_show_price);
                doVisible('#fieldTimeBrackets',d.data.is_show_time_brackets);
                doVisible('#fieldWorkTimes',d.data.is_show_work_times);
                doVisible('.adress_field',d.data.is_show_addr);
            } else
            {
                ShowAllFields();
            }

        },
        error: function()
        {
            ShowAllFields();
        }
    });
    } else
    {
        ShowAllFields();
    }
}

getCategoryInfo();