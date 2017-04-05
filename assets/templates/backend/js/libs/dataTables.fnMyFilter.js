$.fn.dataTableExt.oApi.fnMyFilter = function(oSettings, sInput, iColumn, bRegex, bSmart) {
    var settings = $.fn.dataTableSettings;
    for ( var i=0 ; i<settings.length ; i++ ) {
      // settings[i].oInstance.fnFilter( sInput, iColumn, bRegex, bSmart);
      settings[i].oInstance.fnFilter('Agricultural', iColumn, bRegex, bSmart);
      settings[i].oInstance.fnFilter('consumption', iColumn, bRegex, bSmart);
    }
};