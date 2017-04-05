// Filename: views/dividends
define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var vnfdb_demoView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                "click #vndb_documentation_filter button": "goTo_step1",
                "click #vnfdb_methodogy_test_filter button": "goTo_step3",
                "click .wizard-steps a": "showTab",
                "click #calculate": "goTo_step4",
            },

            excute: function(e){
                
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

            goTo_step4: function(event){
                var $this = $(event.currentTarget);
                $this.closest('div .tabDetails').find('#tab5').attr("style", "display: block;");
                $this.closest('div .tabDetails').find('#tab5').addClass("active");
                $this.closest('div .tabDetails').parent().find('#tabContaier').find('li').find('a[href=#tab5]"').find("span").html('5<span class="status-ok"></span>');
                $this.closest('div #tab4').attr("style", "display: none;");
                $this.closest('div .tabDetails').parent().find('#tabContaier').find('li').find('a[href=#tab4]"').find("span").find("span").remove();
               
                $(location).attr("href", $admin_url + "vnfdb_demo/step_by_step#tab5");
            },

            goTo_step3: function(event){
                var $this = $(event.currentTarget);
                var action = $($this).attr("action");
                switch(action){
                    case 'back':
                        $this.closest('div .tabDetails').find('#tab4').attr("style", "display: block;");
                        $this.closest('div .tabDetails').find('#tab4').addClass("active");
                        $this.closest('div .tabDetails').parent().find('#tabContaier').find('li').find('a[href=#tab4]"').find("span").html('4<span class="status-ok"></span>');
                        $this.closest('div #tab3').attr("style", "display: none;");
                        $this.closest('div .tabDetails').parent().find('#tabContaier').find('li').find('a[href=#tab3]"').find("span").find("span").remove();
                       
                        $(location).attr("href", $admin_url + "vnfdb_demo/step_by_step#tab4");
                    break;
                    case 'export':
                        var where = new Array();
                        var order = new Array();
                        var url = location.href;
                        var urls = url.split('/');
                        url = urls[urls.length - 1];
                        var tmp_order = {
                            value: 'date',
                            type: '',
                        }
                        switch(url){
                            case 'latest': tmp_order.type = 'DESC'; break;
                            case 'step_by_step': tmp_order.type = 'DESC'; break;
                            default: tmp_order.type = 'DESC'; break; 
                        }
                        var oSettings = $('#vnfdb_methodogy_test').dataTable().fnSettings();
                        var filter = oSettings.oPreviousSearch.sSearch;
                        if(filter != ''){
                            var headers = new Array();
                            $.each(oSettings.aoColumns, function(key, item){
                                if(item.sName != ''){
                                    headers.push(item.sName);
                                }
                            });
                            tmp_where = {
                                sSearch: filter,
                                headers: headers
                            }
                            where.push(tmp_where);
                        }
                        order.push(tmp_order);
                        exportTable5('vnfdb_methodogy_test', where, order, new Object);
                    break;
                    default:
                        $(location).attr("href", $admin_url + "vnfdb_demo/step_by_step/" + action);
                    break;
                }
            },

            goTo_step1: function(event){
                var $this = $(event.currentTarget);
                var action = $($this).attr("action");
                switch(action){
                    case 'back':
                        $(location).attr("href", $admin_url + "vnfdb_demo");
                    break;
                    case 'export':
                        var where = new Array();
                        var order = new Array();
                        var url = location.href;
                        var urls = url.split('/');
                        url = urls[urls.length - 1];
                        var tmp_order = {
                            value: 'date',
                            type: '',
                        }
                        switch(url){
                            case 'latest': tmp_order.type = 'DESC'; break;
                            case 'step_by_step': tmp_order.type = 'DESC'; break;
                            default: tmp_order.type = 'DESC'; break; 
                        }
                        var oSettings = $('#vndb_documentation').dataTable().fnSettings();
                        var filter = oSettings.oPreviousSearch.sSearch;
                        if(filter != ''){
                            var headers = new Array();
                            $.each(oSettings.aoColumns, function(key, item){
                                if(item.sName != ''){
                                    headers.push(item.sName);
                                }
                            });
                            tmp_where = {
                                sSearch: filter,
                                headers: headers
                            }
                            where.push(tmp_where);
                        }
                        order.push(tmp_order);
                        exportTable5('vndb_documentation', where, order, new Object);
                    break;
                    default:
                        $(location).attr("href", $admin_url + "vnfdb_demo/step_by_step/" + action);
                    break;
                }
            },

            showTab: function(event){
                var $this = $(event.currentTarget);
                var href = $this.attr('href');
                href = href.replace('#','');
                if(check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')){
                    $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                }else{
                    $file = $base_url + 'assets/language/datatables/eng.txt';
                }
                if(href == 'tab1'){
                    vnfdb_demoView.document_table();
                }else if(href == 'tab3'){
                    if(typeof oTable != 'undefined'){
                        $("#vnfdb_methodogy_test").dataTable().fnDestroy();
                    }
                    var url = location.href;
                    oTable = $('#vnfdb_methodogy_test').dataTable({
                        "oLanguage":{
                            "sUrl": $file
                        },
                        "sScrollY": "300px",
                        // "sScrollXInner": "110%",
                        "bScrollCollapse": true,
                        "iDisplayLength": 10,
                        "iDisplayStart": 0,
                        "bProcessing": true,
                        "bRetrieve": true,
                        "aaSorting": [],
                        "bAutoWidth": true,
                        "bServerSide": true,
                        "sAjaxSource": $admin_url + "vnfdb_demo/process_test",
                        "bPaginate": false,
                        "fnServerData": function(sSource, aoData, fnCallback, oSettings) {
                            aoData.push( { "name": "step", "value": "2" } );
                            $.ajax( {
                                "dataType": 'json',
                                "type": "POST",
                                "url": sSource,
                                "data": aoData,
                                success: function(rs){
                                    fnCallback(rs);
                                }
                            });
                        },
                        "aoColumns": [
                            {
                                "mData": "check",
                                "sType": "string",
                                "sWidth": "2%",
                                "sClass": "string",
                                "sName": "check"
                            },
                            {
                                "mData": "topic",
                                "sType": "string",
                                "sWidth": "12%",
                                "sClass": "string",
                                "sName": "topic"
                            },
                            {
                                "mData": "category",
                                "sType": "string",
                                "sWidth": "12%",
                                "sClass": "string",
                                "sName": "category"
                            },
                            {
                                "mData": "test",
                                "sType": "string",
                                "sWidth": "25%",
                                "sClass": "string",
                                "sName": "test"
                            },
							{
                                "mData": "type",
                                "sType": "string",
                                "sWidth": "10%",
                                "sClass": "string",
                                "sName": "test"
                            },
							{
                                "mData": "date",
                                "sType": "string",
                                "sWidth": "8%",
                                "sClass": "string",
                                "sName": "test"
                            },
                            {
                                "mData": "action",
                                "sType": "string",
                                "sWidth": "15%",
                                "sClass": "string",
                                "sName": "action"
                            },
                            {
                                "mData": "difficulty",
                                "sType": "string",
                                "sWidth": "10%",
                                "sClass": "string",
                                "sName": "difficulty"
                            },
                            
                        ],
                        //sDom: '<"block-controls"<"controls-buttons"p>>rti<"block-footer clearfix"lf>',
                        //sDom: '<"block-controls"<"export-buttons"><"controls-buttons"p><"my-buttons">>rti<"block-footer clearfix"lf>',
                        sDom: '<"block-controls"<"controls-buttons"p><"my-buttons"lf>>rti',
                        /* Callback to apply template setup*/
                        fnDrawCallback: function(){
                            $(this).slideDown(200);
                            $(".with-tip").tip();
                            $("#vnfdb_methodogy_test_filter").find("div").remove();
                            html = '<div style="float:left; margin:10px 5px;"><span>Keyword:</span></div> ';
                            $("#vnfdb_methodogy_test_filter").prepend(html);
                            html = ' <div style="float:left;"><a href="javascript: void(0);" id="submit">Search</a> ' + 
                                '<button type="button" id="later" action="latest" class="red">Latest</button></div> '+
                                '<div style="float:right;"><button type="button" id="back" action="back">Selection</button> ' +
                                '</div>';
                            $("#vnfdb_methodogy_test_filter").append(html);

                            $("#vnfdb_methodogy_test_filter").find("input").attr({'placeholder':'Type Topic','id':'autocomplete'});
                            $(document).on( "click", "#submit", function(){
                                oTable.fnFilter($("#vnfdb_methodogy_test_filter").find("input").val());
                            });
                            oTable.fnSetFilteringPressEnter();
                            $.ajax({
                                url: $admin_url+'vnfdb_demo/autocomplete',
                                data: 'step=3',
                                type: 'post',
                                dataType: 'json',
                                async: false,
                                success: function(rs){
                                    var availableAuto = rs;
                                    function split( val ) {
                                        return val.split( /,\s*/ );
                                    }
                                    function extractLast( term ) {
                                        return split( term ).pop();
                                    }
                                 
                                    $( "#autocomplete" )
                                  // don't navigate away from the field on tab when selecting an item
                                    .bind( "keydown", function( event ) {
                                        if ( event.keyCode === $.ui.keyCode.TAB &&
                                            $( this ).data( "ui-autocomplete" ).menu.active ) {
                                            event.preventDefault();
                                        }
                                    })
                                    .autocomplete({
                                        minLength: 0,
                                        source: function( request, response ) {
                                          // delegate back to autocomplete, but extract the last term
                                          response( $.ui.autocomplete.filter(
                                            availableAuto, extractLast( request.term ) ) );
                                        },
                                        focus: function() {
                                          // prevent value inserted on focus
                                          return false;
                                        }
                                    });
                                }
                            });
                        },
                        fnInitComplete: function(){
                            $(this).slideDown(200);
                        }
                    });
                }
            },

            document_table: function(){
                if(typeof oTable != 'undefined'){
                    $("#vndb_documentation").dataTable().fnDestroy();
                }
                var url = location.href;
                oTable = $('#vndb_documentation').dataTable({
                    "oLanguage":{
                        "sUrl": $file
                    },
                    "sScrollY": "300px",
                    // "sScrollXInner": "110%",
                    "bScrollCollapse": true,
                    "iDisplayLength": 10,
                    "iDisplayStart": 0,
                    "bProcessing": true,
                    "bRetrieve": true,
                    "aaSorting": [],
                    "bAutoWidth": true,
                    "bServerSide": true,
                    "sAjaxSource": $admin_url + "vnfdb_demo/process_document",
                    "bPaginate": false,
                    "fnServerData": function(sSource, aoData, fnCallback, oSettings) {
                        aoData.push( { "name": "step", "value": "1" } );
                        $.ajax( {
                            "dataType": 'json',
                            "type": "POST",
                            "url": sSource,
                            "data": aoData,
                            success: function(rs){
                                fnCallback(rs);
                            }
                        });
                    },
                    "aoColumns": [
                        {
                            "mData": "check",
                            "sType": "string",
                            "sWidth": "2%",
                            "sClass": "string",
                            "sName": "check"
                        },
                        {
                            "mData": "title",
                            "sType": "string",
                            "sWidth": "20%",
                            "sClass": "string",
                            "sName": "title"
                        },
                        {
                            "mData": "authors",
                            "sType": "string",
                            "sWidth": "12%",
                            "sClass": "string",
                            "sName": "authors"
                        },
                        {
                            "mData": "journal",
                            "sType": "string",
                            "sWidth": "12%",
                            "sClass": "string",
                            "sName": "journal"
                        },
                        {
                            "mData": "reference",
                            "sType": "string",
                            "sWidth": "10%",
                            "sClass": "string",
                            "sName": "reference"
                        },
                        {
                            "mData": "date",
                            "sType": "string",
                            "sWidth": "2%",
                            "sClass": "string",
                            "sName": "date"
                        },
                        {
                            "mData": "action",
                            "sType": "string",
                            "sWidth": "15%",
                            "sClass": "string",
                            "sName": "action"
                        },
                        {
                            "mData": "recommandation",
                            "sType": "string",
                            "sWidth": "2%",
                            "sClass": "string",
                            "sName": "recommandation"
                        },
                        
                    ],
                    //sDom: '<"block-controls"<"controls-buttons"p>>rti<"block-footer clearfix"lf>',
                    //sDom: '<"block-controls"<"export-buttons"><"controls-buttons"p><"my-buttons">>rti<"block-footer clearfix"lf>',
                    sDom: '<"block-controls"<"controls-buttons"p><"my-buttons"lf>>rti',
                    /* Callback to apply template setup*/
                    fnDrawCallback: function(){
                        $(this).slideDown(200);
                        $(".with-tip").tip();
                        $("#vndb_documentation_filter").find("div").remove();
                        html = '<div style="float:left; margin:10px 5px;"><span>Keyword:</span></div> ';
                        $("#vndb_documentation_filter").prepend(html);
                        html = ' <div style="float:left;"><a href="javascript: void(0);" id="submit">Search</a> ' + 
                            '<button type="button" id="later" action="latest" class="red">Latest</button></div> '+
                            '<div style="float:right;">' +
                            '<ul class="controls-buttons" style="margin-top:5px;">'+
                                '<li>'+
                                    '<a class="with-tip" type="button" action="export" style="cursor: pointer">Export</a>'+
                                '</li>'+
                            '</ul></div>';
                        $("#vndb_documentation_filter").append(html);

                        $("#vndb_documentation_filter").find("input").attr({'placeholder':'Type Title','id':'autocomplete_step3'});
                        $(document).on( "click", "#submit", function(){
                            oTable.fnFilter($("#vndb_documentation_filter").find("input").val());
                        });
                        oTable.fnSetFilteringPressEnter();
                        $.ajax({
                            url: $admin_url+'vnfdb_demo/autocomplete',
                            type: 'post',
                            data: 'step=1',
                            dataType: 'json',
                            async: false,
                            success: function(rs){
                                var availableAuto = rs;
                                function split( val ) {
                                    return val.split( /,\s*/ );
                                }
                                function extractLast( term ) {
                                    return split( term ).pop();
                                }
                             
                                $( "#autocomplete_step3" )
                              // don't navigate away from the field on tab when selecting an item
                                .bind( "keydown", function( event ) {
                                    if ( event.keyCode === $.ui.keyCode.TAB &&
                                        $( this ).data( "ui-autocomplete" ).menu.active ) {
                                        event.preventDefault();
                                    }
                                })
                                .autocomplete({
                                    minLength: 0,
                                    source: function( request, response ) {
                                      // delegate back to autocomplete, but extract the last term
                                      response( $.ui.autocomplete.filter(
                                        availableAuto, extractLast( request.term ) ) );
                                    },
                                    focus: function() {
                                      // prevent value inserted on focus
                                      return false;
                                    }
                                });
                            }
                        });
                    },
                    fnInitComplete: function(){
                        $(this).slideDown(200);
                    }
                });
            },
            
            step_by_step: function(){
                var pathname = window.location.href;
                pathname = pathname.split("#");
                window.history.pushState("", "", pathname[0]);
                if(check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')){
                    $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                }else{
                    $file = $base_url + 'assets/language/datatables/eng.txt';
                }
                vnfdb_demoView.document_table();
            },

            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return vnfdb_demoView = new vnfdb_demoView;
    });
