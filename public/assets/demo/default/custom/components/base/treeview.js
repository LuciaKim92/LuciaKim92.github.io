var selected_init;

var Treeview = {
  init: function (okr_init_id) {
    $("#m_tree_2").jstree({
        "core": {
          "themes" : { "responsive" : false },
          "check_callback": true,
          "data": {
            "url": function (e) {
              var is_saved;
              if (okr_init_id == '') {
                is_saved = 0;
              } else {
                is_saved = okr_init_id;
              }
              
              if(e.id == '#') {
                return "/CaseController/get_okr_depts/" + is_saved;
              } else if (e.type == 'root') {
                return "/CaseController/get_okr_year/" + e.id + "/" + is_saved;
              } else if (e.type == 'year') {
                return "/CaseController/get_okr_quarter/" + e.parent + "/" + e.id + "/" + is_saved;
              } else if (e.type == 'quarter') {
                return "/CaseController/get_okr_list/" + e.parents[1] + "/" + e.parents[0] + "/" + e.id + "/" + is_saved;
              } else {
                if (e.type == 'okr' && e.parents[4] == '#') {
                  return "/CaseController/get_okr_initiatives/" + e.id + "/" + is_saved;
                }
              }
            },
            "data": function (e) {
              return { "id": e.id };
            },
            "dataType": "json"
          },
        },
        "types": {
          "default": { "icon": "fa fa-briefcase m--font-success" },
          "#" : { "valid_children" : ["root"] },
          "root": { "valid_children" : ["year"] },
          "year": { "icon": "fa fa-folder m--font-accent", "valid_children" : ["quarter"] },
          "quarter": { "icon": "fa fa-folder m--font-accent", "valid_children" : ["okr"] },
          "okr": { "icon": "fa fa-copy m--font-metal", "valid_children" : ["okr", "initiatives"] },
          "initiatives": { "icon": "fa fa-file m--font-metal" },
        },
        plugins: ["types"],
      }),
      $("#m_tree_2").on("loaded.jstree", function (event, obj) {
        if(okr_init_id != '') {
          selected_init = okr_init_id;
        }
      }),
      $("#m_tree_2").on("select_node.jstree", function (event, obj) {
        if(obj.node.type == 'initiatives') {
          selected_init = obj.node.id;
        }
        //console.log(obj.node);
      });
  },
};

function jsSubmit(save_tp, code)
{
  //입력 값 가져오기
  var formData = new FormData();
  formData.append('CASE_TP', $("#case_tp").val());
  formData.append('TITLE', $("#title").val());
  formData.append('TARGET', $("#target").val());
  formData.append('COTCOME', $("#result").val());
  formData.append('CONTEXT', $("#context").val());
  formData.append('STRATEGY', $("#strategy").val());
  formData.append('KNOWHOW', $("#knowhow").val());
  formData.append('OKR_INIT_ID', selected_init);
  formData.append('SAVE_TP', save_tp);
  formData.append('CODE', code);

  /*폼 데이터 console log
  for (let key of formData.keys()) {
    console.log(key);
  }
  for (let value of formData.values()) {
    console.log(value);
  }*/
  
  //SweetAlert 메시지
  var msg;
  if (save_tp == 'CREATE') {
    msg = "OKR 사례를 저장하시겠습니까?";
  } else if (save_tp == 'UPDATE') {
    msg = "OKR 사례를 수정하시겠습니까?";
  } else if (save_tp == 'CONFIRM') {
    msg = "OKR 사례 검수를 요청하시겠습니까?";
  } else if (save_tp == 'DELETE') {
    msg = "OKR 사례를 삭제하시겠습니까?";
  } else {
    msg = "OKR 사례를 공유하시겠습니까?";
  }

  //SweetAlert 실행
  swal({
      title: msg,
      text: "",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "예",
      cancelButtonText: "아니오"
    }).then(function (e) {
      if (e.value) {
        //저장,검수,수정,삭제 실행
          $.ajax({
            type : 'POST',
            url : '/CaseController/save_exm_case',
            data : formData,
            contentType: false,
            processData: false,
            success : function(res){
                //console.log(res);
                swal("완료되었습니다.", "", "success").then(function(){
                  document.location = '/CaseController';
                });
            },
            error : function(jqxhr, status, error){
                //console.log(jqxhr, status, error);
                swal("처리 중 오류가 발생했습니다", "", "error");
            }
          });
      } else {
          "cancel" === e.dismiss && swal("취소되었습니다.", "", "error");
      }
    });
}

//초기화 버튼
function jsReset()
{
  $("#m_tree_2").jstree('deselect_all');
  $("#m_tree_2").jstree('close_all');
  $("#case_tp").val("0");
  $("#title").val("")
  $("#target").val("");
  $("#result").val("");
  $("#context").val("");
  $("#strategy").val("");
  $("#knowhow").val("");
}