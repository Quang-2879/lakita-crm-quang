/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

setEqualTableHeight = () => {
    if ($(".table-view-1").height() > $(".table-view-2").height())
    {
        $(".table-view-2").height($(".table-view-1").height());
    } else
    {
        $(".table-view-1").height($(".table-view-2").height());
    }
    if ($(".table-edit-1").height() > $(".table-edit-2").height())
    {
        $(".table-edit-2").height($(".table-edit-1").height());
    } else
    {
        $(".table-view-1").height($(".table-view-2").height());
    }
    if ($(".table-1").height() > $(".table-2").height())
    {
        $(".table-2").height($(".table-1").height());
    } else
    {
        $(".table-1").height($(".table-2").height());
    }
    
     if ($(".table-add-1").height() > $(".table-add-2").height())
    {
        $(".table-add-2").height($(".table-add-1").height());
    } else
    {
        $(".table-add-1").height($(".table-add-2").height());
    }
};
