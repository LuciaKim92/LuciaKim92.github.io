function getCaseList(is_clip) {

    var tableName = is_clip == "0" ? "#m_table_1" : "#m_table_2";

    $(tableName).DataTable({
        'ajax': {
            "url": "/CaseController/get_exm_cases",
            "data": { "IS_CLIP": is_clip },
            "dataSrc": "data",
        },
        'processing': true,
        'serverSide': true,
        'serverMethod': 'POST',
        'autoWidth': false,
        'order': [[6, "desc"]],
        'columns': [
            { data: 'ID' },
            { data: 'CASE_TP' },
            { data: 'TITLE' },
            { data: 'EMP_NM' },
            { data: 'DEPT_NM' },
            { data: 'DEPT_UP_NM' },
            { data: 'DATE' },
            { data: 'EMPY_NO' }
        ],
        'columnDefs': [
            {
                targets: 0,
                title: "ID",
                visible: false,
            },
            {
                targets: 1,
                title: "분류",
                width: 100,
                render: function (a, e, n, s) {
                    var t = [
                        { title: "도전 성공 사례", class: " m-badge--info" },
                        { title: "도전 축적 사례", class: " m-badge--warning" }
                    ];
                    console.log();
                    return '<span style="font-size:0.85rem;" class="m-badge rounded-pill ' + t[a].class +' m-badge--wide">' + t[a].title + "</span>";
                },
            },
            {
                targets: 2,
                title: "제목",
                width: 430,
                render: function (a, e, n, s) {
                    //console.log(n);
                    return (
                    '<a class="m-link" href="/CaseController/case_detail/' + n['ID'] + '">' + a + "</a>"
                    );
                },
            },
            {
                targets: 3,
                title: "이름",
                width: 100,
                render: function (a, e, n, s) {
                    return a;
                },
            },
            {
                targets: 4,
                title: "팀명",
                width: 200,
                render: function (a, e, n, s) {
                    return a;
                },
            },
            {
                targets: 5,
                title: "부서명",
                width: 200,
                render: function (a, e, n, s) {
                    return a;
                },
            },
            {
                targets: 6,
                title: "날짜",
                width: 100,
                render: function (a, e, n, s) {
                    return a;
                },
            },
            {
                targets: 7,
                title: "EMPY_NO",
                visible: false,
            },
            {
                targets: 8,
                title: "",
                width: 100,
                render: function (a, e, n, s) {
                    //console.log(s);

                    return '\n<span class="dropdown">\
                                <a href="#" class="btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true" onclick="getClipList('+ n['ID'] +');">\
                                    <i class="la la-heart"></i>\
                                </a>\
                                <div class="dropdown-menu dropdown-menu-right">\
                                    <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\
                                </div>\
                            </span>\
                            <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill" title="View">\
                                <i class="la la-comments"></i>\
                            </a>';
                },
            },
        ],
    });
}
    /*$.ajax({
        type : 'POST',
        url : '/CaseController/get_exm_cases',
        data : formData,
        dataType: "json",
        contentType: false,
        processData: false,
        complete: function() {
            $(tableName).DataTable(setting);
        },
        success : function(res){
            //console.log(res);
           
            var html;
            res.forEach(function(item, index, arr){
                html += "<tr>\
                            <td>"+item.CASE_TP+"</td>\
                            <td>"+item.TITLE+"</td>\
                            <td>"+item.EMP_NM+"</td>\
                            <td>"+item.DEPT_NM+"</td>\
                            <td>"+item.DEPT_UP_NM+"</td>\
                            <td>"+item.DATE+"</td>\
                            <td>"+item.ID+"</td>\
                            <td nowrap></td>\
                        </tr>";
            });
            $(tableName+'>tbody').append(html);
        },
        error : function(jqxhr, status, error){
            //console.log(jqxhr, status, error);
        }
    });*/

/*
    {
      targets: 1,
      title: "제목",
      render: function (a, e, n, s) {
        return '<a class="m-link" href="#">' + a + "</a>";
      },
    },
    {
      targets: 2,
      title: "Actions",
      orderable: !1,
      render: function (a, e, n, s) {
        return "";
      },
    },
    {
      targets: 3,
      title: "부서",
      render: function (a, e, n, s) {
        
        return void 0 === t[a]
          ? a
          : '<span class="m-badge ' +
              t[a].class +
              ' m-badge--wide">' +
              t[a].title +
              "</span>";
      },
    },
    {
      targets: 4,
      render: function (a, e, n, s) {
        var t = {
          1: { title: "Online", state: "danger" },
          2: { title: "Retail", state: "primary" },
          3: { title: "Direct", state: "accent" },
        };
        return void 0 === t[a]
          ? a
          : '<span class="m-badge m-badge--' +
              t[a].state +
              ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' +
              t[a].state +
              '">' +
              t[a].title +
              "</span>";
      },
    },*/
