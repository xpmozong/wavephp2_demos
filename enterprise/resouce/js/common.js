/**
 * js公共方法
 */
 
var KxCommon = new Object({
    resultDataTable : null,
    kxDataTable: function(aoColumns, colspan, url, iDisplayLength, success) {
        if (KxCommon.resultDataTable) {
            $(".datatable").dataTable().fnDestroy();
        }
        $(".datatable tbody").html('<tr><td colspan="'+colspan+'">正在加载中...</td></tr>');
        var opt = {
            "sAjaxSource"       : url,
            "bFilter"           : false,            //是否显示搜索
            "bProcessing"       : false,
            "bServerSide"       : true,
            "bLengthChange"     : false,
            "sPaginationType"   : "full_numbers",
            "iDisplayLength"    : iDisplayLength,
            "bSort"             : false,
            "iDisplayStart"     : 0,
            "bAutoWidth"        :false,
            "aoColumns"         : aoColumns,
            "oLanguage" : {
                "sProcessing"   : "正在加载中......",
                "sZeroRecords"  : "没有数据！",
                "sEmptyTable"   : "表中无数据存在！",
                "sInfo"         : "第 _START_ 至 _END_ 条 (共 _TOTAL_ 条)",
                "sInfoEmpty"    : "显示0到0条记录",
                "oPaginate"     : {
                    "sFirst"    : "第一页",
                    "sPrevious" : "上一页",
                    "sNext"     : "下一页",
                    "sLast"     : "最后一页"
                }
            }
        };

        var success = success || undefined;
        if (undefined != success) {
            opt = $.extend(opt, {
                "fnServerData": function (sSource, aoData, fnRequest, oSettings) {
                    oSettings.jqXHR = $.ajax({
                        "dataType": 'json',
                        "type": "POST",
                        "url": url + '&sEcho=',
                        "data": aoData,
                        "success": function (data) {
                            success(data);
                            fnRequest(data);
                        },
                        "error": function (jqXHR) {
                            console.log(jqXHR.responseText);
                        }
                    });
                }
            });
        }

        if (0 == aoColumns.length) {
            columns = [];
            $(".datatable").find("th").each(function(k,v) {
                columns.push({'mDataProp':$(v).attr('name')});
            });
            opt = $.extend(opt, {
                "aoColumns": columns
            });
        }

        KxCommon.resultDataTable = $(".datatable").dataTable(opt);
    }
});
