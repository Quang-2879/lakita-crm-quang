/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * loại bỏ phần tử trùng trong mảng
 */
Array.prototype.unique = function () {
    return this.filter(function (elem, index, self) {
        return index == self.indexOf(elem); // lấy chỉ số đầu tiên
    });
};