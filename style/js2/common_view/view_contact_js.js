/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//
//var nameArr = {
//    id: {
//        name: 'ID Contact',
//        type: 'text'
//    },
//    name: {
//        name: 'Họ và tên',
//        type: 'text'
//    },
//    email: {
//        name: 'Email',
//        type: 'text'
//    },
//    price_purchase: {
//        name: 'Giá tiền mua',
//        type: 'currency'
//    },
//    call_status_id: {
//        name: 'Trạng thái gọi',
//        type: 'array'
//    }
//};
//
//$(document).on('click', 'a.action_view_detail_contact', function (e) {
//    e.preventDefault();
//    var url = $("#base_url").val() + "common/view_detail_contact";
//    var contact_id = $(this).attr("contact_id");
//    $.ajax({
//        url: url,
//        type: "POST",
//        data: {
//            contact_id: contact_id
//        },
//        dataType: "json",
//        success: function (data) {
//            var result = gen_result(data);
//            $("div.replace_content_view_detail_contact").html(result);
//        },
//        complete: function () {
//            $(".view_detail_contact_modal").modal("show");
//        }
//    });
//});
//
//function gen_result(data) {
//    var result = `<div class="row real-search-result-replace">`;
//    result += `<div class="col-md-6">
//                    <table class="table table-striped table-bordered table-hover table-view-1">`;
//    for (var prop in data.view_edit_left) {
//        result += v_row(prop, data);
//    }
//    result += `</table></div>`;
//    result += `</div>`;
//    return result;
//}
//
//function v_row(prop, data) {
//    var result = ``;
//    console.log(prop);
//    console.log(nameArr[prop]);
//    result = `<tr>
//                      <td class="text-right"> ` + nameArr[prop]['name'] + `</td>
//                      <td>`;
//    if (nameArr[prop]['type'] === 'text') {
//        result += data['rows'][prop];
//        result += ` <input type="text" class="form-control datepicker date_recall" name="date_recall" />`;
//    }
//    if (nameArr[prop]['type'] === 'currency') {
//        result += digits(data['rows'][prop]) + ' VNĐ';
//    }
//   
//    result += `       </td>
//              </tr>`;
//
//    return result;
//}
//
//function v_call_status(call_status_id1, call_status_arr) {
//    var result = ``;
//    var name = '' + {call_status_id1} + '';
//    $.each(call_status_arr, function () {
//        if (call_status_id1 === this.id) {
//            result = `<tr>
//                        <td class="text-right"> ` + nameArr.name + `</td>
//                        <td> 
//                            ${this.name}
//                        </td>
//                      </tr>`;
//        }
//    });
//    return result;
//}
//
//function e_call_status(call_status_id, call_status_arr) {
//    console.log(call_status_id);
//    var result = `<tr>
//    <td class="text-right"> Trạng thái gọi </td>
//    <td>  
//        <select class="form-control call_status_id selectpicker" name="call_status_id">`;
//    $.each(call_status_arr, function () {
//        result += ` <option value="${this.id}" ${ (this.id === call_status_id) ? 'selected' : '' }>
//                ${ this.name}
//                </option>`;
//    });
//    result += `</select></td></tr>`;
//    return result;
//}
//
//
//function digits(number){ 
//    return number.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ; 
//};
