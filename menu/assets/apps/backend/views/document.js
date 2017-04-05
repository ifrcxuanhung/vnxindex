define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/caculation/report.html'
    ], function($, _, Backbone,reportTemplate){
        var $html='<div class="caculation-report"><img style="margin-left:180px" src="'+$template_url+'images/loading.gif"/></div>';
        var documentView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            // openModal('Update Indexes', $html, 400);
            },
            events: {
                "click #save": "excute",
                "click #btn-info": "showInfo",
                "click #btn-save": "save",
                "click .delete": "doDelete",
            },

            excute: function(e){
				
            },
            index: function(){
                $(document).ready(function()
                {
                    console.log('index');
                });
            },
            showInfo: function(){
                var style = $("#box-detail").attr("style");
                if(style != ""){
                    $("#box-detail").attr("style", "");
                }else{
                    $("#box-detail").attr("style", "margin-left: 30%");
                }
                $("#box-info").toggle();
            },
            openModal: function openModal($title,$content,$width)
            {
                $.modal({
                    content: $content,
                    title: $title,
                    maxWidth: 2500,
                    width: $width,
                    buttons: {
                        'Close': function(win) {
                            window.location.href = $admin_url;
                        }
                    }
                });
            },
            save: function(){
                var confirm = $("input[type='checkbox']:checked").val();
                $("#confirm").val((confirm === 'on') ? 1 : 0);
                formPapers.submit();
            },
            upload_documents: function(){
                $(document).ready(function(){
                    //$('#lean_overlay').show('0',function(){
                    documentView.openModal('Upload Documents', $html, 400);
                    $("#modal").show(0, function(){
                        $.ajax({
                            url: $admin_url + 'document/process_upload_documents',
                            type: 'post',
                            async: false,
                            success: function(data){
                                var datatemplate={};
                                datatemplate.report=JSON.parse(data);
                                var compiledTemplate = _.template( reportTemplate, datatemplate );
                                $('.caculation-report').html(compiledTemplate).fadeIn();
                            }
                        });
                    });
                });
            },
            doDelete:function(event){
                var $this=$(event.currentTarget);
                if (confirm('Are you sure?')) {
                    var id=$($this).attr("pid");
                    var table=$($this).attr("ptable");
                    $.ajax({
                        type: "POST",
                        url: $admin_url+"document/delete",
                        data: "id=" + id +"&table=" + table,
                        success: function(msg){
                            if(msg>=1){
                                $($this).parents('tr').fadeOut('slow');
                            }
                        }
                    });
                }
                return false;
            },
            papers: function(){
                $(document).ready(function(){
                    if(check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')){
                        $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                    }else{
                        $file = $base_url + 'assets/language/datatables/eng.txt';
                    }
                    if(typeof oTable != 'undefined'){
                        $(".table-paper-list").dataTable().fnDestroy();
                    }
                    var url = location.href;
                    oTable = $('.table-paper-list').dataTable({
                        "oLanguage":{
                            "sUrl": $file
                        },
                        "sScrollX": "100%",
                        // "sScrollXInner": "110%",
                        "bScrollCollapse": true,
                        "iDisplayLength": 10,
                        "iDisplayStart": 0,
                        "bProcessing": true,
                        "bRetrieve": true,
                        "aaSorting": [],
                        "bAutoWidth": true,
                        "bServerSide": true,
                        "sAjaxSource": url,
                        "fnServerData": function(sSource, aoData, fnCallback, oSettings) {
                            $.ajax( {
                                "dataType": 'json',
                                "type": "POST",
                                "url": sSource,
                                "data": aoData,
                                  // "success": fnCallback
                                success: function(rs){
                                    fnCallback(rs);
                                }
                            });

                        },
                        "aoColumns": [
                        {
                            "mData": "title",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "title"
                        },
                        {
                            "mData": "journal",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "journal"
                        },
                        {
                            "mData": "year",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "year"
                        },
                        {
                            "mData": "month",
                            "sType": "date",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "month"
                        },
                        {
                            "mData": "volume",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "volume"
                        },
                        {
                            "mData": "number",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "number"
                        },
			{
                            "mData": "page",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "page"
                        },
			{
                            "mData": "info",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string"
                        },
                        {
                            "mData": "action",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string"
                        }
                        ],
                        "sPaginationType": "full_numbers",
                        sDom: '<"block-controls"<"export-buttons"><"controls-buttons"p><"my-buttons">>rti<"block-footer clearfix"lf>',

                        /* Callback to apply template setup*/
                        fnDrawCallback: function()
                        {
                            $(this).slideDown(200);
                            $(".with-tip").tip();
                            var html = '<div style="clear: left;"></div>';
                            $(".my-buttons").html(html);
                            html = '<div style="clear: left;"></div>';
                            $(".export-buttons").html(html);
                            oTable.fnSetFilteringPressEnter();
                        },
                        fnInitComplete: function()
                        {
                            $(this).slideDown(200);
                        }
                    });
                });
            },
            authors: function(){
                $(document).ready(function(){
                    if(check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')){
                        $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                    }else{
                        $file = $base_url + 'assets/language/datatables/eng.txt';
                    }
                    if(typeof oTable != 'undefined'){
                        $(".table-author-list").dataTable().fnDestroy();
                    }
                    var url = location.href;
                    oTable = $('.table-author-list').dataTable({
                        "oLanguage":{
                            "sUrl": $file
                        },
                        "sScrollX": "100%",
                        // "sScrollXInner": "110%",
                        "bScrollCollapse": true,
                        "iDisplayLength": 10,
                        "iDisplayStart": 0,
                        "bProcessing": true,
                        "bRetrieve": true,
                        "aaSorting": [],
                        "bAutoWidth": true,
//                        "bServerSide": true,
                        "sAjaxSource": url,
                        "fnServerData": function(sSource, aoData, fnCallback, oSettings) {
                            $.ajax( {
                                "dataType": 'json',
                                "type": "POST",
                                "url": sSource,
                                "data": aoData,
                                  // "success": fnCallback
                                success: function(rs){
                                    fnCallback(rs);
                                }
                            });

                        },
                        "aoColumns": [
                        {
                            "mData": "lastname",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "lastname"
                        },
                        {
                            "mData": "firstname",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "firstname"
                        },
                        {
                            "mData": "university",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "university"
                        },
                        {
                            "mData": "country",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "country"
                        },
			{
                            "mData": "email",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "email"
                        },
                        {
                            "mData": "action",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string"
                        }
                        ],
                        "sPaginationType": "full_numbers",
                        sDom: '<"block-controls"<"export-buttons"><"controls-buttons"p><"my-buttons">>rti<"block-footer clearfix"lf>',

                        /* Callback to apply template setup*/
                        fnDrawCallback: function()
                        {
                            $(this).slideDown(200);
                            $(".with-tip").tip();
                            var html = '<div style="clear: left;"></div>';
                            $(".my-buttons").html(html);
                            html = '<div style="clear: left;"></div>';
                            $(".export-buttons").html(html);
                            oTable.fnSetFilteringPressEnter();
                        },
                        fnInitComplete: function()
                        {
                            $(this).slideDown(200);
                        }
                    });
                });
            },
            journals: function(){
                $(document).ready(function(){
                    if(check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')){
                        $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                    }else{
                        $file = $base_url + 'assets/language/datatables/eng.txt';
                    }
                    if(typeof oTable != 'undefined'){
                        $(".table-journal-list").dataTable().fnDestroy();
                    }
                    var url = location.href;
                    oTable = $('.table-journal-list').dataTable({
                        "oLanguage":{
                            "sUrl": $file
                        },
                        "sScrollX": "100%",
                        // "sScrollXInner": "110%",
                        "bScrollCollapse": true,
                        "iDisplayLength": 10,
                        "iDisplayStart": 0,
                        "bProcessing": true,
                        "bRetrieve": true,
                        "aaSorting": [],
                        "bAutoWidth": true,
//                        "bServerSide": true,
                        "sAjaxSource": url,
                        "fnServerData": function(sSource, aoData, fnCallback, oSettings) {
                            $.ajax( {
                                "dataType": 'json',
                                "type": "POST",
                                "url": sSource,
                                "data": aoData,
                                  // "success": fnCallback
                                success: function(rs){
                                    fnCallback(rs);
                                }
                            });

                        },
                        "aoColumns": [
                        {
                            "mData": "code",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "code"
                        },
                        {
                            "mData": "codetype",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "codetype"
                        },
                        {
                            "mData": "name",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "name"
                        },
                        {
                            "mData": "category",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "category"
                        },
                        {
                            "mData": "ranking",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "ranking"
                        },
                        {
                            "mData": "info",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                        },
                        {
                            "mData": "action",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string"
                        }
                        ],
                        "sPaginationType": "full_numbers",
                        sDom: '<"block-controls"<"export-buttons"><"controls-buttons"p><"my-buttons">>rti<"block-footer clearfix"lf>',

                        /* Callback to apply template setup*/
                        fnDrawCallback: function()
                        {
                            $(this).slideDown(200);
                            $(".with-tip").tip();
                            var html = '<div style="clear: left;"></div>';
                            $(".my-buttons").html(html);
                            html = '<div style="clear: left;"></div>';
                            $(".export-buttons").html(html);
                            oTable.fnSetFilteringPressEnter();
                        },
                        fnInitComplete: function()
                        {
                            $(this).slideDown(200);
                        }
                    });
                });
            },
            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return documentView = new documentView;
    });
