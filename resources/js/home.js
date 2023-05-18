function checked() {
    var checkBoxes = document.getElementsByClassName("checkBoxes");
    for (let i = 0; i<checkBoxes.length; i++){
        if (checkBoxes[i].checked){
            console.log(checkBoxes[i].value);
        }
    }
}
