function setAction(action) {
	 var hdnAction = document.getElementById("hdnAction");
	 hdnAction.value = action;
}
function submitForm(frmId, action) {
	setAction(action);
	frm = document.getElementById(frmId);
	if (null != frm) {
		frm.submit();
	}
}