function saveArticle() {
    $('#article_form [name="item_order"]').val(get_item_order());
    var data = $("#article_form").serialize();
    $.ajax({
        url:"/articles/edit",
        data: data,
        type: 'post',
        error:function(){
            alert('保存に失敗しました。');
        },
        success:function(){
            alert('保存しました');
            location.href = '/articles';
        }
    });
}

$(document).on('click', '.article_save', function() {
    if($('#article_form [name="title"]').val()=='' || $('#article_form [name="description"]').val()=='' || get_item_order() == '') {
        alert('正しく入力してください');
    } else {
        saveArticle();
    }

});

$(document).on('click', '.delete', function() {
    if(confirm('本当に削除してよろしいですか？')){
        var item=$(this).closest("li");
        $.post('/articles/delete/'+item.data('id'),{  },function(res){
            $(item).fadeOut();
        },"json");
    }return false;
})


//item編集バーの表示切り替え
$(document).on('mouseenter', '.item', function() {
    $(this).children('.editpager').removeClass("unvisible");
});

$(document).on('mouseleave', '.item', function() {
    $(this).children('.editpager').addClass("unvisible");
});



//item保存時の動作
$(document).on('click', '.item_submit', function() {
    if($('#item_form [name="content"]').val()=='') //内容が空欄だったら
    {
        alert('内容が入力されていません！'); //アラート
    }
    else //空欄がない
    {
        $.ajax(
        {
            type: "POST", //POSTで渡す
            url: "/items/add", //AddController.phpを動かすためのパス
            data: {
                "article_id": $('#item_form [name="article_id"]').val(), //記事番号
                "content_type": $('#item_form [name="content_type"]').val(), //タイプ
                "content": $('#item_form [name="content"]').val() //内容
            },
            dataType: "text",
            success: function (data)
            {
                $('#sortable').append(data);
                $('#item_form').find("textarea").val("");
                $('#item_form').find("select").val("headline_big");
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) //通信失敗
            {
                alert('処理できませんでした');
            }
        });
        return false;
    }
});


//一番上へ
$(document).on('click','.first_order', function() {
    var item=$(this).parents(".item");
    $('#sortable').prepend(item);
    //item_order_post();
});
//上へ
$(document).on('click','.minus_order', function() {
    var item=$(this).parents(".item");
    item.prev().before(item);
    //item_order_post();
});
//下へ
$(document).on('click','.plus_order', function() {
    var item=$(this).parents(".item");
    item.next().after(item);
    //item_order_post();
});
//一番下へ
$(document).on('click','.last_order', function() {
    var item=$(this).parents(".item");
    $('#sortable').append(item);
    //item_order_post();
});


//item削除
$(document).on('click','.delete_item', function() {
    if(confirm('本当に削除してよろしいですか？')){
        var item = $(this).parents(".item");
        var id = item.attr('id');
    $.ajax(
        {
            type: "POST", //POSTで渡す
            url: "/items/delete", //AddController.phpを動かすためのパス
            data: {
                "id": id //id
            },
            dataType: "text",
            success: function (data)
            {
                $(item).remove();
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) //通信失敗
            {
                alert('処理できませんでした');
            }
        });
    } return false;
});

//item編集
$(document).on('click','.edit_item', function() {
    var item = $(this).parents(".item");
    var id = item.attr('id');
    var content_type = item.children().first().attr('class');
    var content = item.children().first().text();
    var dom = '<div class="item" id="' + id + '">'
            + '<form id="item_form" style="margin-top: 20px">'
            + '<select name="content_type" style="margin: 20px 0; vertical-align: middle;">'
            + '<option value="headline_big"' + (content_type == "headline_big" ? " selected" : "") + '>大見出し</option>'
            + '<option value="headline_small"' + (content_type == "headline_small" ? " selected" : "") + '>小見出し</option>'
            + '<option value="text"' + (content_type == "text" ? " selected" : "") + '>本文</option>'
            + '</select>'
            + '<textarea class="form-control " name="content" style="margin-left: 10px; width: 60%; height: 50px; display: inline-block; vertical-align: middle;">' + content + '</textarea>'
            + '<input class="btn btn-primary item_update" style="margin-left: 10px;" type="button" value="保存する">'
            + '<input class="btn btn-default update_cancel" style="margin-left: 10px;" type="reset" value="キャンセル"></form></div>';
    item.replaceWith(dom);
});

//item更新
$(document).on('click','.item_update', function() {
    var item = $(this).parents(".item");
    var id = item.attr('id');
    var content_type = item.find('select').val();
    var content = item.find('textarea').val();
    $.ajax(
        {
            type: "POST", //POSTで渡す
            url: "/items/update", //AddController.phpを動かすためのパス
            data: {
                "id": id, //id
                "content_type": content_type, //タイプ
                "content": content//内容
            },
            dataType: "text",
            success: function (dom)
            {
                item.replaceWith(dom);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) //通信失敗
            {
                alert('処理できませんでした');
            }
        });
});

//itemの更新キャンセル
$(document).on('click','.update_cancel', function() {
    var item = $(this).parents(".item");
    var id = item.attr('id');
    $.ajax(
        {
            type: "POST", //POSTで渡す
            url: "/items/cancel", //AddController.phpを動かすためのパス
            data: {
                "id": id
            },
            dataType: "text",
            success: function (dom)
            {
                item.replaceWith(dom);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) //通信失敗
            {
                alert('処理できませんでした');
            }
        });
});

/*// articleのitem_orderだけ更新する
function item_order_post () {
    var id =$('#article_form [name="data[Article][id]"]').val();
    ajax({
        url:"/articles/save_field",
        data:{"id":id,"item_order":get_item_order()},
        error:function (XMLHttpRequest, textStatus, errorThrown){modal('error');},
        success:function (data, textStatus) {}
    });
    return false;
}*/

//itemの順番を取得
function get_item_order() {
    return $(".item").map(function() {return $(this).attr("id");}).get().join(",");
}

//function ajax(p){$.ajax({dataType:"json",cache:false,haeder:{ "Accept-Encoding":"utf-8"},type:"post",url:p['url'],data:p['data'],error:p['error'],success:p['success']});}


//文字数カウント
$(function(){
    $('#article_form [name="title"]').bind('keydown keyup keypress change',function(){
        var thisValueLength = $(this).val().length;
        $('#title_count_span').html(thisValueLength);
    });
});

$(function(){
    $('#article_form [name="description"]').bind('keydown keyup keypress change',function(){
        var thisValueLength = $(this).val().length;
        $('#desc_count_span').html(thisValueLength);
    });
});