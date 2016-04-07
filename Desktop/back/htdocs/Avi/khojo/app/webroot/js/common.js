function validateChk(frmName, action)
{

    var frm_length = document.forms[frmName].elements.length;
    var chk_length = 0;
    var chk_total = 0;


    for (i = 0; i < frm_length; i++)
    {
        if (document.forms[frmName].elements[i].type == "checkbox")
        {
            if (document.forms[frmName].elements[i].checked && document.forms[frmName].elements[i].name != "chkbox_n")
                chk_length++;
            else
                chk_total++;
        }
    }

    if (chk_length == 0)
    {
        jAlert("Please select at least one checkbox", "Alert");
        return false;
    }
    else
    {
        if (action == "delete") {
            jConfirm('Are you sure you want to delete this record?', 'Confirm Delete', function(r) {
                if (r) {
                    document.forms[frmName].submit();
                    return true;
                }
            }
            );

            return false;
        }
        if (action == "activate") {
            jConfirm('Are you sure you want to activate selected record(s)?', 'Confirm Activate', function(r) {
                if (r) {
                    document.forms[frmName].submit();
                    return true;
                }
            }
            );

            return false;
        }

        if (action == "inactivate") {
            jConfirm('Are you sure you want to deactivate selected record(s)?', 'Confirm Deactivate', function(r) {
                if (r) {
                    document.forms[frmName].submit();
                    return true;
                }
            }
            );

            return false;
        }


    }
    return true;
}
function confirm_delete(x) {
    jConfirm('Are you sure you want to delete this record?', 'Confirm Delete', function(r) {
        if (r) {
            window.location = jQuery(x).attr('href');
        }
    }
    );
    return false;
}