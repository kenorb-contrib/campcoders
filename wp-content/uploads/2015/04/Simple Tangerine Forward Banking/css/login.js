// JavaScript for the Login screens

function focusOnCnField() {
	if (!document.Signin.savedUserIdsExist || ($('#ACN').val() != "") || ($('#cbRemember').is(':checked'))) {
		$('#ACN').focus();
	}
}

function addAnotherNumber() {
	$("#divCNText").show();
	$("#divCNDropDown").hide();
	$("#divSaveNo").show();
	$("#divRemoveNo").hide();
}

function checkAddAnother() {
	if ($("#ddCIF").val() === "addAnother"){
		$("#divCNText").show();
		$("#divCNDropDown").hide();
		$("#divSaveNo").show();
		$("#divRemoveNo").hide();
	}
}

function textCounter(field, cntfield, maxlimit) {
	if (field.val().length > maxlimit) {
		field.val(field.val().substring(0, maxlimit));
	} else {
		cntfield.val(maxlimit - field.val().length);
	}
}
