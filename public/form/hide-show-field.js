$("#seeAnotherField").change(function() {
    if ($(this).val() == "Penagihan utang") {
        $('#otherFieldDiv').show();
        $('#otherField').attr('required','');
        $('#otherField').attr('data-error', 'This field is required.');
    } else {
        $('#otherFieldDiv').hide();
        $('#otherField').removeAttr('required');
        $('#otherField').removeAttr('data-error');				
    }
});
$("#seeAnotherField").trigger("change");

console.log('adas')
