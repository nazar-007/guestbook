function checkAll(context) {
    $("#guestbook_list input:not(:disabled)[type=checkbox]").prop("checked", context.checked);
}

function checkDeleteBtn() {
    var checkbox_ids = document.getElementsByClassName('checkbox_ids');
    var btnDeleteSubmit = document.getElementById('btnDeleteSubmit');
    btnDeleteSubmit.setAttribute('disabled', 'disabled');

    for (var i = 0; i < checkbox_ids.length; i++) {
        if (checkbox_ids[i].checked) {
            btnDeleteSubmit.removeAttribute('disabled');
            break;
        }
    }
}

function guestbookConfirm() {
    return confirm('Are you sure?');
}