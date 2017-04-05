// Filename: views/projects/list
define([
    'jquery',
    'underscore',
    'backbone'
], function($, _, Backbone) {
    var articleListView = Backbone.View.extend({
        el: $(".main-container"),
        initialize: function() {
        },
        events: {
            "click a.action-delete": "doDelete",
            "click a.article-active": "doActive",
            "change select[name='category']": "doChangeParentCate",
            "click a.action-copy": "doCopy",
            "click .changeGroup": "doChangeGroup"
        },
        //"click .changeGroup": "doChangeGroup"
        //"click input[type='checkbox']": "doChangeGroup"
        
        doDelete: function(event) {
            var $this = $(event.currentTarget);
            $.modal({
                content: 'Are you sure?',
                title: 'Delete',
                maxWidth: 2500,
                width: 400,
                buttons: {
                    'Yes': function(win) {
                        var id = $($this).attr("article_id");
                        $.ajax({
                            type: "POST",
                            url: $admin_url + "article/delete",
                            data: "id=" + id,
                            success: function(msg) {
                                win.closeModal();
                                if (msg >= 1) {
                                    $($this).parents('tr').fadeOut('slow');
                                }
                            }
                        });
                    },
                    'Cancel': function(win) {
                        win.closeModal();
                    }
                }
            });
            $('.modal-window .block-content .block-footer').find('button:eq(1)').attr('class', 'red');
        },
        doActive: function(event) {
            var $this = $(event.currentTarget);
            //if (confirm('Are you sure')) {
            var id = $($this).attr('article_id');
            var text = $($this).text();
            var anchor = $this;
            if (anchor.data("disabled")) {
                return false;
            }
            anchor.data("disabled", "disabled");
            $("#loading").show();
            $.ajax({
                type: "POST",
                url: $admin_url + "article/chang_active",
                data: "id=" + id + "&text=" + text,
                success: function(text) {
                    if (typeof text !== "undefined") {
                        if (text == "Enable") {
                            $($this).css("color", "green");
                        }
                        else if (text == "Disable") {
                            $($this).css("color", "red");
                        }
                        $($this).text(text);
                    }
                    anchor.removeData("disabled");
                    $("#loading").hide();
                }
            });
            //}
        },
        doChangeParentCate: function(event) {
            var $this = $(event.currentTarget);
            var id = $this.val();
            window.location = $base_url + 'backend/article/index/' + id;
        },
        doChangeGroup: function(event) {
            var $this = $(event.currentTarget);
            var id = $($this).attr('article_id');

            var group = "";
            if($("input[name='group_nw_"+id+"']").is( ":checked" ) == true)
            {
                if(group == "") group += 'news';
                else group += ';news'; 
            }
            if($("input[name='group_sp_"+id+"']").is( ":checked" ) == true)
            {
                if(group == "") group += 'services_product';
                else group += ';services_product';
            }
            if($("input[name='group_index_"+id+"']").is( ":checked" ) == true)
            {
                if(group == "") group += 'index';
                else group += ';index';
            }
			if($("input[name='group_publications_"+id+"']").is( ":checked" ) == true)
            {
                if(group == "") group += 'publications';
                else group += ';publications';
            }
            if($("input[name='group_progress_"+id+"']").is( ":checked" ) == true)
            {
                if(group == "") group += 'progress';
                else group += ';progress';
            }
            if($("input[name='group_performance_"+id+"']").is( ":checked" ) == true)
            {
                if(group == "") group += 'performance';
                else group += ';performance';
            }
            if($("input[name='group_our_website_"+id+"']").is( ":checked" ) == true)
            {
                if(group == "") group += 'our_website';
                else group += ';our_website';
            }
            if($("input[name='group_home_"+id+"']").is( ":checked" ) == true)
            {
                if(group == "") group += 'home';
                else group += ';home';
            }
            if($("input[name='group_company_"+id+"']").is( ":checked" ) == true)
            {
                if(group == "") group += 'company';
                else group += ';company';
            }
            if($("input[name='group_ifrc_research_live_"+id+"']").is( ":checked" ) == true)
            {
                if(group == "") group += 'ifrc_research_live';
                else group += ';ifrc_research_live';
            }
            if($("input[name='group_documentation_"+id+"']").is( ":checked" ) == true)
            {
                if(group == "") group += 'documentation';
                else group += ';documentation';
            }
            if($("input[name='group_glossary_"+id+"']").is( ":checked" ) == true)
            {
                if(group == "") group += 'glossary';
                else group += ';glossary';
            }
            $("#loading").show();
            $.ajax({
                type: "POST",
                url: $admin_url + "article/chang_group",
                data: "id=" + id + "&group=" + group,
                success: function(data) {
                    $("#loading").hide();
                }
            });
            
        },
        index: function() {
            $(document).ready(function()
            {
                $id = $("select[name='category']").val();
                if (check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')) {
                    $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                } else {
                    $file = $base_url + 'assets/language/datatables/eng.txt';
                }
                oTable = $('.table-article-list').dataTable({
                    "oLanguage": {
                        "sUrl": $file
                    },
                    "iDisplayLength": 10,
                    "iDisplayStart": 0,
                    "bProcessing": true,
                    "aaSorting": [],
                    "sAjaxSource": $admin_url + "article/listdata/" + $id,
                    "aoColumns": [
                        {
                            "mData": "title"
                        },
                        {
                            "mData": "name"
                        },
                        {
                            "mData": "group"
                        },
                        {
                            "mData": "sort_order"
                        },
                        {
                            "mData": "status"
                        },
                        {
                            "mData": "thumb"
                        },
                        {
                            "mData": "action"
                        },
                    ],
                    "sScrollY": '300px',
                    "bScrollCollapse": true,
                    "bPaginate": false,
                    "sPaginationType": "full_numbers",
                    sDom: '<"block-controls"<"controls-buttons">f>rti',
                    /* Callback to apply template setup*/
                    fnDrawCallback: function()
                    {
                        this.parent().applyTemplateSetup();
                        $(this).slideDown(200);
                    },
                    fnInitComplete: function()
                    {
                        this.parent().applyTemplateSetup();
                        $(this).slideDown(200);
                    }
                });
            });
        },
        doCopy: function(event) {
            var $this = $(event.currentTarget);
            $.modal({
                content: 'Are you sure?',
                title: 'Copy',
                maxWidth: 2500,
                width: 400,
                buttons: {
                    'Yes': function(win) {
                        var id = $($this).attr("article_id");
                        $.ajax({
                            type: "POST",
                            url: $admin_url + "article/copy",
                            data: "id=" + id,
                            success: function(msg) {
                                win.closeModal();
                                if (msg >= 1) {
                                    var link = $admin_url + 'article';
                                    window.location = link;
                                }
                            }
                        });
                    },
                    'Cancel': function(win) {
                        win.closeModal();
                    }
                }
            });
            $('.modal-window .block-content .block-footer').find('button:eq(1)').attr('class', 'red');
        },
        render: function() {
            if (typeof this[$app.action] != 'undefined') {
                new this[$app.action];
            }
        }
    });
    return new articleListView;
});
